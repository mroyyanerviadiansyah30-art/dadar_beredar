<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'delivery_type' => $this->delivery_type,
            'delivery_label' => $this->delivery_label,
            'subtotal' => $this->subtotal,
            'formatted_subtotal' => $this->formatted_subtotal,
            'delivery_fee' => $this->delivery_fee,
            'formatted_delivery_fee' => $this->formatted_delivery_fee,
            'tax_amount' => $this->tax_amount,
            'formatted_tax' => $this->formatted_tax,
            'total_amount' => $this->total_amount,
            'formatted_total' => $this->formatted_total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'items' => $this->items->map(fn ($item) => [
                'name' => $item->product_name,
                'price' => $item->price,
                'formatted_price' => $item->formatted_price,
                'quantity' => $item->quantity,
                'spice_level' => $item->spice_level,
                'notes' => $item->notes,
                'subtotal' => $item->subtotal,
                'formatted_subtotal' => $item->formatted_subtotal,
            ]),
            'created_at' => $this->created_at->format('d M Y, H:i'),
        ];
    }
}
