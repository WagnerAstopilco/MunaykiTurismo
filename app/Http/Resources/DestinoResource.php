<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinoResource extends JsonResource
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
            'place' => $this->place,
            'country' => $this->country,
            'description' => $this->description,
            'visible_in_main_web' => $this->visible_in_main_web,
            'image_id' => $this->image_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'productos' => ProductResource::collection($this->whenLoaded('productos')),
            'image' => new ImageResource($this->whenLoaded('image')),
        ];
    }
}
