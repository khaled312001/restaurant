<?php
// Comprehensive encoding check
$files = [
    'resources/views/front/layout.blade.php',
    'resources/views/front/plugin_css.blade.php',
    'resources/views/front/themes_css.blade.php',
    'resources/views/front/themes_header_footer_css.blade.php',
    'resources/views/front/plugin_js.blade.php',
    'public/index.php',
    'bootstrap/app.php',
    'app/Http/Helpers/Helper.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $firstBytes = bin2hex(substr($content, 0, 8));
        
        echo "=== $file ===\n";
        echo "First 8 bytes: $firstBytes\n";
        echo "File size: " . strlen($content) . " bytes\n";
        
        // Check for BOM
        if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
            echo "⚠️  UTF-8 BOM detected!\n";
        } elseif (substr($content, 0, 2) === "\xFF\xFE") {
            echo "⚠️  UTF-16 LE BOM detected!\n";
        } elseif (substr($content, 0, 2) === "\xFE\xFF") {
            echo "⚠️  UTF-16 BE BOM detected!\n";
        } else {
            echo "✅ No BOM detected\n";
        }
        
        // Check for newlines at the beginning
        $firstChar = ord($content[0]);
        echo "First character ASCII: $firstChar (" . chr($firstChar) . ")\n";
        
        if ($firstChar == 10) {
            echo "⚠️  Newline (\\n) at the beginning!\n";
        } elseif ($firstChar == 13) {
            echo "⚠️  Carriage return (\\r) at the beginning!\n";
        } elseif ($firstChar == 32) {
            echo "⚠️  Space at the beginning!\n";
        } elseif ($firstChar == 9) {
            echo "⚠️  Tab at the beginning!\n";
        }
        
        // Check for newlines after PHP opening tag
        if (strpos($content, '<?php') !== false) {
            $phpPos = strpos($content, '<?php');
            $afterPhp = substr($content, $phpPos + 5, 10);
            $afterPhpHex = bin2hex($afterPhp);
            echo "After <?php: $afterPhpHex\n";
            
            if (substr($afterPhp, 0, 1) === "\n") {
                echo "⚠️  Newline after <?php\n";
            }
        }
        
        echo "\n";
    } else {
        echo "=== $file ===\n";
        echo "❌ File not found\n\n";
    }
}
?> 