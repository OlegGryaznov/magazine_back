<?php

namespace App\Http\Resources\Api\V1\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewCartProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'scu' => $this->scu,
            'upc' => $this->upc,
            'price' => $this->price,
            'promotional_price' => $this->promotional_price,
            'manufacturer' => ManufacturerResource::make($this->manufacturer),
            'images' => $this->getMedia()->map(fn($media) => $media->original_url),
            'amount' => $this->amount,
        ];
    }
}
