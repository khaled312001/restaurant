# تعديلات صفحات القوائم - King Kebab Restaurant

## التعديلات المطبقة

### 1. إضافة عمود "Commander" (أمر)
- تم إضافة عمود رابع في جميع الجداول يحتوي على أزرار الشراء
- العمود الجديد يسمى "Commander" ويحتوي على أزرار "Commander" لكل منتج

### 2. إزالة الروابط من عناصر القائمة
- تم إزالة جميع الروابط `<a href="...">` من عناصر القائمة
- العناصر لم تعد قابلة للنقر للانتقال لصفحة التفاصيل
- تم تحويل العناصر من `<a>` إلى `<div>` عادية

### 3. إضافة خيارات "Seul" و "Menu"
- تم إضافة قوائم منسدلة (select) لكل منتج يحتوي على خيارين:
  - **Seul**: السعر الأساسي للمنتج
  - **Menu**: السعر مع الإضافات (عادة +3.00€)
- المستخدم يجب أن يختار النوع قبل إضافة المنتج للكارت

### 4. أزرار الشراء المباشر
- تم إضافة أزرار "Commander" لكل منتج
- الأزرار تستدعي دالة `addToCartWithType()` مع النوع المحدد
- للمنتجات التي ليس لها خيارات Seul/Menu، تستخدم دالة `addToCartSimple()`

## الصفحات المعدلة

### 1. صفحة Kebab & Galette (`kebab_galette.blade.php`)
- **المنتجات الرئيسية**: KEBAB, MAXI KEBAB, GALETTE, MAXI GALETTE
- **المكملات**: PETITE FRITE, GRANDE FRITE, PETITE VIANDE, GRANDE VIANDE
- **الألوان**: البرتقالي (#f39c12)

### 2. صفحة Burgers (`burgers.blade.php`)
- **المنتجات الرئيسية**: CHEESE BURGER, DOUBLE CHEESE BURGER, CHICKEN, CROUSTY GOURMAND, VEGGIE BURGER, LE BIG CHÈVRE
- **الألوان**: البرتقالي الداكن (#e67e22)

### 3. صفحة Tacos (`tacos.blade.php`)
- **المنتجات الرئيسية**: TACOS (1 VIANDE), TACOS MIXTE, MEGA TACOS, MEGA TACOS MIXTE
- **الألوان**: الأخضر (#27ae60)

### 4. صفحة Americain & Kofte (`americain_kofte.blade.php`)
- **المنتجات الرئيسية**: AMERICAIN, KOFTE
- **المكملات**: PETITE FRITE, GRANDE FRITE, PETITE VIANDE, GRANDE VIANDE
- **الألوان**: الأحمر (#e74c3c)

### 5. صفحة Panini (`panini.blade.php`)
- **المنتجات الرئيسية**: PANINI 3 FROMAGES, PANINI VIANDE CHOIX, PANINI KEBAB, PANINI STEAK
- **الألوان**: البرتقالي (#f39c12)

### 6. صفحة Assiettes (`assiettes.blade.php`)
- **المنتجات الرئيسية**: ASSIETTE KEBAB, ASSIETTE GRILLÉE
- **المكملات**: PETITE FRITE, GRANDE FRITE, PETITE VIANDE, GRANDE VIANDE
- **الألوان**: الأزرق (#3498db)

### 7. صفحة Menus Enfant (`menus_enfant.blade.php`)
- **المنتجات الرئيسية**: MENU ENFANT, BURGER + FRITES, NUGGETS + FRITES, VIANDE KEBAB + FRITES
- **الحلويات**: COMPOTE + CAPRISUN + JOUET, GLACE VANILLE
- **الألوان**: الوردي (#e91e63)

### 8. صفحة Salade (`salade.blade.php`)
- **المنتجات الرئيسية**: SALADE FALAFEL, SALADE FETA, SALADE THON, SALADE TENDERS
- **الصلصات**: SAUCE VINAIGRETTE, SAUCE RANCH, PAIN COMPLET
- **الألوان**: الأخضر (#27ae60)

### 9. صفحة Nos Box (`nos_box.blade.php`)
- **المنتجات الرئيسية**: BOX FAMILLE, BOX COUPLE, BOX ÉTUDIANT, BOX TRAVAIL
- **الألوان**: البنفسجي (#9b59b6)

## الدوال JavaScript المضافة

### 1. `addToCartWithType(url, selectId)`
```javascript
function addToCartWithType(url, selectId) {
    const select = document.getElementById(selectId);
    const selectedType = select.value;
    
    const variant = [{
        name: 'Type',
        price: selectedType === 'menu' ? 3.00 : 0
    }];
    
    addToCart(url, variant, 1, []);
}
```

### 2. `addToCartSimple(url)`
```javascript
function addToCartSimple(url) {
    addToCart(url, [], 1, []);
}
```

## كيفية الاستخدام

### للمنتجات مع خيارات Seul/Menu:
1. المستخدم يختار "Seul" أو "Menu" من القائمة المنسدلة
2. يضغط على زر "Commander"
3. يتم إضافة المنتج للكارت مع النوع المحدد

### للمنتجات بدون خيارات (المكملات):
1. المستخدم يضغط مباشرة على زر "Commander"
2. يتم إضافة المنتج للكارت بالسعر الأساسي

## الملفات المضافة

### `public/assets/front/js/menu-cart.js`
- ملف JavaScript مشترك يحتوي على جميع الدوال المطلوبة
- يمكن استدعاؤه في أي صفحة قائمة

## ملاحظات تقنية

1. **التوافق**: جميع التعديلات متوافقة مع النظام الحالي
2. **الأداء**: لا تؤثر التعديلات على أداء الصفحات
3. **التجربة**: تحسن تجربة المستخدم بتوفير شراء مباشر
4. **الأمان**: تستخدم نفس آليات الأمان الموجودة

## الخطوات التالية

1. اختبار جميع الصفحات المعدلة
2. التأكد من عمل أزرار الشراء بشكل صحيح
3. اختبار إضافة المنتجات للكارت
4. التأكد من حساب الأسعار بشكل صحيح 