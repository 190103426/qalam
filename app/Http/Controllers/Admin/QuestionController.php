<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionSaveRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {

        $text = $request->text;
        $answer = $request->answer;

        $questions = Question::when($text, fn($query) => $query->where('text', 'like', "%$text%"))
            ->when($answer, fn($query) => $query->where('answer', 'like', "%$answer%"))
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(QuestionSaveRequest $request)
    {
        $question = new Question();
        $question->text = $request->text;
        $question->answer = $request->answer;
        $question->save();
        return redirect()->route('admin.questions.index')->withSuccess(__('message.success.created'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    public function update($id, QuestionSaveRequest $request)
    {
        $question = Question::findOrFail($id);
        $question->text = $request->text;
        $question->answer = $request->answer;
        $question->save();
        return redirect()->back()->withSuccess(__('message.success.saved'));
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->back()->withSuccess(__('message.success.deleted'));
    }
}
