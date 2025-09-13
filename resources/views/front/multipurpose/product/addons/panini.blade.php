{{-- eslint-disable --}}
@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Personnaliser vos Panini</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.panini')}}">Nos Panini</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Personnalisation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->

<!-- Addon Selection Section -->
<div class="addon-selection-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Full Width Addon Categories -->
            <div class="col-12">
                <div class="addon-categories">
                    @foreach($addons as $category => $addonData)
                        @if($addonData['items']->count() > 0)
                            <div class="addon-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <h2 style="color: #27ae60; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                                    @if($category == 'sauces')
                                        <i class="fas fa-fire" style="margin-right: 10px;"></i>
                                    @elseif($category == 'vegetables')
                                        <i class="fas fa-leaf" style="margin-right: 10px;"></i>
                                    @elseif($category == 'meat')
                                        <i class="fas fa-drumstick-bite" style="margin-right: 10px;"></i>
                                    @elseif($category == 'drinks')
                                        <i class="fas fa-coffee" style="margin-right: 10px;"></i>
                                    @else
                                        <i class="fas fa-plus" style="margin-right: 10px;"></i>
                                    @endif
                                    {{ $addonData['label'] }}
                                    @if($addonData['required'])
                                        <span style="color: #e74c3c; font-size: 0.8rem; margin-left: 10px;">(Obligatoire)</span>
                                    @endif
                                </h2>
                                
                                <div class="addon-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                                    @foreach($addonData['items'] as $addon)
                                        <div class="addon-item" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.3s ease; border: 2px solid transparent;" 
                                             onclick="selectAddon('{{ $category }}', {{ $addon->id }}, '{{ $addon->name }}', {{ $addon->price }}, this)">
                                            @if($addon->icon)
                                                <i class="{{ $addon->icon }}" style="font-size: 2rem; color: #27ae60; margin-bottom: 10px;"></i>
                                            @else
                                                <i class="fas fa-plus" style="font-size: 2rem; color: #27ae60; margin-bottom: 10px;"></i>
                                            @endif
                                            <h5 style="color: white; font-weight: 600; margin: 10px 0; font-size: 1.1rem;">{{ $addon->name }}</h5>
                                            @if($addon->price > 0)
                                                <span style="color: #f1c40f; font-weight: 600; font-size: 1.2rem;">+{{ $addon->price }}€</span>
                                            @else
                                                <span style="color: #27ae60; font-weight: 600; font-size: 1.2rem;">Gratuit</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <!-- Add to Cart Section -->
                <div class="add-to-cart-section" style="background: #34495e; border-radius: 20px; padding: 30px; margin-top: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 style="color: white; margin-bottom: 15px;">
                        <i class="fas fa-shopping-cart" style="margin-right: 10px; color: #f1c40f;"></i>
                        Votre Sélection
                    </h3>
                    
                    <!-- Product Info -->
                    <div id="productInfo" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 15px; margin-bottom: 15px; border-left: 4px solid #e74c3c;">
                        <h4 style="color: white; margin-bottom: 5px; font-size: 1.1rem;">
                            <i class="fas fa-utensils" style="margin-right: 8px; color: #e74c3c;"></i>
                            {{ $product->name }}
                        </h4>
                        <p style="color: #bdc3c7; margin: 0; font-size: 0.9rem;">
                            <span id="productTypeDisplay">Seul</span> - 
                            <span style="color: #f1c40f; font-weight: 600;">{{ $product->price }}€</span>
                        </p>
                    </div>
                    
                    <div id="selectedAddons" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; min-height: 100px;">
                        <p style="color: #bdc3c7; text-align: center; font-style: italic;">Aucune sélection</p>
                    </div>
                </div>
                        <div class="col-md-4 text-center">
                            <div style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px; margin-bottom: 20px;">
                                <h4 style="color: #f1c40f; margin-bottom: 10px;">Total</h4>
                                <div id="totalPrice" style="color: white; font-size: 2rem; font-weight: bold;">0.00€</div>
                            </div>
                            <button id="addToCartBtn" class="btn btn-success btn-lg" style="background: #27ae60; border: none; color: white; padding: 15px 30px; border-radius: 25px; font-weight: 600; font-size: 1.2rem; width: 100%; transition: all 0.3s ease;">
                                <i class="fas fa-plus" style="margin-right: 10px;"></i>
                                Ajouter au Panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.addon-category {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.addon-category:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.addon-item {
    transition: all 0.3s ease;
}

.addon-item:hover {
    background: rgba(39, 174, 96, 0.2) !important;
    border-color: #27ae60 !important;
    transform: translateY(-5px);
}

.addon-item.selected {
    background: rgba(39, 174, 96, 0.3) !important;
    border-color: #27ae60 !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
}

.food-image {
    transition: transform 0.3s ease;
}

.food-item:hover .food-image {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .addon-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
    }
    
    .addon-selection-section {
        padding: 40px 0;
    }
}
</style>

