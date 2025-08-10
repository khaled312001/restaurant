<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;

echo "=== VERIFICATION OF ADDED MEALS ===\n\n";

// Check Salade category
$saladeCategory = Pcategory::find(29);
echo "=== {$saladeCategory->name} CATEGORY ===\n";
$salads = Product::where('category_id', $saladeCategory->id)
    ->where('language_id', 176)
    ->orderBy('id')
    ->get(['id', 'title', 'current_price', 'summary']);

foreach ($salads as $salad) {
    echo "ID: {$salad->id}, {$salad->title} - €{$salad->current_price}\n";
}

// Check Tacos category (vegetarian)
$tacosCategory = Pcategory::find(27);
echo "\n=== {$tacosCategory->name} CATEGORY (VEGETARIAN) ===\n";
$vegetarian = Product::where('category_id', $tacosCategory->id)
    ->where('language_id', 176)
    ->orderBy('id')
    ->get(['id', 'title', 'current_price', 'summary']);

foreach ($vegetarian as $veg) {
    echo "ID: {$veg->id}, {$veg->title} - €{$veg->current_price}\n";
}

// Check Menus Enfant category
$menusEnfantCategory = Pcategory::find(24);
echo "\n=== {$menusEnfantCategory->name} CATEGORY ===\n";
$kidsMenus = Product::where('category_id', $menusEnfantCategory->id)
    ->where('language_id', 176)
    ->orderBy('id')
    ->get(['id', 'title', 'current_price', 'summary']);

foreach ($kidsMenus as $menu) {
    echo "ID: {$menu->id}, {$menu->title} - €{$menu->current_price}\n";
}

echo "\n=== SUMMARY ===\n";
echo "Total salads: " . $salads->count() . "\n";
echo "Total vegetarian options: " . $vegetarian->count() . "\n";
echo "Total kids menus: " . $kidsMenus->count() . "\n"; 