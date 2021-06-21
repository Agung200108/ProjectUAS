<?php

namespace App\Http\Livewire\Librarian\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Jenssegers\Date\Date;

class ReturnBook extends Component
{
    public  $transaction_id,
            $borrowed_book_id,
            $transaction,
            $books,
            $user,
            $sanction = [],
            $now,
            $return_modal = false,
            $renewal_modal = false;

    public function mount($id)
    {
        $this->transaction_id = $id;
    }

    public function render()
    {
        $this->transaction = Transaction::where('id',$this->transaction_id)->with('borrow_books')->first();
        $this->books = Book::whereIn('id',json_decode($this->transaction->borrow_book_id))->get();
        $this->user = User::find($this->transaction->member_id);
        $this->now = date("Y-m-d");

        // check how many penalties member get from each book
        foreach ($this->transaction->borrow_books as $key => $book) {
            $lateness = Date::parse($book->return_date)->timespan($this->now);
            $return_date = $book->return_date;
            $actual_return = $this->now;

            // tahun
            if(explode('-',$return_date)[0] == explode('-',$actual_return)[0]){
                // bulan
                if(explode('-',$return_date)[1] == explode('-',$actual_return)[1]){
                    // hari
                    if(explode('-',$return_date)[2] == explode('-',$actual_return)[2]){
                        array_push($this->sanction, 0);
                    }else{
                        $return_day = (int)explode('-',$return_date)[2];
                        $actual_return_day = (int)explode('-',$actual_return)[2];
                        if($return_day >= $actual_return_day){
                            array_push($this->sanction, 0);
                        }else{
                            array_push($this->sanction,($actual_return_day - $return_day) * 1000);
                        }
                    }
                }else{
                    $return_month = (int)explode('-',$return_date)[1];
                    $actual_return_month = (int)explode('-',$actual_return)[1];
                    
                    if($return_month >= $actual_return_month){
                        array_push($this->sanction, 0);
                    }else{
                        $total_array = explode(',',$lateness);
                        if(count($total_array) == 2){
                            $bulan = explode(' ',data_get($total_array,0));
                            $bulan = (int)data_get($bulan,0) * 30;
                            $minggu = explode(' ',data_get($total_array,1));
                            $minggu = (int)data_get($minggu,1) * 7;
                            $hari = $bulan + $minggu;
                            $denda = $hari * 1000;
                            array_push($this->sanction,$denda);
                        }else if(count($total_array) == 1){
                            $minggu = explode(' ',data_get($total_array,0));
                            $minggu = (int)data_get($minggu,0) * 7;
                            $denda = $minggu * 1000;
                            array_push($this->sanction,$denda);
                        }
                    }
                }
            }else{
                dd("tahunan nehhh");
            }
            
        }

        return view('livewire.librarian.transaction.return-book');
    }

    public function returnBook($id,$sanction,$book_id)
    {
        DB::beginTransaction();
        try {
            BorrowBook::find($id)->update([
                'actual_return' => $this->now,
                'sanction' => $sanction
            ]);

            // return amount of book
            $book = Book::find($book_id);
            $book->amount = $book->amount + 1;
            $book->save();
            
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            session()->flash('errMessage', 'Tidak dapat mengembalikan buku, harap hubungi tim developer aplikasi');
            return;
        }
        session()->flash('message', 'buku berhasil dikembalikan');
        $this->closeReturnModal();
    }

    public function openReturnModal()
    {
        $this->return_modal = true;
    }

    public function closeReturnModal()
    {
        $this->return_modal = false;
    }

    public function openRenewalModal()
    {
        $this->renewal_modal = true;
    }

    public function closeRenewalModal()
    {
        $this->renewal_modal = false;
    }

    public function renewalBook($data)
    {        
        if($data['renewal_date'] == ""){
            session()->flash('errMessage', 'isi terlebih dahulu tanggal pengembaliannya');
            return;
        }
        $result = BorrowBook::find($data['borrowed_book_id'])->update(['renewal_date' => $data['renewal_date']]);
        if($result != "1"){
            session()->flash('errMessage', 'Tidak tidak dapat pemperpanjang peminjaman');
            $this->closeRenewalModal();
            return;
        }
        session()->flash('message', 'Berhasil melakukan perpanjangan');
        $this->closeRenewalModal();
    }
}
