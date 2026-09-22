<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'city',
        'province',
        'address',
        'latitude',
        'longitude',
        'phone',
        'whatsapp',
        'opening_hours',
        'rating',
        'review_count',
        'gmaps_url',
        'gmaps_place_id',
        'gofood_url',
        'grabfood_url',
        'shopeefood_url',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'float',
        'review_count' => 'integer',
        'is_active' => 'boolean',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function bridgeRedirectLogs(): HasMany
    {
        return $this->hasMany(BridgeRedirectLog::class);
    }

    public function getDeliveryUrl(string $platform): string
    {
        $platform = strtolower($platform);
        $encodedName = urlencode($this->name);

        return match ($platform) {
            'gofood' => $this->gofood_url ?: "https://gofood.co.id/id/{$this->slug}?q={$encodedName}",
            'grabfood' => $this->grabfood_url ?: "https://food.grab.com/id/id/restaurant/{$this->slug}",
            'shopeefood' => $this->shopeefood_url ?: "https://shopee.co.id/universal-link/now-food/shop/{$this->slug}",
            default => url('/'),
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('city', 'like', "%{$term}%")
              ->orWhere('address', 'like', "%{$term}%");
        });
    }

    public function getWhatsappLinkAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp ?? '6281234567890');
        $msg = urlencode("Halo Dadar Beredar {$this->name}, saya mau pesan DAR-DOR!");
        return "https://wa.me/{$phone}?text={$msg}";
    }

    public function calculateDistance(float $userLat, float $userLng): float
    {
        $earthRadius = 6371; // km

        $latFrom = deg2rad($userLat);
        $lonFrom = deg2rad($userLng);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return round($angle * $earthRadius, 1);
    }
}
