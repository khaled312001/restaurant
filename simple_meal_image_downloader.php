<?php
/**
 * Simple Meal Image Downloader Script
 * 
 * This script generates high-quality placeholder images for each meal
 * and updates the database with the new image names.
 * 
 * Features:
 * - Generates consistent, professional-looking meal images
 * - Updates database automatically
 * - Creates backups of existing images
 * - Comprehensive logging
 * - Easy to customize and extend
 * 
 * @author AI Assistant
 * @version 1.0
 */

// Configuration
$config = [
    'image_directory' => __DIR__ . '/public/assets/front/img/product/featured/',
    'backup_directory' => __DIR__ . '/public/assets/front/img/product/backup/',
    'image_dimensions' => [
        'width' => 800,
        'height' => 600
    ],
    'log_file' => __DIR__ . '/meal_image_downloader.log'
];

// Database configuration (update these values according to your setup)
$db_config = [
    'host' => 'localhost',
    'database' => 'superv', // Updated to correct database name
    'username' => 'root', // Update this to your database username
    'password' => '' // Update this to your database password
];

class SimpleMealImageDownloader {
    private $config;
    private $db_config;
    private $pdo;
    private $log_file;
    private $processed_count = 0;
    private $error_count = 0;
    
    // Color schemes for different meal categories
    private $color_schemes = [
        'default' => [
            'bg' => [255, 107, 107],      // Light red
            'text' => [255, 255, 255],    // White
            'accent' => [255, 193, 7]     // Yellow
        ],
        'burger' => [
            'bg' => [255, 152, 0],        // Orange
            'text' => [255, 255, 255],    // White
            'accent' => [255, 193, 7]     // Yellow
        ],
        'dessert' => [
            'bg' => [233, 30, 99],        // Pink
            'text' => [255, 255, 255],    // White
            'accent' => [255, 193, 7]     // Yellow
        ],
        'beverage' => [
            'bg' => [33, 150, 243],       // Blue
            'text' => [255, 255, 255],    // White
            'accent' => [255, 193, 7]     // Yellow
        ],
        'set_menu' => [
            'bg' => [76, 175, 80],        // Green
            'text' => [255, 255, 255],    // White
            'accent' => [255, 193, 7]     // Yellow
        ]
    ];
    
    public function __construct($config, $db_config) {
        $this->config = $config;
        $this->db_config = $db_config;
        $this->log_file = $config['log_file'];
        $this->setupDirectories();
        $this->connectDatabase();
    }
    
