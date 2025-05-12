<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'slug' => $this->slug,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price_PEN' => $this->price_PEN,
            'price_USD' => $this->price_USD,
            'stock' => $this->stock,
            'number_of_days' => $this->number_of_days,
            'number_of_nights' => $this->number_of_nights,
            'number_of_people' => $this->number_of_people,
            'file' => $this->file,
            'itinerary' => $this->itinerary,
            'reservation_requirements' => $this->reservation_requirements,
            'reservation_included' => $this->reservation_included,
            'destino_id' => $this->destino_id,
            'visible_in_main_web' => $this->visible_in_main_web,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'category' => new CategoryResource($this->whenLoaded('category')),
            'ratings' => RatingResource::collection($this->whenLoaded('ratings')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations')),
            'promotions' => PromotionResource::collection($this->whenLoaded('promotions')),
            'destino' => new DestinoResource($this->whenLoaded('destino')),
            'coupons' => CouponResource::collection($this->whenLoaded('coupons')),
        ];
    }
}