<script>
let selectedAddons = {};
let addonTotalPrice = 0;
let baseProductPrice = 0;
let productName = '';
let productType = '';

// Define addToCartWithAddons function immediately
window.addToCartWithAddons = function() {
    console.log('=== ADD TO CART FUNCTION STARTED ===');
    console.log('Function execution started at:', new Date().toLocaleTimeString());
    console.log('Function scope check - selectedAddons:', typeof selectedAddons);
    console.log('Function scope check - baseProductPrice:', typeof baseProductPrice);
    console.log('Function scope check - addonTotalPrice:', typeof addonTotalPrice);
    
    try {
        console.log('✅ Entered try block successfully');
        console.log('addToCart function called successfully');
        console.log('selectedAddons:', selectedAddons);
        console.log('selectedAddons type:', typeof selectedAddons);
        console.log('selectedAddons keys:', selectedAddons ? Object.keys(selectedAddons) : 'undefined');
        console.log('baseProductPrice:', baseProductPrice);
        console.log('baseProductPrice type:', typeof baseProductPrice);
        console.log('addonTotalPrice:', addonTotalPrice);
        console.log('addonTotalPrice type:', typeof addonTotalPrice);
        
        // Test if variables are defined
        if (typeof selectedAddons === 'undefined') {
            console.error('selectedAddons is undefined!');
            return;
        }
        if (typeof baseProductPrice === 'undefined') {
            console.error('baseProductPrice is undefined!');
            return;
        }
        if (typeof addonTotalPrice === 'undefined') {
            console.error('addonTotalPrice is undefined!');
            return;
        }
        
        console.log('Checking selectedAddons length:', Object.keys(selectedAddons).length);
        if (Object.keys(selectedAddons).length === 0) {
            console.log('No addons selected - adding product without addons');
            // Allow adding product without addons
        }
        
        // Get product info from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const productType = urlParams.get('type') || 'seul';
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        console.log('CSRF meta tag found:', !!csrfToken);
        const tokenValue = csrfToken ? csrfToken.getAttribute('content') : null;
        console.log('CSRF token value:', tokenValue);
        
        // Create cart data
        const cartData = {
            product_id: {{ $product->id }},
            product_name: '{{ $product->name }}',
            product_price: {{ $product->price }},
            product_type: productType,
            addons: selectedAddons,
            total_price: baseProductPrice + addonTotalPrice,
            _token: tokenValue
        };
        
        console.log('Cart data:', cartData);
        console.log('Cart data JSON:', JSON.stringify(cartData));
        
        // Send to cart
        console.log('About to send fetch request...');
        fetch('/add-to-cart-custom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': tokenValue
            },
            body: JSON.stringify(cartData)
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('✅ Server response received:', data);
            if (data.success) {
                console.log('🎉 Product added successfully! Redirecting to cart...');
                
                // Show success message
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message || 'Produit ajouté au panier avec succès!');
                    console.log('✅ Success message shown via toastr');
                } else {
                    alert(data.message || 'Produit ajouté au panier avec succès!');
                    console.log('✅ Success message shown via alert');
                }
                
                // Redirect to cart
                const redirectUrl = data.redirect || '/cart';
                console.log('🚀 Redirecting to:', redirectUrl);
                
                setTimeout(function() {
                    window.location.href = redirectUrl;
                }, 1500); // Give more time to see the message
                
            } else {
                console.error('❌ Server returned error:', data.message);
                alert('Erreur lors de l\'ajout au panier: ' + (data.message || 'Erreur inconnue'));
            }
        })
        .catch(error => {
            console.error('🚨 Network/Server Error:', error);
            console.error('Error details:', {
                name: error.name,
                message: error.message,
                stack: error.stack
            });
            alert('Erreur de connexion: ' + error.message + '\nVeuillez réessayer.');
        });
    } catch (error) {
        console.error('🚨 JavaScript Error in addToCart:', error);
        console.error('Error details:', {
            name: error.name,
            message: error.message,
            stack: error.stack
        });
        alert('Erreur JavaScript: ' + error.message + '\nVeuillez recharger la page.');
    }
};

