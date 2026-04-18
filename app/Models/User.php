<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'npm',
        'username',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: User memiliki banyak Loan
    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_npm', 'npm');
    }
}