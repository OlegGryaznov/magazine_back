<?php

namespace App\Http\Resources\Api\V1\Front;

use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'purchase_price' => $this->purchase_price,
            'price' => $this->price,
            'promotional_price' => $this->promotional_price,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'categories' => CategoryInnerProductResource::collection($this->categories),
            'manufacturer' => ManufacturerResource::make($this->manufacturer),
            'labels' => LabelResource::collection($this->labels),
            'images' => $this->getMedia()->map(function ($media) {
                return $media->original_url;
            })
        ];
    }
}
