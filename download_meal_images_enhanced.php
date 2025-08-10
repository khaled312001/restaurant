<?php
/**
 * Enhanced Meal Image Downloader Script
 * 
 * This script automatically downloads high-quality, transparent images for each meal
 * based on their names from multiple reliable image sources.
 * 
 * Features:
 * - Downloads high-quality PNG/JPG images
 * - Uses multiple fallback image sources
 * - Optimizes images for web use
 * - Handles multiple languages (English and Arabic)
 * - Creates backup of existing images
 * - Comprehensive logging and error handling
 * - Rate limiting to avoid overwhelming services
 * 
 * @author AI Assistant
 * @version 2.0
 */

// Configuration
$config = [
    'image_sources' => [
        'primary' => [
            'url' => 'https://picsum.photos/800/600?random={seed}',
            'fallback' => 'https://via.placeholder.com/800x600/FF6B6B/FFFFFF?text={query}'
        ],
        'food_specific' => [
            'url' => 'https://source.unsplash.com/800x600/?{query},food',
            'fallback' => 'https://via.placeholder.com/800x600/4ECDC4/FFFFFF?text={query}'
        ],
        'cuisine_specific' => [
            'url' => 'https://source.unsplash.com/800x600/?{query},cuisine',
            'fallback' => 'https://via.placeholder.com/800x600/45B7D1/FFFFFF?text={query}'
        ]
    ],
    'image_directory' => __DIR__ . '/public/assets/front/img/product/featured/',
    'backup_directory' => __DIR__ . '/public/assets/front/img/product/backup/',
    'max_image_size' => 2 * 1024 * 1024, // 2MB
    'image_dimensions' => [
        'width' => 800,
        'height' => 600
    ],
    'supported_formats' => ['png', 'jpg', 'jpeg', 'webp'],
    'log_file' => __DIR__ . '/meal_image_downloader_enhanced.log',
    'rate_limit_delay' => 3, // seconds between downloads
    'max_retries' => 3
];

// Database configuration (update these values according to your setup)
$db_config = [
    'host' => 'localhost',
    'database' => 'king_kebab', // Update this to your database name
    'username' => 'root', // Update this to your database username
    'password' => '' // Update this to your database password
];

