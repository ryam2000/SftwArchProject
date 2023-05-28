<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Comment;

class PostsController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'comments' => Comment::all(),
            'likes' => PostLike::all(),
        ])->with('posts', Post::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'description'=>'required',
            'image'=>'mimes:jpg,png,jpeg,gif,mp4|max:25600'
        ]);

        if (!empty($request->image)) {
            $imageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
        } else $imageName = NULL;



        Post::create([
            'title'=> $request->input('title'),
            'description'=> $request->input('description'),
            'image_path'=> $imageName,
            'user_id'=> auth()->user()->id,
            'hidden' => 0
        ]);

        return redirect('/home')
            ->with('message', 'Successfully posted!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.show', compact('post'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
