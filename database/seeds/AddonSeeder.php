<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Addon;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addons = [
            // Sauces - الصلصات
            [
                'name' => 'White Sauce',
                'name_ar' => 'صلصة بيضاء',
                'name_fr' => 'Sauce Blanche',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Creamy white sauce',
                'sort_order' => 1
            ],
            [
                'name' => 'Mayonnaise',
                'name_ar' => 'مايونيز',
                'name_fr' => 'Mayonnaise',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Classic mayonnaise',
                'sort_order' => 2
            ],
            [
                'name' => 'Ketchup',
                'name_ar' => 'كاتشب',
                'name_fr' => 'Ketchup',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Tomato ketchup',
                'sort_order' => 3
            ],
            [
                'name' => 'Harissa',
                'name_ar' => 'حريرة',
                'name_fr' => 'Harissa',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Spicy harissa sauce',
                'sort_order' => 4
            ],
            [
                'name' => 'Mustard',
                'name_ar' => 'خردل',
                'name_fr' => 'Moutarde',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Dijon mustard',
                'sort_order' => 5
            ],
            [
                'name' => 'BBQ Sauce',
                'name_ar' => 'صلصة باربيكيو',
                'name_fr' => 'Sauce BBQ',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Barbecue sauce',
                'sort_order' => 6
            ],
            [
                'name' => 'Curry Sauce',
                'name_ar' => 'صلصة الكاري',
                'name_fr' => 'Sauce Curry',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-pepper-hot',
                'description' => 'Spicy curry sauce',
                'sort_order' => 7
            ],
            [
                'name' => 'Algerian Sauce',
                'name_ar' => 'صلصة جزائرية',
                'name_fr' => 'Sauce Algérienne',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-pepper-hot',
                'description' => 'Traditional Algerian sauce',
                'sort_order' => 8
            ],
            [
                'name' => 'Samurai Sauce',
                'name_ar' => 'صلصة ساموراي',
                'name_fr' => 'Sauce Samouraï',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Spicy samurai sauce',
                'sort_order' => 9
            ],
            [
                'name' => 'Andalusian Sauce',
                'name_ar' => 'صلصة أندلسية',
                'name_fr' => 'Sauce Andalouse',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Andalusian style sauce',
                'sort_order' => 10
            ],

            // Vegetables - الخضروات
            [
                'name' => 'Tomatoes',
                'name_ar' => 'طماطم',
                'name_fr' => 'Tomates',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-seedling',
                'description' => 'Fresh tomatoes',
                'sort_order' => 1
            ],
            [
                'name' => 'Lettuce',
                'name_ar' => 'خس',
                'name_fr' => 'Salade',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-seedling',
                'description' => 'Fresh lettuce',
                'sort_order' => 2
            ],
            [
                'name' => 'Onions',
                'name_ar' => 'بصل',
                'name_fr' => 'Oignons',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-seedling',
                'description' => 'Fresh onions',
                'sort_order' => 3
            ],
            [
                'name' => 'Cucumber',
                'name_ar' => 'خيار',
                'name_fr' => 'Concombre',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-seedling',
                'description' => 'Fresh cucumber',
                'sort_order' => 4
            ],
            [
                'name' => 'Carrots',
                'name_ar' => 'جزر',
                'name_fr' => 'Carottes',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-seedling',
                'description' => 'Fresh carrots',
                'sort_order' => 5
            ],
            [
                'name' => 'No Vegetables',
                'name_ar' => 'بدون خضروات',
                'name_fr' => 'Sans légumes',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-times',
                'description' => 'No vegetables option',
                'sort_order' => 6
            ],

            // Meat Choices - اختيارات اللحم
            [
                'name' => 'Kebab',
                'name_ar' => 'كباب',
                'name_fr' => 'Kebab',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Traditional kebab meat',
                'sort_order' => 1
            ],
            [
                'name' => 'Steak',
                'name_ar' => 'ستيك',
                'name_fr' => 'Steak',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Beef steak',
                'sort_order' => 2
            ],
            [
                'name' => 'Chicken',
                'name_ar' => 'دجاج',
                'name_fr' => 'Poulet',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Grilled chicken',
                'sort_order' => 3
            ],
            [
                'name' => 'Jacket',
                'name_ar' => 'جاكيت',
                'name_fr' => 'Jacket',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Jacket style meat',
                'sort_order' => 4
            ],
            [
                'name' => 'Cordon Bleu',
                'name_ar' => 'كوردون بلو',
                'name_fr' => 'Cordon Bleu',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Cordon bleu style',
                'sort_order' => 5
            ],
            [
                'name' => 'Tenders',
                'name_ar' => 'تندرز',
                'name_fr' => 'Tenders',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Chicken tenders',
                'sort_order' => 6
            ],
            [
                'name' => 'Nuggets',
                'name_ar' => 'ناجتس',
                'name_fr' => 'Nuggets',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Chicken nuggets',
                'sort_order' => 7
            ],

            // Drinks - المشروبات
            [
                'name' => 'Coca Cola',
                'name_ar' => 'كوكا كولا',
                'name_fr' => 'Coca Cola',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-wine-bottle',
                'description' => 'Coca Cola soft drink',
                'sort_order' => 1
            ],
            [
                'name' => 'Fanta',
                'name_ar' => 'فانتا',
                'name_fr' => 'Fanta',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-wine-bottle',
                'description' => 'Fanta orange drink',
                'sort_order' => 2
            ],
            [
                'name' => 'Sprite',
                'name_ar' => 'سبرايت',
                'name_fr' => 'Sprite',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-wine-bottle',
                'description' => 'Sprite lemon drink',
                'sort_order' => 3
            ],
            [
                'name' => 'Water',
                'name_ar' => 'ماء',
                'name_fr' => 'Eau',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-tint',
                'description' => 'Mineral water',
                'sort_order' => 4
            ],
            [
                'name' => 'No Drink',
                'name_ar' => 'بدون مشروب',
                'name_fr' => 'Sans boisson',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-times',
                'description' => 'No drink option',
                'sort_order' => 5
            ],

            // Extra Items - إضافات إضافية
            [
                'name' => 'Extra Cheese',
                'name_ar' => 'جبنة إضافية',
                'name_fr' => 'Fromage Extra',
                'category' => 'extras',
                'price' => 1.00,
                'icon' => 'fas fa-cheese',
                'description' => 'Additional cheese',
                'sort_order' => 1
            ],
            [
                'name' => 'French Fries',
                'name_ar' => 'بطاطس مقلية',
                'name_fr' => 'Frites',
                'category' => 'extras',
                'price' => 3.50,
                'icon' => 'fas fa-french-fries',
                'description' => 'French fries portion',
                'sort_order' => 2
            ],
            [
                'name' => 'Extra Meat',
                'name_ar' => 'لحم إضافي',
                'name_fr' => 'Viande Extra',
                'category' => 'extras',
                'price' => 2.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Additional meat portion',
                'sort_order' => 3
            ]
        ];

        foreach ($addons as $addon) {
            Addon::create($addon);
        }
    }
}
