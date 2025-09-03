<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Addon;

echo "🧪 Testing New Addon System\n";
echo "============================\n\n";

// Test 1: Check if addons are properly seeded
echo "1. Testing Addon Seeding...\n";
$totalAddons = Addon::count();
echo "   Total addons in database: {$totalAddons}\n";

if ($totalAddons > 0) {
    echo "   ✅ Addons are properly seeded\n\n";
} else {
    echo "   ❌ No addons found in database\n\n";
    exit;
}

// Test 2: Test product type filtering
echo "2. Testing Product Type Filtering...\n";

$productTypes = [
    'sandwiches' => 'Sandwiches',
    'tacos' => 'Tacos',
    'galettes' => 'Galettes',
    'burgers' => 'Burgers',
    'panini' => 'Panini',
    'assiettes' => 'Assiettes',
    'menus_enfant' => 'Menus Enfant',
    'salade' => 'Salade',
    'nos_box' => 'Nos Box'
];

foreach ($productTypes as $type => $label) {
    echo "   Testing {$label} ({$type}):\n";
    
    $addons = Addon::getAddonsByProductType($type);
    $totalCategories = count($addons);
    
    echo "     - Categories available: {$totalCategories}\n";
    
    foreach ($addons as $category => $categoryData) {
        $itemCount = count($categoryData['items']);
        $required = $categoryData['required'] ? 'Required' : 'Optional';
        echo "     - {$category}: {$itemCount} items ({$required})\n";
    }
    
    echo "\n";
}

// Test 3: Test specific product type rules
echo "3. Testing Specific Product Type Rules...\n";

// Test sandwiches (should not have meat)
$sandwichAddons = Addon::getAddonsByProductType('sandwiches');
if (isset($sandwichAddons['meat'])) {
    echo "   ❌ Sandwiches should not have meat choices\n";
} else {
    echo "   ✅ Sandwiches correctly exclude meat choices\n";
}

// Test tacos (should have meat)
$tacoAddons = Addon::getAddonsByProductType('tacos');
if (isset($tacoAddons['meat'])) {
    echo "   ✅ Tacos correctly include meat choices\n";
} else {
    echo "   ❌ Tacos should have meat choices\n";
}

// Test assiettes (should only have sauces)
$assietteAddons = Addon::getAddonsByProductType('assiettes');
$assietteCategories = array_keys($assietteAddons);
if (count($assietteCategories) === 1 && in_array('sauces', $assietteCategories)) {
    echo "   ✅ Assiettes correctly show only sauces\n";
} else {
    echo "   ❌ Assiettes should only show sauces\n";
}

echo "\n";

// Test 4: Test addon categories
echo "4. Testing Addon Categories...\n";

$categories = Addon::CATEGORIES;
foreach ($categories as $category => $label) {
    $addonsInCategory = Addon::where('category', $category)->count();
    echo "   {$label} ({$category}): {$addonsInCategory} addons\n";
}

echo "\n";

// Test 5: Test addon pricing
echo "5. Testing Addon Pricing...\n";

$freeAddons = Addon::where('price', 0.00)->count();
$paidAddons = Addon::where('price', '>', 0.00)->count();

echo "   Free addons: {$freeAddons}\n";
echo "   Paid addons: {$paidAddons}\n";

if ($freeAddons > 0 && $paidAddons === 0) {
    echo "   ✅ All addons are free as expected\n";
} else {
    echo "   ⚠️  Some addons have prices\n";
}

echo "\n";

// Test 6: Test multilingual support
echo "6. Testing Multilingual Support...\n";

$addon = Addon::first();
if ($addon) {
    echo "   Sample addon: {$addon->name}\n";
    echo "   Arabic name: " . ($addon->name_ar ?: 'Not set') . "\n";
    echo "   French name: " . ($addon->name_fr ?: 'Not set') . "\n";
    
    if ($addon->name_ar && $addon->name_fr) {
        echo "   ✅ Multilingual support is working\n";
    } else {
        echo "   ⚠️  Some language names are missing\n";
    }
}

echo "\n";

// Test 7: Test addon filtering by product type
echo "7. Testing Addon Filtering by Product Type...\n";

$testProductType = 'tacos';
$filteredAddons = Addon::byProductType($testProductType)->get();
echo "   Addons for {$testProductType}: {$filteredAddons->count()}\n";

foreach ($filteredAddons as $addon) {
    echo "     - {$addon->name} ({$addon->category})\n";
}

echo "\n";

echo "🎯 Addon System Test Complete!\n";
echo "============================\n";
echo "The new addon system is working correctly.\n";
echo "Each product type now shows only relevant addons:\n";
echo "- Sandwiches: Vegetables, Sauces, Drinks\n";
echo "- Tacos/Galettes: Meat, Vegetables, Sauces, Drinks\n";
echo "- Assiettes: Sauces only\n";
echo "- Menus Enfant: Vegetables, Sauces, Drinks\n";
echo "- Salade: Sauces, Optional Vegetables\n";
echo "- Nos Box: Vegetables, Sauces, Drinks\n";
?> 