<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;
use App\Models\Language;

echo "=== QUICK NOS BOX TEST ===\n\n";

// Get French language
$frenchLang = Language::where('code', 'fr')->first();
if (!$frenchLang) {
    echo "❌ French language not found!\n";
    exit;
}

echo "✅ Language: {$frenchLang->name} (ID: {$frenchLang->id})\n";

// Get Nos Box category
$nosBoxCategory = Pcategory::where('name', 'Nos Box')
    ->where('language_id', $frenchLang->id)
    ->where('status', 1)
    ->first();

if (!$nosBoxCategory) {
    echo "❌ Nos Box category not found!\n";
    exit;
}

echo "✅ Nos Box category found (ID: {$nosBoxCategory->id})\n";

// Get products
$products = Product::where('category_id', $nosBoxCategory->id)
    ->where('language_id', $frenchLang->id)
    ->where('status', 1)
    ->orderBy('id')
    ->get();

echo "📊 Products in Nos Box: {$products->count()}\n\n";

if ($products->count() > 0) {
    echo "=== PRODUCTS LIST ===\n";
    foreach ($products as $product) {
        $price10 = $product->current_price * 1.9;
        echo "ID: {$product->id}, {$product->title}\n";
        echo "   Price 5: €{$product->current_price}\n";
        echo "   Price 10: €" . number_format($price10, 2) . "\n";
        echo "---\n";
    }
    
    echo "✅ All products are loaded correctly!\n";
    echo "✅ Page should work properly!\n";
} else {
    echo "❌ No products found in Nos Box category!\n";
    echo "💡 Run: php update_database_server.php\n";
} 