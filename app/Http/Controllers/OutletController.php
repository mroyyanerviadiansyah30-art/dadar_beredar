<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function nearby(Request $request)
    {
        $lat = (float) $request->query('lat');
        $lng = (float) $request->query('lng');

        if (!$lat || !$lng) {
            $outlets = Outlet::where('is_active', true)->get();
            return response()->json([
                'success' => true,
                'outlets' => $outlets,
            ]);
        }

        $outlets = Outlet::where('is_active', true)->get()->map(function ($outlet) use ($lat, $lng) {
            $outlet->distance_km = $outlet->calculateDistance($lat, $lng);
            return $outlet;
        })->sortBy('distance_km')->values();

        return response()->json([
            'success' => true,
            'user_location' => ['lat' => $lat, 'lng' => $lng],
            'closest' => $outlets->first(),
            'outlets' => $outlets,
        ]);
    }
}
