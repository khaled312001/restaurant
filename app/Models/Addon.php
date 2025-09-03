<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'name_fr',
        'category',
        'price',
        'icon',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // فئات الإضافات المتاحة
    const CATEGORIES = [
        'sauces' => 'Sauces',
        'vegetables' => 'Vegetables',
        'drinks' => 'Drinks',
        'meat' => 'Meat Choices',
        'extras' => 'Extra Items'
    ];

    // الحصول على الإضافات النشطة حسب الفئة
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category)->where('is_active', true);
    }

    // الحصول على الإضافات النشطة مرتبة
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // الحصول على اسم الإضافة باللغة المطلوبة
    public function getLocalizedName($locale = 'en')
    {
        switch ($locale) {
            case 'ar':
                return $this->name_ar ?: $this->name;
            case 'fr':
                return $this->name_fr ?: $this->name;
            default:
                return $this->name;
        }
    }

    // الحصول على جميع الإضافات مقسمة حسب الفئة
    public static function getAddonsByCategory()
    {
        $addons = self::active()->get();
        $grouped = [];
        
        foreach (self::CATEGORIES as $category => $label) {
            $grouped[$category] = [
                'label' => $label,
                'items' => $addons->where('category', $category)
            ];
        }
        
        return $grouped;
    }
}
