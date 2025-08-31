<?php
echo "=== UPDATING MOBILE RESPONSIVENESS ===\n\n";

// List of files to update
$files = [
    'resources/views/front/multipurpose/product/kebab_galette.blade.php',
    'resources/views/front/multipurpose/product/americain_kofte.blade.php',
    'resources/views/front/multipurpose/product/tacos.blade.php',
    'resources/views/front/multipurpose/product/burgers.blade.php',
    'resources/views/front/multipurpose/product/panini.blade.php',
    'resources/views/front/multipurpose/product/assiettes.blade.php',
    'resources/views/front/multipurpose/product/menus_enfant.blade.php',
    'resources/views/front/multipurpose/product/salade.blade.php'
];

$updatedCount = 0;

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "❌ File not found: {$file}\n";
        continue;
    }
    
    echo "🔄 Processing: " . basename($file) . "\n";
    
    // Read file content
    $content = file_get_contents($file);
    
    // Add CSS link if not present
    if (strpos($content, 'mobile-responsive.css') === false) {
        $content = str_replace(
            '@extends(\'front.layout\')',
            '@extends(\'front.layout\')\n<link rel="stylesheet" href="{{ asset(\'assets/front/css/mobile-responsive.css\') }}">',
            $content
        );
    }
    
    // Update CTA buttons for mobile responsiveness
    $content = str_replace(
        '<div class="cta-buttons">',
        '<div class="cta-buttons" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">',
        $content
    );
    
    // Update button styles
    $content = str_replace(
        'margin-right: 20px;',
        'min-width: 200px;',
        $content
    );
    
    // Write back to file
    if (file_put_contents($file, $content)) {
        echo "✅ Updated: " . basename($file) . "\n";
        $updatedCount++;
    } else {
        echo "❌ Failed to update: " . basename($file) . "\n";
    }
}

echo "\n=== SUMMARY ===\n";
echo "✅ Files updated: {$updatedCount}\n";
echo "📱 Mobile responsiveness improved\n";
echo "🎨 CSS file: public/assets/front/css/mobile-responsive.css\n"; 