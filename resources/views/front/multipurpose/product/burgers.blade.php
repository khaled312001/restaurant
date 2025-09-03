{{-- eslint-disable --}}
@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Nos Burgers</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nos Burgers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->

<!-- Menu Section -->
<div class="menu-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Side - Menu Items -->
            <div class="col-lg-8">
                <!-- Main Burgers Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #8e44ad; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS BURGERS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #8e44ad;">
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem;">Burger</span>
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">CHEESE BURGER</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">5,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">8,50€</span>
                            <div style="text-align: center;">
                                <button onclick="openCustomizationModal(133, 'CHEESE BURGER', '5,50', 'Seul', false, false)" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </button>
                                <button onclick="openCustomizationModal(133, 'CHEESE BURGER', '8,50', 'Menu', false, true)" class="btn btn-warning btn-sm" style="background: #9b59b6; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">DOUBLE CHEESE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">7,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">10,50€</span>
                            <div style="text-align: center;">
                                <button onclick="openCustomizationModal(134, 'DOUBLE CHEESE', '7,50', 'Seul', false, false)" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </button>
                                <button onclick="openCustomizationModal(134, 'DOUBLE CHEESE', '10,50', 'Menu', false, true)" class="btn btn-warning btn-sm" style="background: #9b59b6; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">TRIPLE CHEESE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">9,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">12,50€</span>
                            <div style="text-align: center;">
                                <button onclick="openCustomizationModal(135, 'TRIPLE CHEESE', '9,50', 'Seul', false, false)" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </button>
                                <button onclick="openCustomizationModal(135, 'TRIPLE CHEESE', '12,50', 'Menu', false, true)" class="btn btn-warning btn-sm" style="background: #9b59b6; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">BURGER SPECIAL</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">8,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">11,50€</span>
                            <div style="text-align: center;">
                                <button onclick="openCustomizationModal(136, 'BURGER SPECIAL', '8,50', 'Seul', false, false)" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </button>
                                <button onclick="openCustomizationModal(136, 'BURGER SPECIAL', '11,50', 'Menu', false, true)" class="btn btn-warning btn-sm" style="background: #9b59b6; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplements Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #8e44ad; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        SUPPLEMENTS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #8e44ad;">
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem;">Article</span>
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem;">Prix</span>
                            <span style="color: #8e44ad; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">2,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 134) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">GRANDE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">4,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 135) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE VIANDE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">5,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCart('{{ route('add.cart', 136) }}', [], 1, [])" class="btn btn-warning btn-sm" style="background: #8e44ad; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Food Images and Info -->
            <div class="col-lg-4">
                <div class="food-images" style="position: sticky; top: 20px;">
                    <!-- Burger Image -->
                    <div class="food-item" style="margin-bottom: 30px; text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 300px; background: linear-gradient(45deg, #8e44ad, #9b59b6); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden;">
                                <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-hamburger" style="font-size: 5rem; color: white; z-index: 2;"></i>
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(142,68,173,0.3), rgba(142,68,173,0.1)); z-index: 1;"></div>
                                </div>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(142,68,173,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Burgers Gourmets</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Viandes fraîches et fromages</p>
                    </div>

                    <!-- Information Section -->
                    <div class="info-section" style="background: linear-gradient(45deg, #34495e, #2c3e50); border-radius: 20px; padding: 25px; margin-top: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        <h4 style="color: #8e44ad; font-weight: 700; margin-bottom: 20px; text-align: center; font-size: 1.3rem;">
                            <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                            Informations
                        </h4>
                        
                        <div class="info-item" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 15px; margin-bottom: 15px; text-align: center;">
                            <i class="fas fa-clock" style="color: #8e44ad; font-size: 1.5rem; margin-bottom: 10px;"></i>
                            <h5 style="color: white; font-weight: 600; margin: 10px 0; font-size: 1.1rem;">Temps de préparation</h5>
                            <p style="color: #bdc3c7; margin: 0; font-size: 0.9rem;">10-15 minutes</p>
                        </div>
                        
                        <div class="info-item" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 15px; margin-bottom: 15px; text-align: center;">
                            <i class="fas fa-leaf" style="color: #27ae60; font-size: 1.5rem; margin-bottom: 10px;"></i>
                            <h5 style="color: white; font-weight: 600; margin: 10px 0; font-size: 1.1rem;">Garnitures fraîches</h5>
                            <p style="color: #bdc3c7; margin: 0; font-size: 0.9rem;">Légumes et sauces au choix</p>
                        </div>
                        
                        <div class="info-item" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 15px; text-align: center;">
                            <i class="fas fa-star" style="color: #f1c40f; font-size: 1.5rem; margin-bottom: 10px;"></i>
                            <h5 style="color: white; font-weight: 600; margin: 10px 0; font-size: 1.1rem;">Viandes premium</h5>
                            <p style="color: #bdc3c7; margin: 0; font-size: 0.9rem;">Qualité supérieure garantie</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="cta-section" style="background: linear-gradient(45deg, #2c3e50, #34495e); padding: 60px 0; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 style="color: white; font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
                    Prêt à déguster ?
                </h2>
                <p style="color: #bdc3c7; font-size: 1.2rem; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Personnalisez vos burgers avec légumes et sauces, puis ajoutez-les à votre panier !
                </p>
                
                <div class="cta-buttons">
                    <a href="{{ route('front.sandwiches') }}" class="btn btn-light btn-lg" style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; margin-right: 20px;">
                        <i class="fas fa-arrow-left" style="margin-right: 10px;"></i>
                        Retour au menu
                    </a>
                    <a href="{{ route('front.index') }}" class="btn btn-outline-light btn-lg" style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; border: 2px solid white;">
                        <i class="fas fa-home" style="margin-right: 10px;"></i>
                        Accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Customization Modal -->
@include('front.multipurpose.product.customization_modal')

<!-- Debug Information (remove in production) -->
@if(config('app.debug'))
<div class="debug-info" style="background: #f8f9fa; padding: 20px; margin: 20px 0; border-radius: 10px; border: 1px solid #dee2e6;">
    <h5>Debug Info - Addons Data:</h5>
    <pre>{{ print_r($addons, true) }}</pre>
    
    <h5>Debug Info - Product Type:</h5>
    <p>{{ $productType }}</p>
    
    <h5>Debug Info - Current Language:</h5>
    <p>ID: {{ $currentLang->id }}, Code: {{ $currentLang->code }}</p>
</div>
@endif

<style>
.menu-category {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.menu-category:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.menu-item {
    transition: all 0.3s ease;
}

.menu-item:hover {
    background-color: rgba(255,255,255,0.05);
    border-radius: 10px;
    padding-left: 15px;
    padding-right: 15px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(142, 68, 173, 0.4);
}

.food-image {
    transition: transform 0.3s ease;
}

.food-item:hover .food-image {
    transform: scale(1.05);
}

.glow-effect {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 0.5; }
    50% { opacity: 1; }
    100% { opacity: 0.5; }
}

.info-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 2rem;
    }
    
    .menu-section {
        padding: 40px 0;
    }
    
    .cta-buttons .btn {
        display: block;
        margin: 10px auto;
        width: 100%;
        max-width: 300px;
    }
}
</style>

