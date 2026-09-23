<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\Outlet;
use App\Models\Review;
use App\Models\Order;

echo "=== PRODUCTS ===\n";
echo "Total: " . Product::count() . "\n";
echo "Available: " . Product::where('is_available', true)->count() . "\n";
echo "Unavailable: " . Product::where('is_available', false)->count() . "\n";
echo "Bestseller: " . Product::where('is_bestseller', true)->count() . "\n";
echo "Crispy: " . Product::where('is_crispy', true)->count() . "\n";
echo "With original price (discounted): " . Product::whereNotNull('original_price')->count() . "\n";

echo "\n=== CATEGORIES ===\n";
foreach (Category::orderBy('sort_order')->get() as $cat) {
    echo "- [ID: {$cat->id}] {$cat->name} ({$cat->slug}): " . $cat->products()->count() . " products\n";
}

echo "\n=== OUTLETS ===\n";
echo "Total: " . Outlet::count() . "\n";
foreach (Outlet::all() as $o) {
    echo "- [ID: {$o->id}] {$o->name} | City: {$o->city} | Rating: {$o->rating} | Reviews: {$o->review_count} | Active: " . ($o->is_active ? 'Yes' : 'No') . "\n";
    echo "  Shopee: " . ($o->shopeefood_url ?: 'NONE') . "\n";
    echo "  Grab: " . ($o->grabfood_url ?: 'NONE') . "\n";
    echo "  GoFood: " . ($o->gofood_url ?: 'NONE') . "\n";
}

echo "\n=== REVIEWS ===\n";
echo "Total: " . Review::count() . "\n";
foreach (Review::all() as $r) {
    echo "- {$r->author_name} ({$r->rating}*): {$r->comment} [Outlet ID: {$r->outlet_id}]\n";
}

echo "\n=== PRODUCTS WITHOUT IMAGE IN DB ===\n";
foreach (Product::whereNull('image_url')->orWhere('image_url', '')->get() as $p) {
    echo "- {$p->name} ({$p->slug})\n";
}
