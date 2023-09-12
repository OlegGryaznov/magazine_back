<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\V1\Front\PostCommentResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'read_time' => $this->read_time,
            'views_count' => $this->views_count,
            'slug' => $this->slug,
            'category' => new CategoryPostRelationResource($this->category),
            'author' => new UserResource($this->author),
            'tags' => TagResource::collection($this->tags),
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : '',
            'updated_at' => $this->updated_at
        ];
    }
}
