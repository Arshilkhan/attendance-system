<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('roll_no')->get();
        return view('students.index', compact('students'));
    }
    public function myAttendance()
    {
        $student = auth()->user()->student;

        return view('student.attendance', compact('student'));
    }

}