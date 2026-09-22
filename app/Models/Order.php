<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'outlet_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'delivery_type',
        'delivery_address',
        'delivery_notes',
        'subtotal',
        'delivery_fee',
        'tax_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'payment_reference',
        'snap_token',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'delivery_fee' => 'float',
        'tax_amount' => 'float',
        'total_amount' => 'float',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getFormattedDeliveryFeeAttribute(): string
    {
        return 'Rp ' . number_format($this->delivery_fee, 0, ',', '.');
    }

    public function getFormattedTaxAttribute(): string
    {
        return 'Rp ' . number_format($this->tax_amount, 0, ',', '.');
    }

    public function getDeliveryLabelAttribute(): string
    {
        return match ($this->delivery_type) {
            'dine_in' => 'Makan di Tempat (Dine In)',
            'takeaway' => 'Bungkus / Takeaway (DAR-DOR)',
            'express_delivery' => 'Pengiriman Kilat (Express Delivery)',
            default => ucfirst($this->delivery_type),
        };
    }

    public function getPaymentStatusBadge(): array
    {
        return match ($this->payment_status) {
            'paid' => ['label' => 'Sudah Lunas', 'class' => 'bg-emerald-100 text-emerald-800 border-emerald-300'],
            'pending' => ['label' => 'Menunggu Pembayaran', 'class' => 'bg-amber-100 text-amber-800 border-amber-300'],
            'failed' => ['label' => 'Gagal', 'class' => 'bg-red-100 text-red-800 border-red-300'],
            default => ['label' => ucfirst($this->payment_status), 'class' => 'bg-gray-100 text-gray-800 border-gray-300'],
        };
    }

    public function getOrderStatusBadge(): array
    {
        return match ($this->order_status) {
            'received' => ['label' => 'Pesanan Diterima', 'icon' => 'receipt', 'step' => 1],
            'cooking' => ['label' => 'Sedang Digoreng Kresss!', 'icon' => 'flame', 'step' => 2],
            'ready' => ['label' => 'Siap Diantar / Diambil', 'icon' => 'check-circle', 'step' => 3],
            'delivered' => ['label' => 'Selesai & Dinikmati', 'icon' => 'smile', 'step' => 4],
            'cancelled' => ['label' => 'Dibatalkan', 'icon' => 'x-circle', 'step' => 0],
            default => ['label' => ucfirst($this->order_status), 'icon' => 'clock', 'step' => 1],
        };
    }
}
