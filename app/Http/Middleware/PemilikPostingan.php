<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PemilikPostingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $post = Post::findOrFail($request->id);

        if ($currentUser->id !== $post->author) {
            return response()->json([
                'status' => [
                    'code' => 403,
                    'message' => 'Forbidden'
                ],
                'data' => null,
            ], 403);
        }
        return $next($request);
    }
}
