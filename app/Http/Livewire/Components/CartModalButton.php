<?php

namespace App\Http\Livewire\Components;

use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\BorrowBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartModalButton extends Component
{
    public  $modal = false,
            $cartBooks = [],
            $borrow_date,
            $return_date,
            $transaction;

    public function render()
    {
        $this->borrow_date = date("Y/m/d");
        if(session('bookID')){
            $this->cartBooks = Book::whereIn('id',session('bookID'))->get();
        }
        return view('livewire.components.cart-modal-button');
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
    }

    public function removeBook(Request $request,$index)
    {
        // ambil data session
        $session_data = session('bookID');

        // ubah data dari session 
        Arr::pull($session_data, $index);

        // rapihkan array
        $session_data = Arr::flatten($session_data);

        // menghapus session buku
        $request->session()->forget('bookID');
        
        // buat baru session buku dengan data baru
        $request->session()->put('bookID',$session_data);

        // refresh
        $this->render();
    }

    public function store(Request $request,$inputs)
    {
        if(count($inputs) == 0){
            session()->flash('errMessage','pilih buku terlebih dahulu');
            return;
        }

        // validation
        for ($i=0; $i < count($inputs); $i++) { 
            if($inputs['return_date'.$i] == "") {
                session()->flash('errMessage','isi tanggal pengembalian setiap buku');
                return;
            }
        }

        DB::beginTransaction();
        try {
            $transaction_code = Str::upper(Str::random(10).rand(1,10));
            // store transaction data
            Transaction::create([
                'member_id' => Auth::user()->id,
                'borrow_book_id' => json_encode(session('bookID')),
                'borrow_date' => $this->borrow_date,
                'transaction_code' => $transaction_code,
            ]);

            $this->transaction = Transaction::where('transaction_code', $transaction_code)->first();

            // store borrow books data
            for ($i=0; $i < count($inputs); $i++) { 
                BorrowBook::create([
                    'transaction_id' => $this->transaction->id,
                    'book_id' => session('bookID')[$i],
                    'return_date' => $inputs['return_date'.$i]
                ]);
            }

            // update stock of book
            $books = Book::whereIn('id', json_decode($this->transaction->borrow_book_id))->get();
            for ($i=0; $i <count($books) ; $i++) { 
                Book::find($books[$i]->id)->update([
                    'amount' => $books[$i]->amount -= 1
                ]);
            }

            $request->session()->forget('bookID');
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            session()->flash('errMessage','Gagal melakukan checkout, coba lagi atau segera hubungi pustakawan');
            DB::rollback();
            return;
        }
        return redirect()->to('transactions/'.$this->transaction->id);
    }
}
