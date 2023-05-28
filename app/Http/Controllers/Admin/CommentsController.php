<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10);;
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.comments.form');
    }

    public function store(Request $request)
    {
        Comment::create($request->all());
        return redirect('admin/comments')->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.form', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return redirect('admin/comments')->with('success', 'Comment updated successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect('admin/comments')->with('success', 'Comment deleted successfully!');
    }
}
