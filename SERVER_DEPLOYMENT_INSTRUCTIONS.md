# تعليمات نشر التحديثات على الخادم

## 🔧 حل مشكلة Git

### المشكلة:
```
error: Your local changes to the following files would be overwritten by merge:
        .gitignore
Please commit your changes or stash them before you merge.
```

### الحل:

#### الخيار 1: حفظ التغييرات المحلية
```bash
# حفظ التغييرات المحلية
git stash

# سحب التحديثات
git pull origin main

# استعادة التغييرات المحلية
git stash pop
```

#### الخيار 2: تجاهل التغييرات المحلية
```bash
# تجاهل التغييرات المحلية في .gitignore
git checkout -- .gitignore

# سحب التحديثات
git pull origin main
```

#### الخيار 3: إعادة تعيين كاملة
```bash
# إعادة تعيين كاملة (تحذير: سيحذف جميع التغييرات المحلية)
git reset --hard HEAD
git pull origin main
```

## 🗄️ تحديث قاعدة البيانات

### الخطوة 1: تشغيل سكريبت تحديث قاعدة البيانات
```bash
# تشغيل سكريبت إضافة منتجات Nos Box
php update_database_server.php
```

### الخطوة 2: التحقق من النتائج
يجب أن ترى رسائل مثل:
```
=== UPDATING DATABASE ON SERVER ===

=== LANGUAGE ===
Language: Français (ID: 176)

=== NOS BOX CATEGORY ===
Category: Nos Box (ID: 31)

=== EXISTING PRODUCTS ===
Current products in Nos Box: 0

Added product: TENDERS - €5/5pièces, €9.5/10pièces (ID: 154)
Added product: NUGGETS - €4/5pièces, €7.5/10pièces (ID: 155)
...

=== UPDATE SUMMARY ===
✅ Products added: 8
⏭️ Products skipped: 0
📊 Total products in Nos Box: 8
```

## 🔄 تحديث الملفات

### الخطوة 1: التأكد من تحديث الملفات المهمة
```bash
# التحقق من وجود الملفات المحدثة
ls -la app/Http/Controllers/Front/ProductController.php
ls -la resources/views/front/multipurpose/product/nos_box.blade.php
```

### الخطوة 2: مسح الكاش
```bash
# مسح كاش Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## 🧪 اختبار الوظائف

### الخطوة 1: اختبار الصفحة
1. افتح الموقع: `https://kingkebablepouzin.fr/menu/nos-box`
2. تأكد من ظهور المنتجات الجديدة
3. اختبر زر الطلب

### الخطوة 2: اختبار قاعدة البيانات
```bash
# إنشاء سكريبت اختبار سريع
cat > test_nos_box.php << 'EOF'
<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Pcategory;

$nosBoxCategory = Pcategory::where('name', 'Nos Box')->first();
if ($nosBoxCategory) {
    $products = Product::where('category_id', $nosBoxCategory->id)->get();
    echo "Products in Nos Box: " . $products->count() . "\n";
    foreach ($products as $product) {
        echo "- {$product->title}: €{$product->current_price}\n";
    }
} else {
    echo "Nos Box category not found!\n";
}
EOF

# تشغيل الاختبار
php test_nos_box.php
```

## 🚨 استكشاف الأخطاء

### إذا لم تظهر المنتجات:
1. تحقق من وجود فئة "Nos Box" في قاعدة البيانات
2. تحقق من أن المنتجات تم إضافتها باللغة الصحيحة
3. تحقق من أن `status = 1` للمنتجات

### إذا لم يعمل زر الطلب:
1. تحقق من وجود ملف `cart.js`
2. تحقق من console المتصفح للأخطاء
3. تأكد من أن متغير `pprice` محدد

### إذا لم تعمل الصفحة:
1. تحقق من وجود الملفات المحدثة
2. امسح كاش Laravel
3. تحقق من الأخطاء في logs

## 📋 قائمة التحقق النهائية

- [ ] تم حل مشكلة Git
- [ ] تم سحب التحديثات من GitHub
- [ ] تم تشغيل سكريبت تحديث قاعدة البيانات
- [ ] تم مسح كاش Laravel
- [ ] تم اختبار الصفحة
- [ ] تم اختبار زر الطلب
- [ ] تم التحقق من ظهور المنتجات

## 🎯 النتيجة المتوقعة

بعد اتباع هذه التعليمات، يجب أن تعمل صفحة Nos Box بشكل كامل مع:
- ✅ 8 منتجات جديدة معروضة
- ✅ أسعار لـ 5 و 10 قطع
- ✅ زر طلب يعمل بشكل صحيح
- ✅ إضافة المنتجات للسلة
- ✅ رسائل نجاح تظهر

---

**ملاحظة:** إذا واجهت أي مشاكل، يمكنك الرجوع إلى ملف `NOS_BOX_UPDATE_README.md` للحصول على تفاصيل أكثر. 