<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'subject'
    ];

    protected $hidden = [
        'password',
    ];
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function subjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

}
