<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;

Route::get('/', [HomeController::class,'index'])->name('/');
Route::get('/book-details/{id}', [HomeController::class,'show']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard',[DashboardController::Class,'index'])->name('dashboard');
    Route::get('/transactions',[TransactionController::Class,'index'])->name('transactions');
    Route::get('/transactions/{id}',[TransactionController::Class,'show']);
});

Route::middleware(['auth:sanctum', 'verified', 'librarian'])->group(function () {
    Route::get('/books',[BookController::Class,'index'])->name('books');
    Route::get('/transactions/return-book/{id}',[TransactionController::Class,'returnBook']);
});