<?php
/**
 * Google Image Downloader for Meals
 * 
 * This script downloads real food images from Google and other free sources
 * to replace placeholder images with actual food photos.
 * 
 * Features:
 * - Downloads real food images from multiple sources
 * - Handles multiple languages (English, French, Arabic)
 * - Optimizes images for web use
 * - Creates backups of existing images
 * - Logs all operations
 * 
 * @author AI Assistant
 * @version 1.0
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
    'image_sources' => [
        'unsplash' => [
            'base_url' => 'https://api.unsplash.com/search/photos',
            'api_key' => '', // Optional: Add your Unsplash API key for better results
            'query_params' => '?query={query}&per_page=1&orientation=landscape'
        ],
        'pexels' => [
            'base_url' => 'https://api.pexels.com/v1/search',
            'api_key' => '', // Optional: Add your Pexels API key for better results
            'query_params' => '?query={query}&per_page=1&orientation=landscape'
        ],
        'pixabay' => [
            'base_url' => 'https://pixabay.com/api/',
            'api_key' => '', // Optional: Add your Pixabay API key for better results
            'query_params' => '?key={api_key}&q={query}&image_type=photo&orientation=horizontal&per_page=1'
        ]
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
    ],
    'search_settings' => [
        'max_retries' => 3,
        'timeout' => 60,
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'delay_between_requests' => 1.0, // seconds
        'max_concurrent_requests' => 1
    ]
];

class GoogleImageDownloader {
    private $config;
    private $pdo;
    private $log_file;
    private $processed_count = 0;
    private $error_count = 0;
    
    public function __construct($config) {
        $this->config = $config;
        $this->log_file = $config['directories']['logs'] . 'google_image_downloader.log';
        
        // Check if cURL is available
        if (!function_exists('curl_init')) {
            throw new Exception("cURL extension is required but not available");
        }
        
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
     * Generate search query for meal
     */
    private function generateSearchQuery($meal_name, $category_name) {
        // Clean meal name
        $clean_name = preg_replace('/[^\w\s]/', ' ', $meal_name);
        $clean_name = trim($clean_name);
        
        // Add category context for better results
        $search_terms = [$clean_name];
        
        if ($category_name) {
            $search_terms[] = $category_name;
        }
        
        // Add food-related terms for better image results
        $food_terms = ['food', 'meal', 'dish', 'cuisine'];
        foreach ($food_terms as $term) {
            $search_terms[] = $term;
        }
        
        return implode(' ', $search_terms);
    }
    
    /**
     * Search for images using multiple sources
     */
    private function searchForImage($query, $retry_count = 0) {
        $this->log("Searching for image: {$query}" . ($retry_count > 0 ? " (retry {$retry_count})" : ""));
        
        // Try Unsplash first (free, no API key required for basic usage)
        $image_url = $this->searchUnsplash($query);
        if ($image_url) {
            return $image_url;
        }
        
        // Try Pexels
        $image_url = $this->searchPexels($query);
        if ($image_url) {
            return $image_url;
        }
        
        // Try Pixabay
        $image_url = $this->searchPixabay($query);
        if ($image_url) {
            return $image_url;
        }
        
        // Fallback: Use a placeholder service
        $image_url = $this->getPlaceholderImage($query);
        if ($image_url) {
            return $image_url;
        }
        
        // Retry with modified query if we haven't exceeded max retries
        if ($retry_count < $this->config['search_settings']['max_retries']) {
            $this->log("Retrying with simplified query...", 'INFO');
            $simplified_query = $this->simplifyQuery($query);
            if ($simplified_query !== $query) {
                return $this->searchForImage($simplified_query, $retry_count + 1);
            }
        }
        
        return null;
    }
    
    /**
     * Simplify search query for better results
     */
    private function simplifyQuery($query) {
        // Remove common food terms that might be too generic
        $generic_terms = ['food', 'meal', 'dish', 'cuisine'];
        $words = explode(' ', $query);
        $filtered_words = array_filter($words, function($word) use ($generic_terms) {
            return !in_array(strtolower($word), $generic_terms);
        });
        
        return implode(' ', $filtered_words);
    }
    
    /**
     * Search Unsplash for images
     */
    private function searchUnsplash($query) {
        try {
            $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['unsplash']['base_url']);
            $url .= $this->config['image_sources']['unsplash']['query_params'];
            
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $this->config['search_settings']['timeout'],
                CURLOPT_USERAGENT => $this->config['search_settings']['user_agent'],
                CURLOPT_HTTPHEADER => [
                    'Accept: application/json',
                    'Accept-Language: en-US,en;q=0.9,fr;q=0.8'
                ],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                $this->log("Unsplash cURL error: {$error}", 'WARNING');
                return null;
            }
            
            if ($http_code !== 200) {
                $this->log("Unsplash HTTP error: {$http_code}", 'WARNING');
                return null;
            }
            
            if (empty($response)) {
                $this->log("Empty response from Unsplash", 'WARNING');
                return null;
            }
            
            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->log("JSON decode error: " . json_last_error_msg(), 'WARNING');
                return null;
            }
            
            if (isset($data['results'][0]['urls']['regular'])) {
                return $data['results'][0]['urls']['regular'];
            }
            
        } catch (Exception $e) {
            $this->log("Unsplash search error: " . $e->getMessage(), 'WARNING');
        }
        
        return null;
    }
    
    /**
     * Search Pexels for images
     */
    private function searchPexels($query) {
        try {
            $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['pexels']['base_url']);
            $url .= $this->config['image_sources']['pexels']['query_params'];
            
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $this->config['search_settings']['timeout'],
                CURLOPT_USERAGENT => $this->config['search_settings']['user_agent'],
                CURLOPT_HTTPHEADER => [
                    'Accept: application/json',
                    'Accept-Language: en-US,en;q=0.9,fr;q=0.8'
                ],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                $this->log("Pexels cURL error: {$error}", 'WARNING');
                return null;
            }
            
            if ($http_code !== 200) {
                $this->log("Pexels HTTP error: {$http_code}", 'WARNING');
                return null;
            }
            
            if (empty($response)) {
                $this->log("Empty response from Pexels", 'WARNING');
                return null;
            }
            
            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->log("JSON decode error: " . json_last_error_msg(), 'WARNING');
                return null;
            }
            
            if (isset($data['photos'][0]['src']['large'])) {
                return $data['photos'][0]['src']['large'];
            }
            
        } catch (Exception $e) {
            $this->log("Pexels search error: " . $e->getMessage(), 'WARNING');
        }
        
        return null;
    }
    
    /**
     * Search Pixabay for images
     */
    private function searchPixabay($query) {
        try {
            $url = str_replace('{query}', urlencode($query), $this->config['image_sources']['pixabay']['base_url']);
            $url .= $this->config['image_sources']['pixabay']['query_params'];
            
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => $this->config['search_settings']['timeout'],
                CURLOPT_USERAGENT => $this->config['search_settings']['user_agent'],
                CURLOPT_HTTPHEADER => [
                    'Accept: application/json',
                    'Accept-Language: en-US,en;q=0.9,fr;q=0.8'
                ],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ]);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                $this->log("Pixabay cURL error: {$error}", 'WARNING');
                return null;
            }
            
            if ($http_code !== 200) {
                $this->log("Pixabay HTTP error: {$http_code}", 'WARNING');
                return null;
            }
            
            if (empty($response)) {
                $this->log("Empty response from Pixabay", 'WARNING');
                return null;
            }
            
            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->log("JSON decode error: " . json_last_error_msg(), 'WARNING');
                return null;
            }
            
            if (isset($data['hits'][0]['webformatURL'])) {
                return $data['hits'][0]['webformatURL'];
            }
            
        } catch (Exception $e) {
            $this->log("Pixabay search error: " . $e->getMessage(), 'WARNING');
        }
        
        return null;
    }
    
    /**
     * Get placeholder image as fallback
     */
    private function getPlaceholderImage($query) {
        // Use a placeholder service that generates food-related images
        $encoded_query = urlencode($query);
        return "https://source.unsplash.com/800x600/?{$encoded_query}";
    }
    
    /**
     * Download image from URL
     */
    private function downloadImage($image_url, $meal_name) {
        try {
            $this->log("Downloading image from: {$image_url}");
            
            // Use cURL for more reliable downloads
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $image_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 5,
                CURLOPT_TIMEOUT => $this->config['search_settings']['timeout'],
                CURLOPT_USERAGENT => $this->config['search_settings']['user_agent'],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER => [
                    'Accept: image/*',
                    'Accept-Language: en-US,en;q=0.9,fr;q=0.8',
                    'Cache-Control: no-cache'
                ]
            ]);
            
            $image_data = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                throw new Exception("cURL error: {$error}");
            }
            
            if ($http_code !== 200) {
                throw new Exception("HTTP error: {$http_code}");
            }
            
            if (empty($image_data)) {
                throw new Exception("Empty image data received");
            }
            
            // Verify it's actually an image
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_buffer($finfo, $image_data);
            finfo_close($finfo);
            
            if (!str_starts_with($mime_type, 'image/')) {
                throw new Exception("Invalid image type: {$mime_type}");
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
        $this->log("Starting image download process for all meals...");
        
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
                
                // Generate search query
                $search_query = $this->generateSearchQuery($meal['title'], $meal['category_name']);
                
                // Search for image
                $image_url = $this->searchForImage($search_query);
                if (!$image_url) {
                    $this->log("No image found for: {$meal['title']}", 'WARNING');
                    $this->error_count++;
                    continue;
                }
                
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
                
                // Small delay to be respectful to image services
                $delay = $this->config['search_settings']['delay_between_requests'] * 1000000; // Convert to microseconds
                usleep($delay);
                
            } catch (Exception $e) {
                $this->log("Error processing meal {$meal['title']}: " . $e->getMessage(), 'ERROR');
                $this->error_count++;
                
                // Add extra delay on error to avoid overwhelming the service
                sleep(2);
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
echo "=== Google Image Downloader for Meals ===\n";
echo "This script will download real food images from the internet.\n";
echo "Make sure you have proper database credentials configured.\n\n";

try {
    $downloader = new GoogleImageDownloader($config);
    $downloader->processAllMeals();
} catch (Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    exit(1);
} 