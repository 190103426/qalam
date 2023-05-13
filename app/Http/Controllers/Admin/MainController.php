<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $coursesCount = Course::count();
        $usersCount = User::count();
        return view('admin.index', compact('coursesCount', 'usersCount'));

    }
}
