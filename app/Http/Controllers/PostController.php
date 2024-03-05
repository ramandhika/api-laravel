<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            $postsResource = PostResource::collection($posts);
            return response()->json([
                'status' => [
                    'code' => 200,
                    'message' => 'Success fetching the Post Data API'
                ],
                'data' => $postsResource,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => [
                    'code' => 500,
                    'message' => 'Error fetching the API: ' . $e->getMessage(),
                ],
                'data' => null,
            ], 500);
        };
    }

    public function show($id) {
        try {
            $post = Post::with('writer:id,username,firstname')->findOrFail($id);
            if ($post) {
                $postResource = new PostDetailResource($post);
                return response()->json([
                    'status' => [
                        'code' => 200,
                        'message' => 'Success fetching the Post Data API'
                    ],
                    'data' => $postResource,
                ]);
            } else {
                return response()->json([
                    'status' => [
                        'code' => 404,
                        'message' => 'Post not found'
                    ],
                    'data' => null,
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => [
                    'code' => 500,
                    'message' => 'Error fetching the API: ' . $e->getMessage(),
                ],
                'data' => null,
            ], 500);
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
