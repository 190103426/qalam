<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Module\ModuleSaveRequest;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\LessonTask;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    public function index($courseId, Request $request)
    {

        $name = $request->name;

        $course = Course::findOrFail($courseId);
        $modules = Module::when($name, fn($query) => $query->where('name', 'like', "%$name%"))
            ->orderBy('id')
            ->courseBy($courseId)
            ->withCount('lessons')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return view('admin.modules.index', compact('modules', 'course'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('admin.modules.create', compact('course'));
    }

    public function store($courseId, ModuleSaveRequest $request)
    {
        $module = new Module();
        $module->course_id = $courseId;
        $module->name = $request->name;
        $module->save();
        return redirect()->route('admin.modules.index', ['course' => $courseId])->withSuccess(__('message.success.created'));
    }

    public function edit($courseId, $id)
    {
        $module = Module::courseBy($courseId)->with('course')->findOrFail($id);
        return view('admin.modules.edit', compact('module'));
    }

    public function update($courseId, $id, ModuleSaveRequest $request)
    {
        $module = Module::courseBy($courseId)->where('id', $id)->firstOrFail();
        $module->name = $request->name;
        $module->save();
        return redirect()->route('admin.modules.index', $courseId)->withSuccess(__('message.success.saved'));
    }

    public function destroy($courseId, $id)
    {
        $module = Module::with('lessons.questions','lessons.tests')->courseBy($courseId)->where('id', $id)->firstOrFail();

        DB::beginTransaction();
        foreach ($module->lessons as $lesson) {
            foreach ($lesson->tests as $test) {
                $test->userAnswers()->delete();
            }

            if (Storage::disk('public')->exists(LessonTask::FILES_PATH . "/$lesson->id")) {
                Storage::disk('public')->deleteDirectory(LessonTask::FILES_PATH . "/$lesson->id");
            }
            $lesson->comments()->delete();
            $lesson->tasks()->delete();
            $lesson->tests()->delete();
            $lesson->questions()->delete();
            $lesson->accessLesson()->delete();
            $lesson->comments()->delete();
            $path = Lesson::FILES_PATH . $courseId;
            if ($lesson->file_1) {
                FileService::deleteFile($lesson->file_1, $path);
            }
            if ($lesson->file_2) {
                FileService::deleteFile($lesson->file_2, $path);
            }
            if ($lesson->file_3) {
                FileService::deleteFile($lesson->file_3, $path);
            }
            $lesson->questions()->delete();
        }

        $module->lessons()->delete();
        $module->delete();
        DB::commit();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
