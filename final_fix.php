<?php
// Final comprehensive fix for whitespace issues
$layoutFile = 'resources/views/front/layout.blade.php';
$content = file_get_contents($layoutFile);

// Remove all empty lines and normalize whitespace
$lines = explode("\n", $content);
$cleanedLines = [];

foreach ($lines as $line) {
    $trimmedLine = trim($line);
    if ($trimmedLine !== '') {
        $cleanedLines[] = $trimmedLine;
    }
}

// Reconstruct the content with proper formatting
$cleanedContent = implode("\n", $cleanedLines);

// Write back the cleaned content
file_put_contents($layoutFile, $cleanedContent);

echo "Layout file cleaned with final fix!\n";

// Also clean up the included files
$filesToClean = [
    'resources/views/front/plugin_css.blade.php',
    'resources/views/front/themes_css.blade.php',
    'resources/views/front/themes_header_footer_css.blade.php',
    'resources/views/front/plugin_js.blade.php'
];

foreach ($filesToClean as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        $cleanedLines = [];
        
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if ($trimmedLine !== '') {
                $cleanedLines[] = $trimmedLine;
            }
        }
        
        $cleanedContent = implode("\n", $cleanedLines);
        file_put_contents($file, $cleanedContent);
        echo "Cleaned: $file\n";
    }
}

echo "All files cleaned!\n";
?> 