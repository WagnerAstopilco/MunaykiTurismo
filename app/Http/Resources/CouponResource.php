<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code' => $this->code,
            'description' => $this->description,
            'discount_percentage' => $this->discount_percentage,
            'max_uses' => $this->max_uses,
            'uses_count' => $this->uses_count,
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'payments' => PaymentResource::collection($this->whenLoaded('Payments')),
        ];
    }
}
