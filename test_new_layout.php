<?php
echo "=== Test de la Nouvelle Structure des Prix ===\n\n";

$viewPath = 'resources/views/front/multipurpose/product/kebab_galette.blade.php';

if (file_exists($viewPath)) {
    $viewContent = file_get_contents($viewPath);
    
    echo "1. Vérification de la nouvelle structure...\n";
    
    // Vérifier que les éléments du menu ont la bonne structure
    $menuItems = ['KEBAB', 'MAXI KEBAB', 'GALETTE', 'AMERICAIN', 'KOFTE'];
    foreach ($menuItems as $item) {
        if (strpos($viewContent, $item) !== false) {
            echo "   ✓ $item trouvé\n";
        } else {
            echo "   ✗ $item NON trouvé\n";
        }
    }
    
    echo "\n2. Vérification de la structure des prix...\n";
    
    // Vérifier que les prix sont dans des divs flex séparés
    $flexDivCount = substr_count($viewContent, 'display: flex; justify-content: space-between; align-items: center;');
    echo "   Nombre de divs flex pour les prix: $flexDivCount\n";
    
    if ($flexDivCount >= 5) {
        echo "   ✓ Structure flex correcte pour les prix\n";
    } else {
        echo "   ✗ Structure flex incorrecte pour les prix\n";
    }
    
    echo "\n3. Vérification de la séparation nom/prix...\n";
    
    // Vérifier que les h4 ont une marge en bas
    $h4WithMargin = substr_count($viewContent, 'margin: 0 0 10px 0');
    if ($h4WithMargin >= 5) {
        echo "   ✓ Espacement correct entre nom et prix\n";
    } else {
        echo "   ✗ Espacement incorrect entre nom et prix\n";
    }
    
    echo "\n4. Vérification de la structure générale...\n";
    
    // Vérifier que la structure est bien organisée
    if (strpos($viewContent, '<h4') !== false && strpos($viewContent, 'display: flex; justify-content: space-between') !== false) {
        echo "   ✓ Structure générale correcte\n";
    } else {
        echo "   ✗ Structure générale incorrecte\n";
    }
    
} else {
    echo "✗ Vue kebab_galette.blade.php non trouvée\n";
}

echo "\n=== Résumé ===\n";
echo "La nouvelle structure devrait maintenant afficher :\n";
echo "\nKEBAB\n";
echo "7,00€                   10,50€\n";
echo "\nMAXI KEBAB\n";
echo "12,00€                  15,00€\n";
echo "\nGALETTE (VIANDE AU CHOIX)\n";
echo "7,50€                   10,50€\n";
echo "\nLes prix 'Seul' et 'Menu' sont maintenant sur la même ligne !\n";
echo "\nTestez maintenant : http://127.0.0.1:8000/menu/kebab-galette\n";
?>
