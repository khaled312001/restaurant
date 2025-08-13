<?php
echo "=== Test Simple des Routes ===\n\n";

// Test 1: Vérifier que la vue existe
echo "1. Vérification de la vue sandwiches_menus.blade.php...\n";
$viewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Vue trouvée: $viewPath\n";
    echo "   Taille: " . filesize($viewPath) . " octets\n";
} else {
    echo "✗ Vue non trouvée: $viewPath\n";
}

// Test 2: Vérifier que les anciennes vues ont été supprimées
echo "\n2. Vérification de la suppression des anciennes vues...\n";
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

// Test 3: Vérifier les routes dans web.php
echo "\n3. Vérification des routes dans web.php...\n";
$webRoutes = file_get_contents('routes/web.php');

$sandwichsRoute = "Route::get('/menu/sandwichs', 'Front\\ProductController@sandwichesMenus')->name('front.sandwiches')";
$menusRoute = "Route::get('/menu/menus', 'Front\\ProductController@sandwichesMenus')->name('front.menus')";

if (strpos($webRoutes, $sandwichsRoute) !== false) {
    echo "✓ Route sandwichs trouvée\n";
} else {
    echo "✗ Route sandwichs non trouvée\n";
}

if (strpos($webRoutes, $menusRoute) !== false) {
    echo "✓ Route menus trouvée\n";
} else {
    echo "✗ Route menus non trouvée\n";
}

// Test 4: Vérifier le contrôleur
echo "\n4. Vérification du contrôleur...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function sandwichesMenus') !== false) {
        echo "✓ Méthode sandwichesMenus trouvée dans le contrôleur\n";
    } else {
        echo "✗ Méthode sandwichesMenus non trouvée dans le contrôleur\n";
    }
} else {
    echo "✗ Contrôleur non trouvé: $controllerPath\n";
}

echo "\n=== Test terminé ===\n";
?>
