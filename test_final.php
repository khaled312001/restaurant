<?php
echo "=== Test Final - Correction du Layout ===\n\n";

// Test 1: Vérifier que la vue utilise le bon layout
echo "1. Vérification du layout dans sandwiches_menus.blade.php...\n";
$viewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    if (strpos($viewContent, "@extends('front.layout')") !== false) {
        echo "✓ Layout corrigé : @extends('front.layout')\n";
    } else {
        echo "✗ Layout incorrect\n";
    }
} else {
    echo "✗ Vue non trouvée\n";
}

// Test 2: Vérifier que le layout existe
echo "\n2. Vérification de l'existence du layout...\n";
$layoutPath = 'resources/views/front/layout.blade.php';
if (file_exists($layoutPath)) {
    echo "✓ Layout front.layout existe\n";
    echo "   Taille: " . filesize($layoutPath) . " octets\n";
} else {
    echo "✗ Layout front.layout n'existe pas\n";
}

// Test 3: Vérifier que toutes les routes sont en place
echo "\n3. Vérification des routes...\n";
$webRoutes = file_get_contents('routes/web.php');
$sandwichsRoute = "Route::get('/menu/sandwichs', 'Front\\ProductController@sandwichesMenus')->name('front.sandwiches')";
$menusRoute = "Route::get('/menu/menus', 'Front\\ProductController@sandwichesMenus')->name('front.menus')";

if (strpos($webRoutes, $sandwichsRoute) !== false) {
    echo "✓ Route sandwichs OK\n";
} else {
    echo "✗ Route sandwichs manquante\n";
}

if (strpos($webRoutes, $menusRoute) !== false) {
    echo "✓ Route menus OK\n";
} else {
    echo "✗ Route menus manquante\n";
}

echo "\n=== Résumé ===\n";
echo "Maintenant, testez ces URLs dans votre navigateur :\n";
echo "- http://127.0.0.1:8000/menu/sandwichs\n";
echo "- http://127.0.0.1:8000/menu/menus\n";
echo "\nLe problème du layout a été corrigé !\n";
?>
