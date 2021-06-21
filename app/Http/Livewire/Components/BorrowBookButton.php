<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class BorrowBookButton extends Component
{

    public $bookID,
            $storedData;

    public function mount($bookID)
    {
        $this->bookID = $bookID;
    }

    public function render()
    {
        return view('livewire.components.borrow-book-button');
    }

    public function addToCart(Request $request)
    {
        if(Auth::user() == null){
            return redirect('/register');
        }

        if(session('bookID')){
            $result = Arr::where(session('bookID'), function ($value, $key) {
                return $value == $this->bookID;
            });

            if(count($result) != 0){
                session()->flash('errMessage','buku sudah di dalam penanda buku');
                return;
            }
        }
        $request->session()->push('bookID',$this->bookID);
        $this->storedData = $request->session()->get('bookID');
        session()->flash('message','Dimasukan kedalam penanda buku');
    }
}
