<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SearchTransaction extends Component
{
    use WithPagination;

    public  $search;

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];

    public function render()
    {
        $transactions = Transaction::latest()->with('borrow_books')->simplePaginate(10);

        if ($this->search !== null) {
            $transactions = Transaction::where('transaction_code', 'like', '%' . $this->search . '%')
                            ->latest()
                            ->simplePaginate(10);
        }

        return view('livewire.components.search-transaction',[
            'transactions' => $transactions
        ]);
    }
}
