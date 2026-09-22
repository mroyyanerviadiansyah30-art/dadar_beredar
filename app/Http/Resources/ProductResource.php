<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'formatted_price' => $this->formatted_price,
            'original_price' => $this->original_price,
            'formatted_original_price' => $this->formatted_original_price,
            'spiciness_level' => $this->spiciness_level,
            'is_crispy' => $this->is_crispy,
            'is_bestseller' => $this->is_bestseller,
            'is_signature' => $this->is_signature,
            'image_url' => $this->image_url,
            'type' => $this->type,
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                    'slug' => $this->category->slug,
                ];
            }),
        ];
    }
}
