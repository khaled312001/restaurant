@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Kebab & Galette</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kebab & Galette</li>
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
            <!-- Full Width Menu -->
            <div class="col-12">
                <!-- Main Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #f39c12; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS SANDWICHS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f39c12;">
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">Plat</span>
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        @foreach($products as $product)
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; {{ !$loop->last ? 'border-bottom: 1px solid rgba(255,255,255,0.2);' : '' }}">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">{{ strtoupper($product->title) }}</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_seul ?? $product->current_price, 2, ',', '') }}€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_menu ?? $product->current_price, 2, ',', '') }}€</span>
                            <div style="text-align: center;">
                                <a href="{{ route('front.kebabGalette.addons') }}?type=seul&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #f39c12; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Seul
                                </a>
                                <a href="{{ route('front.kebabGalette.addons') }}?type=menu&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #e67e22; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                    <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                    Menu
                                </a>
                            </div>
                        </div>
                        @endforeach
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
                    Personnalisez votre kebab ou galette selon vos préférences et ajoutez-le à votre panier en quelques clics !
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
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
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
window.currentProductType = '{{ $productType }}';

// Store addons data globally so modal can access it
window.currentAddons = @json($addons);

console.log('Addons data loaded:', window.currentAddons);
console.log('Addons data type:', typeof window.currentAddons);
console.log('Addons data keys:', Object.keys(window.currentAddons || {}));


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