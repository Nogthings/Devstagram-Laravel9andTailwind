<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        # validate
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);
        #end validate

        #store
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]);
        #end store

        #message
            return back()->with('message', 'Comment added');
        #end message 
    }
}
