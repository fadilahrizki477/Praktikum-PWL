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

    public static function getDataBooks(): array
    {
        $books = self::with('bookshelf')->get();
        $data  = [];
        $no    = 1;

        foreach ($books as $book) {
            $data[] = [
                $no++,
                $book->title,
                $book->author,
                $book->year,
                $book->publisher,
                $book->city,
                ($book->bookshelf->code ?? '-') . '-' . ($book->bookshelf->name ?? '-'),
            ];
        }

        return $data;
    }


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
