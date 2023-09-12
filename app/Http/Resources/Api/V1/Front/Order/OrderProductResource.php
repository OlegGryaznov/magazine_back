<?php

namespace App\Http\Resources\Api\V1\Front\Order;

use App\Http\Resources\Api\V1\Front\CategoryInnerProductResource;
use App\Http\Resources\Api\V1\Front\LabelResource;
use App\Http\Resources\Api\V1\Front\ManufacturerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'vendor_code' => $this->vendor_code,
            'scu' => $this->scu,
            'upc' => $this->upc,
            'price' => $this->price,
            'promotional_price' => $this->promotional_price,
            'slug' => $this->slug,
            'total_price' => $this->total_price,
            'manufacturer' => ManufacturerResource::make($this->manufacturer),
            'images' => $this->getFirstMediaUrl()
        ];
    }
}
