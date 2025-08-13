<?php
echo "=== Test des Routes Fonctionnelles ===\n\n";

// Test 1: Vérifier que les routes sont bien enregistrées
echo "1. Vérification des routes dans web.php...\n";
$webRoutes = file_get_contents('routes/web.php');

$sandwichsRoute = "Route::get('/menu/sandwichs', 'Front\\ProductController@sandwichesMenus')->name('front.sandwiches')";
$menusRoute = "Route::get('/menu/menus', 'Front\\ProductController@sandwichesMenus')->name('front.menus')";

if (strpos($webRoutes, $sandwichsRoute) !== false) {
    echo "✓ Route sandwichs trouvée dans web.php\n";
} else {
    echo "✗ Route sandwichs NON trouvée dans web.php\n";
}

if (strpos($webRoutes, $menusRoute) !== false) {
    echo "✓ Route menus trouvée dans web.php\n";
} else {
    echo "✗ Route menus NON trouvée dans web.php\n";
}

// Test 2: Vérifier que la méthode sandwichesMenus existe dans le contrôleur
echo "\n2. Vérification de la méthode dans le contrôleur...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function sandwichesMenus') !== false) {
        echo "✓ Méthode sandwichesMenus trouvée dans ProductController\n";
    } else {
        echo "✗ Méthode sandwichesMenus NON trouvée dans ProductController\n";
    }
} else {
    echo "✗ ProductController non trouvé\n";
}

// Test 3: Vérifier que la vue existe
echo "\n3. Vérification de la vue...\n";
$viewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Vue sandwiches_menus.blade.php existe\n";
    echo "   Taille: " . filesize($viewPath) . " octets\n";
} else {
    echo "✗ Vue sandwiches_menus.blade.php n'existe pas\n";
}

// Test 4: Vérifier que la page principale pointe vers les bonnes routes
echo "\n4. Vérification de la page principale...\n";
$productViewPath = 'resources/views/front/multipurpose/product/product.blade.php';
if (file_exists($productViewPath)) {
    $productViewContent = file_get_contents($productViewPath);
    if (strpos($productViewContent, "route('front.sandwiches')") !== false) {
        echo "✓ Page principale pointe vers front.sandwiches\n";
    } else {
        echo "✗ Page principale ne pointe PAS vers front.sandwiches\n";
    }
} else {
    echo "✗ Page principale non trouvée\n";
}

// Test 5: Vérifier que les anciennes vues ont été supprimées
echo "\n5. Vérification de la suppression des anciennes vues...\n";
$oldViews = [
    'resources/views/front/multipurpose/product/sandwiches.blade.php',
    'resources/views/front/multipurpose/product/menus.blade.php'
];

foreach ($oldViews as $view) {
    if (!file_exists($view)) {
        echo "✓ $view a été supprimé\n";
    } else {
        echo "✗ $view existe encore\n";
    }
}

echo "\n=== Résumé ===\n";
echo "Maintenant, testez ces URLs dans votre navigateur :\n";
echo "- http://127.0.0.1:8000/menu/sandwichs\n";
echo "- http://127.0.0.1:8000/menu/menus\n";
echo "\nSi le problème persiste, vérifiez :\n";
echo "1. Que votre serveur Laravel tourne bien\n";
echo "2. Les logs d'erreur dans storage/logs/laravel.log\n";
echo "3. Que vous n'avez pas de cache navigateur\n";
?>
