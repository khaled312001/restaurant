<?php
/**
 * Script to update mobile responsiveness for all menu pages
 * Updates the following pages:
 * - kebab_galette.blade.php
 * - americain_kofte.blade.php
 * - tacos.blade.php
 * - burgers.blade.php
 * - panini.blade.php
 * - assiettes.blade.php
 * - menus_enfant.blade.php
 * - salade.blade.php
 */

echo "=== UPDATING MOBILE RESPONSIVENESS FOR ALL MENU PAGES ===\n\n";

$pages = [
    'kebab_galette.blade.php' => [
        'title' => 'Kebab & Galette',
        'color' => '#f39c12',
        'products' => [
            ['name' => 'KEBAB', 'seul' => '7,00€', 'menu' => '10,50€', 'id' => 127],
            ['name' => 'MAXI KEBAB', 'seul' => '12,00€', 'menu' => '15,00€', 'id' => 128],
            ['name' => 'GALETTE (VIANDE AU CHOIX)', 'seul' => '7,50€', 'menu' => '10,50€', 'id' => 129],
            ['name' => 'MAXI GALETTE (VIANDE AU CHOIX)', 'seul' => '12,00€', 'menu' => '15,00€', 'id' => 130]
        ]
    ],
    'americain_kofte.blade.php' => [
        'title' => 'Americain & Kofte',
        'color' => '#e74c3c',
        'products' => [
            ['name' => 'AMERICAIN', 'seul' => '7,50€', 'menu' => '10,50€', 'id' => 131],
            ['name' => 'KOFTE', 'seul' => '7,50€', 'menu' => '10,50€', 'id' => 132]
        ]
    ],
    'tacos.blade.php' => [
        'title' => 'Tacos Mexicains',
        'color' => '#e67e22',
        'products' => [
            ['name' => 'TACOS (1 VIANDE AU CHOIX)', 'seul' => '8,00€', 'menu' => '11,00€', 'id' => 133],
            ['name' => 'TACOS MIXTE (2 VIANDES AU CHOIX)', 'seul' => '9,50€', 'menu' => '12,50€', 'id' => 134],
            ['name' => 'MEGA TACOS (1 VIANDE AU CHOIX)', 'seul' => '12,50€', 'menu' => '15,50€', 'id' => 135],
            ['name' => 'MEGA TACOS MIXTE (2 VIANDES AU CHOIX)', 'seul' => '14,50€', 'menu' => '17,50€', 'id' => 136]
        ]
    ],
    'burgers.blade.php' => [
        'title' => 'Burgers Gourmets',
        'color' => '#8e44ad',
        'products' => [
            ['name' => 'CHEESE BURGER', 'seul' => '5,50€', 'menu' => '8,50€', 'id' => 137],
            ['name' => 'DOUBLE CHEESE BURGER', 'seul' => '7,00€', 'menu' => '10,00€', 'id' => 138],
            ['name' => 'CHICKEN', 'seul' => '5,50€', 'menu' => '8,50€', 'id' => 139],
            ['name' => 'CROUSTY GOURMAND (POULET OU BŒUF)', 'seul' => '7,00€', 'menu' => '10,00€', 'id' => 140],
            ['name' => 'VEGGIE BURGER', 'seul' => '4,00€', 'menu' => '7,00€', 'id' => 141],
            ['name' => 'LE BIG CHÈVRE (POULET OU BŒUF)', 'seul' => '6,50€', 'menu' => '9,50€', 'id' => 142]
        ]
    ],
    'panini.blade.php' => [
        'title' => 'Nos Panini',
        'color' => '#27ae60',
        'products' => [
            ['name' => 'PANINI 3 FROMAGES', 'seul' => '7,00€', 'menu' => '10,00€', 'id' => 143],
            ['name' => 'PANINI VIANDE CHOIX', 'seul' => '7,00€', 'menu' => '10,00€', 'id' => 144],
            ['name' => 'PANINI KEBAB', 'seul' => '7,50€', 'menu' => '10,50€', 'id' => 145],
            ['name' => 'PANINI STEAK', 'seul' => '8,00€', 'menu' => '11,00€', 'id' => 146]
        ]
    ],
    'assiettes.blade.php' => [
        'title' => 'Nos Assiettes',
        'color' => '#16a085',
        'products' => [
            ['name' => 'ASSIETTE KEBAB', 'seul' => '9,00€', 'menu' => '12,00€', 'id' => 147],
            ['name' => 'ASSIETTE MIXTE', 'seul' => '10,50€', 'menu' => '13,50€', 'id' => 148],
            ['name' => 'ASSIETTE VÉGÉTARIENNE', 'seul' => '8,50€', 'menu' => '11,50€', 'id' => 149]
        ]
    ],
    'menus_enfant.blade.php' => [
        'title' => 'Menus Enfant',
        'color' => '#f1c40f',
        'products' => [
            ['name' => 'MENU ENFANT KEBAB', 'seul' => '6,50€', 'menu' => '8,50€', 'id' => 150],
            ['name' => 'MENU ENFANT BURGER', 'seul' => '6,00€', 'menu' => '8,00€', 'id' => 151],
            ['name' => 'MENU ENFANT NUGGETS', 'seul' => '5,50€', 'menu' => '7,50€', 'id' => 152]
        ]
    ],
    'salade.blade.php' => [
        'title' => 'Nos Salades',
        'color' => '#2ecc71',
        'products' => [
            ['name' => 'SALADE CÉSAR', 'seul' => '8,50€', 'menu' => '11,50€', 'id' => 153],
            ['name' => 'SALADE NIÇOISE', 'seul' => '9,00€', 'menu' => '12,00€', 'id' => 154],
            ['name' => 'SALADE VÉGÉTARIENNE', 'seul' => '7,50€', 'menu' => '10,50€', 'id' => 155]
        ]
    ]
];