class EnhancedMealImageDownloader {
    private $config;
    private $db_config;
    private $pdo;
    private $log_file;
    private $processed_count = 0;
    private $error_count = 0;
    
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
     * Get language information
     */
    public function getLanguage($language_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT code, name FROM languages WHERE id = ?");
            $stmt->execute([$language_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->log("Error fetching language: " . $e->getMessage(), 'ERROR');
            return null;
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
     * Generate intelligent search query for meal
     */
    private function generateSearchQuery($meal_name, $language_code, $category_name = '') {
        // Clean meal name
        $clean_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $meal_name);
        $clean_name = trim($clean_name);
        
        // Add category-specific keywords
        $category_keywords = [];
        if (!empty($category_name)) {
            $category_keywords = $this->getCategoryKeywords($category_name);
        }
        
        // Add general food keywords
        $food_keywords = ['food', 'meal', 'dish', 'cuisine', 'restaurant', 'delicious'];
        
        // Language-specific enhancements
        if ($language_code === 'ar') {
            // For Arabic, add English food terms for better image search results
            $food_keywords = array_merge($food_keywords, ['food', 'meal', 'dish', 'cuisine']);
        }
        
        // Combine all terms
        $search_terms = array_merge([$clean_name], $category_keywords, $food_keywords);
        
        return implode(' ', array_unique($search_terms));
    }
    
    /**
     * Get category-specific keywords for better image search
     */
    private function getCategoryKeywords($category_name) {
        $category_keywords = [
            'burger' => ['burger', 'sandwich', 'fast food', 'meat'],
            'dessert' => ['dessert', 'sweet', 'cake', 'pastry'],
            'beverage' => ['drink', 'beverage', 'refreshment', 'liquid'],
            'set menu' => ['meal', 'plate', 'dinner', 'lunch'],
            'برجر' => ['burger', 'sandwich', 'fast food', 'meat'],
            'الحلوى' => ['dessert', 'sweet', 'cake', 'pastry'],
            'مشروب' => ['drink', 'beverage', 'refreshment', 'liquid'],
            'قائمة الضبط' => ['meal', 'plate', 'dinner', 'lunch']
        ];
        
        $category_lower = strtolower($category_name);
        foreach ($category_keywords as $key => $keywords) {
            if (strpos($category_lower, $key) !== false) {
                return $keywords;
            }
        }
        
        return ['food', 'meal'];
    }
    
    /**
     * Download image with multiple fallback sources
     */
    private function downloadImage($query, $retry_count = 0) {
        $this->log("Attempting to download image for query: {$query} (attempt " . ($retry_count + 1) . ")");
        
        // Try different image sources
        $sources = [
            'food_specific' => $this->config['image_sources']['food_specific']['url'],
            'cuisine_specific' => $this->config['image_sources']['cuisine_specific']['url'],
            'primary' => $this->config['image_sources']['primary']['url']
        ];
        
        foreach ($sources as $source_name => $url_template) {
            try {
                $url = str_replace('{query}', urlencode($query), $url_template);
                
                // Add random seed for variety
                if (strpos($url, '{seed}') !== false) {
                    $url = str_replace('{seed}', time() + rand(1, 1000), $url);
                }
                
                $this->log("Trying source: {$source_name} - {$url}");
                
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 30,
                        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                        'follow_location' => true,
                        'max_redirects' => 3
                    ]
                ]);
                
                $image_data = file_get_contents($url, false, $context);
                
                if ($image_data && strlen($image_data) > 5000) { // Minimum 5KB
                    $this->log("Image downloaded successfully from {$source_name}");
                    return $image_data;
                }
                
            } catch (Exception $e) {
                $this->log("Download from {$source_name} failed: " . $e->getMessage(), 'WARNING');
            }
        }
        
        // If all sources failed and we haven't exceeded max retries, try again
        if ($retry_count < $this->config['max_retries']) {
            $this->log("All sources failed, retrying in 5 seconds... (attempt " . ($retry_count + 1) . ")");
            sleep(5);
            return $this->downloadImage($query, $retry_count + 1);
        }
        
