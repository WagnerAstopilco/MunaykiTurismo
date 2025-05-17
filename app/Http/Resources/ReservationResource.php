<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'reservation_date' => $this->reservation_date,
            'number_of_people' => $this->number_of_people,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'payment_id' => $this->payment_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user' => new UserResource($this->whenLoaded('user')),
            'producto' =>new  ProductResource($this->whenLoaded('producto')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
