<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_item_id', 'order_item_id', 'product_name', 'product_type', 'price', 'quantity',
        'meat_choice', 'vegetables', 'drink_choice', 'sauces', 'addons'
    ];

    protected $casts = [
        'vegetables' => 'array',
        'sauces' => 'array',
        'addons' => 'array',
        'price' => 'decimal:2'
    ];

    // العلاقة مع جدول الإضافات
    public function addonItems()
    {
        return $this->belongsToMany(Addon::class, 'customization_addon', 'customization_id', 'addon_id')
                    ->withPivot('quantity', 'price');
    }

    // الحصول على جميع الإضافات كمجموعة واحدة
    public function getAllAddons()
    {
        $allAddons = [];
        
        // إضافة اللحم المختار
        if ($this->meat_choice) {
            $allAddons[] = [
                'name' => $this->meat_choice,
                'category' => 'meat',
                'price' => 0.00,
                'type' => 'meat_choice'
            ];
        }
        
        // إضافة الخضروات
        if ($this->vegetables && is_array($this->vegetables)) {
            foreach ($this->vegetables as $vegetable) {
                $allAddons[] = [
                    'name' => $vegetable,
                    'category' => 'vegetables',
                    'price' => 0.00,
                    'type' => 'vegetable'
                ];
            }
        }
        
        // إضافة المشروب
        if ($this->drink_choice) {
            $allAddons[] = [
                'name' => $this->drink_choice,
                'category' => 'drinks',
                'price' => 0.00,
                'type' => 'drink'
            ];
        }
        
        // إضافة الصلصات
        if ($this->sauces && is_array($this->sauces)) {
            foreach ($this->sauces as $sauce) {
                $allAddons[] = [
                    'name' => $sauce,
                    'category' => 'sauces',
                    'price' => 0.00,
                    'type' => 'sauce'
                ];
            }
        }
        
        // إضافة الإضافات الإضافية
        if ($this->addons && is_array($this->addons)) {
            foreach ($this->addons as $addon) {
                $allAddons[] = [
                    'name' => $addon['name'] ?? $addon,
                    'category' => 'extras',
                    'price' => $addon['price'] ?? 0.00,
                    'type' => 'extra'
                ];
            }
        }
        
        return $allAddons;
    }

    // الحصول على نص الإضافات للعرض
    public function getAddonsText($locale = 'en')
    {
        $addons = $this->getAllAddons();
        $texts = [];
        
        foreach ($addons as $addon) {
            $texts[] = $addon['name'];
        }
        
        return implode(', ', $texts);
    }

    // الحصول على السعر الإجمالي للإضافات
    public function getAddonsTotalPrice()
    {
        $addons = $this->getAllAddons();
        $total = 0.00;
        
        foreach ($addons as $addon) {
            $total += $addon['price'];
        }
        
        return $total;
    }

    // الحصول على الإضافات مقسمة حسب الفئة
    public function getAddonsByCategory()
    {
        $addons = $this->getAllAddons();
        $grouped = [];
        
        foreach ($addons as $addon) {
            $category = $addon['category'];
            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }
            $grouped[$category][] = $addon;
        }
        
        return $grouped;
    }

    // Helper methods for backward compatibility
    public function getMeatChoiceText($locale = 'en')
    {
        return $this->meat_choice ?: '';
    }

    public function getVegetablesText($locale = 'en')
    {
        if (!$this->vegetables || !is_array($this->vegetables)) {
            return '';
        }
        return implode(', ', $this->vegetables);
    }

    public function getDrinkChoiceText($locale = 'en')
    {
        return $this->drink_choice ?: '';
    }

    public function getSaucesText($locale = 'en')
    {
        if (!$this->sauces || !is_array($this->sauces)) {
            return '';
        }
        return implode(', ', $this->sauces);
    }

    // Relationships
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    // Accessor methods for the view
    public function getVegetablesTextAttribute()
    {
        return $this->getVegetablesText();
    }

    public function getDrinkTextAttribute()
    {
        return $this->getDrinkChoiceText();
    }

    public function getSaucesTextAttribute()
    {
        return $this->getSaucesText();
    }
}
