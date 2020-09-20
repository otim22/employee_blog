<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->json(Comment::all());
    }

    public function show($id)
    {
        return response()->json(Comment::find($id));
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user()->associate($request->user());

        $post = Post::find($request->post_id);
        $post->comments()->save($comment);

        return response()->json($post, 201);
    }

    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'body' => 'required'
            ]);

            $comment = Comment::findOrFail($id);
            $comment->fill($request->all())->save();

            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response('Failed to update comment', 500);
        }
    }

    public function delete($id)
    {
        try {
            if(!Comment::find($id)) return $this->response('Comment not found!', 404);

            if(Comment::findOrFail($id)->delete()) {
                return $this->response('Comment deleted successfully!', 204);
            }
        } catch (\Exception $e) {
            return response('Failed to delete comment', 500);
        }
    }
}
