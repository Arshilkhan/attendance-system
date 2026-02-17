<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentApiController extends Controller
{
    // Fetch classes for dropdown
    public function classes()
    {
        $classes = DB::table('students')
            ->select('class_name')
            ->distinct()
            ->orderBy('class_name')
            ->pluck('class_name');

        return response()->json($classes);
    }

    // Fetch students (filter + search)
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->class) {
            $query->where('class_name', $request->class);
        }

        if ($request->search) {
            $query->where('full_name', 'ILIKE', '%' . $request->search . '%');
        }

        $students = $query->orderBy('roll_no')->get();

        return view('students.table', compact('students'));
    }
}
