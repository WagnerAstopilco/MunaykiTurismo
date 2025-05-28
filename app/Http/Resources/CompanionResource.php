<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanionResource extends JsonResource
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
            'reservation_id' => $this->reservation_id,
            'full_name' => $this->full_name,
            'document_number' => $this->document_number,
            'age' => $this->age,
            'gender' => $this->gender,
            'is_adult' => $this->is_adult,

            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
        ];
    }
}
