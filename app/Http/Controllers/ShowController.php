<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\PostLike;
use App\Models\CommentLike;
use App\Models\Post;

class ShowController extends Controller
{
    public function index()
    {
        return view('pages.show', [
            'posts' => Post::all(),
            'likes' => PostLike::all(),
            'comlikes' => CommentLike::all()
        ])->with('comments', Comment::withCount('likes')->orderBy('likes_count','ASC')->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Comment::create([
            'content'=> $request->input('content'),
            'user_id'=> auth()->user()->id,
            'post_id'=> $request->input('post_id'),
            'hidden' => 0
        ]);

        return redirect('posts/'. $request->input('post_id'))
            ->with('message', 'Comment successfully added!');
    }

    public function show($id)
    {
        return view('pages.show', [
            'post' => Post::findOrFail($id),
            'comments' => Comment::withCount('likes')->orderBy('likes_count','DESC')->get(),
            'likes' => PostLike::all(),
            'comlikes' => CommentLike::all()
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('/home', compact('post'));
    }

    public function update(Request $request, $id)
    {
        if($request->input('type')=="post"){
            if($request->input('hidden') == 1){
                $post = Post::findOrFail($id);
                $post->update($request->all());
                return redirect('/home')->with('message', 'Post deleted successfully!');
            } else {
                $post = Post::findOrFail($id);
                $post->update($request->all());
                return redirect('posts/'.$request->input('post_id'))->with('message', 'Post updated successfully!');
            }
        } elseif($request->input('type')=="comment") {
            if ($request->input('hidden') == 1) {
                $comment = Comment::findOrFail($id);
                $comment->update($request->all());
                return redirect('posts/'.$request->input('post_id'))->with('message', 'Comment deleted successfully!');
            } else {
                $comment = Comment::findOrFail($id);
                $comment->update($request->all());
                return redirect('posts/'.$request->input('post_id'))->with('message', 'Comment updated successfully!');
            }
        }
        //dd($request->all());
        return redirect('/home')->with('message', 'Unknown error. Post/comment was not updated.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::all();
        foreach($comments as $comment){
            if($comment->post_id == $id) $comment->delete();
        }
        $post->delete();
        return redirect('/home')->with('message', 'Post deleted successfully!');
    }
}
