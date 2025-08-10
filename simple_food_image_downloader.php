<?php
/**
 * Simple Food Image Downloader
 * 
 * This script downloads real food images using a more reliable approach
 * that doesn't require API keys or external services.
 * 
 * @author AI Assistant
 * @version 1.1
 */

// Configuration
$config = [
    'database' => [
        'host' => 'localhost',
        'database' => 'superv',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ],
    'directories' => [
        'images' => __DIR__ . '/public/assets/front/img/product/featured/',
        'backup' => __DIR__ . '/public/assets/front/img/product/backup/',
        'logs' => __DIR__ . '/logs/'
    ],
    'image_settings' => [
        'width' => 800,
        'height' => 600,
        'quality' => 85,
        'format' => 'jpg'
    ]
];

class SimpleFoodImageDownloader {
    private $config;
    private $pdo;
    private $log_file;
    private $processed_count = 0;
    private $error_count = 0;
    
    // Pre-defined food image URLs (free, high-quality food images)
    private $food_images = [
        'burger' => [
            'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop'
        ],
        'kebab' => [
            'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'pizza' => [
            'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'tacos' => [
            'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'sandwich' => [
            'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'fries' => [
            'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'dessert' => [
            'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'beverage' => [
            'https://images.unsplash.com/photo-1546173159-315724a31696?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop'
        ],
        'default' => [
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=800&h=600&fit=crop'
        ]
    ];
    
