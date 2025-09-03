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
        // Clear existing addons
        Addon::truncate();

        $addons = [
            // ===== SAUCES =====
            [
                'name' => 'Sauce Blanche',
                'name_ar' => 'صلصة بيضاء',
                'name_fr' => 'Sauce Blanche',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce blanche crémeuse et onctueuse',
                'is_active' => true,
                'sort_order' => 1,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Mayonnaise',
                'name_ar' => 'مايونيز',
                'name_fr' => 'Mayonnaise',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Mayonnaise classique',
                'is_active' => true,
                'sort_order' => 2,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Ketchup',
                'name_ar' => 'كاتشب',
                'name_fr' => 'Ketchup',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Ketchup tomate',
                'is_active' => true,
                'sort_order' => 3,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Harissa',
                'name_ar' => 'هريسة',
                'name_fr' => 'Harissa',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce harissa épicée',
                'is_active' => true,
                'sort_order' => 4,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Moutarde',
                'name_ar' => 'الخردل',
                'name_fr' => 'Moutarde',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Moutarde forte',
                'is_active' => true,
                'sort_order' => 5,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Barbecue',
                'name_ar' => 'باربكيو',
                'name_fr' => 'Barbecue',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce barbecue fumée',
                'is_active' => true,
                'sort_order' => 6,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Curry',
                'name_ar' => 'كاري',
                'name_fr' => 'Curry',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce curry indienne',
                'is_active' => true,
                'sort_order' => 7,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Aigre Douce',
                'name_ar' => 'اجيري',
                'name_fr' => 'Aigre Douce',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce aigre douce chinoise',
                'is_active' => true,
                'sort_order' => 8,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Samouraï',
                'name_ar' => 'الساموراي',
                'name_fr' => 'Samouraï',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce samouraï épicée',
                'is_active' => true,
                'sort_order' => 9,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Andalouse',
                'name_ar' => 'الأندلسي',
                'name_fr' => 'Andalouse',
                'category' => 'sauces',
                'price' => 0.00,
                'icon' => 'fas fa-fire',
                'description' => 'Sauce andalouse crémeuse',
                'is_active' => true,
                'sort_order' => 10,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'salade', 'nos_box']
            ],

            // ===== VEGETABLES =====
            [
                'name' => 'Tomates',
                'name_ar' => 'الطماطم',
                'name_fr' => 'Tomates',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Tomates fraîches',
                'is_active' => true,
                'sort_order' => 11,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Salade',
                'name_ar' => 'سلطة',
                'name_fr' => 'Salade',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Salade verte fraîche',
                'is_active' => true,
                'sort_order' => 12,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Oignons',
                'name_ar' => 'البصل',
                'name_fr' => 'Oignons',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Oignons frais',
                'is_active' => true,
                'sort_order' => 13,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Sans Légumes',
                'name_ar' => 'بدون خضار',
                'name_fr' => 'Sans Légumes',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Aucun légume',
                'is_active' => true,
                'sort_order' => 14,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Sans Tomates',
                'name_ar' => 'بدون طماطم',
                'name_fr' => 'Sans Tomates',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Exclure les tomates',
                'is_active' => true,
                'sort_order' => 15,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Sans Salade',
                'name_ar' => 'بدون سلطة',
                'name_fr' => 'Sans Salade',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Exclure la salade',
                'is_active' => true,
                'sort_order' => 16,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],
            [
                'name' => 'Sans Oignons',
                'name_ar' => 'بدون بصل',
                'name_fr' => 'Sans Oignons',
                'category' => 'vegetables',
                'price' => 0.00,
                'icon' => 'fas fa-leaf',
                'description' => 'Exclure les oignons',
                'is_active' => true,
                'sort_order' => 17,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'salade', 'nos_box']
            ],

            // ===== DRINKS =====
            [
                'name' => 'Coca Cola',
                'name_ar' => 'كوكا كولا',
                'name_fr' => 'Coca Cola',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Coca Cola classique',
                'is_active' => true,
                'sort_order' => 18,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Coca Cherry',
                'name_ar' => 'كوكا شيري',
                'name_fr' => 'Coca Cherry',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Coca Cola cerise',
                'is_active' => true,
                'sort_order' => 19,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Coca Zero',
                'name_ar' => 'كوكا زيرو',
                'name_fr' => 'Coca Zero',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Coca Cola sans sucre',
                'is_active' => true,
                'sort_order' => 20,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Oasis Tropical',
                'name_ar' => 'أواسيس تروبيكال',
                'name_fr' => 'Oasis Tropical',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Jus Oasis tropical',
                'is_active' => true,
                'sort_order' => 21,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Oasis Pomme Raisins',
                'name_ar' => 'تفاح الواحة مع الكشمش الأسود والتوت',
                'name_fr' => 'Oasis Pomme Raisins',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Jus Oasis pomme avec raisins',
                'is_active' => true,
                'sort_order' => 22,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Thé Glacé',
                'name_ar' => 'شاي مثلج',
                'name_fr' => 'Thé Glacé',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Thé glacé rafraîchissant',
                'is_active' => true,
                'sort_order' => 23,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Fanta Orange',
                'name_ar' => 'فانتا برتقال',
                'name_fr' => 'Fanta Orange',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Fanta orange',
                'is_active' => true,
                'sort_order' => 24,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Sprite',
                'name_ar' => 'سبرايت',
                'name_fr' => 'Sprite',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Sprite citron-lime',
                'is_active' => true,
                'sort_order' => 25,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Tropica',
                'name_ar' => 'تروبيكا',
                'name_fr' => 'Tropica',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Jus Tropica',
                'is_active' => true,
                'sort_order' => 26,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Orangina',
                'name_ar' => 'أورانجينا',
                'name_fr' => 'Orangina',
                'category' => 'drinks',
                'price' => 0.00,
                'icon' => 'fas fa-glass-whiskey',
                'description' => 'Orangina avec pulpe',
                'is_active' => true,
                'sort_order' => 27,
                'product_types' => ['sandwiches', 'tacos', 'galettes', 'burgers', 'panini', 'menus_enfant', 'nos_box']
            ],

            // ===== MEAT CHOICES =====
            [
                'name' => 'Kebab',
                'name_ar' => 'كباب',
                'name_fr' => 'Kebab',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Viande kebab traditionnelle',
                'is_active' => true,
                'sort_order' => 28,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Steak',
                'name_ar' => 'شريحة لحم',
                'name_fr' => 'Steak',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Steak de bœuf grillé',
                'is_active' => true,
                'sort_order' => 29,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Poulet',
                'name_ar' => 'فرخة',
                'name_fr' => 'Poulet',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Poulet grillé',
                'is_active' => true,
                'sort_order' => 30,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Escalope',
                'name_ar' => 'سترة',
                'name_fr' => 'Escalope',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Escalope de poulet',
                'is_active' => true,
                'sort_order' => 31,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Cordon Bleu',
                'name_ar' => 'كوردون بلو',
                'name_fr' => 'Cordon Bleu',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Cordon bleu de poulet',
                'is_active' => true,
                'sort_order' => 32,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Tenders',
                'name_ar' => 'قطع طرية',
                'name_fr' => 'Tenders',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Tenders de poulet',
                'is_active' => true,
                'sort_order' => 33,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Nuggets',
                'name_ar' => 'ناجتس',
                'name_fr' => 'Nuggets',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Nuggets de poulet',
                'is_active' => true,
                'sort_order' => 34,
                'product_types' => ['tacos', 'galettes']
            ],
            [
                'name' => 'Dinde',
                'name_ar' => 'ديك رومي',
                'name_fr' => 'Dinde',
                'category' => 'meat',
                'price' => 0.00,
                'icon' => 'fas fa-drumstick-bite',
                'description' => 'Viande de dinde',
                'is_active' => true,
                'sort_order' => 35,
                'product_types' => ['tacos', 'galettes']
            ],

            // ===== EXTRA ITEMS =====
            [
                'name' => 'Petite Frite',
                'name_ar' => 'بطاطس صغيرة',
                'name_fr' => 'Petite Frite',
                'category' => 'extras',
                'price' => 0.00,
                'icon' => 'fas fa-plus',
                'description' => 'Portion de frites petite',
                'is_active' => true,
                'sort_order' => 36,
                'product_types' => ['sandwiches', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Grande Frite',
                'name_ar' => 'بطاطس كبيرة',
                'name_fr' => 'Grande Frite',
                'category' => 'extras',
                'price' => 0.00,
                'icon' => 'fas fa-plus',
                'description' => 'Portion de frites grande',
                'is_active' => true,
                'sort_order' => 37,
                'product_types' => ['sandwiches', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Petite Viande',
                'name_ar' => 'لحم صغير',
                'name_fr' => 'Petite Viande',
                'category' => 'extras',
                'price' => 0.00,
                'icon' => 'fas fa-plus',
                'description' => 'Portion de viande petite',
                'is_active' => true,
                'sort_order' => 38,
                'product_types' => ['sandwiches', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'nos_box']
            ],
            [
                'name' => 'Grande Viande',
                'name_ar' => 'لحم كبير',
                'name_fr' => 'Grande Viande',
                'category' => 'extras',
                'price' => 0.00,
                'icon' => 'fas fa-plus',
                'description' => 'Portion de viande grande',
                'is_active' => true,
                'sort_order' => 39,
                'product_types' => ['sandwiches', 'burgers', 'panini', 'assiettes', 'menus_enfant', 'nos_box']
            ]
        ];

        foreach ($addons as $addon) {
            Addon::create($addon);
        }

        $this->command->info('Addons seeded successfully!');
    }
}
