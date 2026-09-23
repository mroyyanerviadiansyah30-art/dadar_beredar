<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->query('q', ''));

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'products' => [],
                'outlets' => [],
                'total' => 0,
            ]);
        }

        $products = Product::with('category')
            ->where('is_available', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('category', function ($catQ) use ($query) {
                      $catQ->where('name', 'like', "%{$query}%");
                  });
            })
            ->limit(8)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'category' => $product->category->name ?? 'Menu',
                    'price' => $product->price,
                    'formatted_price' => $product->formatted_price,
                    'original_price' => $product->original_price,
                    'formatted_original_price' => $product->formatted_original_price,
                    'description' => $product->description,
                    'spiciness_level' => $product->spiciness_level,
                    'is_crispy' => $product->is_crispy,
                    'is_bestseller' => $product->is_bestseller,
                    'image_url' => $product->image_url,
                    'type' => $product->type,
                ];
            });

        $outlets = Outlet::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('city', 'like', "%{$query}%")
                  ->orWhere('address', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get()
            ->map(function ($outlet) {
                return [
                    'id' => $outlet->id,
                    'name' => $outlet->name,
                    'city' => $outlet->city,
                    'address' => $outlet->address,
                    'rating' => $outlet->rating,
                    'review_count' => $outlet->review_count,
                    'opening_hours' => $outlet->opening_hours,
                    'whatsapp_link' => $outlet->whatsapp_link,
                    'gmaps_url' => $outlet->gmaps_url,
                ];
            });

        return response()->json([
            'success' => true,
            'query' => $query,
            'products' => $products,
            'outlets' => $outlets,
            'total' => $products->count() + $outlets->count(),
        ]);
    }
}
