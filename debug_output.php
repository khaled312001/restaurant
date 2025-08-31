<?php
// Debug file to check output
ob_start();

// Simulate a request to the homepage
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';

// Include the application
require_once 'public/index.php';

$output = ob_get_contents();
ob_end_clean();

// Check the first 100 characters
echo "First 100 characters:\n";
echo bin2hex(substr($output, 0, 100)) . "\n\n";

// Check for any content before DOCTYPE
$doctypePos = stripos($output, '<!doctype');
if ($doctypePos > 0) {
    echo "Content before DOCTYPE found at position: $doctypePos\n";
    echo "Content: " . bin2hex(substr($output, 0, $doctypePos)) . "\n";
    echo "Text: " . substr($output, 0, $doctypePos) . "\n";
} else {
    echo "No content before DOCTYPE found\n";
}

// Check for newlines at the beginning
$firstChar = ord($output[0]);
echo "First character ASCII: $firstChar\n";
if ($firstChar == 10) {
    echo "First character is a newline (\\n)\n";
} elseif ($firstChar == 13) {
    echo "First character is a carriage return (\\r)\n";
} elseif ($firstChar == 239) {
    echo "First character might be BOM\n";
}
?> 