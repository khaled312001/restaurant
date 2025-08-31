module.exports = {
    env: {
        browser: true,
        es2021: true,
        jquery: true
    },
    extends: [
        'eslint:recommended'
    ],
    parserOptions: {
        ecmaVersion: 12,
        sourceType: 'module'
    },
    rules: {
        // Disable rules that conflict with Blade template syntax
        'no-unexpected-multiline': 'off',
        'no-trailing-spaces': 'warn',
        'no-unused-vars': 'warn'
    },
    ignorePatterns: [
        // Ignore Blade template files
        '**/*.blade.php',
        // Ignore other template files
        '**/*.php',
        // Ignore vendor files
        'vendor/**',
        // Ignore node modules
        'node_modules/**',
        // Ignore compiled assets
        'public/mix-manifest.json',
        'public/css/**',
        'public/js/**',
        // Ignore all template files
        'resources/views/**/*.blade.php',
        'resources/views/**/*.php'
    ],
    overrides: [
        {
            // For any JavaScript files that might contain Blade-like syntax
            files: ['*.js', '*.jsx'],
            rules: {
                'no-unexpected-multiline': 'off'
            }
        }
    ]
}; 