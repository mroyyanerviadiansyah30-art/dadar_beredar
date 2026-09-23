<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'original_price',
        'spiciness_level',
        'is_crispy',
        'is_bestseller',
        'is_signature',
        'image_url',
        'type',
        'stock',
        'is_available',
    ];

    protected $casts = [
        'price' => 'float',
        'original_price' => 'float',
        'spiciness_level' => 'integer',
        'is_crispy' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_signature' => 'boolean',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];

    protected $appends = [
        'formatted_price',
        'formatted_original_price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if (!$this->original_price) {
            return null;
        }
        return 'Rp ' . number_format($this->original_price, 0, ',', '.');
    }

    public function getSpiceRatingHtmlAttribute(): string
    {
        $name = strtolower($this->name);
        $catSlug = strtolower($this->category->slug ?? '');

        // Menu teriyaki tidak pedas sama sekali
        if (str_contains($name, 'teriyaki')) {
            return '';
        }

        // Minuman, Kids Meals, Upgrade & item pelengkap non-pedas
        if ($this->type === 'beverage' || str_contains($catSlug, 'minuman') || str_contains($catSlug, 'kids') || str_contains($catSlug, 'upgrade')) {
            return '';
        }

        if (in_array($this->slug, ['kerupuk', 'nasi-putih', 'tambahan-kotak-takeaway-lugu', 'tambahan-kotak-takeaway-lugut'])) {
            return '';
        }

        if ($this->spiciness_level === 0) {
            return '<span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Gak Pedas</span>';
        }

        return '<span class="text-xs font-bold text-red-700 bg-red-100 px-2.5 py-0.5 rounded-full inline-flex items-center gap-1">🌶️ Pedas</span>';
    }

    public function getImageUrlAttribute(?string $value): ?string
    {
        // 1. Items explicitly configured without photo
        if (in_array($this->slug, ['upgrade-ceplok-dadar-saos-bbq', 'tambahan-kotak-takeaway-lugu', 'kerupuk'])) {
            return null;
        }

        // 2. Check if user provided an override file named after product slug in public/images/menu/
        $slug = $this->slug;
        if (!empty($slug)) {
            foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                if (file_exists(public_path("images/menu/{$slug}.{$ext}"))) {
                    return "/images/menu/{$slug}.{$ext}";
                }
            }
        }

        // 3. Check if the database attribute points to an existing file
        if (!empty($value) && file_exists(public_path(ltrim($value, '/')))) {
            return $value;
        }

        if (!empty($value)) {
            return $value;
        }

        // 4. Return null if no image is available
        return null;
    }
}

