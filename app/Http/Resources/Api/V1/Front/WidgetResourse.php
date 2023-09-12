<?php

namespace App\Http\Resources\Api\V1\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WidgetResourse extends JsonResource
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
            'section' => $this->section,
            'text' => $this->text,
            'text_link' => $this->text_link,
            'is_active' => $this->is_active,
            'link' => $this->link,
            'start_date' => $this->start_date,
            'expiration_date' => $this->expiration_date,
            'image' => $this->getFirstMediaUrl()
        ];
    }
}
