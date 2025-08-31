<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;
use App\Models\Language;
use Illuminate\Support\Str;

echo "=== UPDATING DATABASE ON SERVER ===\n\n";

// Get French language
$frenchLang = Language::where('code', 'fr')->first();
if (!$frenchLang) {
    echo "Error: French language not found!\n";
    exit;
}

echo "=== LANGUAGE ===\n";
echo "Language: {$frenchLang->name} (ID: {$frenchLang->id})\n\n";

// Get Nos Box category
$nosBoxCategory = Pcategory::where('name', 'Nos Box')
    ->where('language_id', $frenchLang->id)
    ->where('status', 1)
    ->first();

if (!$nosBoxCategory) {
    echo "Error: Nos Box category not found!\n";
    exit;
}

echo "=== NOS BOX CATEGORY ===\n";
echo "Category: {$nosBoxCategory->name} (ID: {$nosBoxCategory->id})\n\n";

// Check if products already exist
$existingProducts = Product::where('category_id', $nosBoxCategory->id)
    ->where('language_id', $frenchLang->id)
    ->count();

echo "=== EXISTING PRODUCTS ===\n";
echo "Current products in Nos Box: {$existingProducts}\n\n";

if ($existingProducts > 0) {
    echo "Products already exist. Do you want to:\n";
    echo "1. Keep existing products\n";
    echo "2. Delete and recreate all products\n";
    echo "3. Add missing products only\n";
    
    // For server deployment, we'll add missing products only
    echo "Choosing option 3: Add missing products only\n\n";
}

// Define the products to add
$products = [
    [
        'title' => 'TENDERS',
        'price_5' => 5.00,
        'price_10' => 9.50,
        'description' => 'Tenders de poulet croustillants servis par 5 ou 10 pièces'
    ],
    [
        'title' => 'NUGGETS',
        'price_5' => 4.00,
        'price_10' => 7.50,
        'description' => 'Nuggets de poulet dorés servis par 5 ou 10 pièces'
    ],
    [
        'title' => 'WINGS',
        'price_5' => 4.50,
        'price_10' => 8.50,
        'description' => 'Ailes de poulet marinées servies par 5 ou 10 pièces'
    ],
    [
        'title' => 'FALAFELS',
        'price_5' => 4.00,
        'price_10' => 7.50,
        'description' => 'Falafels végétariens servis par 5 ou 10 pièces'
    ],
    [
        'title' => 'CAMEMBERT PANÉ',
        'price_5' => 4.00,
        'price_10' => 7.00,
        'description' => 'Camembert pané et frit servi par 5 ou 10 pièces'
    ],
    [
        'title' => 'BEIGNET DE CALAMAR',
        'price_5' => 3.50,
        'price_10' => 6.50,
        'description' => 'Beignets de calamar frits servis par 5 ou 10 pièces'
    ],
    [
        'title' => 'STICK MOZA',
        'price_5' => 5.00,
        'price_10' => 9.50,
        'description' => 'Bâtonnets de mozzarella panés servis par 5 ou 10 pièces'
    ],
    [
        'title' => 'OIGNON RINGS',
        'price_5' => 3.50,
        'price_10' => 6.50,
        'description' => 'Rings d\'oignon frits servis par 5 ou 10 pièces'
    ]
];

$addedCount = 0;
$skippedCount = 0;

// Add each product
foreach ($products as $productData) {
    // Check if product already exists
    $existingProduct = Product::where('title', $productData['title'])
        ->where('category_id', $nosBoxCategory->id)
        ->where('language_id', $frenchLang->id)
        ->first();
    
    if ($existingProduct) {
        echo "Product '{$productData['title']}' already exists (ID: {$existingProduct->id}) - SKIPPED\n";
        $skippedCount++;
        continue;
    }
    
    // Create new product
    $product = new Product();
    $product->title = $productData['title'];
    $product->slug = Str::slug($productData['title']);
    $product->language_id = $frenchLang->id;
    $product->category_id = $nosBoxCategory->id;
    $product->current_price = $productData['price_5'];
    $product->previous_price = $productData['price_5'];
    $product->summary = $productData['description'];
    $product->description = $productData['description'] . "\n\nPrix:\n- 5 pièces: €" . number_format($productData['price_5'], 2) . "\n- 10 pièces: €" . number_format($productData['price_10'], 2);
    $product->status = 1;
    $product->is_feature = 0;
    $product->rating = 0.00;
    $product->save();
    
    echo "Added product: {$productData['title']} - €{$productData['price_5']}/5pièces, €{$productData['price_10']}/10pièces (ID: {$product->id})\n";
    $addedCount++;
}

echo "\n=== UPDATE SUMMARY ===\n";
echo "✅ Products added: {$addedCount}\n";
echo "⏭️ Products skipped: {$skippedCount}\n";
echo "📊 Total products in Nos Box: " . ($existingProducts + $addedCount) . "\n";

// Verify final state
$finalProducts = Product::where('category_id', $nosBoxCategory->id)
    ->where('language_id', $frenchLang->id)
    ->where('status', 1)
    ->orderBy('id')
    ->get();

echo "\n=== FINAL PRODUCTS LIST ===\n";
foreach ($finalProducts as $product) {
    echo "ID: {$product->id}, {$product->title} - €{$product->current_price}\n";
}

echo "\n=== DATABASE UPDATE COMPLETED ===\n";
echo "✅ All Nos Box products are now available\n";
echo "✅ Page should work correctly\n";
echo "✅ Cart functionality should work\n"; 