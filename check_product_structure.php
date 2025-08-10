<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

echo "=== EXISTING PRODUCT STRUCTURE ===\n";
$product = Product::first();
if ($product) {
    $attributes = $product->getAttributes();
    foreach ($attributes as $key => $value) {
        echo "{$key}: " . (is_null($value) ? 'NULL' : $value) . "\n";
    }
} else {
    echo "No products found in database\n";
} 