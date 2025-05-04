<?php

namespace App\Http\Resources;

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
            'names' => $this->names,
            'last_names' => $this->last_names,
            'email' =>  $this->email,
            'password' => $this->password,
            'phone' =>  $this->phone,
            'profile_photo' => $this->profile_photo,
            'role' =>  $this->role,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
