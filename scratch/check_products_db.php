<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\DB;

$rows = DB::table('products')->select('id', 'name', 'slug', 'image_url')->get();
$mismatches = 0;
foreach ($rows as $row) {
    $model = Product::find($row->id);
    $accessorVal = $model->image_url;
    $rawVal = $row->image_url;
    if ($accessorVal !== $rawVal) {
        echo "Product ID {$row->id} ({$row->slug}): Raw DB = '{$rawVal}' | Accessor = '{$accessorVal}'\n";
        $mismatches++;
    }
}
echo "\nTotal DB vs Accessor mismatches: {$mismatches}\n";
