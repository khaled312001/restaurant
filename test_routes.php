<?php
require_once 'vendor/autoload.php';

// Simuler l'environnement Laravel
putenv('APP_ENV=testing');

echo "=== Test des Routes ===\n\n";

// Test 1: Vérifier que le contrôleur existe
echo "1. Vérification du contrôleur...\n";
if (class_exists('App\Http\Controllers\Front\ProductController')) {
    echo "✓ ProductController existe\n";
} else {
    echo "✗ ProductController n'existe pas\n";
}

// Test 2: Vérifier que la méthode sandwichesMenus existe
echo "\n2. Vérification de la méthode sandwichesMenus...\n";
$controller = new ReflectionClass('App\Http\Controllers\Front\ProductController');
if ($controller->hasMethod('sandwichesMenus')) {
    echo "✓ Méthode sandwichesMenus existe\n";
} else {
    echo "✗ Méthode sandwichesMenus n'existe pas\n";
}

// Test 3: Vérifier que la vue existe
echo "\n3. Vérification de la vue...\n";
$viewPath = 'resources/views/front/multipurpose/product/sandwiches_menus.blade.php';
if (file_exists($viewPath)) {
    echo "✓ Vue sandwiches_menus.blade.php existe\n";
} else {
    echo "✗ Vue sandwiches_menus.blade.php n'existe pas\n";
}

// Test 4: Vérifier que les anciennes vues ont été supprimées
echo "\n4. Vérification de la suppression des anciennes vues...\n";
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

// Test 5: Vérifier les routes dans web.php
echo "\n5. Vérification des routes...\n";
$webRoutes = file_get_contents('routes/web.php');
$routesToCheck = [
    'Route::get(\'/menu/sandwichs\', \'Front\\ProductController@sandwichesMenus\')->name(\'front.sandwichs\')',
    'Route::get(\'/menu/menus\', \'Front\\ProductController@sandwichesMenus\')->name(\'front.menus\')'
];

foreach ($routesToCheck as $route) {
    if (strpos($webRoutes, $route) !== false) {
        echo "✓ Route trouvée: " . substr($route, 0, 50) . "...\n";
    } else {
        echo "✗ Route non trouvée: " . substr($route, 0, 50) . "...\n";
    }
}

echo "\n=== Test terminé ===\n";
?>
