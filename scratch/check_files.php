<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$missingFiles = 0;
foreach (Product::all() as $p) {
    if ($p->image_url) {
        $path = public_path(ltrim($p->image_url, '/'));
        if (!file_exists($path)) {
            echo "Missing file for [{$p->id}] {$p->name}: {$p->image_url} (Expected at {$path})\n";
            $missingFiles++;
        }
    }
}
echo "Total missing files: {$missingFiles}\n";
