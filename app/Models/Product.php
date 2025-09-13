<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

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
        'is_special',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Pcategory::class, 'category_id', 'id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(PsubCategory::class, 'subcategory_id', 'id');
    }

    public function product_reviews(): HasMany
    {
        return $this->hasMany('App\Models\ProductReview');
    }

    public function product_images(): HasMany
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo('App\Models\Language');
    }

    /**
     * Get price based on type (seul or menu)
     */
    public function getPriceByType($type = 'seul'): float
    {
        if ($type === 'menu' && $this->price_menu) {
            return (float) $this->price_menu;
        }
        
        if ($type === 'seul' && $this->price_seul) {
            return (float) $this->price_seul;
        }
        
        // Fallback to current_price if specific prices not set
        return (float) $this->current_price;
    }

    /**
     * Get product by type
     */
    public static function getByType($productType): ?self
    {
        return self::where('product_type', $productType)->first();
    }

}