$templatePath = 'resources/views/front/multipurpose/product/';
$updatedCount = 0;

foreach ($pages as $filename => $pageData) {
    $filepath = $templatePath . $filename;
    
    if (!file_exists($filepath)) {
        echo "❌ File not found: {$filename}\n";
        continue;
    }
    
    echo "🔄 Updating: {$filename}\n";
    
    // Read the file content
    $content = file_get_contents($filepath);
    
    // Update the page title
    $content = str_replace(
        '<h2 class="title">' . $pageData['title'] . '</h2>',
        '<h2 class="title">' . $pageData['title'] . '</h2>',
        $content
    );
    
    // Update breadcrumb
    $content = str_replace(
        '<li class="breadcrumb-item active" aria-current="page">' . $pageData['title'] . '</li>',
        '<li class="breadcrumb-item active" aria-current="page">' . $pageData['title'] . '</li>',
        $content
    );
    
    // Update the main title in the menu section
    $content = str_replace(
        '<h2 style="color: ' . $pageData['color'] . '; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">',
        '<h2 style="color: ' . $pageData['color'] . '; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">',
        $content
    );
    
    // Add mobile responsive CSS link
    if (strpos($content, 'mobile-responsive.css') === false) {
        $content = str_replace(
            '@extends(\'front.layout\')',
            '@extends(\'front.layout\')\n<link rel="stylesheet" href="{{ asset(\'assets/front/css/mobile-responsive.css\') }}">',
            $content
        );
    }
    
    // Update the menu table structure for mobile responsiveness
    $menuTableStart = '<div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">';
    $menuTableEnd = '</div>';
    
    // Find the menu table section
    $tableStart = strpos($content, $menuTableStart);
    if ($tableStart !== false) {
        $tableEnd = strpos($content, $menuTableEnd, $tableStart);
        if ($tableEnd !== false) {
            $tableContent = substr($content, $tableStart, $tableEnd - $tableStart + strlen($menuTableEnd));
            
            // Create new mobile-responsive table content
            $newTableContent = $menuTableStart . "\n";
            $newTableContent .= '                        <!-- Desktop Header (hidden on mobile) -->' . "\n";
            $newTableContent .= '                        <div class="table-header desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid ' . $pageData['color'] . ';">' . "\n";
            $newTableContent .= '                            <span style="color: ' . $pageData['color'] . '; font-weight: 600; font-size: 1.1rem;">Plat</span>' . "\n";
            $newTableContent .= '                            <span style="color: ' . $pageData['color'] . '; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>' . "\n";
            $newTableContent .= '                            <span style="color: ' . $pageData['color'] . '; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>' . "\n";
            $newTableContent .= '                            <span style="color: ' . $pageData['color'] . '; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>' . "\n";
            $newTableContent .= '                        </div>' . "\n";
            
            // Add desktop and mobile versions for each product
            foreach ($pageData['products'] as $product) {
                $newTableContent .= '                        ' . "\n";
                $newTableContent .= '                        <!-- Desktop Layout (hidden on mobile) -->' . "\n";
                $newTableContent .= '                        <div class="menu-item desktop-only" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">' . "\n";
                $newTableContent .= '                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">' . $product['name'] . '</h4>' . "\n";
                $newTableContent .= '                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">' . $product['seul'] . '</span>' . "\n";
                $newTableContent .= '                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">' . $product['menu'] . '</span>' . "\n";
                $newTableContent .= '                            <div style="text-align: center;">' . "\n";
                $newTableContent .= '                                <select id="product-type-' . $product['id'] . '" class="form-control mb-2" style="background: rgba(255,255,255,0.9); border: none; border-radius: 10px; padding: 5px; font-size: 0.9rem; margin-bottom: 8px;">' . "\n";
                $newTableContent .= '                                    <option value="seul">Seul (' . $product['seul'] . ')</option>' . "\n";
                $newTableContent .= '                                    <option value="menu">Menu (' . $product['menu'] . ')</option>' . "\n";
                $newTableContent .= '                                </select>' . "\n";
                $newTableContent .= '                                <button onclick="addToCartWithType(\'{{ route(\'add.cart\', ' . $product['id'] . ') }}\', \'product-type-' . $product['id'] . '\')" class="btn btn-warning btn-sm" style="background: ' . $pageData['color'] . '; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">' . "\n";
                $newTableContent .= '                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>' . "\n";
                $newTableContent .= '                                    Commander' . "\n";
                $newTableContent .= '                                </button>' . "\n";
                $newTableContent .= '                            </div>' . "\n";
                $newTableContent .= '                        </div>' . "\n";
                $newTableContent .= '                        ' . "\n";
                $newTableContent .= '                        <!-- Mobile Layout (hidden on desktop) -->' . "\n";
                $newTableContent .= '                        <div class="menu-item-mobile mobile-only" style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);">' . "\n";
                $newTableContent .= '                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">' . "\n";
                $newTableContent .= '                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.2rem;">' . $product['name'] . '</h4>' . "\n";
                $newTableContent .= '                                <div style="text-align: right;">' . "\n";
                $newTableContent .= '                                    <div style="color: ' . $pageData['color'] . '; font-size: 0.9rem; margin-bottom: 5px;">Prix</div>' . "\n";
                $newTableContent .= '                                </div>' . "\n";
                $newTableContent .= '                            </div>' . "\n";
                $newTableContent .= '                            ' . "\n";
                $newTableContent .= '                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">' . "\n";
                $newTableContent .= '                                <span style="color: white; font-size: 0.9rem;">Seul</span>' . "\n";
                $newTableContent .= '                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">' . $product['seul'] . '</span>' . "\n";
                $newTableContent .= '                            </div>' . "\n";
                $newTableContent .= '                            ' . "\n";
                $newTableContent .= '                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: rgba(255,255,255,0.1); padding: 10px; border-radius: 10px;">' . "\n";
                $newTableContent .= '                                <span style="color: white; font-size: 0.9rem;">Menu</span>' . "\n";
                $newTableContent .= '                                <span style="color: white; font-weight: 600; font-size: 1.1rem;">' . $product['menu'] . '</span>' . "\n";
                $newTableContent .= '                            </div>' . "\n";
                $newTableContent .= '                            ' . "\n";
                $newTableContent .= '                            <div style="text-align: center;">' . "\n";
                $newTableContent .= '                                <select id="product-type-mobile-' . $product['id'] . '" class="form-control mb-3" style="background: rgba(255,255,255,0.9); border: none; border-radius: 10px; padding: 12px; font-size: 1rem; margin-bottom: 15px; width: 100%;">' . "\n";
                $newTableContent .= '                                    <option value="seul">Seul (' . $product['seul'] . ')</option>' . "\n";
                $newTableContent .= '                                    <option value="menu">Menu (' . $product['menu'] . ')</option>' . "\n";
                $newTableContent .= '                                </select>' . "\n";
                $newTableContent .= '                                <button onclick="addToCartWithType(\'{{ route(\'add.cart\', ' . $product['id'] . ') }}\', \'product-type-mobile-' . $product['id'] . '\')" class="btn btn-warning" style="background: ' . $pageData['color'] . '; border: none; color: white; padding: 12px 24px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; width: 100%; font-size: 1rem;">' . "\n";
                $newTableContent .= '                                    <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>' . "\n";
                $newTableContent .= '                                    Commander' . "\n";
                $newTableContent .= '                                </button>' . "\n";
                $newTableContent .= '                            </div>' . "\n";
                $newTableContent .= '                        </div>' . "\n";
            }
            
            $newTableContent .= $menuTableEnd;
            
            // Replace the old table content with the new one
            $content = str_replace($tableContent, $newTableContent, $content);
        }
    }
    
    // Update CTA buttons for mobile responsiveness
    $content = str_replace(
        '<div class="cta-buttons">',
        '<div class="cta-buttons" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">',
        $content
    );
    
    // Update button styles for mobile
    $content = str_replace(
        'style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; margin-right: 20px;"',
        'style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; min-width: 200px;"',
        $content
    );
    
    $content = str_replace(
        'style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; border: 2px solid white;"',
        'style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; border: 2px solid white; min-width: 200px;"',
        $content
    );
    
    // Write the updated content back to the file
    if (file_put_contents($filepath, $content)) {
        echo "✅ Updated: {$filename}\n";
        $updatedCount++;
    } else {
        echo "❌ Failed to update: {$filename}\n";
    }
}

echo "\n=== UPDATE SUMMARY ===\n";
echo "✅ Files updated: {$updatedCount}\n";
echo "📱 Mobile responsiveness improved for all menu pages\n";
echo "🎨 CSS file created: public/assets/front/css/mobile-responsive.css\n";
echo "\n=== NEXT STEPS ===\n";
echo "1. Upload the updated files to the server\n";
echo "2. Clear Laravel cache: php artisan cache:clear\n";
echo "3. Test the pages on mobile devices\n";
echo "4. Verify that desktop layout still works correctly\n"; 