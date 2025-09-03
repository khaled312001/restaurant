# نظام الإضافات الجديد - King Kebab Restaurant

## نظرة عامة
تم إنشاء نظام شامل للإضافات يتيح تخزين وإدارة جميع أنواع الإضافات المستخدمة في المطعم في قاعدة بيانات واحدة، مع عرضها في modal التخصيص عند الضغط على "Commander".

## الميزات الرئيسية

### 1. قاعدة بيانات موحدة للإضافات
- **جدول `addons`**: يحتوي على جميع الإضافات مقسمة حسب الفئات
- **فئات الإضافات**:
  - `meat`: اختيارات اللحم (Kebab, Steak, Chicken, إلخ)
  - `vegetables`: الخضروات (Tomatoes, Lettuce, Onions, إلخ)
  - `drinks`: المشروبات (Coca Cola, Fanta, Sprite, إلخ)
  - `sauces`: الصلصات (White Sauce, Mayonnaise, Ketchup, إلخ)
  - `extras`: إضافات إضافية (Extra Cheese, French Fries, إلخ)

### 2. نظام التخصيص الديناميكي
- **Modal التخصيص**: يعرض الإضافات تلقائياً حسب الفئات
- **اختيار متعدد**: للخضروات والصلصات والإضافات
- **اختيار واحد**: للحم والمشروب
- **أسعار ديناميكية**: عرض الأسعار الإضافية للإضافات المدفوعة

### 3. تخزين البيانات
- **عمود `addons`**: في جدول `customizations` لتخزين جميع الإضافات
- **عمود `addons`**: في جدول `order_items` لتخزين الإضافات في الطلبات
- **تنسيق JSON**: لتخزين الإضافات مع الأسعار والفئات

## كيفية الاستخدام

### 1. إضافة منتج إلى الكارت
1. انتقل إلى صفحة المنتج (مثل `/menu/kebab-galette`)
2. اضغط على زر "Commander" (Seul أو Menu)
3. اختر الإضافات المطلوبة من modal التخصيص:
   - **اللحم**: اختر نوع واحد
   - **الخضروات**: اختر ما تريد (يمكن اختيار عدة أنواع)
   - **المشروب**: اختر مشروب واحد (للمنو)
   - **الصلصات**: اختر ما تريد (يمكن اختيار عدة أنواع)
   - **إضافات**: اختر ما تريد (مع الأسعار الإضافية)

### 2. عرض الإضافات في الكارت
- **صفحة الكارت**: تعرض جميع الإضافات مقسمة حسب الفئات
- **صفحة الشيك أوت**: تعرض الإضافات بنفس الطريقة
- **ألوان مميزة**: كل فئة لها لون مختلف للتمييز

### 3. إدارة الإضافات (للمدير)
- **لوحة الإدارة**: `/admin/addons`
- **إضافة إضافات جديدة**: مع تحديد الفئة والسعر
- **تعديل الإضافات**: تحديث الأسماء والأسعار
- **تفعيل/إلغاء**: إمكانية إيقاف إضافات معينة

## الملفات المعدلة

### 1. قاعدة البيانات
- `database/migrations/2025_09_03_194128_create_addons_table.php`
- `database/migrations/2025_09_03_195758_add_addons_to_customizations_table.php`
- `database/migrations/2025_09_03_200024_add_addons_to_order_items_table.php`

### 2. النماذج
- `app/Models/Addon.php`: نموذج الإضافات
- `app/Models/Customization.php`: نموذج التخصيص (محدث)

### 3. المتحكمات
- `app/Http/Controllers/Admin/AddonController.php`: إدارة الإضافات
- `app/Http/Controllers/Front/ProductController.php`: تحديث ليرسل الإضافات

### 4. الواجهات
- `resources/views/front/multipurpose/product/customization_modal.blade.php`: modal التخصيص الديناميكي
- `resources/views/front/multipurpose/product/cart.blade.php`: عرض الإضافات في الكارت
- `resources/views/front/multipurpose/product/checkout.blade.php`: عرض الإضافات في الشيك أوت

### 5. البيانات
- `database/seeds/AddonSeeder.php`: إضافة الإضافات الأساسية
- `database/seeds/DatabaseSeeder.php`: تحديث ليتضمن AddonSeeder

## الإضافات المتاحة حالياً

### اللحوم (Meat)
- Kebab, Steak, Chicken, Jacket, Cordon Bleu, Tenders, Nuggets

### الخضروات (Vegetables)
- Tomatoes, Lettuce, Onions, Cucumber, Carrots, No Vegetables

### المشروبات (Drinks)
- Coca Cola, Fanta, Sprite, Water, No Drink

### الصلصات (Sauces)
- White Sauce, Mayonnaise, Ketchup, Harissa, Mustard, BBQ, Curry, Algerian, Samurai, Andalusian

### الإضافات (Extras)
- Extra Cheese (+1.00€), French Fries (+3.50€), Extra Meat (+2.00€)

## المزايا

1. **مرونة عالية**: إمكانية إضافة إضافات جديدة بسهولة
2. **إدارة مركزية**: جميع الإضافات في مكان واحد
3. **أسعار ديناميكية**: إمكانية تحديد أسعار مختلفة لكل إضافة
4. **دعم متعدد اللغات**: أسماء الإضافات بالعربية والفرنسية والإنجليزية
5. **ترتيب قابل للتخصيص**: إمكانية ترتيب الإضافات حسب الرغبة
6. **تفعيل/إلغاء**: إمكانية إيقاف إضافات معينة

## الخطوات التالية

1. **اختبار النظام**: تأكد من عمل modal التخصيص
2. **إضافة إضافات جديدة**: حسب احتياجات المطعم
3. **تخصيص الألوان**: تعديل ألوان الفئات حسب التصميم
4. **إضافة أيقونات**: تحسين المظهر العام للإضافات

## ملاحظات تقنية

- النظام يعتمد على Laravel 8+
- يستخدم JSON columns لتخزين البيانات المركبة
- يدعم الترجمة متعددة اللغات
- متوافق مع النظام الحالي للكارت والطلبات 