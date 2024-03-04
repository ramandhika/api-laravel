<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json([
                'status' => [
                    'code' => 200,
                    'message' => 'Success fetching the Post Data API'
                ],
                'data' => $posts,
            ]);
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
}
