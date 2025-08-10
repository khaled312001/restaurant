<?php
/**
 * Meal Image Downloader Script
 * 
 * This script automatically downloads high-quality, transparent images for each meal
 * based on their names from multiple image sources including Unsplash, Pexels, and Pixabay.
 * 
 * Features:
 * - Downloads transparent PNG images when possible
 * - Falls back to high-quality JPG images
 * - Optimizes images for web use
 * - Handles multiple languages (English and Arabic)
 * - Creates backup of existing images
 * - Logs all operations
 * 
 * @author AI Assistant
 * @version 1.0
 */

// Configuration
$config = [
    'image_sources' => [
        'unsplash' => [
            'api_key' => '', // Add your Unsplash API key here if you have one
            'base_url' => 'https://api.unsplash.com/search/photos',
            'fallback_url' => 'https://source.unsplash.com/featured/?{query}&transparent'
        ],
        'pexels' => [
            'api_key' => '', // Add your Pexels API key here if you have one
            'base_url' => 'https://api.pexels.com/v1/search',
            'fallback_url' => 'https://images.pexels.com/photos/random?query={query}&transparent'
        ],
        'pixabay' => [
            'api_key' => '', // Add your Pixabay API key here if you have one
            'base_url' => 'https://pixabay.com/api/',
            'fallback_url' => 'https://pixabay.com/images/search/{query}/?transparent'
        ]
    ],
    'image_directory' => __DIR__ . '/public/assets/front/img/product/featured/',
    'backup_directory' => __DIR__ . '/public/assets/front/img/product/backup/',
    'max_image_size' => 1024 * 1024, // 1MB
    'image_dimensions' => [
        'width' => 800,
        'height' => 600
    ],
    'supported_formats' => ['png', 'jpg', 'jpeg', 'webp'],
    'log_file' => __DIR__ . '/meal_image_downloader.log'
];

// Database configuration (update these values according to your setup)
$db_config = [
    'host' => 'localhost',
    'database' => 'king_kebab', // Update this to your database name
    'username' => 'root', // Update this to your database username
    'password' => '' // Update this to your database password
];

class MealImageDownloader {
    private $config;
    private $db_config;
    private $pdo;
    private $log_file;
    
    public function __init__($config, $db_config) {
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
        if (!is_dir($this->config['image_directory'])) {
            mkdir($this->config['image_directory'], 0755, true);
        }
        
        if (!is_dir($this->config['backup_directory'])) {
            mkdir($this->config['backup_directory'], 0755, true);
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
                SELECT id, title, feature_image, language_id 
                FROM products 
                WHERE status = 1 
                ORDER BY id ASC
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
     * Generate search query for meal
     */
    private function generateSearchQuery($meal_name, $language_code) {
        // Clean meal name
        $clean_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $meal_name);
        $clean_name = trim($clean_name);
        
        // Add food-related keywords for better results
        $food_keywords = ['food', 'meal', 'dish', 'cuisine', 'restaurant'];
        
        // Language-specific enhancements
        if ($language_code === 'ar') {
            // For Arabic, add English food terms for better image search results
            $food_keywords = array_merge($food_keywords, ['food', 'meal', 'dish']);
        }
        
        // Combine meal name with food keywords
        $search_terms = array_merge([$clean_name], $food_keywords);
        
        return implode(' ', $search_terms);
    }
    
    /**
     * Download image from Unsplash
     */
    private function downloadFromUnsplash($query) {
        $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['unsplash']['fallback_url']);
        
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]
            ]);
            
            $image_data = file_get_contents($url, false, $context);
            
            if ($image_data && strlen($image_data) > 1000) {
                return $image_data;
            }
        } catch (Exception $e) {
            $this->log("Unsplash download failed: " . $e->getMessage(), 'WARNING');
        }
        
        return false;
    }
    
    /**
     * Download image from Pexels
     */
    private function downloadFromPexels($query) {
        $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['pexels']['fallback_url']);
        
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]
            ]);
            
            $image_data = file_get_contents($url, false, $context);
            
            if ($image_data && strlen($image_data) > 1000) {
                return $image_data;
            }
        } catch (Exception $e) {
            $this->log("Pexels download failed: " . $e->getMessage(), 'WARNING');
        }
        
        return false;
    }
    
    /**
     * Download image from Pixabay
     */
    private function downloadFromPixabay($query) {
        $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['pixabay']['fallback_url']);
        
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]
            ]);
            
            $image_data = file_get_contents($url, false, $context);
            
            if ($image_data && strlen($image_data) > 1000) {
                return $image_data;
            }
        } catch (Exception $e) {
            $this->log("Pixabay download failed: " . $e->getMessage(), 'WARNING');
        }
        
        return false;
    }
    
    /**
     * Download image from multiple sources
     */
    private function downloadImage($query) {
        $this->log("Attempting to download image for query: {$query}");
        
        // Try Unsplash first
        $image_data = $this->downloadFromUnsplash($query);
        if ($image_data) {
            $this->log("Image downloaded successfully from Unsplash");
            return $image_data;
        }
        
        // Try Pexels
        $image_data = $this->downloadFromPexels($query);
        if ($image_data) {
            $this->log("Image downloaded successfully from Pexels");
            return $image_data;
        }
        
        // Try Pixabay
        $image_data = $this->downloadFromPixabay($query);
        if ($image_data) {
            $this->log("Image downloaded successfully from Pixabay");
            return $image_data;
        }
        
        $this->log("Failed to download image from all sources", 'ERROR');
        return false;
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
        $this->log("Starting meal image download process...");
        
        $meals = $this->getMeals();
        $this->log("Found " . count($meals) . " meals to process");
        
        $success_count = 0;
        $error_count = 0;
        
        foreach ($meals as $meal) {
            $this->log("Processing meal: {$meal['title']} (ID: {$meal['id']})");
            
            try {
                // Get language info
                $language = $this->getLanguage($meal['language_id']);
                $language_code = $language ? $language['code'] : 'en';
                
                // Create backup of existing image
                $this->backupImage($meal['feature_image']);
                
                // Generate search query
                $search_query = $this->generateSearchQuery($meal['title'], $language_code);
                $this->log("Search query: {$search_query}");
                
                // Download image
                $image_data = $this->downloadImage($search_query);
                
                if ($image_data) {
                    // Save and optimize image
                    $new_image_name = $this->saveImage($image_data, $meal['title']);
                    
                    if ($new_image_name) {
                        // Update database
                        if ($this->updateDatabase($meal['id'], $new_image_name)) {
                            $success_count++;
                            $this->log("Successfully processed meal: {$meal['title']}");
                        } else {
                            $error_count++;
                            $this->log("Failed to update database for meal: {$meal['title']}", 'ERROR');
                        }
                    } else {
                        $error_count++;
                        $this->log("Failed to save image for meal: {$meal['title']}", 'ERROR');
                    }
                } else {
                    $error_count++;
                    $this->log("Failed to download image for meal: {$meal['title']}", 'ERROR');
                }
                
                // Add delay to avoid overwhelming image services
                sleep(2);
                
            } catch (Exception $e) {
                $error_count++;
                $this->log("Error processing meal {$meal['title']}: " . $e->getMessage(), 'ERROR');
            }
        }
        
        $this->log("Process completed. Success: {$success_count}, Errors: {$error_count}");
        return ['success' => $success_count, 'errors' => $error_count];
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
    echo "=== Meal Image Downloader Script ===\n";
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
    $downloader = new MealImageDownloader();
    $downloader->__init__($config, $db_config);
    
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