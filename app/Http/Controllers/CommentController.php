<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
       $comment->body = $request->body;
       $comment->user()->associate($request->user());

       $post = Post::find($request->post_id);
       $post->comments()->save($comment);

        return response()->json($post, 201);
    }
}
