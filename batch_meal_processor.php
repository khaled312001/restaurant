<?php
/**
 * Batch Meal Image Processor
 * 
 * This script processes meals in batches for better performance and memory management.
 * It's designed to handle large numbers of meals without overwhelming the system.
 * 
 * @author AI Assistant
 * @version 1.0
 */

// Load configuration
$config_file = __DIR__ . '/meal_image_config.php';
if (!file_exists($config_file)) {
    die("Configuration file not found. Please run the main script first.\n");
}

$config = include $config_file;

// Batch processing configuration
$batch_config = [
    'batch_size' => 10,           // Process 10 meals at a time
    'delay_between_batches' => 5, // 5 seconds between batches
    'max_batches' => 50,          // Maximum 50 batches (500 meals)
    'memory_limit' => '512M'      // Increase memory limit for batch processing
];

// Set memory limit
ini_set('memory_limit', $batch_config['memory_limit']);

class BatchMealProcessor {
    private $config;
    private $batch_config;
    private $pdo;
    private $log_file;
    private $total_processed = 0;
    private $total_errors = 0;
    private $batch_count = 0;
    
    public function __construct($config, $batch_config) {
        $this->config = $config;
        $this->batch_config = $batch_config;
        $this->log_file = $config['directories']['logs'] . 'batch_processor.log';
        $this->setupDirectories();
        $this->connectDatabase();
    }
    
    /**
     * Setup necessary directories
     */
    private function setupDirectories() {
        $directories = [
            $this->config['directories']['images'],
            $this->config['directories']['backup'],
            $this->config['directories']['logs']
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
            $db_config = $this->config['database'];
            $dsn = "mysql:host={$db_config['host']};dbname={$db_config['database']};charset={$db_config['charset']}";
            $this->pdo = new PDO($dsn, $db_config['username'], $db_config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->log("Database connection established successfully");
        } catch (PDOException $e) {
            $this->log("Database connection failed: " . $e->getMessage(), 'ERROR');
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get total count of meals to process
     */
    public function getTotalMealCount() {
        try {
            $stmt = $this->pdo->query("
                SELECT COUNT(*) as total 
                FROM products 
                WHERE status = 1
            ");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            $this->log("Error getting meal count: " . $e->getMessage(), 'ERROR');
            return 0;
        }
    }
    
    /**
     * Get meals for a specific batch
     */
    public function getMealsBatch($offset, $limit) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.id, p.title, p.feature_image, p.language_id, p.category_id,
                       pc.name as category_name
                FROM products p
                LEFT JOIN pcategories pc ON p.category_id = pc.id
                WHERE p.status = 1 
                ORDER BY p.id ASC
                LIMIT ? OFFSET ?
            ");
            $stmt->execute([$limit, $offset]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->log("Error fetching meals batch: " . $e->getMessage(), 'ERROR');
            return [];
        }
    }
    
    /**
     * Process a single meal
     */
    private function processMeal($meal) {
        try {
            $this->log("Processing meal: {$meal['title']} (ID: {$meal['id']})");
            
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
                        $this->total_processed++;
                        $this->log("Successfully processed meal: {$meal['title']}");
                        return true;
                    } else {
                        $this->total_errors++;
                        $this->log("Failed to update database for meal: {$meal['title']}", 'ERROR');
                        return false;
                    }
                } else {
                    $this->total_errors++;
                    $this->log("Failed to save image for meal: {$meal['title']}", 'ERROR');
                    return false;
                }
            } else {
                $this->total_errors++;
                $this->log("Failed to generate image for meal: {$meal['title']}", 'ERROR');
                return false;
            }
            
        } catch (Exception $e) {
            $this->total_errors++;
            $this->log("Error processing meal {$meal['title']}: " . $e->getMessage(), 'ERROR');
            return false;
        }
    }
    
