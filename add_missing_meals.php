<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;
use Illuminate\Support\Str;

// Get the Assiettes category (ID: 23)
$assiettesCategory = Pcategory::find(23);
if (!$assiettesCategory) {
    echo "Error: Assiettes category not found!\n";
    exit;
}

echo "Found category: {$assiettesCategory->name} (ID: {$assiettesCategory->id})\n";

// Define the missing meals from the image
$meals = [
    [
        'title' => 'KEBAB',
        'price' => 12.00,
        'description' => 'Délicieux kebab servi avec frites et salade fraîche'
    ],
    [
        'title' => 'POULET',
        'price' => 12.00,
        'description' => 'Assiette de poulet grillé avec frites et salade fraîche'
    ],
    [
        'title' => 'SAUMON',
        'price' => 12.00,
        'description' => 'Assiette de saumon grillé avec frites et salade fraîche'
    ],
    [
        'title' => 'KOFTE',
        'price' => 11.00,
        'description' => 'Assiette de kofte avec frites et salade fraîche'
    ],
    [
        'title' => 'STEAK',
        'price' => 11.00,
        'description' => 'Assiette de steak avec frites et salade fraîche'
    ]
];

// Add each meal
foreach ($meals as $meal) {
    // Check if product already exists
    $existingProduct = Product::where('title', $meal['title'])
        ->where('category_id', $assiettesCategory->id)
        ->where('language_id', 176)
        ->first();
    
    if ($existingProduct) {
        echo "Product '{$meal['title']}' already exists (ID: {$existingProduct->id})\n";
        continue;
    }
    
    // Create new product
    $product = new Product();
    $product->title = $meal['title'];
    $product->slug = Str::slug($meal['title']);
    $product->language_id = 176; // French
    $product->category_id = $assiettesCategory->id;
    $product->current_price = $meal['price'];
    $product->previous_price = $meal['price'];
    $product->summary = $meal['description'];
    $product->description = $meal['description'];
    $product->status = 1; // Active
    $product->is_feature = 0;
    $product->rating = 0.00;
    $product->save();
    
    echo "Added product: {$meal['title']} - €{$meal['price']} (ID: {$product->id})\n";
}

echo "\nAll missing meals have been added successfully!\n"; 