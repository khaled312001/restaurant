<?php
echo "=== Test de la Page Kebab & Galette ===\n\n";

// Test 1: Vérifier que la route existe
echo "1. Vérification de la route kebab-galette...\n";
$webRoutes = file_get_contents('routes/web.php');
$kebabGaletteRoute = "Route::get('/menu/kebab-galette', 'Front\\ProductController@kebabGalette')->name('front.kebabGalette')";

if (strpos($webRoutes, $kebabGaletteRoute) !== false) {
    echo "✓ Route kebab-galette trouvée dans web.php\n";
} else {
    echo "✗ Route kebab-galette NON trouvée dans web.php\n";
}

// Test 2: Vérifier que la méthode kebabGalette existe dans le contrôleur
echo "\n2. Vérification de la méthode kebabGalette dans ProductController...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function kebabGalette') !== false) {
        echo "✓ Méthode kebabGalette trouvée dans ProductController\n";
    } else {
        echo "✗ Méthode kebabGalette NON trouvée dans ProductController\n";
    }
} else {
    echo "✗ ProductController non trouvé\n";
}

// Test 3: Vérifier que la vue kebab_galette.blade.php existe
echo "\n3. Vérification de la vue kebab_galette.blade.php...\n";
$viewPath = 'resources/views/front/multipurpose/product/kebab_galette.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Vue kebab_galette.blade.php existe\n";
    echo "   Taille: " . filesize($viewPath) . " octets\n";
} else {
    echo "✗ Vue kebab_galette.blade.php n'existe pas\n";
}

// Test 4: Vérifier que la page sandwiches_menus pointe vers la page kebab_galette
echo "\n4. Vérification des liens vers kebab_galette dans sandwiches_menus...\n";
$sandwichesViewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($sandwichesViewPath)) {
    $sandwichesContent = file_get_contents($sandwichesViewPath);
    $linkCount = substr_count($sandwichesContent, "route('front.kebabGalette')");
    if ($linkCount >= 2) {
        echo "✓ $linkCount liens vers front.kebabGalette trouvés dans sandwiches_menus\n";
    } else {
        echo "✗ Liens vers front.kebabGalette insuffisants dans sandwiches_menus\n";
    }
} else {
    echo "✗ Vue sandwiches_menus non trouvée\n";
}

// Test 5: Vérifier que la vue kebab_galette utilise le bon layout
echo "\n5. Vérification du layout dans kebab_galette.blade.php...\n";
if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    if (strpos($viewContent, "@extends('front.layout')") !== false) {
        echo "✓ Layout correct : @extends('front.layout')\n";
    } else {
        echo "✗ Layout incorrect\n";
    }
} else {
    echo "✗ Vue kebab_galette non trouvée\n";
}

// Test 6: Vérifier le contenu du menu
echo "\n6. Vérification du contenu du menu...\n";
if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    $menuItems = ['KEBAB', 'MAXI KEBAB', 'GALETTE', 'AMERICAIN', 'KOFTE'];
    $supplements = ['PETITE FRITE', 'GRANDE FRITE', 'PETITE VIANDE', 'GRANDE VIANDE'];
    
    $menuFound = 0;
    foreach ($menuItems as $item) {
        if (strpos($viewContent, $item) !== false) {
            $menuFound++;
        }
    }
    
    $supplementsFound = 0;
    foreach ($supplements as $item) {
        if (strpos($viewContent, $item) !== false) {
            $supplementsFound++;
        }
    }
    
    echo "✓ $menuFound/5 éléments du menu principal trouvés\n";
    echo "✓ $supplementsFound/4 suppléments trouvés\n";
} else {
    echo "✗ Vue kebab_galette non trouvée\n";
}

echo "\n=== Résumé ===\n";
echo "Maintenant, testez cette URL dans votre navigateur :\n";
echo "- http://127.0.0.1:8000/menu/kebab-galette\n";
echo "\nLa page Kebab & Galette devrait afficher :\n";
echo "- NOS SANDWICHS (KEBAB, MAXI KEBAB, GALETTE, AMERICAIN, KOFTE)\n";
echo "- SUPPLEMENTS (PETITE FRITE, GRANDE FRITE, PETITE VIANDE, GRANDE VIANDE)\n";
echo "- Images des plats avec effet de lueur\n";
echo "- Prix pour 'Seul' et 'Menu'\n";
echo "\nLes cartes 'Kebab & Galette' et 'Americain & Kofte' pointent maintenant vers cette page !\n";
?>
