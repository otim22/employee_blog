<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all());
    }

    public function show($id)
    {
        return response()->json(Post::find($id));
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function update($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $post->fill($request->all())->save();

            return response()->json($post, 200);
        } catch (\Exception $e) {
            return response('Failed to update post', 500);
        }
    }

    public function delete($id)
    {
        try {
            if(!Post::find($id)) return $this->response('Post not found!', 404);

            if(Post::findOrFail($id)->delete()) {
                return $this->response('Post deleted successfully!', 200);
            }
        } catch (\Exception $e) {
            return response('Failed to delete post', 500);
        }

    }
}
