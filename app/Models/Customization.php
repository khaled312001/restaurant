<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_item_id',
        'order_item_id',
        'product_name',
        'product_type',
        'price',
        'quantity',
        'meat_choice',
        'vegetables',
        'drink_choice',
        'sauces'
    ];

    protected $casts = [
        'vegetables' => 'array',
        'sauces' => 'array',
        'price' => 'decimal:2'
    ];

    // Relationships
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    // Helper methods
    public function getVegetablesTextAttribute()
    {
        if (!$this->vegetables) return '';
        
        $vegNames = [
            'tomatoes' => 'Tomates',
            'salad' => 'Salade',
            'onions' => 'Oignons',
            'no-vegetables' => 'Sans légumes'
        ];
        
        return collect($this->vegetables)->map(function($veg) use ($vegNames) {
            return $vegNames[$veg] ?? ucfirst($veg);
        })->join(', ');
    }

    public function getSaucesTextAttribute()
    {
        if (!$this->sauces) return '';
        
        $sauceNames = [
            'white-sauce' => 'Sauce Blanche',
            'mayonnaise' => 'Mayonnaise',
            'ketchup' => 'Ketchup',
            'harissa' => 'Harissa',
            'mustard' => 'Moutarde',
            'bbq' => 'BBQ',
            'curry' => 'Curry',
            'algerienne' => 'Algérienne',
            'samourai' => 'Samouraï',
            'andalouse' => 'Andalouse'
        ];
        
        return collect($this->sauces)->map(function($sauce) use ($sauceNames) {
            return $sauceNames[$sauce] ?? ucfirst($sauce);
        })->join(', ');
    }

    public function getDrinkTextAttribute()
    {
        if (!$this->drink_choice) return '';
        
        $drinkNames = [
            'coca-cola' => 'Coca-Cola',
            'coca-cherry' => 'Coca Cherry',
            'coca-zero' => 'Coca Zero',
            'oasis-tropical' => 'Oasis Tropical',
            'oasis-apple' => 'Oasis Apple',
            'ice-tea' => 'Ice Tea',
            'fuze-tea' => 'Fuze Tea',
            'sprite' => 'Sprite',
            'fanta-orange' => 'Fanta Orange',
            'tropico' => 'Tropico',
            'orangina' => 'Orangina'
        ];
        
        return $drinkNames[$this->drink_choice] ?? ucfirst($this->drink_choice);
    }
}
