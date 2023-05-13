<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseStoreRequest;
use App\Http\Requests\Admin\Course\CourseUpdateRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{

    public function __construct(
        public CourseService $courseService
    )
    {
    }

    public function index(Request $request)
    {

        $name = $request->name;
        $id = $request->id;
        $description = $request->description;

        $courses = Course::when($name, fn($query) => $query->where('name', 'like', "%$name%"))
            ->when($description, fn($query) => $query->where('description', 'like', "%$description%"))
            ->when($id, fn($query) => $query->where('id', $id))
            ->with(['lessons' => fn($query)=>$query->withCount('tasks')])
            ->orderByDesc('id')
            ->withCount('modules')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(CourseStoreRequest $request)
    {
//        $image = $request->file('image');
//        $imageName = rand(1, 99) . time() . '.' . $image->getClientOriginalExtension();
//        $request->image->move(public_path(Course::IMAGE_PATH), $imageName);

        $course = new Course();

        $course = $this->courseService->save($course, $request);
        return redirect()->route('admin.courses.index')->withSuccess(__('message.success.created'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update($id, CourseUpdateRequest $request)
    {
        $course = Course::findOrFail($id);
        $course = $this->courseService->save($course, $request);
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function destroy($id)
    {
        $course = Course::with('modules.lessons')->findOrFail($id);

        DB::beginTransaction();
        $course->accessCourses()->delete();
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                    $lesson->comments()->delete();
                    $lesson->accessLessons()->delete();
            }
            $module->lessons()->delete();
        }
        $course->delete();
        DB::commit();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }

}
