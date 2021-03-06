<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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
        return response()->json(Post::all());
    }

    public function show($id)
    {
        return response()->json(Post::find($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:25',
            'body' => 'required|max:255'
        ]);

        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|max:25',
                'body' => 'required|max:255'
            ]);

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
            if(! Post::find($id)) return response('Post not found!', 404);

            if(Post::findOrFail($id)->delete()) {
                return response('Post deleted successfully!', 204);
            }
        } catch (\Exception $e) {
            return response('Failed to delete post', 500);
        }
    }
}