function selectAddon(category, addonId, addonName, addonPrice, element) {
    const addonKey = `${category}_${addonId}`;
    
    // Check if this addon is already selected
    if (selectedAddons[addonKey]) {
        // Remove addon
        delete selectedAddons[addonKey];
        element.classList.remove('selected');
        addonTotalPrice -= addonPrice;
    } else {
        // Add new addon (allow multiple selections from same category)
        selectedAddons[addonKey] = {
            category: category,
            id: addonId,
            name: addonName,
            price: addonPrice
        };
        element.classList.add('selected');
        addonTotalPrice += addonPrice;
    }
    
    updateSelectionDisplay();
}

function updateSelectionDisplay() {
    const container = document.getElementById('selectedAddons');
    container.innerHTML = '';
    
    if (Object.keys(selectedAddons).length === 0) {
        container.innerHTML = '<p style="color: #bdc3c7; text-align: center; font-style: italic;">Aucune sélection</p>';
        return;
    }
    
    // Group addons by category
    const groupedAddons = {};
    Object.values(selectedAddons).forEach(addon => {
        if (!groupedAddons[addon.category]) {
            groupedAddons[addon.category] = [];
        }
        groupedAddons[addon.category].push(addon);
    });
    
    // Display grouped addons
    Object.keys(groupedAddons).forEach(category => {
        const categoryDiv = document.createElement('div');
        categoryDiv.style.cssText = 'background: rgba(255,255,255,0.05); border-radius: 10px; padding: 15px; margin-bottom: 15px; border-left: 4px solid #27ae60;';
        
        const categoryTitle = document.createElement('h5');
        categoryTitle.style.cssText = 'color: #27ae60; margin-bottom: 10px; font-size: 1rem; font-weight: 600;';
        categoryTitle.textContent = category.charAt(0).toUpperCase() + category.slice(1);
        categoryDiv.appendChild(categoryTitle);
        
        groupedAddons[category].forEach(addon => {
            const addonDiv = document.createElement('div');
            addonDiv.style.cssText = 'background: rgba(255,255,255,0.1); border-radius: 8px; padding: 8px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center;';
            
            addonDiv.innerHTML = `
                <span style="color: white; font-weight: 500; font-size: 0.9rem;">${addon.name}</span>
                <span style="color: #f1c40f; font-weight: 600; font-size: 0.9rem;">${addon.price > 0 ? '+' + addon.price + '€' : 'Gratuit'}</span>
            `;
            
            categoryDiv.appendChild(addonDiv);
        });
        
        container.appendChild(categoryDiv);
    });
    
    const finalTotal = baseProductPrice + addonTotalPrice;
    document.getElementById('totalPrice').textContent = finalTotal.toFixed(2) + '€';
}


// Initialize display
document.addEventListener('DOMContentLoaded', function() {
    // Get product info from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    productType = urlParams.get('type') || 'seul';
    
    // Set base product price
    baseProductPrice = {{ $product->price }};
    productName = '{{ $product->name }}';
    
    // Update product type display
    const productTypeDisplay = document.getElementById('productTypeDisplay');
    if (productTypeDisplay) {
        productTypeDisplay.textContent = productType === 'menu' ? 'Menu' : 'Seul';
    }
    
    // Update display
    updateSelectionDisplay();
    
    // Add event listener to button
    const addToCartBtn = document.getElementById('addToCartBtn');
    console.log('🔍 Looking for add to cart button...');
    console.log('Button found:', !!addToCartBtn);
    
    if (addToCartBtn) {
        console.log('✅ Button found! Adding event listener...');
        addToCartBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent any default behavior
            console.log('🖱️ Button clicked via event listener!');
            console.log('Event details:', {
                type: event.type,
                target: event.target,
                timestamp: new Date().toLocaleTimeString()
            });
            console.log('🚀 About to call addToCartWithAddons function...');
            console.log('addToCartWithAddons function type:', typeof addToCartWithAddons);
            console.log('window.addToCartWithAddons function type:', typeof window.addToCartWithAddons);
            
            try {
                if (typeof window.addToCartWithAddons === 'function') {
                    console.log('✅ Calling window.addToCartWithAddons...');
                    console.log('About to execute window.addToCartWithAddons()...');
                    window.addToCartWithAddons();
                    console.log('window.addToCartWithAddons() execution completed');
                } else {
                    console.error('❌ addToCartWithAddons function not found!');
                    alert('Erreur: La fonction addToCartWithAddons n\'est pas définie. Veuillez recharger la page.');
                    return;
                }
                console.log('✅ addToCartWithAddons function called successfully');
            } catch (error) {
                console.error('❌ Error calling addToCartWithAddons function:', error);
                console.error('Error stack:', error.stack);
                alert('Erreur lors de l\'appel de la fonction: ' + error.message);
            }
        });
        console.log('✅ Event listener added successfully!');
    } else {
        console.error('❌ Add to cart button not found! ID: addToCartBtn');
    }
});
</script>

@endsection