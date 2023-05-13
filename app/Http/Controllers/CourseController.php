<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderByDesc('id')->get();
        return view('client.courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with([
            'modules.lessons' =>  fn($query) => $query->withExists('accessThisUser'), 'accessCourseThisUser'])
            ->withExists('accessCourseThisUser')
            ->findOrFail($id);
        return view('client.courses.show', compact('course'));
    }
}
