<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Language;
use App\Models\Pcategory;
use App\Models\TimeFrame;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use App\Models\BasicExtended;
use App\Models\ProductReview;
use App\Models\ServingMethod;
use App\Models\OfflineGateway;
use App\Models\PaymentGateway;
use App\Models\ShippingCharge;
use App\Models\BasicSetting as BS;
use App\Models\BasicExtended as BE;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('setlang');
    }

    /**
     * Get current language with proper fallback logic
     */
    private function getCurrentLanguage()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        
        // If no default language is set or language not found, get the first available language
        if (!$currentLang) {
            $currentLang = Language::first();
        }
        
        // If still no language found, abort with error
        if (!$currentLang) {
            \abort(500, 'No language configured');
        }
        
        return $currentLang;
    }

    public function product(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;

        $lang_id = $currentLang->id;

        // Filtrer uniquement les 6 catégories spécifiques du menu
        $data['categories'] = Pcategory::where('status', 1)
            ->where('language_id', $currentLang->id)
            ->whereIn('name', ['Assiettes', 'Sandwichs', 'Menus', 'Salade', 'Menus Enfant', 'Nos Box'])
            ->orderBy('id')
            ->get();

        // Récupérer la catégorie sélectionnée si category_id est fourni
        $selectedCategory = null;
        if ($request->has('category_id')) {
            $selectedCategory = Pcategory::where('id', $request->category_id)
                ->where('language_id', $lang_id)
                ->where('status', 1)
                ->first();
        }

        // Construire la requête des produits
        $productsQuery = Product::where('language_id', $lang_id)->where('status', 1);
        
        // Filtrer par catégorie si une catégorie est sélectionnée
        if ($selectedCategory) {
            $productsQuery->where('category_id', $selectedCategory->id);
            $data['selectedCategory'] = $selectedCategory;
        }

        $data['products'] = $productsQuery->paginate(10);
        $data['selectedCategory'] = $selectedCategory;

        return view('front.multipurpose.product.product', $data);
    }



    public function sandwichesMenus(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        return view('front.multipurpose.product.sandwiches_menus', $data);
    }

    public function kebabGalette(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for galettes (includes meat choices)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('galettes');
        $data['productType'] = 'galettes';
        
        // Get galettes products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'galettes')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.kebab_galette', $data);
    }

    public function americainKofte(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for sandwiches (no meat choices)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('sandwiches');
        $data['productType'] = 'sandwiches';
        
        // Get sandwiches products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'sandwiches')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.americain_kofte', $data);
    }

    public function tacos(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for tacos (includes meat choices)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('tacos');
        $data['productType'] = 'tacos';
        
        // Get tacos products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'tacos')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.tacos', $data);
    }

    public function burgers(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for burgers (no meat choices)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('burgers');
        $data['productType'] = 'burgers';
        
        // Get burgers products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'burgers')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.burgers', $data);
    }

    public function panini(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for panini (no meat choices)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('panini');
        $data['productType'] = 'panini';
        
        // Get panini products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'panini')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.panini', $data);
    }

    public function assiettes(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for assiettes (only sauces)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('assiettes');
        $data['productType'] = 'assiettes';
        
        // Get assiettes products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'assiettes')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.assiettes', $data);
    }

    public function menusEnfant(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for menus enfant (vegetables, sauces, drinks)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('menus_enfant');
        $data['productType'] = 'menus_enfant';
        
        // Get menus enfant products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'menus_enfant')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.menus_enfant', $data);
    }

    public function salade(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        
        // If no default language is set or language not found, get the first available language
        if (!$currentLang) {
            $currentLang = Language::first();
        }
        
        // If still no language found, abort with error
        if (!$currentLang) {
            abort(500, 'No language configured');
        }
        
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for salade (sauces required, vegetables optional)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('salade');
        $data['productType'] = 'salade';
        
        // Get salade products with their prices from database
        $data['products'] = \App\Models\Product::where('product_type', 'salade')
            ->where('language_id', $currentLang->id)
            ->where('status', 1)
            ->get();

        return view('front.multipurpose.product.salade', $data);
    }

    public function nosBox(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;

        // Get addons for nos box (vegetables, sauces, drinks)
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('nos_box');
        $data['productType'] = 'nos_box';

        // Load products for 'Nos Box' category
        $nosBoxCategory = Pcategory::where('status', 1)
            ->where('language_id', $currentLang->id)
            ->where('name', 'Nos Box')
            ->first();

        if ($nosBoxCategory) {
            $data['products'] = Product::where('language_id', $currentLang->id)
                ->where('status', 1)
                ->where('category_id', $nosBoxCategory->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $data['products'] = collect();
        }

        return view('front.multipurpose.product.nos_box', $data);
    }

    // Addon selection pages for each category
    public function tacosAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('tacos');
        $data['productType'] = 'tacos';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'tacos');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'TACOS',
                'price' => ($type === 'menu') ? 11.50 : 7.50
            ];
        }
        
        return view('front.multipurpose.product.addons.tacos', $data);
    }

    public function kebabGaletteAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('galettes');
        $data['productType'] = 'galettes';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'kebab-galette');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'KEBAB GALETTE',
                'price' => ($type === 'menu') ? 13.50 : 9.50
            ];
        }
        
        return view('front.multipurpose.product.addons.kebab_galette', $data);
    }

    public function americainKofteAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('galettes');
        $data['productType'] = 'galettes';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'americain-kofte');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'AMERICAIN KOFTE',
                'price' => ($type === 'menu') ? 14.50 : 10.50
            ];
        }
        
        return view('front.multipurpose.product.addons.americain_kofte', $data);
    }

    public function burgersAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('burgers');
        $data['productType'] = 'burgers';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'burger');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'BURGER',
                'price' => ($type === 'menu') ? 12.00 : 8.00
            ];
        }
        
        return view('front.multipurpose.product.addons.burgers', $data);
    }

    public function paniniAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('panini');
        $data['productType'] = 'panini';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'panini-3-fromages');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'PANINI 3 FROMAGES',
                'price' => ($type === 'menu') ? 9.50 : 6.50
            ];
        }
        
        return view('front.multipurpose.product.addons.panini', $data);
    }

    public function assiettesAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('assiettes');
        $data['productType'] = 'assiettes';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'assiette');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'ASSIETTE',
                'price' => ($type === 'menu') ? 16.00 : 12.00
            ];
        }
        
        return view('front.multipurpose.product.addons.assiettes', $data);
    }

    public function menusEnfantAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('menus_enfant');
        $data['productType'] = 'menus_enfant';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'menu-enfant');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'MENU ENFANT',
                'price' => ($type === 'menu') ? 8.50 : 6.50
            ];
        }
        
        return view('front.multipurpose.product.addons.menus_enfant', $data);
    }

    public function saladeAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('salade');
        $data['productType'] = 'salade';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'salade');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'SALADE',
                'price' => ($type === 'menu') ? 10.50 : 7.50
            ];
        }
        
        return view('front.multipurpose.product.addons.salade', $data);
    }

    public function nosBoxAddons(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $data['bs'] = $currentLang->basic_setting;
        $data['be'] = $currentLang->basic_extended;
        $data['addons'] = \App\Models\Addon::getAddonsByProductType('nos_box');
        $data['productType'] = 'nos_box';
        
        // Get type and product from URL parameters
        $type = $request->get('type', 'seul');
        $productSlug = $request->get('product', 'nos-box');
        
        // Get specific product from database by slug
        $product = \App\Models\Product::where('slug', $productSlug)
                                    ->where('language_id', $currentLang->id)
                                    ->first();
        
        if ($product) {
            $data['product'] = (object) [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->getPriceByType($type)
            ];
        } else {
            // Fallback if no product found in database
            $data['product'] = (object) [
                'id' => 1,
                'name' => 'NOS BOX',
                'price' => ($type === 'menu') ? 15.00 : 11.00
            ];
        }
        
        return view('front.multipurpose.product.addons.nos_box', $data);
    }

    public function productDetails($slug, $id)
    {
        $currentLang = $this->getCurrentLanguage();

        Session::put('link', route('front.product.details', ['slug' => $slug, 'id' => $id]));

        $data['product'] = Product::where('id', $id)->where('language_id', $currentLang->id)->first();
        $data['categories'] = Pcategory::where('status', 1)->where('language_id', $currentLang->id)->get();
        $data['reviews'] = ProductReview::where('product_id', $id)->get();

        $data['related_product'] = Product::where('category_id', $data['product']->category_id)->where('language_id', $currentLang->id)->where('id', '!=', $data['product']->id)->get();

        return view('front.multipurpose.product.details', $data);
    }

    public function items(Request $request)
    {
        $currentLang = $this->getCurrentLanguage();
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;

        $data['products'] = Product::where('status', 1)->where('language_id', $currentLang->id)->paginate(6);
        $data['categories'] = Pcategory::where('status', 1)->where('language_id', $currentLang->id)->get();

        $search = $request->search;
        $minprice = $request->minprice;
        $maxprice = $request->maxprice;
        $category = $request->category_id;
        $subcategory = $request->subcategory_id;

        if ($request->type) {
            $type = $request->type;
        } else {
            $type = 'new';
        }


        $review = $request->review;

        $data['products'] =
            Product::when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($subcategory, function ($query, $subcategory) {
                return $query->where('subcategory_id', $subcategory);
            })
            ->when($lang_id, function ($query, $lang_id) {
                return $query->where('language_id', $lang_id);
            })
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')->orwhere('summary', 'like', '%' . $search . '%')->orwhere('description', 'like', '%' . $search . '%');
            })
            ->when($minprice, function ($query, $minprice) {
                return $query->where('current_price', '>=', $minprice);
            })
            ->when($maxprice, function ($query, $maxprice) {
                return $query->where('current_price', '<=', $maxprice);
            })

            ->when($review, function ($query, $review) {
                return $query->where('rating', '>=', $review);
            })

            ->when($type, function ($query, $type) {
                if ($type == 'new') {
                    return $query->orderBy('id', 'DESC');
                } elseif ($type == 'old') {
                    return $query->orderBy('id', 'ASC');
                } elseif ($type == 'high-to-low') {
                    return $query->orderBy('current_price', 'DESC');
                } elseif ($type == 'low-to-high') {
                    return $query->orderBy('current_price', 'ASC');
                }
            })

            ->where('status', 1)->paginate(9);

        return view('front.multipurpose.product.items', $data);
    }

    public function cart()
    {
        $currentLang = $this->getCurrentLanguage();

        if (Session::has('cart')) {
            $cart = Session::get('cart');
            
            // Debug: Log cart contents
        \Log::info("Cart keys: " . implode(", ", array_keys($cart)));
            \Log::info('Cart contents', ['cart' => $cart]);
            
            // Validate and clean cart data
            if (is_array($cart)) {
                foreach ($cart as $key => $item) {
                    // Ensure all required fields exist
                    if (!isset($item['id']) || !isset($item['name']) || !isset($item['qty']) || !isset($item['total'])) {
                        unset($cart[$key]);
                        continue;
                    }
                    
                    // Validate product exists
                    $product = Product::find($item['id']);
                    if (!$product) {
                        unset($cart[$key]);
                        continue;
                    }
                    
                    // Debug: Log each cart item
                    \Log::info('Cart item ' . $key, ['item' => $item]);
                    
                    // Recalculate total to ensure accuracy
                    $itemTotal = (float)$item['product_price'];
                    
                    // Add variations price
                    if (isset($item['variations']) && is_array($item['variations'])) {
                        foreach ($item['variations'] as $variation) {
                            if (is_array($variation) && array_key_exists('price', $variation)) {
                                $itemTotal += (float)$variation["price"];
                            }
                        }
                    }
                    
                    // Add addons price
                    if (isset($item['addons']) && is_array($item['addons'])) {
                        foreach ($item['addons'] as $addon) {
                            if (is_array($addon) && array_key_exists('price', $addon)) {
                                $itemTotal += (float)$addon["price"];
                            }
                        }
                    }
                    
                    // Update total
                    $cart[$key]['total'] = $itemTotal * (int)$item['qty'];
                }
                
                // Save cleaned cart
                Session::put('cart', $cart);
                Session::save();
            }
        } else {
            $cart = null;
        }
        
        // Get basic settings and extended settings
        $bs = $currentLang->basic_setting;
        $be = $currentLang->basic_extended;
        $rtl = $currentLang->rtl ?? 0;
        $activeTheme = $currentLang->basic_setting->theme ?? 'multipurpose';
        
        return view('front.multipurpose.product.cart', compact('cart', 'bs', 'be', 'rtl', 'activeTheme', 'currentLang'));
    }

    public function addToCart($id, Request $request)
    {
        $cart = Session::get('cart');
        $customizationData = null; // Initialize customizationData

        // Debug logging
        \Log::info('AddToCart called with method: ' . ($request ? $request->method() : 'null'));
        \Log::info('Has customizations: ' . ($request && $request->has('customizations') ? 'yes' : 'no'));
        \Log::info('Request data', $request ? $request->all() : []);

        // Check if this is a POST request with customization data
        if ($request && ($request->isMethod('post') || $request->has('customizations'))) {
            $customizations = $request->input('customizations');
            $quantity = (int)$request->input('quantity', 1);
            
            \Log::info('POST request received for addToCart');
            \Log::info('Raw customizations', ['customizations' => $customizations]);
            \Log::info('Quantity', ['quantity' => $quantity]);
            \Log::info('All POST data', $request->all());
            
            if ($customizations) {
                $customizationData = json_decode($customizations, true);
                \Log::info('Decoded customizations', ['customizationData' => $customizationData]);
                
                $id = (int)$id;
                $qty = $quantity;
                $total = 0;
                $variant = [];
                $addons = [];
            } else {
                \Log::info('No customizations found, falling back to GET logic');
                // Fallback to GET logic
                return $this->addToCartGet($id);
            }
        } else {
            \Log::info('No POST request, using GET logic');
            // Check if this is a simple product addition or complex one
            if (strpos($id, ',,,') !== false) {
                // Complex product with variants/addons
                $data = explode(',,,', $id);
                $id = (int)$data[0];
                $qty = (int)$data[1];
                $total = (float)$data[2];
                $variant = json_decode($data[3], true);
                $addons = json_decode($data[4], true);
            } else {
                // Simple product addition - use default values
                $id = (int)$id;
                $qty = 1;
                $total = 0;
                $variant = [];
                $addons = [];
            }
        }

        // Try to resolve product by ID first; if not found, try by provided name
        try {
            $product = Product::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $fallbackTitle = null;
            if ($customizationData && isset($customizationData['productName'])) {
                $fallbackTitle = $customizationData['productName'];
            } elseif ($request) {
                $raw = $request->input('customizations');
                if ($raw) {
                    $decoded = json_decode($raw, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($decoded['productName'])) {
                        $fallbackTitle = $decoded['productName'];
                    }
                }
            }

            if ($fallbackTitle) {
                $product = Product::where('title', $fallbackTitle)->first();
            } else {
                $product = null;
            }

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], 404);
            }
            // If we found by title, normalize $id
            $id = (int)$product->id;
        }
        // validations
        if ($qty < 1) {
            return response()->json(['error' => 'Quantity must be 1 or more than 1.']);
        }
        
        $pvariant = json_decode($product->variations, true);
        
        // If this is a simple addition but the product has variations, 
        // we need to handle this case gracefully
        if (!empty($pvariant) && empty($variant)) {
            // For simple additions, try to use the first available variant
            if (is_array($pvariant)) {
                $firstVariantKey = array_key_first($pvariant);
                if ($firstVariantKey && is_array($pvariant[$firstVariantKey]) && !empty($pvariant[$firstVariantKey])) {
                    $firstVariant = $pvariant[$firstVariantKey][0]; // Get first option of first variant
                    $variant = [$firstVariantKey => $firstVariant];
                } else {
                    return response()->json(['error' => 'You must select a variant.']);
                }
            } else {
                return response()->json(['error' => 'You must select a variant.']);
            }
        }

        if (!$product) {
            abort(404);
        }
        
        // Recalculate total on server side to ensure accuracy
        $calculatedTotal = (float)$product->current_price;
        
        // Add variations price
        if (is_array($variant)) {
            foreach ($variant as $variation) {
                if (is_array($variation) && array_key_exists('price', $variation)) {
                    $calculatedTotal += (float)$variation["price"];
                }
            }
        }
        
        // Addons are always free per business rules; ignore addon prices entirely
        if (is_array($addons)) {
            // Intentionally no-op to enforce free addons
        }
        
        // Multiply by quantity
        $calculatedTotal = $calculatedTotal * $qty;
        
        $cart = Session::get('cart');
        $ckey = uniqid();
        
        // Ensure cart key is always a string
        $ckey = (string)$ckey;

        // Prepare cart item data
        $cartItem = [
            "id" => $id,
            "name" => $product->title,
            "qty" => (int)$qty,
            "variations" => $variant,
            "addons" => [], // Initialize as empty, will be filled with customizations if available
            "product_price" => (float)$product->current_price,
            "total" => $calculatedTotal,
            "photo" => $product->feature_image
        ];

        // Add customizations if provided
        if ($customizationData) {
            $cartItem["customizations"] = $customizationData;
            
            // Debug: Log the cart item with customizations
            \Log::info('Cart item with customizations', ['cartItem' => $cartItem]);
            \Log::info('Customization data received', ['customizationData' => $customizationData]);
            
            // Prepare addons array for database storage
            $allAddons = [];
            
            // Add meat choice
            if (!empty($customizationData['meatChoice'])) {
                $allAddons[] = [
                    'name' => $customizationData['meatChoice'],
                    'category' => 'meat',
                    'price' => 0.00,
                    'type' => 'meat_choice'
                ];
            }
            
            // Add vegetables
            if (!empty($customizationData['vegetables']) && is_array($customizationData['vegetables'])) {
                foreach ($customizationData['vegetables'] as $vegetable) {
                    $allAddons[] = [
                        'name' => $vegetable,
                        'category' => 'vegetables',
                        'price' => 0.00,
                        'type' => 'vegetable'
                    ];
                }
            }
            
            // Add drinks (multiple selections possible)
            if (!empty($customizationData['drinks']) && is_array($customizationData['drinks'])) {
                foreach ($customizationData['drinks'] as $drink) {
                    $allAddons[] = [
                        'name' => $drink,
                        'category' => 'drinks',
                        'price' => 0.00,
                        'type' => 'drink'
                    ];
                }
            }
            
            // Backward compatibility for single drink choice
            if (!empty($customizationData['drinkChoice'])) {
                $allAddons[] = [
                    'name' => $customizationData['drinkChoice'],
                    'category' => 'drinks',
                    'price' => 0.00,
                    'type' => 'drink'
                ];
            }
            
            // Add sauces
            if (!empty($customizationData['sauces']) && is_array($customizationData['sauces'])) {
                foreach ($customizationData['sauces'] as $sauce) {
                    $allAddons[] = [
                        'name' => $sauce,
                        'category' => 'sauces',
                        'price' => 0.00,
                        'type' => 'sauce'
                    ];
                }
            }
            
            // Add extras
            if (!empty($customizationData['extras']) && is_array($customizationData['extras'])) {
                foreach ($customizationData['extras'] as $extra) {
                    $allAddons[] = [
                        'name' => $extra,
                        'category' => 'extras',
                        'price' => 0.00,
                        'type' => 'extra'
                    ];
                }
            }
            
            // IMPORTANT: Add addons to cart item so they appear in cart
            $cartItem["addons"] = $allAddons;
            
            \Log::info('All addons prepared', ['allAddons' => $allAddons]);
            \Log::info('Cart item after adding addons', ['cartItem' => $cartItem]);
            
            // Save customization to database
            try {
                $customization = new \App\Models\Customization();
                $customization->product_name = $customizationData['productName'] ?? $product->title;
                $customization->product_type = $customizationData['productType'] ?? 'Product';
                $customization->price = (float)str_replace(',', '.', $customizationData['price'] ?? $product->current_price);
                $customization->quantity = $customizationData['quantity'] ?? $qty;
                $customization->meat_choice = $customizationData['meatChoice'] ?? null;
                $customization->vegetables = $customizationData['vegetables'] ?? [];
                $customization->drink_choice = $customizationData['drinkChoice'] ?? null;
                $customization->sauces = $customizationData['sauces'] ?? [];
                $customization->addons = $allAddons; // Store all addons in one field
                $customization->save();
                
                // Store customization ID in cart item
                $cartItem["customization_id"] = $customization->id;
                
                \Log::info('Customization saved to database with ID: ' . $customization->id);
            } catch (\Exception $e) {
                // Log error but continue with cart
                \Log::error('Failed to save customization: ' . $e->getMessage());
            }
        } else {
            // If no customizations, use the old addons system for backward compatibility
            $cartItem["addons"] = $addons;
            
            \Log::info('No customizations, using old addons', ['addons' => $addons]);
        }

        // Debug: Log the final cart item before saving
        \Log::info('Final cart item to be saved', ['cartItem' => $cartItem]);
        \Log::info('Addons in final cart item: ' . json_encode($cartItem['addons'] ?? []));
        \Log::info('Customizations in final cart item: ' . json_encode($cartItem['customizations'] ?? []));

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $ckey => $cartItem
            ];

            Session::put('cart', $cart);
            Session::save();
            
            if ($request && $request->isMethod('post')) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart successfully!',
                    'redirect' => url('/cart')
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'redirect' => url('/cart')
            ]);
        }

        // if cart not empty then check if this product (with same variation and customizations) exist then increment quantity
        foreach ($cart as $key => $existingCartItem) {
            $variationsMatch = $variant == $existingCartItem["variations"];
            $addonsMatch = $addons == $existingCartItem["addons"];
            $customizationsMatch = true;
            
            if (isset($customizationData) && isset($existingCartItem["customizations"])) {
                $customizationsMatch = $customizationData == $existingCartItem["customizations"];
            } elseif (!isset($customizationData) && !isset($existingCartItem["customizations"])) {
                $customizationsMatch = true;
            } else {
                $customizationsMatch = false;
            }
            
            if ($existingCartItem["id"] == $id && $variationsMatch && $addonsMatch && $customizationsMatch) {
                $cart[$key]['qty'] = (int)$cart[$key]['qty'] + $qty;
                // Recalculate total for this item
                $itemTotal = (float)$existingCartItem["product_price"];
                
                // Add variations price
                if (is_array($existingCartItem["variations"])) {
                    foreach ($existingCartItem["variations"] as $variation) {
                        if (is_array($variation) && array_key_exists('price', $variation)) {
                            $itemTotal += (float)$variation["price"];
                        }
                    }
                }
                
                // Addons are free; do not add any addon price
                
                $cart[$key]['total'] = $itemTotal * $cart[$key]['qty'];
                Session::put('cart', $cart);
                Session::save();
                
                if ($request && $request->isMethod('post')) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Product added to cart successfully!',
                        'redirect' => url('/cart')
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart successfully!',
                    'redirect' => url('/cart')
                ]);
            }
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$ckey] = $cartItem;

        Session::put('cart', $cart);
        Session::save();

        if ($request && ($request->isMethod('post') || $request->has('customizations'))) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'redirect' => url('/cart')
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'redirect' => url('/cart')
        ]);
    }

    // Helper method for GET requests (original logic)
    private function addToCartGet($id)
    {
        $cart = Session::get('cart');

        // Check if this is a simple product addition or complex one
        if (strpos($id, ',,,') !== false) {
            // Complex product with variants/addons
            $data = explode(',,,', $id);
            $id = (int)$data[0];
            $qty = (int)$data[1];
            $total = (float)$data[2];
            $variant = json_decode($data[3], true);
            $addons = json_decode($data[4], true);
        } else {
            // Simple product addition - use default values
            $id = (int)$id;
            $qty = 1;
            $total = 0;
            $variant = [];
            $addons = [];
        }

        $product = Product::findOrFail($id);
        // validations
        if ($qty < 1) {
            return response()->json(['error' => 'Quantity must be 1 or more than 1.']);
        }
        
        $pvariant = json_decode($product->variations, true);
        
        // If this is a simple addition but the product has variations, 
        // we need to handle this case gracefully
        if (!empty($pvariant) && empty($variant)) {
            // For simple additions, try to use the first available variant
            if (is_array($pvariant)) {
                $firstVariantKey = array_key_first($pvariant);
                if ($firstVariantKey && is_array($pvariant[$firstVariantKey]) && !empty($pvariant[$firstVariantKey])) {
                    $firstVariant = $pvariant[$firstVariantKey][0]; // Get first option of first variant
                    $variant = [$firstVariantKey => $firstVariant];
                } else {
                    return response()->json(['error' => 'You must select a variant.']);
                }
            } else {
                return response()->json(['error' => 'You must select a variant.']);
            }
        }

        if (!$product) {
            abort(404);
        }
        
        // Recalculate total on server side to ensure accuracy
        $calculatedTotal = (float)$product->current_price;
        
        // Add variations price
        if (is_array($variant)) {
            foreach ($variant as $variation) {
                if (is_array($variation) && array_key_exists('price', $variation)) {
                    $calculatedTotal += (float)$variation["price"];
                }
            }
        }
        
        // Addons are always free per business rules; ignore addon prices entirely
        if (is_array($addons)) {
            // Intentionally no-op to enforce free addons
        }
        
        // Multiply by quantity
        $calculatedTotal = $calculatedTotal * $qty;
        
        $cart = Session::get('cart');
        $ckey = uniqid();
        
        // Ensure cart key is always a string
        $ckey = (string)$ckey;

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $ckey => [
                    "id" => $id,
                    "name" => $product->title,
                    "qty" => (int)$qty,
                    "variations" => $variant,
                    "addons" => $addons,
                    "product_price" => (float)$product->current_price,
                    "total" => $calculatedTotal,
                    "photo" => $product->feature_image
                ]
            ];

            Session::put('cart', $cart);
            Session::save();
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'redirect' => url('/cart')
            ]);
        }

        // if cart not empty then check if this product (with same variation) exist then increment quantity
        foreach ($cart as $key => $cartItem) {
            if ($cartItem["id"] == $id && $variant == $cartItem["variations"] && $addons == $cartItem["addons"]) {
                $cart[$key]['qty'] = (int)$cart[$key]['qty'] + $qty;
                // Recalculate total for this item
                $itemTotal = (float)$cartItem["product_price"];
                
                // Add variations price
                if (is_array($cartItem["variations"])) {
                    foreach ($cartItem["variations"] as $variation) {
                        if (is_array($variation) && array_key_exists('price', $variation)) {
                            $itemTotal += (float)$variation["price"];
                        }
                    }
                }
                
                // Addons are free; do not add any addon price
                
                $cart[$key]['total'] = $itemTotal * $cart[$key]['qty'];
                Session::put('cart', $cart);
                Session::save();
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart successfully!',
                    'redirect' => url('/cart')
                ]);
            }
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$ckey] = [
            "id" => $id,
            "name" => $product->title,
            "qty" => (int)$qty,
            "variations" => $variant,
            "addons" => $addons,
            "product_price" => (float)$product->current_price,
            "total" => $calculatedTotal,
            "photo" => $product->feature_image
        ];

        Session::put('cart', $cart);
        Session::save();

        return response()->json(['message' => 'Product added to cart successfully!']);
    }


    public function updatecart(Request $request)
    {
        $cart = Session::get('cart');
        $qtys = $request->qty;
        $i = 0;

        if (!is_array($qtys)) {
            return response()->json(['error' => 'Invalid quantity data']);
        }

        foreach ($cart as $cartKey => $cartItem) {
            if (!isset($qtys[$i]) || !is_numeric($qtys[$i]) || $qtys[$i] < 1) {
                $i++;
                continue;
            }

            $total = 0;
            $cart[$cartKey]["qty"] = (int)$qtys[$i];

            // calculate total
            $addons = isset($cartItem["addons"]) ? $cartItem["addons"] : [];
            if (is_array($addons)) {
                foreach ($addons as $key => $addon) {
                    if (is_array($addon) && array_key_exists('price', $addon)) {
                        $total += (float)$addon["price"];
                    }
                }
            }
            
            $variations = isset($cartItem["variations"]) ? $cartItem["variations"] : [];
            if (is_array($variations)) {
                foreach ($variations as $key => $variation) {
                    if (is_array($variation) && array_key_exists('price', $variation)) {
                        $total += (float)$variation["price"];
                    }
                }
            }

            $total += (float)$cartItem["product_price"];
            $total = $total * (int)$qtys[$i];

            // save total in the cart item
            $cart[$cartKey]["total"] = $total;

            $i++;
        }

        Session::put('cart', $cart);
        Session::save();

        return response()->json(['message' => 'Cart Updated Successfully.']);
    }


    public function cartitemremove($id)
    {
        try {
            if ($id !== null) {
                $cart = Session::get('cart');
                
                // Normalize id to string to match how keys are stored
                $originalId = $id;
                $id = (string)$id;
                
                // If item exists by exact key or by integer product id, remove directly
                if (isset($cart[$id])) {
                    unset($cart[$id]);
                } elseif (isset($cart[(int)$originalId])) {
                    unset($cart[(int)$originalId]);
                } else {
                    // If direct key not found but a numeric index was provided, map index to actual key
                    if (is_array($cart) && is_numeric($originalId)) {
                        $index = (int)$originalId;
                        $keys = array_keys($cart);
                        if (array_key_exists($index, $keys)) {
                            $id = (string)$keys[$index];
                            if (isset($cart[$id])) {
                                unset($cart[$id]);
                            }
                        }
                    }
                }
                
                if (is_array($cart)) {
                    Session::put('cart', $cart);
                    Session::save();
                }
                
                if (!empty($cart)) {
                    \Log::info("Cart item removal attempt completed. Provided: {$originalId}");
                }
                
                return response()->json([
                    'success' => true,
                    'message' => 'Article supprimé avec succès',
                    'cart_count' => is_array($cart) ? count($cart) : 0
                ]);
            } else {
                \Log::error("Invalid ID provided for cart item removal");
                return response()->json([
                    'success' => false,
                    'message' => 'ID invalide'
                ], 400);
            }
        } catch (\Exception $e) {
            \Log::error("Cart item removal failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur s\'est produite'
            ], 500);
        }
    }


    public function clearCart()
    {
        Session::forget('cart');
        Session::save();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }

    public function checkout(Request $request)
    {
        // السماح بالطلبات كضيف افتراضياً أو للمستخدمين المسجلين
        if (!Auth::check()) {
            // إذا لم يكن المستخدم مسجل دخول، نعتبره ضيف
            $request->merge(['type' => 'guest']);
        }
        
        // Validate customer information if form is submitted
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'billing_fname' => 'required|string|max:255',
                'billing_lname' => 'required|string|max:255',
                'billing_email' => 'required|email|max:255',
                'billing_number' => 'required|string|max:20',
                'billing_address' => 'required|string|max:500',
                'billing_city' => 'required|string|max:100',
                'billing_zip' => 'required|string|max:20',
                'billing_country' => 'required|string|max:100',
                'serving_method' => 'required|string|in:pick_up,on_table,home_delivery',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $currentLang = $this->getCurrentLanguage();

        // التأكد من وجود لغة
        if (!$currentLang) {
            // إذا لم توجد لغة افتراضية، استخدم أول لغة متاحة
            $currentLang = Language::first();
            if (!$currentLang) {
                abort(500, 'No language configured');
            }
        }

        // Get basic settings and extended settings
        try {
            $data['bs'] = $currentLang->basic_setting;
            $data['be'] = $currentLang->basic_extended;
            $data['rtl'] = $currentLang->rtl ?? 0;
            $data['currentLang'] = $currentLang;
            $data['activeTheme'] = $currentLang->basic_setting->theme ?? 'multipurpose';
            
            // Get languages and socials
            $data['langs'] = \App\Models\Language::all();
            $data['socials'] = collect([]);
            
            // Get popups and menus
            $data['apopups'] = $currentLang->popups()->where('status', 1)->orderBy('serial_number', 'ASC')->get();
            if (\App\Models\Menu::where('language_id', $currentLang->id)->count() > 0) {
                $data['menus'] = \App\Models\Menu::where('language_id', $currentLang->id)->first()->menus;
            } else {
                $data['menus'] = json_encode([]);
            }
            
            // Calculate cart data
            $data['itemsCount'] = 0;
            $data['cartTotal'] = 0;
            if(!empty($data['cart'])){
                foreach($data['cart'] as $p){
                    if (isset($p['qty']) && is_numeric($p['qty'])) {
                        $data['itemsCount'] += (int)$p['qty'];
                    }
                    if (isset($p['total']) && is_numeric($p['total'])) {
                        $data['cartTotal'] += (float)$p['total'];
                    }
                }
            }
        } catch (\Exception $e) {
            // Set default values if database operations fail
            $data['bs'] = null;
            $data['be'] = null;
            $data['rtl'] = 0;
            $data['currentLang'] = null;
            $data['activeTheme'] = 'multipurpose';
            $data['langs'] = collect([]);
            $data['socials'] = collect([]);
            $data['apopups'] = collect([]);
            $data['menus'] = json_encode([]);
            $data['itemsCount'] = 0;
            $data['cartTotal'] = 0;
        }

        if (Session::has('cart')) {
            $data['cart'] = Session::get('cart');
        } else {
            $data['cart'] = null;
        }
        $data['shippings'] = ShippingCharge::where('language_id', $currentLang->id)->get();
        $data['postcodes'] = PostalCode::where('language_id', $currentLang->id)->orderBy('serial_number', 'ASC')->get();
        $data['ogateways'] = OfflineGateway::where('status', 1)->orderBy('serial_number', 'ASC')->get();
        $data['stripe'] = PaymentGateway::find(14);
        $data['paypal'] = PaymentGateway::find(15);
        $data['paystackData'] = PaymentGateway::whereKeyword('paystack')->first();
        $data['paystack'] = $data['paystackData']->convertAutoData();
        $data['flutterwave'] = PaymentGateway::find(6);
        $data['razorpay'] = PaymentGateway::find(9);
        $data['instamojo'] = PaymentGateway::find(13);
        $data['paytm'] = PaymentGateway::find(11);
        $data['mollie'] = PaymentGateway::find(17);
        $data['mercadopago'] = PaymentGateway::find(19);
        $data['payumoney'] = PaymentGateway::find(18);

        $data['scharges'] = $currentLang->shippings;
        $data['smethods'] = ServingMethod::where('website_menu', 1)->orderBy('serial_number', 'ASC')->get();

        $data['discount'] = session()->has('coupon') && !empty(session()->get('coupon')) ? session()->get('coupon') : 0;

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $disDays = [];
        foreach ($days as $key => $day) {
            $count = TimeFrame::where('day', $day)->count();
            if ($count == 0) {
                if ($day == 'sunday') {
                    $disDays[] = 0;
                } elseif ($day == 'monday') {
                    $disDays[] = 1;
                } elseif ($day == 'tuesday') {
                    $disDays[] = 2;
                } elseif ($day == 'wednesday') {
                    $disDays[] = 3;
                } elseif ($day == 'thursday') {
                    $disDays[] = 4;
                } elseif ($day == 'friday') {
                    $disDays[] = 5;
                } elseif ($day == 'saturday') {
                    $disDays[] = 6;
                }
            }
        }
        $data['disDays'] = $disDays;

        $data['ccodes'] = [["code" => "+7840", "name" => "Abkhazia"], ["code" => "+93", "name" => "Afghanistan"], ["code" => "+355", "name" => "Albania"], ["code" => "+213", "name" => "Algeria"], ["code" => "+1684", "name" => "American Samoa"], ["code" => "+376", "name" => "Andorra"], ["code" => "+244", "name" => "Angola"], ["code" => "+1264", "name" => "Anguilla"], ["code" => "+1268", "name" => "Antigua and Barbuda"], ["code" => "+54", "name" => "Argentina"], ["code" => "+374", "name" => "Armenia"], ["code" => "+297", "name" => "Aruba"], ["code" => "+247", "name" => "Ascension"], ["code" => "+61", "name" => "Australia"], ["code" => "+672", "name" => "Australian External Territories"], ["code" => "+43", "name" => "Austria"], ["code" => "+994", "name" => "Azerbaijan"], ["code" => "+1242", "name" => "Bahamas"], ["code" => "+973", "name" => "Bahrain"], ["code" => "+880", "name" => "Bangladesh"], ["code" => "+1246", "name" => "Barbados"], ["code" => "+1268", "name" => "Barbuda"], ["code" => "+375", "name" => "Belarus"], ["code" => "+32", "name" => "Belgium"], ["code" => "+501", "name" => "Belize"], ["code" => "+229", "name" => "Benin"], ["code" => "+1441", "name" => "Bermuda"], ["code" => "+975", "name" => "Bhutan"], ["code" => "+591", "name" => "Bolivia"], ["code" => "+387", "name" => "Bosnia and Herzegovina"], ["code" => "+267", "name" => "Botswana"], ["code" => "+55", "name" => "Brazil"], ["code" => "+246", "name" => "British Indian Ocean Territory"], ["code" => "+1284", "name" => "British Virgin Islands"], ["code" => "+673", "name" => "Brunei"], ["code" => "+359", "name" => "Bulgaria"], ["code" => "+226", "name" => "Burkina Faso"], ["code" => "+257", "name" => "Burundi"], ["code" => "+855", "name" => "Cambodia"], ["code" => "+237", "name" => "Cameroon"], ["code" => "+1", "name" => "Canada"], ["code" => "+238", "name" => "Cape Verde"], ["code" => "+345", "name" => "Cayman Islands"], ["code" => "+236", "name" => "Central African Republic"], ["code" => "+235", "name" => "Chad"], ["code" => "+56", "name" => "Chile"], ["code" => "+86", "name" => "China"], ["code" => "+61", "name" => "Christmas Island"], ["code" => "+61", "name" => "Cocos-Keeling Islands"], ["code" => "+57", "name" => "Colombia"], ["code" => "+269", "name" => "Comoros"], ["code" => "+242", "name" => "Congo"], ["code" => "+243", "name" => "Congo, Dem. Rep. of (Zaire)"], ["code" => "+682", "name" => "Cook Islands"], ["code" => "+506", "name" => "Costa Rica"], ["code" => "+385", "name" => "Croatia"], ["code" => "+53", "name" => "Cuba"], ["code" => "+599", "name" => "Curacao"], ["code" => "+537", "name" => "Cyprus"], ["code" => "+420", "name" => "Czech Republic"], ["code" => "+45", "name" => "Denmark"], ["code" => "+246", "name" => "Diego Garcia"], ["code" => "+253", "name" => "Djibouti"], ["code" => "+1767", "name" => "Dominica"], ["code" => "+1809", "name" => "Dominican Republic"], ["code" => "+670", "name" => "East Timor"], ["code" => "+56", "name" => "Easter Island"], ["code" => "+593", "name" => "Ecuador"], ["code" => "+20", "name" => "Egypt"], ["code" => "+503", "name" => "El Salvador"], ["code" => "+240", "name" => "Equatorial Guinea"], ["code" => "+291", "name" => "Eritrea"], ["code" => "+372", "name" => "Estonia"], ["code" => "+251", "name" => "Ethiopia"], ["code" => "+500", "name" => "Falkland Islands"], ["code" => "+298", "name" => "Faroe Islands"], ["code" => "+679", "name" => "Fiji"], ["code" => "+358", "name" => "Finland"], ["code" => "+33", "name" => "France"], ["code" => "+596", "name" => "French Antilles"], ["code" => "+594", "name" => "French Guiana"], ["code" => "+689", "name" => "French Polynesia"], ["code" => "+241", "name" => "Gabon"], ["code" => "+220", "name" => "Gambia"], ["code" => "+995", "name" => "Georgia"], ["code" => "+49", "name" => "Germany"], ["code" => "+233", "name" => "Ghana"], ["code" => "+350", "name" => "Gibraltar"], ["code" => "+30", "name" => "Greece"], ["code" => "+299", "name" => "Greenland"], ["code" => "+1473", "name" => "Grenada"], ["code" => "+590", "name" => "Guadeloupe"], ["code" => "+1671", "name" => "Guam"], ["code" => "+502", "name" => "Guatemala"], ["code" => "+224", "name" => "Guinea"], ["code" => "+245", "name" => "Guinea-Bissau"], ["code" => "+595", "name" => "Guyana"], ["code" => "+509", "name" => "Haiti"], ["code" => "+504", "name" => "Honduras"], ["code" => "+852", "name" => "Hong Kong SAR China"], ["code" => "+36", "name" => "Hungary"], ["code" => "+354", "name" => "Iceland"], ["code" => "+91", "name" => "India"], ["code" => "+62", "name" => "Indonesia"], ["code" => "+98", "name" => "Iran"], ["code" => "+964", "name" => "Iraq"], ["code" => "+353", "name" => "Ireland"], ["code" => "+972", "name" => "Israel"], ["code" => "+39", "name" => "Italy"], ["code" => "+225", "name" => "Ivory Coast"], ["code" => "+1876", "name" => "Jamaica"], ["code" => "+81", "name" => "Japan"], ["code" => "+962", "name" => "Jordan"], ["code" => "+77", "name" => "Kazakhstan"], ["code" => "+254", "name" => "Kenya"], ["code" => "+686", "name" => "Kiribati"], ["code" => "+965", "name" => "Kuwait"], ["code" => "+996", "name" => "Kyrgyzstan"], ["code" => "+856", "name" => "Laos"], ["code" => "+371", "name" => "Latvia"], ["code" => "+961", "name" => "Lebanon"], ["code" => "+266", "name" => "Lesotho"], ["code" => "+231", "name" => "Liberia"], ["code" => "+218", "name" => "Libya"], ["code" => "+423", "name" => "Liechtenstein"], ["code" => "+370", "name" => "Lithuania"], ["code" => "+352", "name" => "Luxembourg"], ["code" => "+853", "name" => "Macau SAR China"], ["code" => "+389", "name" => "Macedonia"], ["code" => "+261", "name" => "Madagascar"], ["code" => "+265", "name" => "Malawi"], ["code" => "+60", "name" => "Malaysia"], ["code" => "+960", "name" => "Maldives"], ["code" => "+223", "name" => "Mali"], ["code" => "+356", "name" => "Malta"], ["code" => "+692", "name" => "Marshall Islands"], ["code" => "+596", "name" => "Martinique"], ["code" => "+222", "name" => "Mauritania"], ["code" => "+230", "name" => "Mauritius"], ["code" => "+262", "name" => "Mayotte"], ["code" => "+52", "name" => "Mexico"], ["code" => "+691", "name" => "Micronesia"], ["code" => "+1808", "name" => "Midway Island"], ["code" => "+373", "name" => "Moldova"], ["code" => "+377", "name" => "Monaco"], ["code" => "+976", "name" => "Mongolia"], ["code" => "+382", "name" => "Montenegro"], ["code" => "+1664", "name" => "Montserrat"], ["code" => "+212", "name" => "Morocco"], ["code" => "+95", "name" => "Myanmar"], ["code" => "+264", "name" => "Namibia"], ["code" => "+674", "name" => "Nauru"], ["code" => "+977", "name" => "Nepal"], ["code" => "+31", "name" => "Netherlands"], ["code" => "+599", "name" => "Netherlands Antilles"], ["code" => "+1869", "name" => "Nevis"], ["code" => "+687", "name" => "New Caledonia"], ["code" => "+64", "name" => "New Zealand"], ["code" => "+505", "name" => "Nicaragua"], ["code" => "+227", "name" => "Niger"], ["code" => "+234", "name" => "Nigeria"], ["code" => "+683", "name" => "Niue"], ["code" => "+672", "name" => "Norfolk Island"], ["code" => "+850", "name" => "North Korea"], ["code" => "+1670", "name" => "Northern Mariana Islands"], ["code" => "+47", "name" => "Norway"], ["code" => "+968", "name" => "Oman"], ["code" => "+92", "name" => "Pakistan"], ["code" => "+680", "name" => "Palau"], ["code" => "+970", "name" => "Palestinian Territory"], ["code" => "+507", "name" => "Panama"], ["code" => "+675", "name" => "Papua New Guinea"], ["code" => "+595", "name" => "Paraguay"], ["code" => "+51", "name" => "Peru"], ["code" => "+63", "name" => "Philippines"], ["code" => "+48", "name" => "Poland"], ["code" => "+351", "name" => "Portugal"], ["code" => "+1787", "name" => "Puerto Rico"], ["code" => "+974", "name" => "Qatar"], ["code" => "+262", "name" => "Reunion"], ["code" => "+40", "name" => "Romania"], ["code" => "+7", "name" => "Russia"], ["code" => "+250", "name" => "Rwanda"], ["code" => "+685", "name" => "Samoa"], ["code" => "+378", "name" => "San Marino"], ["code" => "+966", "name" => "Saudi Arabia"], ["code" => "+221", "name" => "Senegal"], ["code" => "+381", "name" => "Serbia"], ["code" => "+248", "name" => "Seychelles"], ["code" => "+232", "name" => "Sierra Leone"], ["code" => "+65", "name" => "Singapore"], ["code" => "+421", "name" => "Slovakia"], ["code" => "+386", "name" => "Slovenia"], ["code" => "+677", "name" => "Solomon Islands"], ["code" => "+27", "name" => "South Africa"], ["code" => "+500", "name" => "South Georgia and the South Sandwich Islands"], ["code" => "+82", "name" => "South Korea"], ["code" => "+34", "name" => "Spain"], ["code" => "+94", "name" => "Sri Lanka"], ["code" => "+249", "name" => "Sudan"], ["code" => "+597", "name" => "Suriname"], ["code" => "+268", "name" => "Swaziland"], ["code" => "+46", "name" => "Sweden"], ["code" => "+41", "name" => "Switzerland"], ["code" => "+963", "name" => "Syria"], ["code" => "+886", "name" => "Taiwan"], ["code" => "+992", "name" => "Tajikistan"], ["code" => "+255", "name" => "Tanzania"], ["code" => "+66", "name" => "Thailand"], ["code" => "+670", "name" => "Timor Leste"], ["code" => "+228", "name" => "Togo"], ["code" => "+690", "name" => "Tokelau"], ["code" => "+676", "name" => "Tonga"], ["code" => "+1868", "name" => "Trinidad and Tobago"], ["code" => "+216", "name" => "Tunisia"], ["code" => "+90", "name" => "Turkey"], ["code" => "+993", "name" => "Turkmenistan"], ["code" => "+1649", "name" => "Turks and Caicos Islands"], ["code" => "+688", "name" => "Tuvalu"], ["code" => "+1340", "name" => "U.S. Virgin Islands"], ["code" => "+256", "name" => "Uganda"], ["code" => "+380", "name" => "Ukraine"], ["code" => "+971", "name" => "United Arab Emirates"], ["code" => "+44", "name" => "United Kingdom"], ["code" => "+1", "name" => "United States"], ["code" => "+598", "name" => "Uruguay"], ["code" => "+998", "name" => "Uzbekistan"], ["code" => "+678", "name" => "Vanuatu"], ["code" => "+58", "name" => "Venezuela"], ["code" => "+84", "name" => "Vietnam"], ["code" => "+1808", "name" => "Wake Island"], ["code" => "+681", "name" => "Wallis and Futuna"], ["code" => "+967", "name" => "Yemen"], ["code" => "+260", "name" => "Zambia"], ["code" => "+255", "name" => "Zanzibar"], ["code" => "+263", "name" => "Zimbabwe"]];

        return view('front.multipurpose.product.checkout', $data);
    }


    public function Prdouctcheckout(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        if ($request->qty) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }


        $cart = Session::get('cart');
        $id = $product->id;
        // if cart is empty then this the first product
        if (!($cart)) {
            if ($product->stock <  $qty) {
                Session::flash('error', 'Out of stock');
                return back();
            }
            $cart = [
                $id => [
                    "name" => $product->title,
                    "qty" => $qty,
                    "price" => $product->current_price,
                    "photo" => $product->feature_image
                ]
            ];

            Session::put('cart', $cart);

            return redirect(route('front.checkout'));
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            if ($product->stock < $cart[$id]['qty'] + $qty) {
                Session::flash('error', 'Out of stock');
                return back();
            }
            $qt = $cart[$id]['qty'];
            $cart[$id]['qty'] = $qt + $qty;

            Session::put('cart', $cart);

            return redirect(route('front.checkout'));
        }

        if ($product->stock <  $qty) {
            Session::flash('error', 'Out of stock');
            return back();
        }


        $cart[$id] = [
            "name" => $product->title,
            "qty" => $qty,
            "price" => $product->current_price,
            "photo" => $product->feature_image
        ];
        Session::put('cart', $cart);

        return redirect(route('front.checkout'));
    }


    public function coupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon);
        $be = BasicExtended::first();

        if ($coupon->count() == 0) {
            return response()->json(['status' => 'error', 'message' => "Coupon is not valid"]);
        } else {
            $coupon = $coupon->first();
            if (cartTotal() < $coupon->minimum_spend) {
                return response()->json(['status' => 'error', 'message' => "Cart Total must be minimum " . $coupon->minimum_spend . " " . $be->base_currency_text]);
            }
            $start = Carbon::parse($coupon->start_date);
            $end = Carbon::parse($coupon->end_date);
            $today = Carbon::now();
            // return response()->json($end->lessThan($today));

            // if coupon is active
            if ($today->greaterThanOrEqualTo($start) && $today->lessThan($end)) {
                $cartTotal = cartTotal();
                $value = $coupon->value;
                $type = $coupon->type;

                if ($type == 'fixed') {
                    if ($value > cartTotal()) {
                        return response()->json(['status' => 'error', 'message' => "Coupon discount is greater than cart total"]);
                    }
                    $couponAmount = $value;
                } else {
                    $couponAmount = ($cartTotal * $value) / 100;
                }
                session()->put('coupon', round($couponAmount, 2));

                return response()->json(['status' => 'success', 'message' => "Coupon applied successfully"]);
            } else {
                return response()->json(['status' => 'error', 'message' => "Coupon is not valid"]);
            }
        }
    }

    public function timeframes(Request $request)
    {
        $date = Carbon::parse($request->date);
        $day = strtolower($date->format('l'));

        $timeframes = TimeFrame::where('day', $day)->get();

        if (count($timeframes) > 0) {
            // if (condition) {
            //     # code...
            // }
            return response()->json(['status' => 'success', 'timeframes' => $timeframes]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No delivery time frame is available on ' . ucfirst($day)]);
        }
    }

    public function addToCartCustom(Request $request)
    {
        try {
            $data = $request->all();
            
            // Validate required fields
            if (!isset($data['product_id']) || !isset($data['product_name']) || !isset($data['product_price'])) {
                return response()->json(['success' => false, 'message' => 'Missing required product information']);
            }
            
            // Get or create cart
            $cart = Session::get('cart', []);
            
            // Create unique key for this customized product
            $cartKey = 'custom_' . $data['product_id'] . '_' . $data['product_type'] . '_' . time();
            
            // Calculate addons total
            $addonsTotal = 0;
            $addonsArray = [];
            if (isset($data['addons']) && is_array($data['addons'])) {
                foreach ($data['addons'] as $addon) {
                    if (isset($addon['price'])) {
                        $addonsTotal += (float)$addon['price'];
                        $addonsArray[] = $addon;
                    }
                }
            }
            
            // Create cart item
            $cartItem = [
                'id' => $data['product_id'],
                'name' => $data['product_name'],
                'product_price' => (float)$data['product_price'],
                'qty' => 1,
                'total' => (float)$data['total_price'],
                'product_type' => $data['product_type'] ?? 'seul',
                'addons' => $addonsArray,
                'addons_total' => $addonsTotal,
                'customized' => true
            ];
            
            // Add to cart
            $cart[$cartKey] = $cartItem;
            Session::put('cart', $cart);
            
            \Log::info('Custom product added to cart', [
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'total_price' => $data['total_price'],
                'addons_count' => count($addonsArray),
                'cart_key' => $cartKey,
                'cart_item' => $cartItem
            ]);
            
            // Debug: Log current cart
            \Log::info('Current cart after adding', ['cart' => Session::get('cart')]);
            
            return response()->json([
                'success' => true, 
                'message' => 'Product added to cart successfully',
                'cart_count' => count($cart),
                'redirect' => url('/cart')
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error adding custom product to cart: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error adding product to cart']);
        }
    }
}
