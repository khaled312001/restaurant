<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Language;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the default language
        $language = Language::where('is_default', 1)->first();
        
        if (!$language) {
            $this->command->error('No default language found. Please run language seeder first.');
            return;
        }

        $products = [
            [
                'title' => 'PANINI 3 FROMAGES',
                'slug' => 'panini-3-fromages',
                'product_type' => 'panini',
                'price_seul' => 6.50,
                'price_menu' => 9.50,
                'current_price' => 6.50,
                'feature_image' => 'panini.jpg',
                'summary' => 'Panini aux 3 fromages',
                'description' => 'Délicieux panini aux 3 fromages',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'TACOS',
                'slug' => 'tacos',
                'product_type' => 'tacos',
                'price_seul' => 7.50,
                'price_menu' => 11.50,
                'current_price' => 7.50,
                'feature_image' => 'tacos.jpg',
                'summary' => 'Tacos traditionnels',
                'description' => 'Tacos avec viande et légumes',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'KEBAB GALETTE',
                'slug' => 'kebab-galette',
                'product_type' => 'galettes',
                'price_seul' => 9.50,
                'price_menu' => 13.50,
                'current_price' => 9.50,
                'feature_image' => 'kebab-galette.jpg',
                'summary' => 'Kebab en galette',
                'description' => 'Kebab traditionnel en galette',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'AMERICAIN KOFTE',
                'slug' => 'americain-kofte',
                'product_type' => 'galettes',
                'price_seul' => 10.50,
                'price_menu' => 14.50,
                'current_price' => 10.50,
                'feature_image' => 'americain-kofte.jpg',
                'summary' => 'Americain Kofte',
                'description' => 'Americain avec kofte',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'BURGER',
                'slug' => 'burger',
                'product_type' => 'burgers',
                'price_seul' => 8.00,
                'price_menu' => 12.00,
                'current_price' => 8.00,
                'feature_image' => 'burger.jpg',
                'summary' => 'Burger classique',
                'description' => 'Burger avec viande et légumes',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'ASSIETTE',
                'slug' => 'assiette',
                'product_type' => 'assiettes',
                'price_seul' => 12.00,
                'price_menu' => 16.00,
                'current_price' => 12.00,
                'feature_image' => 'assiette.jpg',
                'summary' => 'Assiette complète',
                'description' => 'Assiette avec viande et accompagnements',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'MENU ENFANT',
                'slug' => 'menu-enfant',
                'product_type' => 'menus_enfant',
                'price_seul' => 6.50,
                'price_menu' => 8.50,
                'current_price' => 6.50,
                'feature_image' => 'menu-enfant.jpg',
                'summary' => 'Menu spécial enfant',
                'description' => 'Menu adapté aux enfants',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'SALADE',
                'slug' => 'salade',
                'product_type' => 'salade',
                'price_seul' => 7.50,
                'price_menu' => 10.50,
                'current_price' => 7.50,
                'feature_image' => 'salade.jpg',
                'summary' => 'Salade fraîche',
                'description' => 'Salade avec légumes frais',
                'status' => 1,
                'is_feature' => 1,
            ],
            [
                'title' => 'NOS BOX',
                'slug' => 'nos-box',
                'product_type' => 'nos_box',
                'price_seul' => 11.00,
                'price_menu' => 15.00,
                'current_price' => 11.00,
                'feature_image' => 'nos-box.jpg',
                'summary' => 'Box complète',
                'description' => 'Box avec plusieurs éléments',
                'status' => 1,
                'is_feature' => 1,
            ],
        ];

        foreach ($products as $productData) {
            $productData['language_id'] = $language->id;
            $productData['category_id'] = 1; // Default category
            $productData['subcategory_id'] = null;
            $productData['variations'] = json_encode([]);
            $productData['addons'] = json_encode([]);
            $productData['previous_price'] = null;
            $productData['rating'] = 5;
            
            Product::updateOrCreate(
                ['slug' => $productData['slug'], 'language_id' => $language->id],
                $productData
            );
        }

        $this->command->info('Products seeded successfully!');
    }
}
