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

        return response()->json($comment, 201);
    }

    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'body' => 'required'
            ]);

            $comment = Comment::findOrFail($id);
            $comment->fill($request->all())->save();

            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response('Failed to update comment', 500);
        }
    }

    public function hideComment($id, Request $request)
    {
        try {
            if(!Comment::find($id)) return response('Comment not found!', 404);

            if($request->user()) {
                $comment = new Comment;

                if(method_exists($comment, 'trashed')) {
                    $comment->findOrFail($id)->delete();

                    return response('Comment hidden successfully!', 204);
                }
            }
        } catch (\Exception $e) {
            return response('Failed to hide comment', 500);
        }
    }

    public function unHideComment($id, Request $request)
    {
        try {
            if(!Comment::find($id)) return response('Comment not found!', 404);

            if($request->user()) {
                $comment = new Comment;

                if(method_exists($comment, 'trashed')) {
                    $comment->withTrashed()->where('id', $id)->restore();

                    return response('Comment restored successfully!', 204);
                }
            }
        } catch (\Exception $e) {
            return response('Failed to restore comment', 500);
        }
    }

    public function delete($id, Request $request)
    {
        try {
            if(!Comment::find($id)) return response('Comment not found!', 404);

            if($request->user()) {
                $comment = new Comment;

                if(method_exists($comment, 'trashed')) {
                    $comment->findOrFail($id)->forceDelete();

                    return response('Comment deleted successfully!', 204);
                }
            }
        } catch (\Exception $e) {
            return response('Failed to delete comment', 500);
        }
    }
}