    /**
     * Setup necessary directories
     */
    private function setupDirectories() {
        $directories = [
            $this->config['image_directory'],
            $this->config['backup_directory']
        ];
        
        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                if (mkdir($dir, 0755, true)) {
                    $this->log("Created directory: {$dir}");
                } else {
                    $this->log("Failed to create directory: {$dir}", 'ERROR');
                }
            }
        }
    }
    
    /**
     * Connect to database
     */
    private function connectDatabase() {
        try {
            $dsn = "mysql:host={$this->db_config['host']};dbname={$this->db_config['database']};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->db_config['username'], $this->db_config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->log("Database connection established successfully");
        } catch (PDOException $e) {
            $this->log("Database connection failed: " . $e->getMessage(), 'ERROR');
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get all meals from database
     */
    public function getMeals() {
        try {
            $stmt = $this->pdo->query("
                SELECT p.id, p.title, p.feature_image, p.language_id, p.category_id,
                       pc.name as category_name
                FROM products p
                LEFT JOIN pcategories pc ON p.category_id = pc.id
                WHERE p.status = 1 
                ORDER BY p.id ASC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->log("Error fetching meals: " . $e->getMessage(), 'ERROR');
            return [];
        }
    }
    
    /**
     * Create backup of existing image
     */
    private function backupImage($image_name) {
        if (empty($image_name)) return true;
        
        $source_path = $this->config['image_directory'] . $image_name;
        $backup_path = $this->config['backup_directory'] . $image_name;
        
        if (file_exists($source_path)) {
            if (copy($source_path, $backup_path)) {
                $this->log("Backup created for: {$image_name}");
                return true;
            } else {
                $this->log("Failed to create backup for: {$image_name}", 'WARNING');
                return false;
            }
        }
        return true;
    }
    
    /**
     * Get color scheme based on category
     */
    private function getColorScheme($category_name) {
        if (empty($category_name)) {
            return $this->color_schemes['default'];
        }
        
        $category_lower = strtolower($category_name);
        
        foreach ($this->color_schemes as $key => $scheme) {
            if (strpos($category_lower, $key) !== false) {
                return $scheme;
            }
        }
        
        return $this->color_schemes['default'];
    }
    
    /**
     * Generate meal image
     */
    private function generateMealImage($meal_name, $category_name) {
        try {
            $width = $this->config['image_dimensions']['width'];
            $height = $this->config['image_dimensions']['height'];
            
            // Create image
            $image = imagecreatetruecolor($width, $height);
            
            // Get color scheme
            $colors = $this->getColorScheme($category_name);
            
            // Allocate colors
            $bg_color = imagecolorallocate($image, $colors['bg'][0], $colors['bg'][1], $colors['bg'][2]);
            $text_color = imagecolorallocate($image, $colors['text'][0], $colors['text'][1], $colors['text'][2]);
            $accent_color = imagecolorallocate($image, $colors['accent'][0], $colors['accent'][1], $colors['accent'][2]);
            
            // Fill background
            imagefill($image, 0, 0, $bg_color);
            
            // Add decorative elements
            $this->addDecorativeElements($image, $width, $height, $accent_color);
            
            // Add meal name text
            $this->addMealText($image, $meal_name, $width, $height, $text_color);
            
            // Start output buffering to capture image data
            ob_start();
            imagepng($image, null, 9);
            $image_data = ob_get_contents();
            ob_end_clean();
            
            // Clean up
            imagedestroy($image);
            
            return $image_data;
            
        } catch (Exception $e) {
            $this->log("Failed to generate image: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
    
    /**
     * Add decorative elements to the image
     */
    private function addDecorativeElements($image, $width, $height, $accent_color) {
        // Add some circles for decoration
        $circle_radius = 50;
        $positions = [
            [100, 100],
            [$width - 100, 100],
            [100, $height - 100],
            [$width - 100, $height - 100],
            [$width / 2, 80],
            [$width / 2, $height - 80]
        ];
        
        foreach ($positions as $pos) {
            imagefilledellipse($image, $pos[0], $pos[1], $circle_radius, $circle_radius, $accent_color);
        }
        
        // Add border
        $border_thickness = 10;
        for ($i = 0; $i < $border_thickness; $i++) {
            imagerectangle($image, $i, $i, $width - $i - 1, $height - $i - 1, $accent_color);
        }
    }
    
    /**
     * Add meal name text to the image
     */
    private function addMealText($image, $meal_name, $width, $height, $text_color) {
        // Clean meal name for display
        $display_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $meal_name);
        $display_name = trim($display_name);
        
        // Limit text length
        if (strlen($display_name) > 30) {
            $display_name = substr($display_name, 0, 27) . '...';
        }
        
        // Try to use TTF font if available
        $font_path = __DIR__ . '/arial.ttf';
        $font_size = 48;
        
        if (file_exists($font_path) && function_exists('imagettftext')) {
            // Use TTF font
            $text_box = imagettfbbox($font_size, 0, $font_path, $display_name);
            $text_width = abs($text_box[4] - $text_box[0]);
            $text_height = abs($text_box[5] - $text_box[1]);
            
            $x = ($width - $text_width) / 2;
            $y = ($height + $text_height) / 2;
            
            imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path, $display_name);
        } else {
            // Fallback to built-in font
            $font_size = 5;
            $text_width = strlen($display_name) * imagefontwidth($font_size);
            $text_height = imagefontheight($font_size);
            
            $x = ($width - $text_width) / 2;
            $y = ($height - $text_height) / 2;
            
            imagestring($image, $font_size, $x, $y, $display_name, $text_color);
        }
    }
    
    /**
     * Save image to file
     */
    private function saveImage($image_data, $meal_name) {
        try {
            // Generate filename
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $meal_name) . '.png';
            $filepath = $this->config['image_directory'] . $filename;
            
            // Save image
            if (file_put_contents($filepath, $image_data)) {
                $this->log("Image saved successfully: {$filename}");
                return $filename;
            } else {
                $this->log("Failed to save image: {$filename}", 'ERROR');
                return false;
            }
            
        } catch (Exception $e) {
            $this->log("Error saving image for {$meal_name}: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
    
    /**
     * Update database with new image
     */
    private function updateDatabase($meal_id, $new_image_name) {
        try {
            $stmt = $this->pdo->prepare("UPDATE products SET feature_image = ? WHERE id = ?");
            if ($stmt->execute([$new_image_name, $meal_id])) {
                $this->log("Database updated for meal ID: {$meal_id}");
                return true;
            } else {
                $this->log("Failed to update database for meal ID: {$meal_id}", 'ERROR');
                return false;
            }
        } catch (PDOException $e) {
            $this->log("Database update error: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
    
    /**
     * Process all meals
     */
    public function processAllMeals() {
        $this->log("Starting simple meal image generation process...");
        
        $meals = $this->getMeals();
        $this->log("Found " . count($meals) . " meals to process");
        
        if (empty($meals)) {
            $this->log("No meals found to process", 'WARNING');
            return ['success' => 0, 'errors' => 0];
        }
        
        foreach ($meals as $meal) {
            $this->log("Processing meal: {$meal['title']} (ID: {$meal['id']})");
            
            try {
                // Create backup of existing image
                $this->backupImage($meal['feature_image']);
                
                // Generate new image
                $image_data = $this->generateMealImage($meal['title'], $meal['category_name']);
                
                if ($image_data) {
                    // Save image
                    $new_image_name = $this->saveImage($image_data, $meal['title']);
                    
                    if ($new_image_name) {
                        // Update database
                        if ($this->updateDatabase($meal['id'], $new_image_name)) {
                            $this->processed_count++;
                            $this->log("Successfully processed meal: {$meal['title']}");
                        } else {
                            $this->error_count++;
                            $this->log("Failed to update database for meal: {$meal['title']}", 'ERROR');
                        }
                    } else {
                        $this->error_count++;
                        $this->log("Failed to save image for meal: {$meal['title']}", 'ERROR');
                    }
                } else {
                    $this->error_count++;
                    $this->log("Failed to generate image for meal: {$meal['title']}", 'ERROR');
                }
                
            } catch (Exception $e) {
                $this->error_count++;
                $this->log("Error processing meal {$meal['title']}: " . $e->getMessage(), 'ERROR');
            }
        }
        
        $this->log("Process completed. Success: {$this->processed_count}, Errors: {$this->error_count}");
        return ['success' => $this->processed_count, 'errors' => $this->error_count];
    }
    
    /**
     * Log message to file
     */
    private function log($message, $level = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
        
        file_put_contents($this->log_file, $log_entry, FILE_APPEND | LOCK_EX);
        
        // Also output to console
        echo $log_entry;
    }
}

// Main execution
try {
    echo "=== Simple Meal Image Generator Script ===\n";
    echo "This script will generate high-quality placeholder images for all meals.\n";
    echo "Make sure you have proper database credentials configured.\n\n";
    
    // Check if required extensions are available
    if (!extension_loaded('gd')) {
        die("Error: GD extension is required for image processing.\n");
    }
    
    if (!extension_loaded('pdo_mysql')) {
        die("Error: PDO MySQL extension is required for database operations.\n");
    }
    
    // Create downloader instance
    $generator = new SimpleMealImageDownloader($config, $db_config);
    
    // Process all meals
    $result = $generator->processAllMeals();
    
    echo "\n=== Process Summary ===\n";
    echo "Successfully processed: {$result['success']} meals\n";
    echo "Errors: {$result['errors']} meals\n";
    echo "Check the log file for detailed information: {$config['log_file']}\n";
    
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    echo "Check the log file for more details: {$config['log_file']}\n";
}
?> 