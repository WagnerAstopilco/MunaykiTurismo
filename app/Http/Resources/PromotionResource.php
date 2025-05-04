<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'description' => $this->description,
            'discount_percentage' => $this->discount_percentage,
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
