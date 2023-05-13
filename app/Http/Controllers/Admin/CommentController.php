<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $fullName = $request->full_name;
        $text = $request->text;
        $comments = Comment::with('lesson.course')
            ->joinUserFullName()
//            ->paginate($request->input('per_page', 20))
//            ->when($fullName, function($query) use ($fullName) {
//                return $query->where('full_name', 'like', "%$fullName%");
//            })
            ->when($fullName, fn($query) => $query->where('full_name', 'like', "%$fullName%"))
            ->when($text, fn($query) => $query->where('text', 'like', "%$text%"))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return view('admin.comments.index', compact('comments'));
    }

    public function edit($id)
    {
        $comment = Comment::with('lesson.course')->findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }

    public function update($id, Request $request)
    {
        $comment = Comment::with('lesson.course')->findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }
}
