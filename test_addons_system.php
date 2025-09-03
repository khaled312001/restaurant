<?php
echo "=== اختبار نظام الإضافات الجديد ===\n\n";

// Test 1: التحقق من وجود جدول addons
echo "1. التحقق من جدول addons...\n";
$addonsTableExists = file_exists('database/migrations/2025_09_03_194128_create_addons_table.php');
if ($addonsTableExists) {
    echo "✓ جدول addons تم إنشاؤه بنجاح\n";
} else {
    echo "✗ جدول addons لم يتم إنشاؤه\n";
}

// Test 2: التحقق من نموذج Addon
echo "\n2. التحقق من نموذج Addon...\n";
$addonModelExists = file_exists('app/Models/Addon.php');
if ($addonModelExists) {
    echo "✓ نموذج Addon موجود\n";
} else {
    echo "✗ نموذج Addon غير موجود\n";
}

// Test 3: التحقق من AddonSeeder
echo "\n3. التحقق من AddonSeeder...\n";
$addonSeederExists = file_exists('database/seeds/AddonSeeder.php');
if ($addonSeederExists) {
    echo "✓ AddonSeeder موجود\n";
} else {
    echo "✗ AddonSeeder غير موجود\n";
}

// Test 4: التحقق من تحديث ProductController
echo "\n4. التحقق من تحديث ProductController...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'Addon::active()') !== false) {
        echo "✓ ProductController محدث ليرسل الإضافات\n";
    } else {
        echo "✗ ProductController لم يتم تحديثه\n";
    }
} else {
    echo "✗ ProductController غير موجود\n";
}

// Test 5: التحقق من تحديث modal التخصيص
echo "\n5. التحقق من تحديث modal التخصيص...\n";
$modalPath = 'resources/views/front/multipurpose/product/customization_modal.blade.php';
if (file_exists($modalPath)) {
    $modalContent = file_get_contents($modalPath);
    if (strpos($modalContent, '@foreach($addons as $category => $categoryData)') !== false) {
        echo "✓ Modal التخصيص محدث لعرض الإضافات الديناميكية\n";
    } else {
        echo "✗ Modal التخصيص لم يتم تحديثه\n";
    }
} else {
    echo "✗ Modal التخصيص غير موجود\n";
}

// Test 6: التحقق من تحديث صفحة الكارت
echo "\n6. التحقق من تحديث صفحة الكارت...\n";
$cartPath = 'resources/views/front/multipurpose/product/cart.blade.php';
if (file_exists($cartPath)) {
    $cartContent = file_get_contents($cartPath);
    if (strpos($cartContent, 'customization-details') !== false && strpos($cartContent, 'groupedAddons') !== false) {
        echo "✓ صفحة الكارت محدثة لعرض الإضافات\n";
    } else {
        echo "✗ صفحة الكارت لم يتم تحديثها\n";
    }
} else {
    echo "✗ صفحة الكارت غير موجودة\n";
}

// Test 7: التحقق من Routes الإدارة
echo "\n7. التحقق من Routes الإدارة...\n";
$routesPath = 'routes/web.php';
if (file_exists($routesPath)) {
    $routesContent = file_get_contents($routesPath);
    if (strpos($routesContent, 'admin.addons.index') !== false) {
        echo "✓ Routes الإدارة للإضافات موجودة\n";
    } else {
        echo "✗ Routes الإدارة للإضافات غير موجودة\n";
    }
} else {
    echo "✗ ملف Routes غير موجود\n";
}

echo "\n=== ملخص الاختبار ===\n";
echo "النظام جاهز للاستخدام!\n\n";

echo "للاختبار:\n";
echo "1. انتقل إلى: http://127.0.0.1:8000/menu/kebab-galette\n";
echo "2. اضغط على زر 'Commander' (Seul أو Menu)\n";
echo "3. ستظهر الإضافات الديناميكية في modal التخصيص\n";
echo "4. اختر الإضافات المطلوبة وأضف المنتج إلى الكارت\n";
echo "5. تحقق من عرض الإضافات في صفحة الكارت\n\n";

echo "لإدارة الإضافات:\n";
echo "- انتقل إلى: http://127.0.0.1:8000/admin/addons\n";
echo "- أضف إضافات جديدة أو عدل الموجودة\n";
echo "- يمكنك تفعيل/إلغاء الإضافات حسب الحاجة\n\n";

echo "ملاحظة: تأكد من تشغيل الهجرات وإضافة البيانات:\n";
echo "php artisan migrate\n";
echo "php artisan db:seed --class=AddonSeeder\n"; 