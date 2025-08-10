<?php
/**
 * Meal Image Generator Configuration
 * 
 * This file contains all the configuration options for the meal image generator.
 * Modify these values according to your needs.
 */

return [
    // Database Configuration
    'database' => [
        'host' => 'localhost',
        'database' => 'superv', // Updated to correct database name
        'username' => 'root',       // Update this to your database username
        'password' => '',           // Update this to your database password
        'charset' => 'utf8mb4'
    ],
    
    // Image Configuration
    'image' => [
        'width' => 800,
        'height' => 600,
        'quality' => 9, // PNG quality (0-9, 9 being best)
        'format' => 'png'
    ],
    
    // Directory Configuration
    'directories' => [
        'images' => __DIR__ . '/public/assets/front/img/product/featured/',
        'backup' => __DIR__ . '/public/assets/front/img/product/backup/',
        'logs' => __DIR__ . '/logs/'
    ],
    
    // Color Schemes for Different Meal Categories
    'color_schemes' => [
        'default' => [
            'background' => [255, 107, 107],  // Light red
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'burger' => [
            'background' => [255, 152, 0],    // Orange
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'dessert' => [
            'background' => [233, 30, 99],    // Pink
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'beverage' => [
            'background' => [33, 150, 243],   // Blue
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'set_menu' => [
            'background' => [76, 175, 80],    // Green
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'kebab' => [
            'background' => [156, 39, 176],   // Purple
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'pizza' => [
            'background' => [244, 67, 54],    // Red
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ],
        'salad' => [
            'background' => [139, 195, 74],   // Light green
            'text' => [255, 255, 255],        // White
            'accent' => [255, 193, 7],        // Yellow
            'border' => [255, 193, 7]         // Yellow
        ]
    ],
    
    // Text Configuration
    'text' => [
        'max_length' => 30,
        'font_size' => 48,
        'font_path' => __DIR__ . '/arial.ttf', // Path to TTF font file
        'fallback_font_size' => 5,            // Built-in font size if TTF not available
        'text_padding' => 20
    ],
    
    // Decorative Elements
    'decorations' => [
        'circles' => [
            'enabled' => true,
            'radius' => 50,
            'positions' => [
                [100, 100],
                [700, 100],
                [100, 500],
                [700, 500],
                [400, 80],
                [400, 520]
            ]
        ],
        'border' => [
            'enabled' => true,
            'thickness' => 10
        ],
        'gradient' => [
            'enabled' => false,
            'direction' => 'vertical' // vertical, horizontal, diagonal
        ]
    ],
    
    // Processing Options
    'processing' => [
        'backup_existing' => true,
        'overwrite_existing' => false,
        'max_processing_time' => 300, // 5 minutes
        'memory_limit' => '256M'
    ],
    
    // Logging Configuration
    'logging' => [
        'enabled' => true,
        'level' => 'INFO', // DEBUG, INFO, WARNING, ERROR
        'max_log_size' => '10MB',
        'log_rotation' => true
    ],
    
    // Category Mappings (for better color scheme selection)
    'category_mappings' => [
        'برجر' => 'burger',
        'الحلوى' => 'dessert',
        'مشروب' => 'beverage',
        'قائمة الضبط' => 'set_menu',
        'كباب' => 'kebab',
        'بيتزا' => 'pizza',
        'سلطة' => 'salad',
        'burger' => 'burger',
        'dessert' => 'dessert',
        'beverage' => 'beverage',
        'set menu' => 'set_menu',
        'kebab' => 'kebab',
        'pizza' => 'pizza',
        'salad' => 'salad'
    ]
];
?> 