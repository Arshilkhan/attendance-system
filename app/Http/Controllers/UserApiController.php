<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function current()
    {
        return response()->json(Auth::user());
    }
}
