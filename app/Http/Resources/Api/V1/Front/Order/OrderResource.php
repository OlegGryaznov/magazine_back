<?php

namespace App\Http\Resources\Api\V1\Front\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_status_id' => $this->order_status_id,
            'payment_status_id' => $this->payment_status_id,
            'payment_id' => $this->payment_id,
            'ttn' => $this->ttn,
            'comment' => $this->comment,
            'delivery_status_id' => $this->delivery_status_id,
            'delivery_address' => $this->delivery_address,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'products' => OrderProductResource::collection($this->products)
        ];
    }
}
