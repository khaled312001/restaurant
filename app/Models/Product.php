<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'language_id',
        'category_id',
        'subcategory_id',
        'feature_image',
        'summary',
        'description',
        'variations',
        'addons',
        'current_price',
        'previous_price',
        'price_seul',
        'price_menu',
        'product_type',
        'rating',
        'status',
        'is_feature',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Pcategory', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(PsubCategory::class, 'id', 'subcategory_id');
    }

    public function product_reviews()
    {
        return $this->hasMany('App\Models\ProductReview');
    }

    public function product_images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    /**
     * Get price based on type (seul or menu)
     */
    public function getPriceByType($type = 'seul')
    {
        if ($type === 'menu' && $this->price_menu) {
            return $this->price_menu;
        }
        
        if ($type === 'seul' && $this->price_seul) {
            return $this->price_seul;
        }
        
        // Fallback to current_price if specific prices not set
        return $this->current_price;
    }

    /**
     * Get product by type
     */
    public static function getByType($productType)
    {
        return self::where('product_type', $productType)->first();
    }

}
