<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Pcategory;
use App\Models\Product;

class FetchMenuData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:fetch-data {--lang=fr : Language code (default: fr)} {--format=table : Output format (table, json, csv)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch menu data from MySQL database including categories and products with prices';

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
        $langCode = $this->option('lang');
        $format = $this->option('format');

        $this->info("Récupération des données du menu en français...");
        $this->info("Langue: {$langCode}");
        $this->info("Format: {$format}");
        $this->info("");

        try {
            // Récupérer les catégories
            $categories = $this->fetchCategories($langCode);
            
            // Récupérer les produits avec leurs prix
            $products = $this->fetchProducts($langCode);

            // Afficher les résultats selon le format demandé
            switch ($format) {
                case 'json':
                    $this->outputJson($categories, $products);
                    break;
                case 'csv':
                    $this->outputCsv($categories, $products);
                    break;
                default:
                    $this->outputTable($categories, $products);
                    break;
            }

            $this->info("");
            $this->info("Données récupérées avec succès!");
            
            return 0;
        } catch (\Exception $e) {
            $this->error("Erreur lors de la récupération des données: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Récupérer les catégories depuis la base de données
     */
    private function fetchCategories($langCode)
    {
        $this->info("Récupération des catégories...");
        
        $categories = DB::table('pcategories')
            ->where('status', 1)
            ->where('language_id', function($query) use ($langCode) {
                $query->select('id')
                      ->from('languages')
                      ->where('code', $langCode)
                      ->first();
            })
            ->select('id', 'name', 'slug', 'tax')
            ->get();

        $this->info("Nombre de catégories trouvées: " . $categories->count());
        
        return $categories;
    }

    /**
     * Récupérer les produits avec leurs prix depuis la base de données
     */
    private function fetchProducts($langCode)
    {
        $this->info("Récupération des produits...");
        
        $products = DB::table('products')
            ->join('pcategories', 'products.category_id', '=', 'pcategories.id')
            ->where('products.status', 1)
            ->where('products.language_id', function($query) use ($langCode) {
                $query->select('id')
                      ->from('languages')
                      ->where('code', $langCode)
                      ->first();
            })
            ->select(
                'products.id',
                'products.title',
                'products.current_price',
                'products.previous_price',
                'products.is_special',
                'pcategories.name as category_name'
            )
            ->orderBy('pcategories.name')
            ->orderBy('products.title')
            ->get();

        $this->info("Nombre de produits trouvés: " . $products->count());
        
        return $products;
    }

    /**
     * Afficher les résultats en format tableau
     */
    private function outputTable($categories, $products)
    {
        // Afficher les catégories
        $this->info("=== CATÉGORIES ===");
        $categoryHeaders = ['ID', 'Nom', 'Slug', 'Taxe (%)'];
        $categoryRows = $categories->map(function($cat) {
            return [$cat->id, $cat->name, $cat->slug, $cat->tax];
        })->toArray();
        
        $this->table($categoryHeaders, $categoryRows);

        // Afficher les produits par catégorie
        $this->info("");
        $this->info("=== PRODUITS PAR CATÉGORIE ===");
        
        $productsByCategory = $products->groupBy('category_name');
        
        foreach ($productsByCategory as $categoryName => $categoryProducts) {
            $this->info("");
            $this->info("--- {$categoryName} ---");
            
            $productHeaders = ['ID', 'Nom', 'Prix Actuel', 'Prix Précédent', 'Spécial'];
            $productRows = $categoryProducts->map(function($prod) {
                $special = $prod->is_special ? 'OUI' : 'NON';
                $currentPrice = number_format($prod->current_price, 2) . ' €';
                $previousPrice = $prod->previous_price ? number_format($prod->previous_price, 2) . ' €' : '-';
                
                return [$prod->id, $prod->title, $currentPrice, $previousPrice, $special];
            })->toArray();
            
            $this->table($productHeaders, $productRows);
        }
    }

    /**
     * Afficher les résultats en format JSON
     */
    private function outputJson($categories, $products)
    {
        $data = [
            'categories' => $categories,
            'products' => $products->groupBy('category_name')
        ];
        
        $this->line(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Afficher les résultats en format CSV
     */
    private function outputCsv($categories, $products)
    {
        // CSV des catégories
        $this->info("=== CSV DES CATÉGORIES ===");
        $this->line("ID,Nom,Slug,Taxe");
        foreach ($categories as $cat) {
            $this->line("{$cat->id},{$cat->name},{$cat->slug},{$cat->tax}");
        }
        
        $this->info("");
        $this->info("=== CSV DES PRODUITS ===");
        $this->line("ID,Nom,Catégorie,Prix Actuel,Prix Précédent,Spécial");
        foreach ($products as $prod) {
            $special = $prod->is_special ? 'OUI' : 'NON';
            $this->line("{$prod->id},{$prod->title},{$prod->category_name},{$prod->current_price},{$prod->previous_price},{$special}");
        }
    }
} 