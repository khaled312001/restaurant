<?php
echo "=== Nettoyage du Cache Laravel ===\n\n";

// Vider le cache des routes
echo "1. Nettoyage du cache des routes...\n";
if (file_exists('bootstrap/cache/routes.php')) {
    unlink('bootstrap/cache/routes.php');
    echo "✓ Cache des routes vidé\n";
} else {
    echo "✓ Pas de cache des routes à vider\n";
}

// Vider le cache des vues
echo "\n2. Nettoyage du cache des vues...\n";
$viewCacheDir = 'bootstrap/cache/views';
if (is_dir($viewCacheDir)) {
    $files = glob($viewCacheDir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "✓ Cache des vues vidé\n";
} else {
    echo "✓ Pas de cache des vues à vider\n";
}

// Vider le cache de configuration
echo "\n3. Nettoyage du cache de configuration...\n";
if (file_exists('bootstrap/cache/config.php')) {
    unlink('bootstrap/cache/config.php');
    echo "✓ Cache de configuration vidé\n";
} else {
    echo "✓ Pas de cache de configuration à vider\n";
}

// Vider le cache général
echo "\n4. Nettoyage du cache général...\n";
$cacheDir = 'bootstrap/cache';
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '/*.php');
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            unlink($file);
        }
    }
    echo "✓ Cache général vidé\n";
} else {
    echo "✓ Pas de cache général à vider\n";
}

echo "\n=== Cache nettoyé avec succès ===\n";
echo "Maintenant, essayez de redémarrer votre serveur web et tester les pages.\n";
?>
