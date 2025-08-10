<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowMenuInFrench extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:show-french';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Afficher le menu complet en français avec toutes les sections et repas';

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
        $this->info("🍽️  MENU DU RESTAURANT KING KEBAB 🍽️");
        $this->info("==========================================");
        $this->info("");

        try {
            // Récupérer les catégories principales
            $categories = $this->getMainCategories();
            
            foreach ($categories as $category) {
                $this->displayCategory($category);
            }

            $this->info("");
            $this->info("✅ Menu affiché avec succès!");
            
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Erreur lors de l'affichage du menu: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Récupérer les catégories principales
     */
    private function getMainCategories()
    {
        return DB::table('pcategories')
            ->where('status', 1)
            ->where('language_id', function($query) {
                $query->select('id')
                      ->from('languages')
                      ->where('code', 'fr')
                      ->first();
            })
            ->orderBy('name')
            ->get();
    }

    /**
     * Afficher une catégorie avec ses produits
     */
    private function displayCategory($category)
    {
        // Compter le nombre de produits dans cette catégorie
        $productCount = DB::table('products')
            ->where('category_id', $category->id)
            ->where('status', 1)
            ->count();

        $this->info("📋 {$category->name}");
        $this->info("   {$productCount} plats disponibles");
        $this->info("");

        // Récupérer les produits de cette catégorie
        $products = DB::table('products')
            ->where('category_id', $category->id)
            ->where('status', 1)
            ->select('title', 'current_price', 'previous_price', 'is_special')
            ->orderBy('title')
            ->get();

        if ($products->count() > 0) {
            foreach ($products as $product) {
                $this->displayProduct($product);
            }
        } else {
            $this->line("   Aucun plat disponible pour le moment");
        }

        $this->info("   Voir tous les plats");
        $this->info("");
        $this->info("----------------------------------------");
        $this->info("");
    }

    /**
     * Afficher un produit individuel
     */
    private function displayProduct($product)
    {
        $price = number_format($product->current_price, 2) . ' €';
        $special = $product->is_special ? ' ⭐ SPÉCIAL' : '';
        
        if ($product->previous_price && $product->previous_price > $product->current_price) {
            $oldPrice = number_format($product->previous_price, 2) . ' €';
            $this->line("   • {$product->title} - {$price} (au lieu de {$oldPrice}){$special}");
        } else {
            $this->line("   • {$product->title} - {$price}{$special}");
        }
    }
} 