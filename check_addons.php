<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Addon;

echo "=== AVAILABLE ADDONS ===\n\n";

$addons = Addon::where('is_active', 1)->orderBy('category')->orderBy('name')->get();

$grouped = [];
foreach ($addons as $addon) {
    if (!isset($grouped[$addon->category])) {
        $grouped[$addon->category] = [];
    }
    $grouped[$addon->category][] = $addon;
}

foreach ($grouped as $category => $categoryAddons) {
    echo strtoupper($category) . ":\n";
    foreach ($categoryAddons as $addon) {
        echo "  - {$addon->name} ({$addon->name_fr}) - {$addon->price}€\n";
    }
    echo "\n";
}

// Check nos_box specific addons
echo "=== NOS BOX ADDONS ===\n";
$nosBoxAddons = Addon::getAddonsByProductType('nos_box');
foreach ($nosBoxAddons as $category => $data) {
    echo strtoupper($category) . " (Required: " . ($data['required'] ? 'Yes' : 'No') . "):\n";
    foreach ($data['items'] as $addon) {
        echo "  - {$addon->name} ({$addon->name_fr}) - {$addon->price}€\n";
    }
    echo "\n";
}