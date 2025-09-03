<?php
echo "=== Cart Delete Test ===\n\n";

// Test 1: Check if route exists
echo "1. Checking route...\n";
$routesPath = 'routes/web.php';
if (file_exists($routesPath)) {
    $routesContent = file_get_contents($routesPath);
    $routeCount = substr_count($routesContent, 'cart.item.remove');
    if ($routeCount > 0) {
        echo "✓ Route cart.item.remove found ($routeCount times)\n";
    } else {
        echo "✗ Route cart.item.remove not found\n";
    }
} else {
    echo "✗ Routes file not found\n";
}

// Test 2: Check if controller method exists
echo "\n2. Checking controller method...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function cartitemremove') !== false) {
        echo "✓ cartitemremove method found\n";
    } else {
        echo "✗ cartitemremove method not found\n";
    }
} else {
    echo "✗ ProductController not found\n";
}

echo "\n=== Test Complete ===\n";
echo "To test the delete button:\n";
echo "1. Go to: http://127.0.0.1:8000/cart\n";
echo "2. Open Developer Tools (F12)\n";
echo "3. Go to Console tab\n";
echo "4. Click on 'Supprimer' button\n";
echo "5. Check console messages\n";
echo "6. Check Network tab for AJAX request\n"; 