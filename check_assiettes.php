<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;

// Get the Assiettes category (ID: 23)
$assiettesCategory = Pcategory::find(23);
if (!$assiettesCategory) {
    echo "Error: Assiettes category not found!\n";
    exit;
}

echo "=== ASSIETTES CATEGORY ===\n";
echo "Category: {$assiettesCategory->name} (ID: {$assiettesCategory->id})\n\n";

// Get all products in the Assiettes category
$products = Product::where('category_id', $assiettesCategory->id)
    ->where('language_id', 176)
    ->orderBy('id')
    ->get(['id', 'title', 'current_price', 'summary']);

echo "=== PRODUCTS IN ASSIETTES ===\n";
if ($products->count() > 0) {
    foreach ($products as $product) {
        echo "ID: {$product->id}, Title: {$product->title}, Price: €{$product->current_price}\n";
        echo "Description: {$product->summary}\n";
        echo "---\n";
    }
    echo "Total products in Assiettes: {$products->count()}\n";
} else {
    echo "No products found in Assiettes category.\n";
} 