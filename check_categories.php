<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;

$product = Product::with('category')->first();
if($product) {
    echo "Product: " . $product->title . "\n";
    echo "Category ID: " . $product->category_id . "\n";
    echo "Category: " . ($product->category ? $product->category->name : 'NULL') . "\n";
    
    // Check if category exists
    $category = Pcategory::find($product->category_id);
    echo "Category exists: " . ($category ? 'YES - ' . $category->name : 'NO') . "\n";
} else {
    echo "No products found\n";
}