<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    protected $table = 'bookshelfs';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

    // Relasi: Bookshelf memiliki banyak Book
    public function books()
    {
        return $this->hasMany(Book::class, 'bookshelf_id');
    }
}