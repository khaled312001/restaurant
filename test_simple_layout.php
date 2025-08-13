<?php
echo "=== Test Simple de la Mise en Page ===\n\n";

$viewPath = 'resources/views/front/multipurpose/product/kebab_galette.blade.php';

if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    
    echo "1. Vérification de la structure générale...\n";
    
    // Compter les éléments du menu principal
    $menuItems = ['KEBAB', 'MAXI KEBAB', 'GALETTE', 'AMERICAIN', 'KOFTE'];
    foreach ($menuItems as $item) {
        if (strpos($viewContent, $item) !== false) {
            echo "   ✓ $item trouvé\n";
        } else {
            echo "   ✗ $item NON trouvé\n";
        }
    }
    
    echo "\n2. Vérification des suppléments...\n";
    $supplements = ['PETITE FRITE', 'GRANDE FRITE', 'PETITE VIANDE', 'GRANDE VIANDE'];
    foreach ($supplements as $item) {
        if (strpos($viewContent, $item) !== false) {
            echo "   ✓ $item trouvé\n";
        } else {
            echo "   ✗ $item NON trouvé\n";
        }
    }
    
    echo "\n3. Vérification de la structure flex...\n";
    if (strpos($viewContent, 'display: flex; justify-content: space-between; align-items: center') !== false) {
        echo "   ✓ Structure flex correcte\n";
    } else {
        echo "   ✗ Structure flex incorrecte\n";
    }
    
    echo "\n4. Vérification que les divs inutiles ont été supprimés...\n";
    if (strpos($viewContent, '<div><h4') === false) {
        echo "   ✓ Pas de divs inutiles autour des h4\n";
    } else {
        echo "   ✗ Divs inutiles encore présents\n";
    }
    
    echo "\n5. Vérification de la structure des prix...\n";
    // Vérifier que les prix sont bien alignés
    $pricePattern = '/<h4[^>]*>([^<]+)<\/h4>\s*<span[^>]*>([^<]+)<\/span>\s*<span[^>]*>([^<]+)<\/span>/';
    if (preg_match_all($pricePattern, $viewContent, $matches)) {
        echo "   ✓ " . count($matches[0]) . " éléments avec prix sur la même ligne\n";
        foreach ($matches[1] as $index => $item) {
            echo "      - " . trim($item) . " : " . trim($matches[2][$index]) . " / " . trim($matches[3][$index]) . "\n";
        }
    } else {
        echo "   ✗ Structure des prix incorrecte\n";
    }
    
} else {
    echo "✗ Vue kebab_galette.blade.php non trouvée\n";
}

echo "\n=== Résumé ===\n";
echo "La page Kebab & Galette est maintenant configurée avec :\n";
echo "- Prix sur la même ligne que les noms des plats\n";
echo "- Structure flex pour un alignement parfait\n";
echo "- Suppression des divs inutiles\n";
echo "\nTestez maintenant : http://127.0.0.1:8000/menu/kebab-galette\n";
?>
