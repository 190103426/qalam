<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAccessCourse;
use App\Services\AccessLessonService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $courses = Course::inRandomOrder()->take(6)->get();
        $questions = Question::get();
        return view('client/index', compact('courses', 'questions'));
    }
}
