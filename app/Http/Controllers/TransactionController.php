<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Book;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = [];
        if(Auth::user()->position == "member"){
            $transactions = Transaction::where('member_id',Auth::user()->id)->latest()->with('borrow_books')->get();
        }

        return view('librarian.transaction.index',[
            'transactions' => $transactions
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::where('id',$id)->with('borrow_books')->first();
        $books = Book::whereIn('id',json_decode($transaction->borrow_book_id))->get();
        return view('librarian.transaction.details',[
            'transaction' => $transaction,
            'books' => $books,
            'transaction_id' => $id
        ]);
    }

    public function returnBook($id)
    {
        return view('librarian.transaction.return-book', [
            'transaction_id' => $id
        ]);
    }
}
