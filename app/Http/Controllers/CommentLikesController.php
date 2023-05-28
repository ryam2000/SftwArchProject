<?php

namespace App\Http\Controllers;

use App\Models\CommentLike;
use http\Message;
use Illuminate\Http\Request;

class CommentLikesController extends Controller
{
    public function index()
    {
        $comlikes = CommentLike::all();
        return view('pages.home', compact('comlikes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $user = $request->user();

        $comlike = CommentLike::where('user_id', $user->id)->where('comment_id', $request->comment_id)->first();

        if($comlike) {
            $comlike->delete();
            return redirect('posts/'.$request->input('post_id'))
                ->with('message','Comment unliked.');
        } else {
            CommentLike::create([
                'user_id' => auth()->user()->id,
                'comment_id' => $request->input('comment_id')
            ]);
        }
        return redirect('posts/'.$request->input('post_id'))
            ->with('message','Comment liked!');
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
