<?php
echo "=== Test de la Mise en Page des Prix ===\n\n";

// Test 1: Vérifier que les prix sont sur la même ligne
echo "1. Vérification de la mise en page des prix...\n";
$viewPath = 'resources/views/front/multipurpose/product/kebab_galette.blade.php';

if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    
    // Vérifier que les divs inutiles ont été supprimés
    $divCount = substr_count($viewContent, '<div>');
    $h4Count = substr_count($viewContent, '<h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">');
    
    echo "   Nombre de divs simples: $divCount\n";
    echo "   Nombre de titres h4: $h4Count\n";
    
    // Vérifier la structure des éléments du menu
    $menuItems = ['KEBAB', 'MAXI KEBAB', 'GALETTE', 'AMERICAIN', 'KOFTE'];
    $supplements = ['PETITE FRITE', 'GRANDE FRITE', 'PETITE VIANDE', 'GRANDE VIANDE'];
    
    echo "\n2. Vérification de la structure des éléments du menu...\n";
    
    foreach ($menuItems as $item) {
        $pattern = "/<h4[^>]*>$item<\/h4>\s*<span[^>]*>[\d,]+€<\/span>\s*<span[^>]*>[\d,]+€<\/span>/";
        if (preg_match($pattern, $viewContent)) {
            echo "   ✓ $item: Prix sur la même ligne\n";
        } else {
            echo "   ✗ $item: Prix pas sur la même ligne\n";
        }
    }
    
    echo "\n3. Vérification de la structure des suppléments...\n";
    
    foreach ($supplements as $item) {
        $pattern = "/<h4[^>]*>$item<\/h4>\s*<span[^>]*>[\d,]+€<\/span>/";
        if (preg_match($pattern, $viewContent)) {
            echo "   ✓ $item: Prix sur la même ligne\n";
        } else {
            echo "   ✗ $item: Prix pas sur la même ligne\n";
        }
    }
    
    // Vérifier que la structure flex est correcte
    echo "\n4. Vérification de la structure flex...\n";
    if (strpos($viewContent, 'display: flex; justify-content: space-between; align-items: center') !== false) {
        echo "   ✓ Structure flex correcte\n";
    } else {
        echo "   ✗ Structure flex incorrecte\n";
    }
    
} else {
    echo "✗ Vue kebab_galette.blade.php non trouvée\n";
}

echo "\n=== Résumé ===\n";
echo "Maintenant, testez cette URL dans votre navigateur :\n";
echo "- http://127.0.0.1:8000/menu/kebab-galette\n";
echo "\nLes prix devraient maintenant être affichés sur la même ligne que les noms des plats !\n";
echo "Structure attendue :\n";
echo "KEBAB                   7,00€    10,50€\n";
echo "MAXI KEBAB             12,00€    15,00€\n";
echo "GALETTE (VIANDE AU CHOIX) 7,50€    10,50€\n";
echo "etc...\n";
?>
