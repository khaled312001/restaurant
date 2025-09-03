<?php
echo "=== اختبار Route الحذف ===\n\n";

// Test 1: التحقق من وجود route الحذف
echo "1. التحقق من route الحذف...\n";
$routesPath = 'routes/web.php';
if (file_exists($routesPath)) {
    $routesContent = file_get_contents($routesPath);
    $routeCount = substr_count($routesContent, 'cart.item.remove');
    if ($routeCount > 0) {
        echo "✓ Route cart.item.remove موجود ($routeCount مرات)\n";
    } else {
        echo "✗ Route cart.item.remove غير موجود\n";
    }
} else {
    echo "✗ ملف routes غير موجود\n";
}

// Test 2: التحقق من وجود دالة cartitemremove
echo "\n2. التحقق من دالة cartitemremove...\n";
$controllerPath = 'app/Http/Controllers/Front/ProductController.php';
if (file_exists($controllerPath)) {
    $controllerContent = file_get_contents($controllerPath);
    if (strpos($controllerContent, 'public function cartitemremove') !== false) {
        echo "✓ دالة cartitemremove موجودة\n";
    } else {
        echo "✗ دالة cartitemremove غير موجودة\n";
    }
} else {
    echo "✗ ProductController غير موجود\n";
}

// Test 3: التحقق من وجود Session facade
echo "\n3. التحقق من Session facade...\n";
if (strpos($controllerContent, 'use Illuminate\\Support\\Facades\\Session;') !== false || 
    strpos($controllerContent, 'Session::') !== false) {
    echo "✓ Session facade مستخدم\n";
} else {
    echo "✗ Session facade غير مستخدم\n";
}

// Test 4: التحقق من وجود Log facade
echo "\n4. التحقق من Log facade...\n";
if (strpos($controllerContent, 'use Illuminate\\Support\\Facades\\Log;') !== false || 
    strpos($controllerContent, '\\Log::') !== false) {
    echo "✓ Log facade مستخدم\n";
} else {
    echo "✗ Log facade غير مستخدم\n";
}

echo "\n=== ملخص الاختبار ===\n";
echo "للاختبار:\n";
echo "1. انتقل إلى: http://127.0.0.1:8000/cart\n";
echo "2. افتح Developer Tools (F12)\n";
echo "3. انتقل إلى Console\n";
echo "4. اضغط على زر 'Supprimer'\n";
echo "5. تحقق من الرسائل في Console\n";
echo "6. تحقق من Network tab لرؤية AJAX request\n\n";

echo "إذا كان هناك مشكلة:\n";
echo "- تأكد من أن jQuery محمل\n";
echo "- تحقق من Console للأخطاء\n";
echo "- تحقق من Network tab للـ AJAX requests\n";
echo "- تأكد من أن route يعمل\n"; 