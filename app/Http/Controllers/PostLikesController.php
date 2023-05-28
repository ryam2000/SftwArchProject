<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use http\Message;
use Illuminate\Http\Request;

class PostLikesController extends Controller
{
    public function index()
    {
        $likes = PostLike::all();
        return view('pages.home', compact('likes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $user = $request->user();

        $like = PostLike::where('user_id', $user->id)->where('post_id', $request->post_id)->first();

        if($like) {
            $like->delete();
            return redirect('posts/'.$request->input('post_id'))
                ->with('message','Post unliked.');
        } else {
            PostLike::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->input('post_id')
            ]);
        }
        return redirect('posts/'.$request->input('post_id'))
        ->with('message','Post liked!');
    }

    public function show($id)
    {
        //
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
