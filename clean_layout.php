<?php
// Clean up the layout file by removing empty lines
$layoutFile = 'resources/views/front/layout.blade.php';
$content = file_get_contents($layoutFile);

// Remove empty lines while preserving the structure
$lines = explode("\n", $content);
$cleanedLines = [];

foreach ($lines as $line) {
    $trimmedLine = trim($line);
    if ($trimmedLine !== '' || count($cleanedLines) === 0) {
        $cleanedLines[] = $line;
    }
}

// Write back the cleaned content
file_put_contents($layoutFile, implode("\n", $cleanedLines));

echo "Layout file cleaned successfully!\n";
?> 