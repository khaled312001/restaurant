<?php
// Check actual HTML output
ob_start();

// Simulate a request
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';

require_once 'public/index.php';

$output = ob_get_contents();
ob_end_clean();

// Find the first few elements
$dom = new DOMDocument();
@$dom->loadHTML($output, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

// Check the first few nodes
$body = $dom->getElementsByTagName('body')->item(0);
if ($body) {
    $firstChild = $body->firstChild;
    if ($firstChild) {
        echo "First child node type: " . $firstChild->nodeType . "\n";
        echo "First child node name: " . $firstChild->nodeName . "\n";
        if ($firstChild->nodeType === XML_TEXT_NODE) {
            echo "First child text content: '" . trim($firstChild->textContent) . "'\n";
            echo "First child text length: " . strlen($firstChild->textContent) . "\n";
            if (strlen(trim($firstChild->textContent)) > 0) {
                echo "⚠️  Text content found before first element!\n";
            }
        }
    }
}

// Check for any text nodes with content
$xpath = new DOMXPath($dom);
$textNodes = $xpath->query('//text()[normalize-space()]');

echo "\nText nodes with content:\n";
foreach ($textNodes as $node) {
    $content = trim($node->textContent);
    if (strlen($content) > 0) {
        echo "Node: '" . $content . "' (Length: " . strlen($content) . ")\n";
        echo "Parent: " . $node->parentNode->nodeName . "\n";
        echo "---\n";
    }
}

// Check the first 200 characters of the output
echo "\nFirst 200 characters of output:\n";
echo bin2hex(substr($output, 0, 200)) . "\n";
echo substr($output, 0, 200) . "\n";
?> 