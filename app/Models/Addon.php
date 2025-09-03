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
        'sort_order',
        'product_types' // أنواع المنتجات التي تنطبق عليها هذه الإضافة
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'product_types' => 'array'
    ];

    // فئات الإضافات المتاحة مع التصنيفات الجديدة
    const CATEGORIES = [
        'sauces' => 'Sauces',
        'vegetables' => 'Vegetables',
        'drinks' => 'Drinks',
        'meat' => 'Meat Choices',
        'extras' => 'Extra Items'
    ];

    // أنواع المنتجات المتاحة
    const PRODUCT_TYPES = [
        'sandwiches' => 'Sandwiches',
        'tacos' => 'Tacos',
        'galettes' => 'Galettes',
        'burgers' => 'Burgers',
        'panini' => 'Panini',
        'assiettes' => 'Assiettes',
        'menus_enfant' => 'Menus Enfant',
        'salade' => 'Salade',
        'nos_box' => 'Nos Box'
    ];

    // قواعد الإضافات حسب نوع المنتج
    const PRODUCT_ADDON_RULES = [
        'sandwiches' => [
            'required' => ['vegetables', 'sauces'],
            'optional' => ['drinks'],
            'excluded' => ['meat']
        ],
        'tacos' => [
            'required' => ['meat', 'vegetables', 'sauces'],
            'optional' => ['drinks'],
            'excluded' => []
        ],
        'galettes' => [
            'required' => ['meat', 'vegetables', 'sauces'],
            'optional' => ['drinks'],
            'excluded' => []
        ],
        'burgers' => [
            'required' => ['vegetables', 'sauces'],
            'optional' => ['drinks'],
            'excluded' => ['meat']
        ],
        'panini' => [
            'required' => ['vegetables', 'sauces'],
            'optional' => ['drinks'],
            'excluded' => ['meat']
        ],
        'assiettes' => [
            'required' => ['sauces'],
            'optional' => [],
            'excluded' => ['meat', 'vegetables', 'drinks']
        ],
        'menus_enfant' => [
            'required' => ['vegetables', 'sauces', 'drinks'],
            'optional' => [],
            'excluded' => ['meat']
        ],
        'salade' => [
            'required' => ['sauces'],
            'optional' => ['vegetables'],
            'excluded' => ['meat', 'drinks']
        ],
        'nos_box' => [
            'required' => ['vegetables', 'sauces', 'drinks'],
            'optional' => [],
            'excluded' => ['meat']
        ]
    ];

    // الحصول على الإضافات النشطة حسب الفئة
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category)->where('is_active', true);
    }

    // الحصول على الإضافات النشطة حسب نوع المنتج
    public function scopeByProductType($query, $productType)
    {
        return $query->where('is_active', true)
                    ->where(function($q) use ($productType) {
                        $q->whereNull('product_types')
                          ->orWhereJsonContains('product_types', $productType);
                    });
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

    // الحصول على الإضافات حسب نوع المنتج
    public static function getAddonsByProductType($productType)
    {
        $rules = self::PRODUCT_ADDON_RULES[$productType] ?? [];
        $addons = self::active()->get();
        $grouped = [];
        
        foreach (self::CATEGORIES as $category => $label) {
            // تجاهل الفئات المستبعدة
            if (in_array($category, $rules['excluded'] ?? [])) {
                continue;
            }
            
            $categoryAddons = $addons->where('category', $category);
            
            // تصفية حسب نوع المنتج
            $categoryAddons = $categoryAddons->filter(function($addon) use ($productType) {
                return empty($addon->product_types) || in_array($productType, $addon->product_types);
            });
            
            if ($categoryAddons->count() > 0) {
                $grouped[$category] = [
                    'label' => $label,
                    'items' => $categoryAddons,
                    'required' => in_array($category, $rules['required'] ?? []),
                    'optional' => in_array($category, $rules['optional'] ?? [])
                ];
            }
        }
        
        return $grouped;
    }

    // التحقق من أن الإضافة تنطبق على نوع المنتج
    public function appliesToProductType($productType)
    {
        return empty($this->product_types) || in_array($productType, $this->product_types);
    }

    // الحصول على فئة الإضافة مع الترجمة
    public function getCategoryLabelAttribute()
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
