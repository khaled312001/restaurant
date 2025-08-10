<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowMenuSections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:sections {--detailed : Show detailed product information}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Afficher les sections du menu avec le nombre de plats disponibles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $detailed = $this->option('detailed');

        $this->info("🍽️  SECTIONS DU MENU - KING KEBAB 🍽️");
        $this->info("==========================================");
        $this->info("");

        try {
            // Récupérer les catégories principales
            $categories = $this->getCategoriesWithProductCount();
            
            foreach ($categories as $category) {
                $this->displayMenuSection($category, $detailed);
            }

            $this->info("");
            $this->info("✅ Sections du menu affichées avec succès!");
            
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Erreur lors de l'affichage des sections: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Récupérer les catégories avec le nombre de produits
     */
    private function getCategoriesWithProductCount()
    {
        return DB::table('pcategories')
            ->leftJoin('products', function($join) {
                $join->on('pcategories.id', '=', 'products.category_id')
                     ->where('products.status', 1);
            })
            ->where('pcategories.status', 1)
            ->where('pcategories.language_id', function($query) {
                $query->select('id')
                      ->from('languages')
                      ->where('code', 'fr')
                      ->first();
            })
            ->select(
                'pcategories.id',
                'pcategories.name',
                'pcategories.slug',
                DB::raw('COUNT(products.id) as product_count')
            )
            ->groupBy('pcategories.id', 'pcategories.name', 'pcategories.slug')
            ->orderBy('pcategories.name')
            ->get();
    }

    /**
     * Afficher une section du menu
     */
    private function displayMenuSection($category, $detailed)
    {
        $this->info("📋 {$category->name}");
        $this->info("   {$category->product_count} plats disponibles");
        $this->info("");
        
        if ($detailed && $category->product_count > 0) {
            $this->displayProductsInCategory($category->id);
        }
        
        $this->info("   Voir tous les plats");
        $this->info("");
    }

    /**
     * Afficher les produits d'une catégorie
     */
    private function displayProductsInCategory($categoryId)
    {
        $products = DB::table('products')
            ->where('category_id', $categoryId)
            ->where('status', 1)
            ->select('title', 'current_price', 'previous_price', 'is_special')
            ->orderBy('title')
            ->get();

        foreach ($products as $product) {
            $price = number_format($product->current_price, 2) . ' €';
            $special = $product->is_special ? ' ⭐' : '';
            
            if ($product->previous_price && $product->previous_price > $product->current_price) {
                $oldPrice = number_format($product->previous_price, 2) . ' €';
                $this->line("      • {$product->title} - {$price} (au lieu de {$oldPrice}){$special}");
            } else {
                $this->line("      • {$product->title} - {$price}{$special}");
            }
        }
        
        $this->info("");
    }
} 