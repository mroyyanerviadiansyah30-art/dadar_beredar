<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OutletResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'city' => $this->city,
            'province' => $this->province,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'whatsapp_link' => $this->whatsapp_link,
            'opening_hours' => $this->opening_hours,
            'rating' => $this->rating,
            'review_count' => $this->review_count,
            'gmaps_url' => $this->gmaps_url,
            'is_active' => $this->is_active,
        ];
    }
}
