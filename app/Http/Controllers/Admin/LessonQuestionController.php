<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Lesson\LessonQuestionSaveRequest;
use App\Models\Lesson;
use App\Models\LessonQuestion;
use App\Models\Module;

class LessonQuestionController extends Controller
{
    public function index($courseId, $moduleId, $lessonId)
    {
        $lesson = Lesson::with(['questions', 'module.course'])
            ->moduleBy($moduleId)
            ->findOrFail($lessonId);
        return view('admin.lessons.questions.index', compact('lesson'));
    }


    public function create($courseId, $moduleId, $lessonId)
    {
        $lesson = Lesson::with(['module.course'])
            ->moduleBy($moduleId)
            ->findOrFail($lessonId);
        return view('admin.lessons.questions.create',compact('lesson'));
    }

    public function edit($courseId, $moduleId, $lessonId, $questionId)
    {
        $lesson = Lesson::with(['module.course'])
            ->moduleBy($moduleId)
            ->findOrFail($lessonId);
        $question = LessonQuestion::lessonBy($lessonId)->findOrFail($questionId);
        return view('admin.lessons.questions.edit', compact('question', 'lesson'));
    }

    public function update($courseId, $moduleId, $lessonId, $questionId, LessonQuestionSaveRequest $request)
    {
        $module = Module::courseBy($courseId)->findOrFail($moduleId);
        $question = LessonQuestion::lessonBy($lessonId)->findOrFail($questionId);
        $question->text = $request->text;
        $question->answer_1 = $request->answer_1;
        $question->answer_2 = $request->answer_2;
        $question->answer_3 = $request->answer_3;
        // $question->answer_4 = $request->answer_4;
        // $question->answer_5 = $request->answer_5;
        $question->current_answer_number = $request->current_answer_number;
        $question->save();
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function store($courseId, $moduleId, $lessonId, LessonQuestionSaveRequest $request)
    {
        $lesson = Lesson::moduleBy($moduleId)->findOrFail($lessonId);
        $question = new LessonQuestion();
        $question->text = $request->text;
        $question->answer_1 = $request->answer_1;
        $question->answer_2 = $request->answer_2;
        $question->answer_3 = $request->answer_3;
        // $question->answer_4 = $request->answer_4;
        // $question->answer_5 = $request->answer_5;
        $question->current_answer_number = $request->current_answer_number;
        $lesson->questions()->save($question);
        $question->save();
        return redirect()->route('admin.lessons.questions.index', [
            'course' => $courseId,
            'module' => $moduleId,
            'lesson' => $lessonId
        ])->withSuccess(__('message.success.created'));
    }


    public function destroy($courseId, $moduleId, $lessonId, $questionId)
    {
        $question = LessonQuestion::lessonBy($lessonId)->findOrFail($questionId);
        $question->userAnswers()->delete();
        $question->delete();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
