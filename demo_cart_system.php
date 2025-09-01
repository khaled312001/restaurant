<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart System Demo - King Kebab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .addon-item {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
        }
        .variation-item {
            background: #e3f2fd;
            border: 1px solid #2196f3;
            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
        }
        .cart-item {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
        }
        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #28a745;
        }
        .badge-custom {
            font-size: 0.8em;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">
            <i class="fas fa-shopping-cart text-primary"></i>
            Cart System Demo - King Kebab
        </h1>
        
        <div class="row">
            <div class="col-md-8">
                <h3>Available Products</h3>
                
                <!-- Product 1: Kebab -->
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/200x150/FF6B6B/FFFFFF?text=Kebab" 
                                 alt="Chicken Kebab" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h4>Chicken Kebab</h4>
                            <p class="price">€8.99</p>
                            <p>Delicious chicken kebab with fresh vegetables and special sauce.</p>
                            
                            <h6><i class="fas fa-list text-info"></i> Variations:</h6>
                            <div class="variation-item">
                                <strong>Meat Choice:</strong>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebab_meat" value="chicken" data-price="0" checked>
                                    <label class="form-check-label">Chicken (+€0.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebab_meat" value="beef" data-price="2.50">
                                    <label class="form-check-label">Beef (+€2.50)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebab_meat" value="lamb" data-price="3.00">
                                    <label class="form-check-label">Lamb (+€3.00)</label>
                                </div>
                            </div>
                            
                            <div class="variation-item">
                                <strong>Size:</strong>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebab_size" value="regular" data-price="0" checked>
                                    <label class="form-check-label">Regular (+€0.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebab_size" value="large" data-price="1.50">
                                    <label class="form-check-label">Large (+€1.50)</label>
                                </div>
                            </div>
                            
                            <h6><i class="fas fa-plus text-success"></i> Addons:</h6>
                            <div class="addon-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kebab_addons" value="garlic_sauce" data-price="1.00">
                                    <label class="form-check-label">Garlic Sauce (+€1.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kebab_addons" value="extra_cheese" data-price="1.50">
                                    <label class="form-check-label">Extra Cheese (+€1.50)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kebab_addons" value="fries" data-price="3.50">
                                    <label class="form-check-label">French Fries (+€3.50)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kebab_addons" value="drink" data-price="2.00">
                                    <label class="form-check-label">Soft Drink (+€2.00)</label>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <label for="kebab_qty" class="form-label">Quantity:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQty('kebab_qty', -1)">-</button>
                                    <input type="number" class="form-control text-center" id="kebab_qty" value="1" min="1">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQty('kebab_qty', 1)">+</button>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <strong>Total: €<span id="kebab_total">8.99</span></strong>
                            </div>
                            
                            <button class="btn btn-primary mt-2" onclick="addToCart('kebab')">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2: Pizza -->
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/200x150/4ECDC4/FFFFFF?text=Pizza" 
                                 alt="Margherita Pizza" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h4>Margherita Pizza</h4>
                            <p class="price">€12.99</p>
                            <p>Classic margherita pizza with tomato sauce and mozzarella cheese.</p>
                            
                            <h6><i class="fas fa-list text-info"></i> Variations:</h6>
                            <div class="variation-item">
                                <strong>Size:</strong>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pizza_size" value="small" data-price="0" checked>
                                    <label class="form-check-label">Small (+€0.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pizza_size" value="medium" data-price="2.00">
                                    <label class="form-check-label">Medium (+€2.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pizza_size" value="large" data-price="4.00">
                                    <label class="form-check-label">Large (+€4.00)</label>
                                </div>
                            </div>
                            
                            <h6><i class="fas fa-plus text-success"></i> Addons:</h6>
                            <div class="addon-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pizza_addons" value="extra_cheese" data-price="2.50">
                                    <label class="form-check-label">Extra Cheese (+€2.50)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pizza_addons" value="pepperoni" data-price="3.00">
                                    <label class="form-check-label">Pepperoni (+€3.00)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pizza_addons" value="mushrooms" data-price="1.50">
                                    <label class="form-check-label">Mushrooms (+€1.50)</label>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <label for="pizza_qty" class="form-label">Quantity:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQty('pizza_qty', -1)">-</button>
                                    <input type="number" class="form-control text-center" id="pizza_qty" value="1" min="1">
                                    <button class="btn btn-outline-secondary" type="button" onclick="changeQty('pizza_qty', 1)">+</button>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <strong>Total: €<span id="pizza_total">12.99</span></strong>
                            </div>
                            
                            <button class="btn btn-primary mt-2" onclick="addToCart('pizza')">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <h3><i class="fas fa-shopping-cart text-primary"></i> Shopping Cart</h3>
                <div id="cart-items">
                    <p class="text-muted">Your cart is empty</p>
                </div>
                
                <div id="cart-summary" class="d-none">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total Items:</strong>
                        <span id="cart-count">0</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <strong>Cart Total:</strong>
                        <span id="cart-total">€0.00</span>
                    </div>
                    <hr>
                    <button class="btn btn-success w-100" onclick="checkout()">
                        <i class="fas fa-credit-card"></i> Proceed to Checkout
                    </button>
                    <button class="btn btn-outline-danger w-100 mt-2" onclick="clearCart()">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let cart = [];
        let cartTotal = 0;
        let cartCount = 0;

        // Initialize price calculations
        document.addEventListener('DOMContentLoaded', function() {
            updateKebabTotal();
            updatePizzaTotal();
            
            // Add event listeners for price updates
            document.querySelectorAll('input[name="kebab_meat"], input[name="kebab_size"]').forEach(input => {
                input.addEventListener('change', updateKebabTotal);
            });
            
            document.querySelectorAll('input[name="kebab_addons"]').forEach(input => {
                input.addEventListener('change', updateKebabTotal);
            });
            
            document.querySelectorAll('input[name="pizza_size"]').forEach(input => {
                input.addEventListener('change', updatePizzaTotal);
            });
            
            document.querySelectorAll('input[name="pizza_addons"]').forEach(input => {
                input.addEventListener('change', updatePizzaTotal);
            });
            
            document.getElementById('kebab_qty').addEventListener('input', updateKebabTotal);
            document.getElementById('pizza_qty').addEventListener('input', updatePizzaTotal);
        });

        function changeQty(inputId, change) {
            const input = document.getElementById(inputId);
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
            
            if (inputId === 'kebab_qty') {
                updateKebabTotal();
            } else if (inputId === 'pizza_qty') {
                updatePizzaTotal();
            }
        }

        function updateKebabTotal() {
            let basePrice = 8.99;
            let total = basePrice;
            
            // Add variation prices
            const selectedMeat = document.querySelector('input[name="kebab_meat"]:checked');
            if (selectedMeat) {
                total += parseFloat(selectedMeat.dataset.price);
            }
            
            const selectedSize = document.querySelector('input[name="kebab_size"]:checked');
            if (selectedSize) {
                total += parseFloat(selectedSize.dataset.price);
            }
            
            // Add addon prices
            document.querySelectorAll('input[name="kebab_addons"]:checked').forEach(addon => {
                total += parseFloat(addon.dataset.price);
            });
            
            // Multiply by quantity
            const qty = parseInt(document.getElementById('kebab_qty').value);
            total *= qty;
            
            document.getElementById('kebab_total').textContent = total.toFixed(2);
        }

        function updatePizzaTotal() {
            let basePrice = 12.99;
            let total = basePrice;
            
            // Add variation prices
            const selectedSize = document.querySelector('input[name="pizza_size"]:checked');
            if (selectedSize) {
                total += parseFloat(selectedSize.dataset.price);
            }
            
            // Add addon prices
            document.querySelectorAll('input[name="pizza_addons"]:checked').forEach(addon => {
                total += parseFloat(addon.dataset.price);
            });
            
            // Multiply by quantity
            const qty = parseInt(document.getElementById('pizza_qty').value);
            total *= qty;
            
            document.getElementById('pizza_total').textContent = total.toFixed(2);
        }

        function addToCart(productType) {
            let product = {};
            
            if (productType === 'kebab') {
                product = {
                    id: 'kebab_' + Date.now(),
                    name: 'Chicken Kebab',
                    price: parseFloat(document.getElementById('kebab_total').textContent),
                    qty: parseInt(document.getElementById('kebab_qty').value),
                    variations: getKebabVariations(),
                    addons: getKebabAddons()
                };
            } else if (productType === 'pizza') {
                product = {
                    id: 'pizza_' + Date.now(),
                    name: 'Margherita Pizza',
                    price: parseFloat(document.getElementById('pizza_total').textContent),
                    qty: parseInt(document.getElementById('pizza_qty').value),
                    variations: getPizzaVariations(),
                    addons: getPizzaAddons()
                };
            }
            
            cart.push(product);
            updateCartDisplay();
            
            // Show success message
            showNotification('Product added to cart successfully!', 'success');
        }

        function getKebabVariations() {
            const variations = [];
            
            const selectedMeat = document.querySelector('input[name="kebab_meat"]:checked');
            if (selectedMeat && selectedMeat.dataset.price > 0) {
                variations.push({
                    name: selectedMeat.value,
                    price: parseFloat(selectedMeat.dataset.price)
                });
            }
            
            const selectedSize = document.querySelector('input[name="kebab_size"]:checked');
            if (selectedSize && selectedSize.dataset.price > 0) {
                variations.push({
                    name: selectedSize.value,
                    price: parseFloat(selectedSize.dataset.price)
                });
            }
            
            return variations;
        }

        function getKebabAddons() {
            const addons = [];
            document.querySelectorAll('input[name="kebab_addons"]:checked').forEach(addon => {
                addons.push({
                    name: addon.value,
                    price: parseFloat(addon.dataset.price)
                });
            });
            return addons;
        }

        function getPizzaVariations() {
            const variations = [];
            
            const selectedSize = document.querySelector('input[name="pizza_size"]:checked');
            if (selectedSize && selectedSize.dataset.price > 0) {
                variations.push({
                    name: selectedSize.value,
                    price: parseFloat(selectedSize.dataset.price)
                });
            }
            
            return variations;
        }

        function getPizzaAddons() {
            const addons = [];
            document.querySelectorAll('input[name="pizza_addons"]:checked').forEach(addon => {
                addons.push({
                    name: addon.value,
                    price: parseFloat(addon.dataset.price)
                });
            });
            return addons;
        }

        function updateCartDisplay() {
            const cartContainer = document.getElementById('cart-items');
            const cartSummary = document.getElementById('cart-summary');
            
            if (cart.length === 0) {
                cartContainer.innerHTML = '<p class="text-muted">Your cart is empty</p>';
                cartSummary.classList.add('d-none');
                return;
            }
            
            cartSummary.classList.remove('d-none');
            
            let cartHtml = '';
            cartTotal = 0;
            cartCount = 0;
            
            cart.forEach((item, index) => {
                cartTotal += item.price;
                cartCount += item.qty;
                
                cartHtml += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6>${item.name}</h6>
                                <p class="mb-1">Qty: ${item.qty}</p>
                                ${item.variations.length > 0 ? `
                                    <div class="mb-1">
                                        <small class="text-info">
                                            <i class="fas fa-list"></i> 
                                            ${item.variations.map(v => v.name).join(', ')}
                                        </small>
                                    </div>
                                ` : ''}
                                ${item.addons.length > 0 ? `
                                    <div class="mb-1">
                                        <small class="text-success">
                                            <i class="fas fa-plus"></i> 
                                            ${item.addons.map(a => a.name).join(', ')}
                                        </small>
                                    </div>
                                ` : ''}
                            </div>
                            <div class="text-end">
                                <div class="price">€${item.price.toFixed(2)}</div>
                                <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${index})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            cartContainer.innerHTML = cartHtml;
            document.getElementById('cart-count').textContent = cartCount;
            document.getElementById('cart-total').textContent = '€' + cartTotal.toFixed(2);
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
            showNotification('Item removed from cart', 'info');
        }

        function clearCart() {
            cart = [];
            updateCartDisplay();
            showNotification('Cart cleared', 'info');
        }

        function checkout() {
            if (cart.length === 0) {
                showNotification('Your cart is empty', 'warning');
                return;
            }
            
            showNotification('Redirecting to checkout...', 'success');
            // Here you would redirect to the actual checkout page
            setTimeout(() => {
                alert('This would redirect to the checkout page in the real application.');
            }, 1000);
        }

        function showNotification(message, type) {
            // Simple notification system
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto-remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 3000);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 