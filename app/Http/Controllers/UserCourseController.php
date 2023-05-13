<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = Course::whereHas( 'accessCourses', fn($query) => $query->where('user_id', $user->id))
            ->get();
        return view('client.user.courses', compact('courses'));
    }
}