    public function __construct($config) {
        $this->config = $config;
        $this->log_file = $config['directories']['logs'] . 'simple_food_downloader.log';
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
            $dsn = "mysql:host={$this->config['database']['host']};dbname={$this->config['database']['database']};charset={$this->config['database']['charset']}";
            $this->pdo = new PDO($dsn, $this->config['database']['username'], $this->config['database']['password']);
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
                       c.name as category_name
                FROM products p
                LEFT JOIN pcategories c ON p.category_id = c.id
                WHERE p.title IS NOT NULL AND p.title != ''
                ORDER BY p.id
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->log("Error fetching meals: " . $e->getMessage(), 'ERROR');
            return [];
        }
    }
    
    /**
     * Backup existing image
     */
    private function backupImage($image_name) {
        $source = $this->config['directories']['images'] . $image_name;
        $backup = $this->config['directories']['backup'] . $image_name;
        
        if (file_exists($source)) {
            if (copy($source, $backup)) {
                $this->log("Backed up existing image: {$image_name}");
                return true;
            } else {
                $this->log("Failed to backup image: {$image_name}", 'ERROR');
                return false;
            }
        }
        return true; // No existing image to backup
    }
    
    /**
     * Determine image category based on meal name and category
     */
    private function getImageCategory($meal_name, $category_name) {
        $meal_lower = strtolower($meal_name);
        $category_lower = strtolower($category_name);
        
        // Check meal name first
        if (strpos($meal_lower, 'burger') !== false) return 'burger';
        if (strpos($meal_lower, 'kebab') !== false) return 'kebab';
        if (strpos($meal_lower, 'pizza') !== false) return 'pizza';
        if (strpos($meal_lower, 'tacos') !== false) return 'tacos';
        if (strpos($meal_lower, 'sandwich') !== false) return 'sandwich';
        if (strpos($meal_lower, 'frites') !== false || strpos($meal_lower, 'frite') !== false) return 'fries';
        if (strpos($meal_lower, 'dessert') !== false || strpos($meal_lower, 'glace') !== false) return 'dessert';
        if (strpos($meal_lower, 'boisson') !== false || strpos($meal_lower, 'jus') !== false) return 'beverage';
        
        // Check category name
        if (strpos($category_lower, 'burger') !== false) return 'burger';
        if (strpos($category_lower, 'kebab') !== false) return 'kebab';
        if (strpos($category_lower, 'pizza') !== false) return 'pizza';
        if (strpos($category_lower, 'tacos') !== false) return 'tacos';
        if (strpos($category_lower, 'sandwich') !== false) return 'sandwich';
        if (strpos($category_lower, 'assiette') !== false) return 'default';
        if (strpos($category_lower, 'dessert') !== false) return 'dessert';
        if (strpos($category_lower, 'boisson') !== false) return 'beverage';
        
        return 'default';
    }
    
    /**
     * Get random image URL for category
     */
    private function getRandomImageUrl($category) {
        $images = $this->food_images[$category] ?? $this->food_images['default'];
        return $images[array_rand($images)];
    }
    
    /**
     * Download image from URL
     */
    private function downloadImage($image_url, $meal_name) {
        try {
            $this->log("Downloading image from: {$image_url}");
            
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ],
                    'timeout' => 30
                ]
            ]);
            
            $image_data = file_get_contents($image_url, false, $context);
            if ($image_data === false) {
                throw new Exception("Failed to download image");
            }
            
            // Generate filename
            $timestamp = time();
            $clean_name = preg_replace('/[^\w\s]/', '_', $meal_name);
            $clean_name = preg_replace('/\s+/', '_', $clean_name);
            $filename = "{$timestamp}_{$clean_name}.{$this->config['image_settings']['format']}";
            
            // Save image
            $filepath = $this->config['directories']['images'] . $filename;
            if (file_put_contents($filepath, $image_data)) {
                $this->log("Image downloaded successfully: {$filename}");
                return $filename;
            } else {
                throw new Exception("Failed to save image to disk");
            }
            
        } catch (Exception $e) {
            $this->log("Image download error: " . $e->getMessage(), 'ERROR');
            return null;
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
                throw new Exception("Database update failed");
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
        $this->log("Starting food image download process for all meals...");
        
        $meals = $this->getMeals();
        $total_meals = count($meals);
        
        $this->log("Found {$total_meals} meals to process");
        
        foreach ($meals as $meal) {
            $this->log("Processing meal: {$meal['title']} (ID: {$meal['id']})");
            
            try {
                // Backup existing image
                if ($meal['feature_image']) {
                    $this->backupImage($meal['feature_image']);
                }
                
                // Determine image category
                $image_category = $this->getImageCategory($meal['title'], $meal['category_name']);
                $this->log("Selected image category: {$image_category}");
                
                // Get random image URL for category
                $image_url = $this->getRandomImageUrl($image_category);
                
                // Download image
                $new_image_name = $this->downloadImage($image_url, $meal['title']);
                if (!$new_image_name) {
                    $this->log("Failed to download image for: {$meal['title']}", 'ERROR');
                    $this->error_count++;
                    continue;
                }
                
                // Update database
                if ($this->updateDatabase($meal['id'], $new_image_name)) {
                    $this->log("Successfully processed meal: {$meal['title']}");
                    $this->processed_count++;
                } else {
                    $this->error_count++;
                }
                
                // Small delay to be respectful
                usleep(200000); // 0.2 seconds
                
            } catch (Exception $e) {
                $this->log("Error processing meal {$meal['title']}: " . $e->getMessage(), 'ERROR');
                $this->error_count++;
            }
        }
        
        $this->log("Process completed. Success: {$this->processed_count}, Errors: {$this->error_count}");
        $this->displaySummary();
    }
    
    /**
     * Display process summary
     */
    private function displaySummary() {
        echo "\n=== Process Summary ===\n";
        echo "Successfully processed: {$this->processed_count} meals\n";
        echo "Errors: {$this->error_count} meals\n";
        echo "Check the log file for detailed information: {$this->log_file}\n";
    }
    
    /**
     * Log message to file and console
     */
    private function log($message, $level = 'INFO') {
        $timestamp = date('Y-m-d H:i:s');
        $log_message = "[{$timestamp}] [{$level}] {$message}\n";
        
        // Write to log file
        file_put_contents($this->log_file, $log_message, FILE_APPEND | LOCK_EX);
        
        // Output to console
        echo $log_message;
    }
}

// Main execution
echo "=== Simple Food Image Downloader ===\n";
echo "This script will download real food images for your meals.\n";
echo "Using pre-selected high-quality food images.\n\n";

try {
    $downloader = new SimpleFoodImageDownloader($config);
    $downloader->processAllMeals();
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    exit(1);
} 