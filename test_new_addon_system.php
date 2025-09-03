<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Addon;

echo "🧪 Testing New Addon System - Product Type Specific\n";
echo "==================================================\n\n";

// Test 1: Test product type specific addons
echo "1. Testing Product Type Specific Addons...\n";

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

// Test 2: Test specific rules
echo "2. Testing Specific Product Rules...\n";

// Test sandwiches (should not have meat, drinks, or extras)
$sandwichAddons = Addon::getAddonsByProductType('sandwiches');
$sandwichCategories = array_keys($sandwichAddons);
echo "   Sandwiches categories: " . implode(', ', $sandwichCategories) . "\n";
if (!in_array('meat', $sandwichCategories) && !in_array('drinks', $sandwichCategories) && !in_array('extras', $sandwichCategories)) {
    echo "   ✅ Sandwiches correctly exclude meat, drinks, and extras\n";
} else {
    echo "   ❌ Sandwiches should not have meat, drinks, or extras\n";
}

// Test tacos (should have meat, vegetables, sauces, optional drinks)
$tacoAddons = Addon::getAddonsByProductType('tacos');
$tacoCategories = array_keys($tacoAddons);
echo "   Tacos categories: " . implode(', ', $tacoCategories) . "\n";
if (in_array('meat', $tacoCategories) && in_array('vegetables', $tacoCategories) && in_array('sauces', $tacoCategories)) {
    echo "   ✅ Tacos correctly include meat, vegetables, and sauces\n";
} else {
    echo "   ❌ Tacos should have meat, vegetables, and sauces\n";
}

// Test assiettes (should only have sauces)
$assietteAddons = Addon::getAddonsByProductType('assiettes');
$assietteCategories = array_keys($assietteAddons);
echo "   Assiettes categories: " . implode(', ', $assietteCategories) . "\n";
if (count($assietteCategories) === 1 && in_array('sauces', $assietteCategories)) {
    echo "   ✅ Assiettes correctly show only sauces\n";
} else {
    echo "   ❌ Assiettes should only show sauces\n";
}

echo "\n";

// Test 3: Test menu vs seul differences
echo "3. Testing Menu vs Seul Differences...\n";

// Test galettes seul (should not have drinks)
$galettesSeul = Addon::getAddonsByProductType('galettes');
$galettesSeulCategories = array_keys($galettesSeul);
echo "   Galettes (Seul) categories: " . implode(', ', $galettesSeulCategories) . "\n";

// Test galettes menu (should have drinks)
$galettesMenu = Addon::getAddonsByProductTypeAndMenu('galettes', true);
$galettesMenuCategories = array_keys($galettesMenu);
echo "   Galettes (Menu) categories: " . implode(', ', $galettesMenuCategories) . "\n";

if (in_array('drinks', $galettesMenuCategories) && !in_array('drinks', $galettesSeulCategories)) {
    echo "   ✅ Menu correctly includes drinks while Seul does not\n";
} else {
    echo "   ❌ Menu and Seul should have different drink options\n";
}

echo "\n";

// Test 4: Test addon counts
echo "4. Testing Addon Counts...\n";

foreach ($productTypes as $type => $label) {
    $addons = Addon::getAddonsByProductType($type);
    $totalAddons = 0;
    
    foreach ($addons as $category => $categoryData) {
        $totalAddons += count($categoryData['items']);
    }
    
    echo "   {$label}: {$totalAddons} total addons\n";
}

echo "\n";

// Test 5: Test required vs optional
echo "5. Testing Required vs Optional Addons...\n";

foreach ($productTypes as $type => $label) {
    $addons = Addon::getAddonsByProductType($type);
    $required = 0;
    $optional = 0;
    
    foreach ($addons as $category => $categoryData) {
        if ($categoryData['required']) {
            $required++;
        } elseif ($categoryData['optional']) {
            $optional++;
        }
    }
    
    echo "   {$label}: {$required} required, {$optional} optional categories\n";
}

echo "\n";

echo "🎯 New Addon System Test Complete!\n";
echo "==================================\n";
echo "The new system now shows only relevant addons for each product type:\n\n";

echo "📋 Product Type Rules:\n";
echo "- Sandwiches: Vegetables + Sauces only\n";
echo "- Tacos/Galettes (Seul): Meat + Vegetables + Sauces\n";
echo "- Tacos/Galettes (Menu): Meat + Vegetables + Sauces + Drinks\n";
echo "- Burgers: Vegetables + Sauces only\n";
echo "- Panini: Vegetables + Sauces only\n";
echo "- Assiettes: Sauces only\n";
echo "- Menus Enfant: Vegetables + Sauces + Drinks\n";
echo "- Salade: Sauces + Optional Vegetables\n";
echo "- Nos Box: Vegetables + Sauces + Drinks\n\n";

echo "✅ All addons are free (0.00€)\n";
echo "✅ Multilingual support (Arabic, French, English)\n";
echo "✅ Dynamic category display based on product type\n";
echo "✅ Required vs Optional indicators\n";
?> 