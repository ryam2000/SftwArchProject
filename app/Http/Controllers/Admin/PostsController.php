<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect('admin/posts')->with('success', 'Post added successfully!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('admin.posts')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        dd("still admin post :(");
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('admin.posts')->with('success', 'Post deleted successfully!');
    }

    public function dt()
    {
        $posts = Post::all();
        return view('admin.posts.dt', compact('posts'));
    }
}
