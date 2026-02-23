<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceApiController extends Controller
{
    public function subjects()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return DB::table('subject')->get();
        }

        return DB::table('teacher_subjects')
            ->join('subject', 'subject.subject_code', '=', 'teacher_subjects.subject_code')
            ->where('teacher_subjects.user_id', $user->id)
            ->select('subject.*')
            ->get();
    }


    public function classes()
    {
        return DB::table('class_')
            ->select('class_id', 'class_name')
            ->orderBy('class_name')
            ->get();
    }




    public function studentsByClass(Request $request)
    {
        return DB::table('students')
            ->where('class_id', $request->class_id)
            ->orderBy('roll_no')
            ->get();
    }

    public function save(Request $request)
    {
        DB::table('attendance_records')->insert([
            'subject_code' => $request->subject_code,
            'class_id' => $request->class_id,
            'date' => $request->date,
            'stud_data' => $request->attendance,
            'present_count' => substr_count($request->attendance, '-p'),
        ]);
        return response()->json(['message' => 'Attendance Saved']);
    }
}
