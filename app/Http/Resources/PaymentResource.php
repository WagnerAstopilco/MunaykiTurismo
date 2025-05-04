<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'payment_method' => $this->payment_method,
            'transaction_id' => $this->transaction_id,
            'status' => $this->status,
            'date' => $this->date,
            'voucher' => $this->voucher,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
            'coupons' => CouponResource::collection($this->whenLoaded('coupons')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