    /**
     * Create backup of existing image
     */
    private function backupImage($image_name) {
        if (empty($image_name)) return true;
        
        $source_path = $this->config['directories']['images'] . $image_name;
        $backup_path = $this->config['directories']['backup'] . $image_name;
        
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
     * Generate meal image using configuration
     */
    private function generateMealImage($meal_name, $category_name) {
        try {
            $width = $this->config['image']['width'];
            $height = $this->config['image']['height'];
            
            // Create image
            $image = imagecreatetruecolor($width, $height);
            
            // Get color scheme
            $colors = $this->getColorScheme($category_name);
            
            // Allocate colors
            $bg_color = imagecolorallocate($image, $colors['background'][0], $colors['background'][1], $colors['background'][2]);
            $text_color = imagecolorallocate($image, $colors['text'][0], $colors['text'][1], $colors['text'][2]);
            $accent_color = imagecolorallocate($image, $colors['accent'][0], $colors['accent'][1], $colors['accent'][2]);
            $border_color = imagecolorallocate($image, $colors['border'][0], $colors['border'][1], $colors['border'][2]);
            
            // Fill background
            imagefill($image, 0, 0, $bg_color);
            
            // Add decorative elements
            $this->addDecorativeElements($image, $width, $height, $accent_color);
            
            // Add meal name text
            $this->addMealText($image, $meal_name, $width, $height, $text_color);
            
            // Start output buffering to capture image data
            ob_start();
            imagepng($image, null, $this->config['image']['quality']);
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
     * Get color scheme based on category
     */
    private function getColorScheme($category_name) {
        if (empty($category_name)) {
            return $this->config['color_schemes']['default'];
        }
        
        $category_lower = strtolower($category_name);
        
        // Check category mappings first
        foreach ($this->config['category_mappings'] as $key => $mapped_category) {
            if (strpos($category_lower, $key) !== false) {
                if (isset($this->config['color_schemes'][$mapped_category])) {
                    return $this->config['color_schemes'][$mapped_category];
                }
            }
        }
        
        // Check direct category matches
        foreach ($this->config['color_schemes'] as $key => $scheme) {
            if (strpos($category_lower, $key) !== false) {
                return $scheme;
            }
        }
        
        return $this->config['color_schemes']['default'];
    }
    
    /**
     * Add decorative elements to the image
     */
    private function addDecorativeElements($image, $width, $height, $accent_color) {
        $decorations = $this->config['decorations'];
        
        // Add circles if enabled
        if ($decorations['circles']['enabled']) {
            $radius = $decorations['circles']['radius'];
            foreach ($decorations['circles']['positions'] as $pos) {
                if ($pos[0] < $width && $pos[1] < $height) {
                    imagefilledellipse($image, $pos[0], $pos[1], $radius, $radius, $accent_color);
                }
            }
        }
        
        // Add border if enabled
        if ($decorations['border']['enabled']) {
            $thickness = $decorations['border']['thickness'];
            for ($i = 0; $i < $thickness; $i++) {
                imagerectangle($image, $i, $i, $width - $i - 1, $height - $i - 1, $accent_color);
            }
        }
    }
    
    /**
     * Add meal name text to the image
     */
    private function addMealText($image, $meal_name, $width, $height, $text_color) {
        $text_config = $this->config['text'];
        
        // Clean meal name for display
        $display_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $meal_name);
        $display_name = trim($display_name);
        
        // Limit text length
        if (strlen($display_name) > $text_config['max_length']) {
            $display_name = substr($display_name, 0, $text_config['max_length'] - 3) . '...';
        }
        
        // Try to use TTF font if available
        $font_path = $text_config['font_path'];
        $font_size = $text_config['font_size'];
        
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
            $font_size = $text_config['fallback_font_size'];
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
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $meal_name) . '.' . $this->config['image']['format'];
            $filepath = $this->config['directories']['images'] . $filename;
            
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
     * Process all meals in batches
     */
    public function processAllMealsInBatches() {
        $this->log("Starting batch meal processing...");
        
        $total_meals = $this->getTotalMealCount();
        $this->log("Total meals to process: {$total_meals}");
        
        if ($total_meals == 0) {
            $this->log("No meals found to process", 'WARNING');
            return ['success' => 0, 'errors' => 0];
        }
        
        $total_batches = ceil($total_meals / $this->batch_config['batch_size']);
        $this->log("Will process in {$total_batches} batches of {$this->batch_config['batch_size']} meals each");
        
        for ($batch = 0; $batch < $total_batches && $batch < $this->batch_config['max_batches']; $batch++) {
            $this->batch_count++;
            $offset = $batch * $this->batch_config['batch_size'];
            
            $this->log("Processing batch {$this->batch_count} (offset: {$offset})");
            
            // Get meals for this batch
            $meals = $this->getMealsBatch($offset, $this->batch_config['batch_size']);
            
            if (empty($meals)) {
                $this->log("No meals found in batch {$this->batch_count}");
                break;
            }
            
            // Process each meal in the batch
            foreach ($meals as $meal) {
                $this->processMeal($meal);
            }
            
            $this->log("Batch {$this->batch_count} completed. Processed: " . count($meals) . " meals");
            
            // Add delay between batches (except for the last batch)
            if ($batch < $total_batches - 1 && $this->batch_config['delay_between_batches'] > 0) {
                $this->log("Waiting {$this->batch_config['delay_between_batches']} seconds before next batch...");
                sleep($this->batch_config['delay_between_batches']);
            }
            
            // Memory cleanup
            gc_collect_cycles();
        }
        
        $this->log("All batches completed. Total processed: {$this->total_processed}, Total errors: {$this->total_errors}");
        return ['success' => $this->total_processed, 'errors' => $this->total_errors];
    }
    
    /**
     * Log message to file
     */
    private function log($message, $level = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "[{$timestamp}] [{$level}] [BATCH {$this->batch_count}] {$message}" . PHP_EOL;
        
        file_put_contents($this->log_file, $log_entry, FILE_APPEND | LOCK_EX);
        
        // Also output to console
        echo $log_entry;
    }
}

// Main execution
try {
    echo "=== Batch Meal Image Processor ===\n";
    echo "This script will process meals in batches for better performance.\n";
    echo "Batch size: {$batch_config['batch_size']} meals\n";
    echo "Delay between batches: {$batch_config['delay_between_batches']} seconds\n";
    echo "Memory limit: {$batch_config['memory_limit']}\n\n";
    
    // Check if required extensions are available
    if (!extension_loaded('gd')) {
        die("Error: GD extension is required for image processing.\n");
    }
    
    if (!extension_loaded('pdo_mysql')) {
        die("Error: PDO MySQL extension is required for database operations.\n");
    }
    
    // Create processor instance
    $processor = new BatchMealProcessor($config, $batch_config);
    
    // Process all meals in batches
    $result = $processor->processAllMealsInBatches();
    
    echo "\n=== Process Summary ===\n";
    echo "Successfully processed: {$result['success']} meals\n";
    echo "Errors: {$result['errors']} meals\n";
    echo "Check the log file for detailed information: {$config['directories']['logs']}batch_processor.log\n";
    
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    echo "Check the log file for more details: {$config['directories']['logs']}batch_processor.log\n";
}
?> 