<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class GlobalSearch extends Component
{
    use WithPagination;

    public  $search,
            $fastSearch = false;

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];

    public function render()
    {
        $books = [];
        if ($this->search !== null) {
            $books = Book::where('title','like', '%' . $this->search . '%')
                            ->orWhere('isbn','like', '%' . $this->search . '%')
                            ->orWhere('author','like', '%' . $this->search . '%')
                            ->latest()
                            ->simplePaginate(12);
        }

        if($this->fastSearch){
            $books = Book::where('subject','like', '%' . $this->search . '%')
                            ->latest()
                            ->simplePaginate(12);
        }

        return view('livewire.components.global-search',[
            'books' => $books
        ]);
    }

    public function fastSearchSubject($subject)
    {
        $this->search = $subject;
        $this->fastSearch = true;
    }
}
