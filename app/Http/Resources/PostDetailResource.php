<?php

namespace App\Http\Resources;

use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'news_content' => $this->news_content,
            'author' => $this->author,
            'writer' => $this->whenLoaded('writer'),//->firstname,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'comments' => $this->whenLoaded('comments', function () {
                return collect($this->comments)->each(function ($comment) {
                    $comment->commentator;
                    return $comment;
                });
            }),
            'comment_count' => $this->comments->count(),
        ];
    }
}
