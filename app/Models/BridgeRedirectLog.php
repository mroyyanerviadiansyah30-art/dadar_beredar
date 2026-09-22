<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BridgeRedirectLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'outlet_id',
        'device_type',
        'user_agent',
        'ip_address',
        'referrer',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
