<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        "product_order_id",
        "product_id",
        "user_id",
        "title",
        "sku",
        "variations",
        "addons",
        "customizations",
        "variations_price",
        "addons_price",
        "product_price",
        "total",
        "image",

       ];

    public function order()
    {
        return $this->belongsTo(ProductOrder::class, 'product_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customization()
    {
        return $this->hasOne(Customization::class, 'order_item_id');
    }
}
