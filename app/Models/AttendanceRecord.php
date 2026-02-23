<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $table = 'attendance_records';
    public $timestamps = false;

    protected $fillable = [
        'subject_code',
        'class_id',
        'date',
        'stud_data',
        'present_count'
    ];

}
