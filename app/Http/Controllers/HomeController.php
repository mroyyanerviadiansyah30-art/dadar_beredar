<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_available', true);
        }])->orderBy('sort_order')->get();

        $bestsellers = Product::where('is_bestseller', true)
            ->where('is_available', true)
            ->limit(6)
            ->get();

        $outlets = Outlet::where('is_active', true)
            ->orderBy('city')
            ->get();

        $primaryOutlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first() 
            ?? $outlets->first();

        $reviews = Review::where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('home', compact(
            'categories',
            'bestsellers',
            'outlets',
            'primaryOutlet',
            'reviews'
        ));
    }
}
