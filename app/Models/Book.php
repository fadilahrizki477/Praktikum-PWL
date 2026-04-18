<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'cover',
        'bookshelf_id',
    ];

    // Relasi: Book milik satu Bookshelf
    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id');
    }

    // Relasi: Book memiliki banyak LoanDetail
    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class, 'book_id');
    }
}