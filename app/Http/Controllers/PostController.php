<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use App\Models\Post;
use Illuminate\Http\Request;

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
}
