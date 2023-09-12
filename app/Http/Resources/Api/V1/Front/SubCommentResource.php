<?php

namespace App\Http\Resources\Api\V1\Front;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCommentResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
            'text' => $this->text,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'published_at' => Carbon::parse($this->published_at)->diffForHumans()
        ];
    }
}
