<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'roll_no';
    public $timestamps = false;

    protected $fillable = [
        'roll_no',
        'prn_no',
        'full_name'
    ];
}
