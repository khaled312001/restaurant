<?php

/**
 * Verify JavaScript validation errors fix
 * This script checks that all necessary files have been updated
 */

echo "=== JavaScript Validation Errors Fix Verification ===\n\n";

// Check configuration files
$configFiles = [
    '.eslintrc.js',
    '.eslintignore',
    '.vscode/settings.json',
    '.vscode/workspace.code-workspace',
    '.vscode/launch.json'
];

echo "Checking configuration files:\n";
foreach ($configFiles as $file) {
    if (file_exists($file)) {
        echo "✓ $file exists\n";
    } else {
        echo "✗ $file missing\n";
    }
}

// Check Blade template files
$bladeFiles = [
    'resources/views/front/multipurpose/product/americain_kofte.blade.php',
    'resources/views/front/multipurpose/product/assiettes.blade.php',
    'resources/views/front/multipurpose/product/burgers.blade.php',
    'resources/views/front/multipurpose/product/kebab_galette.blade.php',
    'resources/views/front/multipurpose/product/nos_box.blade.php',
    'resources/views/front/multipurpose/product/panini.blade.php',
    'resources/views/front/multipurpose/product/tacos.blade.php',
    'resources/views/front/multipurpose/product/salade.blade.php',
    'resources/views/front/multipurpose/product/menus_enfant.blade.php',
    'resources/views/front/multipurpose/qrmenu/layout.blade.php',
    'resources/views/front/qrmenu/layout.blade.php'
];

echo "\nChecking Blade template files for ESLint disable comments:\n";
foreach ($bladeFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if (strpos($content, '{{-- eslint-disable --}}') !== false) {
            echo "✓ $file has ESLint disable comment\n";
        } else {
            echo "✗ $file missing ESLint disable comment\n";
        }
    } else {
        echo "✗ $file not found\n";
    }
}

// Check for automation script
echo "\nChecking automation script:\n";
if (file_exists('fix_javascript_errors.php')) {
    echo "✓ fix_javascript_errors.php exists\n";
} else {
    echo "✗ fix_javascript_errors.php missing\n";
}

echo "\n=== Verification Complete ===\n";
echo "\nTo apply the fix:\n";
echo "1. Restart VS Code completely\n";
echo "2. If using workspace file, open the .code-workspace file\n";
echo "3. Install recommended extensions if prompted\n";
echo "4. JavaScript validation errors should disappear from Blade template files\n"; 