<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $table = 'loan_detail';

    protected $fillable = [
        'loan_id',
        'book_id',
        'is_return',
    ];

    // Relasi: LoanDetail milik satu Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    // Relasi: LoanDetail milik satu Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // Relasi: LoanDetail memiliki satu Return
    public function return()
    {
        return $this->hasOne(ReturnModel::class, 'loan_detail_id');
    }
}