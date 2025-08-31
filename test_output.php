<?php
// Test file to check for unwanted output
ob_start();

// Include the main application
require_once 'public/index.php';

$output = ob_get_contents();
ob_end_clean();

// Check for any content before DOCTYPE
$doctypePos = strpos($output, '<!doctype');
if ($doctypePos > 0) {
    echo "Found content before DOCTYPE:\n";
    echo "Length: " . $doctypePos . "\n";
    echo "Content: " . bin2hex(substr($output, 0, $doctypePos)) . "\n";
    echo "Text: " . substr($output, 0, $doctypePos) . "\n";
} else {
    echo "No content found before DOCTYPE\n";
}
?> 