<?php
require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== DEPLOYMENT CHECK FOR PRODUCTION SERVER ===\n\n";

echo "1. DATABASE UPDATES NEEDED:\n";
echo "----------------------------\n";
$categories = App\Models\Pcategory::whereIn('name', ['Assiettes', 'Sandwichs', 'Menus', 'Salade', 'Menus Enfant', 'Nos Box'])
    ->get(['id', 'name', 'image']);

echo "UPDATE pcategories SET image = CASE\n";
foreach($categories as $cat) {
    echo "  WHEN name = '{$cat->name}' THEN '{$cat->image}'\n";
}
echo "  ELSE image\nEND\nWHERE name IN ('Assiettes', 'Sandwichs', 'Menus', 'Salade', 'Menus Enfant', 'Nos Box');\n\n";

echo "2. IMAGE FILES TO UPLOAD:\n";
echo "-------------------------\n";
echo "Upload these files to: public/assets/front/img/category/\n\n";

$requiredImages = [];
foreach($categories as $cat) {
    if ($cat->image) {
        $requiredImages[] = $cat->image;
        $localPath = 'public/assets/front/img/category/' . $cat->image;
        $size = file_exists($localPath) ? filesize($localPath) : 0;
        echo "- {$cat->image} ({$cat->name}) - " . number_format($size) . " bytes\n";
    }
}

echo "\n3. FILES TO COPY FROM LOCAL TO PRODUCTION:\n";
echo "------------------------------------------\n";
foreach($requiredImages as $image) {
    echo "Local:  public/assets/front/img/category/{$image}\n";
    echo "Remote: public/assets/front/img/category/{$image}\n";
    echo "---\n";
}

echo "\n4. TEMPLATE FILE UPDATED:\n";
echo "-------------------------\n";
echo "File: resources/views/front/multipurpose/product/product.blade.php\n";
echo "Status: Already updated with fallback handling\n\n";

echo "5. DEPLOYMENT STEPS:\n";
echo "--------------------\n";
echo "Step 1: Upload the 6 image files to production server\n";
echo "Step 2: Run the SQL UPDATE query on production database\n";
echo "Step 3: Upload the updated product.blade.php template\n";
echo "Step 4: Clear any cache (php artisan cache:clear)\n";
echo "Step 5: Test the website\n\n";

echo "ALTERNATIVE: Use FTP/SFTP to upload missing images to production\n"; 