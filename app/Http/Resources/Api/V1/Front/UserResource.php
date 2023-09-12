<?php

namespace App\Http\Resources\Api\V1\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'promotional_price' => $this->promotional_price,
            'manufacturer' => ManufacturerResource::make($this->manufacturer),
            'image' => $this->getFirstMediaUrl(),
            'amount' => $this->amount,
        ];
    }
}
