<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'librarian_id',
        'borrow_book_id',
        'borrow_date',
        'status',
        'transaction_code'
    ];

    public function borrow_books()
    {
        return $this->hasMany(BorrowBook::class);
    }
}
