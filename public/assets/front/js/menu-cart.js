// دالة إضافة المنتج للكارت مع اختيار النوع (Seul أو Menu)
function addToCartWithType(url, selectId) {
    const select = document.getElementById(selectId);
    const selectedType = select.value;
    
    // إضافة النوع المحدد كـ variant
    const variant = [{
        name: 'Type',
        price: selectedType === 'menu' ? 3.00 : 0 // فرق السعر بين Menu و Seul
    }];
    
    // استدعاء الدالة الأصلية مع النوع المحدد
    addToCart(url, variant, 1, []);
}

// دالة إضافة المنتج للكارت بدون اختيار نوع (للمنتجات التي ليس لها Seul/Menu)
function addToCartSimple(url) {
    addToCart(url, [], 1, []);
}

// تحسين تجربة المستخدم - إظهار رسالة نجاح
function showSuccessMessage(message) {
    if (typeof toastr !== 'undefined') {
        toastr.success(message);
    } else {
        alert(message);
    }
}

// تحسين تجربة المستخدم - إظهار رسالة خطأ
function showErrorMessage(message) {
    if (typeof toastr !== 'undefined') {
        toastr.error(message);
    } else {
        alert(message);
    }
} 