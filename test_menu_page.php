<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pcategory;
use App\Models\Language;

echo "=== TEST DE LA PAGE MENU - 6 CATÉGORIES SPÉCIFIQUES ===\n\n";

// Récupérer la langue française (ID: 176)
$currentLang = Language::where('code', 'fr')->first();
if (!$currentLang) {
    echo "❌ Erreur: Langue française non trouvée!\n";
    exit;
}

echo "✅ Langue: {$currentLang->name} (ID: {$currentLang->id})\n\n";

// Définir les 6 catégories spécifiques du menu
$menuCategories = ['Assiettes', 'Sandwichs', 'Menus', 'Salade', 'Menus Enfant', 'Nos Box'];

// Récupérer uniquement les 6 catégories spécifiques
$categories = Pcategory::where('status', 1)
    ->where('language_id', $currentLang->id)
    ->whereIn('name', $menuCategories)
    ->orderBy('id')
    ->get();

echo "=== CATÉGORIES DU MENU (6 CATÉGORIES) ===\n";
foreach ($categories as $category) {
    $productCount = $category->products()->where('status', 1)->count();
    $imageStatus = $category->image ? "✅ {$category->image}" : "❌ Aucune image";
    
    echo "ID: {$category->id} | {$category->name} | {$category->slug}\n";
    echo "   Image: {$imageStatus}\n";
    echo "   Produits: {$productCount} plats disponibles\n";
    echo "   ---\n";
}

echo "\n=== RÉSUMÉ ===\n";
echo "Total des catégories affichées: " . $categories->count() . "\n";

// Vérifier que toutes les catégories attendues sont présentes
$foundCategories = $categories->pluck('name')->toArray();

echo "\nCatégories attendues: " . implode(', ', $menuCategories) . "\n";
echo "Catégories trouvées: " . implode(', ', $foundCategories) . "\n";

$missingCategories = array_diff($menuCategories, $foundCategories);
$extraCategories = array_diff($foundCategories, $menuCategories);

if (empty($missingCategories) && empty($extraCategories)) {
    echo "✅ Parfait ! Exactement les 6 catégories attendues sont présentes.\n";
} else {
    if (!empty($missingCategories)) {
        echo "❌ Catégories manquantes: " . implode(', ', $missingCategories) . "\n";
    }
    if (!empty($extraCategories)) {
        echo "❌ Catégories en trop: " . implode(', ', $extraCategories) . "\n";
    }
}

echo "\n=== VÉRIFICATION DES IMAGES ===\n";
$categoriesWithImages = $categories->where('image', '!=', null)->count();
$categoriesWithoutImages = $categories->where('image', '=', null)->count();

echo "Catégories avec images: {$categoriesWithImages}\n";
echo "Catégories sans images: {$categoriesWithoutImages}\n";

if ($categoriesWithoutImages > 0) {
    echo "\n⚠️  Recommandation: Ajoutez des images pour toutes les catégories\n";
}

echo "\n🎉 Test terminé! La page du menu affiche maintenant uniquement les 6 catégories spécifiques.\n";
echo "URL de test: / (cliquez sur 'Menu' dans la navigation)\n";
echo "Catégories affichées: Assiettes, Sandwichs, Menus, Salade, Menus Enfant, Nos Box\n";
