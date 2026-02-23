<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $table = 'teacher_subjects';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subject_code',
        'class_name'
    ];
}