<script>
// Set current product type for this page
window.currentProductType = 'burgers';

// Store addons data globally so modal can access it
window.currentAddons = @json($addons);

console.log('Addons data loaded:', window.currentAddons);
console.log('Addons data type:', typeof window.currentAddons);
console.log('Addons data keys:', Object.keys(window.currentAddons || {}));

function openCustomizationModal(productId, productName, price, type, hasMeat, isMenu) {
    console.log('Opening modal for:', { productId, productName, price, type, hasMeat, isMenu });
    
    // Store product information
    window.currentProduct = {
        id: productId,
        name: productName,
        price: price,
        type: type,
        hasMeat: hasMeat,
        isMenu: isMenu
    };
    
    // Update current product type and menu status for modal
    if (typeof window.currentCustomizationOptions !== 'undefined') {
        window.currentCustomizationOptions.productType = 'burgers';
        window.currentCustomizationOptions.isMenu = isMenu;
    }
    
    // IMPORTANT: Set addons data before opening modal
    if (window.currentAddons) {
        console.log('Setting addons data for modal:', window.currentAddons);
    } else {
        console.error('No addons data available!');
        console.log('Available window variables:', Object.keys(window).filter(key => key.includes('addon')));
    }
    
    // Set modal data attributes
    $('#customizationModal').modal('show');
    
    // Update modal content immediately
    $('#modalProductName').text(productName);
    $('#modalProductType').text(type);
    $('#modalProductPrice').text(price + '€');
    
    // Trigger modal show event to update sections
    setTimeout(() => {
        $('#customizationModal').trigger('show.bs.modal', [{
            relatedTarget: {
                dataset: {
                    productType: 'burgers',
                    productName: productName,
                    productPrice: price,
                    menuType: isMenu
                }
            }
        }]);
    }, 100);
}