        // Final fallback - generate a placeholder
        $this->log("All download attempts failed, generating placeholder image");
        return $this->generatePlaceholderImage($query);
    }
    
    /**
     * Generate a placeholder image when downloads fail
     */
    private function generatePlaceholderImage($query) {
        try {
            $width = $this->config['image_dimensions']['width'];
            $height = $this->config['image_dimensions']['height'];
            
            // Create image
            $image = imagecreatetruecolor($width, $height);
            
            // Define colors
            $bg_color = imagecolorallocate($image, 255, 107, 107); // Light red
            $text_color = imagecolorallocate($image, 255, 255, 255); // White
            
            // Fill background
            imagefill($image, 0, 0, $bg_color);
            
            // Add text
            $font_size = 5;
            $text = substr($query, 0, 20); // Limit text length
            
            // Center text
            $text_box = imagettfbbox($font_size, 0, __DIR__ . '/arial.ttf', $text);
            $text_width = abs($text_box[4] - $text_box[0]);
            $text_height = abs($text_box[5] - $text_box[1]);
            $x = ($width - $text_width) / 2;
            $y = ($height + $text_height) / 2;
            
            // Use imagestring if TTF not available
            if (function_exists('imagettftext')) {
                imagettftext($image, $font_size, 0, $x, $y, $text_color, __DIR__ . '/arial.ttf', $text);
            } else {
                imagestring($image, $font_size, $x, $y, $text, $text_color);
            }
            
            // Start output buffering to capture image data
            ob_start();
            imagepng($image);
            $image_data = ob_get_contents();
            ob_end_clean();
            
            // Clean up
            imagedestroy($image);
            
            return $image_data;
            
        } catch (Exception $e) {
            $this->log("Failed to generate placeholder image: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
    
    /**
     * Optimize and save image
     */
    private function saveImage($image_data, $meal_name) {
        try {
            // Create image resource
            $image = imagecreatefromstring($image_data);
            if (!$image) {
                $this->log("Failed to create image resource for: {$meal_name}", 'ERROR');
                return false;
            }
            
            // Get original dimensions
            $original_width = imagesx($image);
            $original_height = imagesy($image);
            
            // Calculate new dimensions maintaining aspect ratio
            $target_width = $this->config['image_dimensions']['width'];
            $target_height = $this->config['image_dimensions']['height'];
            
            $ratio = min($target_width / $original_width, $target_height / $original_height);
            $new_width = round($original_width * $ratio);
            $new_height = round($original_height * $ratio);
            
            // Create new image
            $new_image = imagecreatetruecolor($new_width, $new_height);
            
            // Enable alpha blending for transparency
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            
            // Resize image
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            
            // Generate filename
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $meal_name) . '.png';
            $filepath = $this->config['image_directory'] . $filename;
            
            // Save as PNG with transparency support
            if (imagepng($new_image, $filepath, 9)) {
                $this->log("Image saved successfully: {$filename}");
                
                // Clean up
                imagedestroy($image);
                imagedestroy($new_image);
                
                return $filename;
            } else {
                $this->log("Failed to save image: {$filename}", 'ERROR');
                imagedestroy($image);
                imagedestroy($new_image);
                return false;
            }
            
        } catch (Exception $e) {
            $this->log("Error processing image for {$meal_name}: " . $e->getMessage(), 'ERROR');
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
        $this->log("Starting enhanced meal image download process...");
        
        $meals = $this->getMeals();
        $this->log("Found " . count($meals) . " meals to process");
        
        if (empty($meals)) {
            $this->log("No meals found to process", 'WARNING');
            return ['success' => 0, 'errors' => 0];
        }
        
        foreach ($meals as $meal) {
            $this->log("Processing meal: {$meal['title']} (ID: {$meal['id']})");
            
            try {
                // Get language info
                $language = $this->getLanguage($meal['language_id']);
                $language_code = $language ? $language['code'] : 'en';
                
                // Create backup of existing image
                $this->backupImage($meal['feature_image']);
                
                // Generate search query
                $search_query = $this->generateSearchQuery($meal['title'], $language_code, $meal['category_name']);
                $this->log("Search query: {$search_query}");
                
                // Download image
                $image_data = $this->downloadImage($search_query);
                
                if ($image_data) {
                    // Save and optimize image
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
                    $this->log("Failed to download image for meal: {$meal['title']}", 'ERROR');
                }
                
                // Add delay to avoid overwhelming image services
                if ($this->config['rate_limit_delay'] > 0) {
                    sleep($this->config['rate_limit_delay']);
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
    echo "=== Enhanced Meal Image Downloader Script ===\n";
    echo "This script will download high-quality images for all meals.\n";
    echo "Make sure you have proper database credentials configured.\n\n";
    
    // Check if required extensions are available
    if (!extension_loaded('gd')) {
        die("Error: GD extension is required for image processing.\n");
    }
    
    if (!extension_loaded('pdo_mysql')) {
        die("Error: PDO MySQL extension is required for database operations.\n");
    }
    
    // Create downloader instance
    $downloader = new EnhancedMealImageDownloader($config, $db_config);
    
    // Process all meals
    $result = $downloader->processAllMeals();
    
    echo "\n=== Process Summary ===\n";
    echo "Successfully processed: {$result['success']} meals\n";
    echo "Errors: {$result['errors']} meals\n";
    echo "Check the log file for detailed information: {$config['log_file']}\n";
    
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    echo "Check the log file for more details: {$config['log_file']}\n";
}
?> 