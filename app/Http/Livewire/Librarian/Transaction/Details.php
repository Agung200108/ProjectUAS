<?php

namespace App\Http\Livewire\Librarian\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\BorrowBook;
use Illuminate\Support\Facades\DB;

class Details extends Component
{
    public  $transaction,
            $books,
            $transaction_id,
            $isDelete = false,
            $inactive = false;

    public function mount($id)
    {
        $this->transaction_id = $id;
    }

    public function render()
    {
        $this->transaction = Transaction::where('id',$this->transaction_id)->with('borrow_books')->first();
        foreach ($this->transaction->borrow_books as $key => $book) {
            if($book->actual_return != null && $key == count($this->transaction->borrow_books) - 1){
                Transaction::find($this->transaction_id)->update(['status' => 'inactive']);
            }
        }
        $this->books = Book::whereIn('id',json_decode($this->transaction->borrow_book_id))->get();
        return view('livewire.librarian.transaction.details');
    }

    public function approve()
    {
        try {
            Transaction::where('id', $this->transaction_id)
            ->update([
                'librarian_id' => Auth::user()->id,
                'status' => 'active'
            ]);
            session()->flash('message', 'transaction approved');
        } catch (\Throwable $th) {
            session()->flash('errMessage', 'transaction failed to be approved');
            return;
        }
    }

    public function openDeleteModal()
    {
        $this->isDelete = true;
    }

    public function closeDeleteModal()
    {
        $this->isDelete = false;
    }

    public function delete()
    {
        DB::beginTransaction();

        try {
            Transaction::find($this->transaction_id)->delete();
            BorrowBook::where('transaction_id',$this->transaction_id)->delete();

            // update amount of book
            $books = $this->transaction->borrow_books;
            foreach ($books as $key => $book) {
                if($book->actual_return != null){
                session()->flash('errMessage', 'The transaction cannot be deleted, because the book has already been returned');
                DB::rollback();
                return;
                }else{
                    Book::find($book->book_id)->update([
                        'amount' => $book->amount += 1
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            session()->flash('errMessage', 'transactions cannot be deleted, something is wrong');
            return;
        }

        session()->flash('message', 'transaction is deleted');
        return redirect()->to('/transactions');
    }
}