<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'visible_in_main_web' => $this->visible_in_main_web,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'subcategories' => CategoryResource::collection($this->whenLoaded('subcategories')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
