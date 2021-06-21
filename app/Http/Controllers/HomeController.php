<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'books' => Book::latest()->limit(6)->get()
        ]);
    }

    public function show(Request $request,$id)
    {
        return view('pages.detail', [
            'book' => Book::find($id)
        ]);
    }
}
