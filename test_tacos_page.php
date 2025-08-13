<?php
echo "=== Test de la Page Tacos ===\n\n";

// Test 1: Vérifier que la route existe
echo "1. Vérification de la route tacos...\n";
$webRoutes = file_get_contents('routes/web.php');
$tacosRoute = "Route::get('/menu/tacos', 'Front\\ProductController@tacos')->name('front.tacos')";

if (strpos($webRoutes, $tacosRoute) !== false) {
    echo "✓ Route tacos trouvée dans web.php\n";
} else {
    echo "✗ Route tacos NON trouvée dans web.php\n";
}

// Test 2: Vérifier que la méthode tacos existe dans le contrôleur
echo "\n2. Vérification de la méthode tacos dans ProductController...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function tacos') !== false) {
        echo "✓ Méthode tacos trouvée dans ProductController\n";
    } else {
        echo "✗ Méthode tacos NON trouvée dans ProductController\n";
    }
} else {
    echo "✗ ProductController non trouvé\n";
}

// Test 3: Vérifier que la vue tacos.blade.php existe
echo "\n3. Vérification de la vue tacos.blade.php...\n";
$viewPath = 'resources/views/front/multipurpose/product/tacos.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Vue tacos.blade.php existe\n";
    echo "   Taille: " . filesize($viewPath) . " octets\n";
} else {
    echo "✗ Vue tacos.blade.php n'existe pas\n";
}

// Test 4: Vérifier que la page sandwiches_menus pointe vers la page tacos
echo "\n4. Vérification du lien vers tacos dans sandwiches_menus...\n";
$sandwichesViewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($sandwichesViewPath)) {
    $sandwichesContent = file_get_contents($sandwichesViewPath);
    if (strpos($sandwichesContent, "route('front.tacos')") !== false) {
        echo "✓ Lien vers front.tacos trouvé dans sandwiches_menus\n";
    } else {
        echo "✗ Lien vers front.tacos NON trouvé dans sandwiches_menus\n";
    }
} else {
    echo "✗ Vue sandwiches_menus non trouvée\n";
}

// Test 5: Vérifier que la vue tacos utilise le bon layout
echo "\n5. Vérification du layout dans tacos.blade.php...\n";
if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    if (strpos($viewContent, "@extends('front.layout')") !== false) {
        echo "✓ Layout correct : @extends('front.layout')\n";
    } else {
        echo "✗ Layout incorrect\n";
    }
} else {
    echo "✗ Vue tacos non trouvée\n";
}

echo "\n=== Résumé ===\n";
echo "Maintenant, testez cette URL dans votre navigateur :\n";
echo "- http://127.0.0.1:8000/menu/tacos\n";
echo "\nLa page Tacos devrait afficher le menu complet avec :\n";
echo "- NOS TACOS (TACOS, TACOS MIXTE, MEGA TACOS, MEGA TACOS MIXTE)\n";
echo "- NOS BURGERS (CHEESE BURGER, DOUBLE CHEESE, CHICKEN, etc.)\n";
echo "- Images des plats avec effet de lueur\n";
echo "- Prix pour 'Seul' et 'Menu'\n";
?>

