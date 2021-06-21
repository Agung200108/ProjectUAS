<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'author',
        'publisher',
        'responsible_person',
        'publication_year',
        'publication_place',
        'description',
        'edition',
        'gmd',
        'call_number',
        'language',
        'subject',
        'amount',
        'cover_file_name',
        'pdf_file_name',
    ];
}
