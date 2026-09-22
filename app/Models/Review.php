<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'author_name',
        'author_avatar',
        'rating',
        'comment',
        'relative_time',
        'verified_buyer',
        'is_featured',
    ];

    protected $casts = [
        'rating' => 'float',
        'verified_buyer' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
