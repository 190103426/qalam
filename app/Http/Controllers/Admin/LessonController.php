<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lesson\LessonStoreRequest;
use App\Http\Requests\Admin\Lesson\LessonUpdateRequest;
use App\Models\Lesson;
use App\Models\LessonTask;
use App\Models\Module;
use App\Services\FileService;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LessonController extends Controller
{
    public function __construct(public LessonService $lessonService)
    {
    }

    public function index($courseId, $moduleId)
    {
//        if (!$request->course_id) {
//            return redirect()->route('admin.courses.index')->withErrors([
//                'lesson' => 'Курстар тізімінен сабақтар батырмасын басыңыз'
//            ]);
//        }
        $module = Module::with(['lessons' => fn($query)=>$query->withCount('tasks', 'questions'), 'course'])
            ->courseBy($courseId)
            ->findOrFail($moduleId);
        return view('admin.lessons.index', compact( 'module'));
    }

    public function create($courseId, $moduleId)
    {
//        if (!$request->course_id) {
//            return redirect()->route('admin.courses.index')->withErrors([
//                'lesson' => 'Курстар тізімінен сабақтар батырмасын басыңыз'
//            ]);
//        }

        $module = Module::courseBy($courseId)
            ->with('course')
            ->findOrFail($moduleId);
        return view('admin.lessons.create', compact('module'));
    }

    public function store($courseId, $moduleId, LessonStoreRequest $request)
    {
//        if (!$request->course_id) {
//            return redirect()->route('admin.courses.index')->withErrors([
//                'lesson' => 'Курстар тізімінен сабақтар батырмасын басыңыз'
//            ]);
//        }
        $module = Module::courseBy($courseId)->findOrFail($moduleId);

        $lesson = new Lesson();
        $lesson->module_id = $module->id;
        $lesson = $this->lessonService->save($lesson,$module, $request);

        return redirect()->route('admin.lessons.index', ['course' => $courseId, 'module' => $moduleId])
            ->withSuccess(__('message.success.created'));
    }

    public function edit($courseId, $moduleId, $id)
    {
        $module = Module::courseBy($courseId)->with('course')->findOrFail($moduleId);
        $lesson = Lesson::findOrFail($id);
        return view('admin.lessons.edit', compact('lesson','module'));
    }

    public function update($courseId, $moduleId, $id, LessonUpdateRequest $request)
    {
        $lesson = Lesson::moduleBy($moduleId)->with('module')->findOrFail($id);
        $lesson = $this->lessonService->save($lesson,$lesson->module, $request);
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function deleteFile($courseId, $moduleId, $id, $number)
    {
        $lesson = Lesson::moduleBy($moduleId)->findOrFail($id);
        $path = Lesson::FILES_PATH . $courseId ;
        switch ($number) {
            case 1:
            {
                $lesson->file_1 = FileService::deleteFile($lesson->file_1, $path);
                break;
            }
            case 2:
            {
                $lesson->file_2 = FileService::deleteFile($lesson->file_2, $path);
                break;
            }
            case 3:
            {
                $lesson->file_3 = FileService::deleteFile($lesson->file_3, $path);
                break;
            }
        }
        $lesson->save();
        return redirect()->back()->withSuccess('Материал сәтті жойылды');
    }

    public function destroy($courseId, $moduleId, $id)
    {
        $lesson = Lesson::moduleBy($moduleId)->with('tests')->findOrFail($id);

        DB::beginTransaction();
        foreach ($lesson->tests as $test) {
            $test->userAnswers()->delete();
        }

        if (Storage::disk('public')->exists(LessonTask::FILES_PATH . "/$lesson->id")) {
            Storage::disk('public')->deleteDirectory(LessonTask::FILES_PATH . "/$lesson->id");
        }
        $lesson->comments()->delete();
        $lesson->tasks()->delete();
        $lesson->tests()->delete();
        DB::select('DELETE FROM `user_lesson_test_answers` WHERE  NOT EXISTS(SELECT * FROM `user_lesson_tests` WHERE  user_lesson_tests.`uuid` = user_lesson_test_answers.test_uuid)');
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
        $lesson->delete();
        DB::commit();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
