<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class pemilikComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $comment = Comment::findOrFail($request->id);

        if ($user->id !== $comment->user_id) {
            return response()->json([
                'status' => [
                    'code' => 403,
                    'message' => 'Forbidden',
                ],
            ], 403);
        }
        return $next($request);
    }
}