function updateModalSections(addons, productType, isMenu) {
    console.log('Updating modal sections with addons:', addons);
    
    // Store addons data globally for modal to use
    window.currentAddons = addons;
    
    // Log what we're passing to modal
    console.log('Current addons stored for modal:', window.currentAddons);
    console.log('Product type:', productType);
    console.log('Is menu:', isMenu);
}

function addToCart(url, variant, quantity, extras) {
    // Existing addToCart function
    // You can keep your existing implementation here
    console.log('Adding to cart:', url, variant, quantity, extras);
    
    // For now, redirect to the cart route
    window.location.href = url;
}

// Add to cart with customization
window.addToCartWithCustomization = function(customizationOptions) {
    console.log('=== ADD TO CART WITH CUSTOMIZATION ===');
    console.log('Customization options received:', customizationOptions);
    
    // Get current product information
    if (!window.currentProduct) {
        console.error('No current product information available');
        console.log('Available window variables:', Object.keys(window).filter(key => key.includes('current')));
        return;
    }
    
    const product = window.currentProduct;
    console.log('Current product:', product);
    
    // Validate customization options
    if (!customizationOptions || !customizationOptions.addons) {
        console.error('Invalid customization options:', customizationOptions);
        return;
    }
    
    console.log('Addons collected:', customizationOptions.addons);
    
    // Prepare data for backend
    const cartData = {
        product_id: product.id,
        quantity: customizationOptions.quantity || 1,
        customizations: JSON.stringify({
            productName: product.name,
            productType: product.type,
            price: product.price,
            quantity: customizationOptions.quantity || 1,
            meatChoice: customizationOptions.addons?.meat || null,
            vegetables: customizationOptions.addons?.vegetables || [],
            sauces: customizationOptions.addons?.sauces || [],
            drinks: customizationOptions.addons?.drinks || [],
            extras: customizationOptions.addons?.extras || []
        }),
        _token: $('meta[name="csrf-token"]').attr('content')
    };
    
    console.log('Cart data prepared:', cartData);
    console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));
    
    // Send POST request to add to cart
    $.ajax({
        url: '/add-to-cart/' + product.id,
        method: 'POST',
        data: cartData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('=== ADD TO CART SUCCESS ===');
            console.log('Response:', response);
            
            if (response.success) {
                // Show success message
                if (typeof toastr !== 'undefined') {
                    toastr.success('Produit ajouté au panier avec succès!');
                } else {
                    alert('Produit ajouté au panier avec succès!');
                }
                
                // Redirect to cart page
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    window.location.href = '/cart';
                }
            } else {
                // Show error message
                if (typeof toastr !== 'undefined') {
                    toastr.error(response.message || 'Erreur lors de l\'ajout au panier');
                } else {
                    alert(response.message || 'Erreur lors de l\'ajout au panier');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('=== ADD TO CART ERROR ===');
            console.error('Error:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
            console.error('Status code:', xhr.status);
            
            // Show error message
            if (typeof toastr !== 'undefined') {
                toastr.error('Erreur lors de l\'ajout au panier');
            } else {
                alert('Erreur lors de l\'ajout au panier');
            }
        }
    });
};
</script>

@endsection
