<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comments_content' => 'required',
            'post_id' => 'required',
        ]);

        $comment = Comment::create([
            'comments_content' => $request->comments_content,
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
        ]);


        return response()->json([
            'status' => [
                'code' => 200,
                'message' => 'Comment created successfully',
            ],
            'data' => $comment->loadMissing('commentator:id,username,firstname'),
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
            'status' => [
                'code' => 200,
                'message' => 'Comment deleted successfully',
            ],
        ]);
    }
}
