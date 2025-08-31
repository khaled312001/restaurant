<?php
// Check for BOM characters in key files
$files = [
    'resources/views/front/layout.blade.php',
    'resources/views/front/plugin_css.blade.php',
    'resources/views/front/themes_css.blade.php',
    'resources/views/front/themes_header_footer_css.blade.php',
    'resources/views/front/plugin_js.blade.php',
    'public/index.php',
    'bootstrap/app.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $firstBytes = bin2hex(substr($content, 0, 4));
        
        echo "File: $file\n";
        echo "First 4 bytes: $firstBytes\n";
        
        // Check for BOM
        if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
            echo "⚠️  BOM detected!\n";
        } elseif (substr($content, 0, 2) === "\xFF\xFE") {
            echo "⚠️  UTF-16 LE BOM detected!\n";
        } elseif (substr($content, 0, 2) === "\xFE\xFF") {
            echo "⚠️  UTF-16 BE BOM detected!\n";
        } else {
            echo "✅ No BOM detected\n";
        }
        
        // Check for newlines at the beginning
        if (substr($content, 0, 1) === "\n") {
            echo "⚠️  Newline at the beginning!\n";
        }
        if (substr($content, 0, 1) === "\r") {
            echo "⚠️  Carriage return at the beginning!\n";
        }
        
        echo "\n";
    } else {
        echo "File: $file - Not found\n\n";
    }
}
?> 