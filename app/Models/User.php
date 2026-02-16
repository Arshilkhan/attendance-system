<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';   // your existing table

    protected $primaryKey = 'id';

    public $timestamps = false;   // you don't have updated_at

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'subject_code'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

}
