<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    use HasFactory;

    protected $table = "borrow_books";

    protected $fillable = [
        'transaction_id',
        'book_id',
        'return_date',
        'renewal_date',
        'actual_return',
        'sanction'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
