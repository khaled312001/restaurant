<?php
/**
 * Quick Fix Script for Missing Meal Images
 * 
 * This script attempts to fix missing meal images by:
 * 1. Checking which meals have missing images
 * 2. Attempting to download new images
 * 3. Providing a summary of what was fixed
 */

require_once 'google_image_downloader.php';

echo "=== Fix Missing Meal Images ===\n";

try {
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
                'api_key' => '',
                'query_params' => '?query={query}&per_page=1&orientation=landscape'
            ],
            'pexels' => [
                'base_url' => 'https://api.pexels.com/v1/search',
                'api_key' => '',
                'query_params' => '?query={query}&per_page=1&orientation=landscape'
            ],
            'pixabay' => [
                'base_url' => 'https://pixabay.com/api/',
                'api_key' => '',
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
            'delay_between_requests' => 1.0,
            'max_concurrent_requests' => 1
        ]
    ];
    
    // Initialize downloader
    $downloader = new GoogleImageDownloader($config);
    
    // Get meals with missing images
    $meals = $downloader->getMeals();
    $missing_images = [];
    $has_images = [];
    
    foreach ($meals as $meal) {
        if (empty($meal['feature_image']) || !file_exists($config['directories']['images'] . $meal['feature_image'])) {
            $missing_images[] = $meal;
        } else {
            $has_images[] = $meal;
        }
    }
    
    echo "Total meals: " . count($meals) . "\n";
    echo "Meals with images: " . count($has_images) . "\n";
    echo "Meals missing images: " . count($missing_images) . "\n\n";
    
    if (empty($missing_images)) {
        echo "✓ All meals have images! No action needed.\n";
        exit(0);
    }
    
    echo "Meals missing images:\n";
    foreach ($missing_images as $meal) {
        echo "- {$meal['title']} (ID: {$meal['id']})\n";
    }
    
    echo "\nStarting to fix missing images...\n";
    echo "This may take a while. Press Ctrl+C to stop.\n\n";
    
    $fixed_count = 0;
    $failed_count = 0;
    
    foreach ($missing_images as $index => $meal) {
        $current = $index + 1;
        $total = count($missing_images);
        
        echo "[{$current}/{$total}] Processing: {$meal['title']}\n";
        
        try {
            // Generate search query
            $search_query = $downloader->generateSearchQuery($meal['title'], $meal['category_name']);
            
            // Search for image
            $image_url = $downloader->searchForImage($search_query);
            if (!$image_url) {
                echo "  ✗ No image found\n";
                $failed_count++;
                continue;
            }
            
            // Download image
            $new_image_name = $downloader->downloadImage($image_url, $meal['title']);
            if (!$new_image_name) {
                echo "  ✗ Download failed\n";
                $failed_count++;
                continue;
            }
            
            // Update database
            if ($downloader->updateDatabase($meal['id'], $new_image_name)) {
                echo "  ✓ Image fixed: {$new_image_name}\n";
                $fixed_count++;
            } else {
                echo "  ✗ Database update failed\n";
                $failed_count++;
            }
            
            // Delay between requests
            sleep(1);
            
        } catch (Exception $e) {
            echo "  ✗ Error: " . $e->getMessage() . "\n";
            $failed_count++;
        }
    }
    
    echo "\n=== Fix Summary ===\n";
    echo "Successfully fixed: {$fixed_count} meals\n";
    echo "Failed to fix: {$failed_count} meals\n";
    echo "Total processed: " . count($missing_images) . " meals\n";
    
    if ($fixed_count > 0) {
        echo "\n✓ Some images were successfully fixed!\n";
    }
    
    if ($failed_count > 0) {
        echo "\n⚠ Some images could not be fixed. Check the logs for details.\n";
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
