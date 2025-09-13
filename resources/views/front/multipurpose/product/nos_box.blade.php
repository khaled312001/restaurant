@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Nos Box</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nos Box</li>
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
<script>window.currentProductType = 'nos_box'; window.currentAddons = @json($addons ?? []);</script>
    <div class="container">
        <div class="row">
            <!-- Full Width Menu -->
            <div class="col-12">
                <!-- Main Box Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #9b59b6; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS BOX
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #9b59b6;">
                            <span style="color: #9b59b6; font-weight: 600; font-size: 1.1rem;">Produit</span>
                            <span style="color: #9b59b6; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #9b59b6; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #9b59b6; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        @if(isset($products) && $products->count() > 0)
                            @foreach($products as $product)
                                <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; {{ !$loop->last ? 'border-bottom: 1px solid rgba(255,255,255,0.2);' : '' }}">
                                    <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">{{ strtoupper($product->title) }}</h4>
                                    <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_seul, 2, ',', '') }}€</span>
                                    <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">{{ number_format($product->price_menu, 2, ',', '') }}€</span>
                                    <div style="text-align: center;">
                                        <a href="{{ route('front.nosBox.addons') }}?type=seul&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #9b59b6; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; margin-bottom: 8px; width: 100%; text-decoration: none;">
                                            <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                            Seul
                                        </a>
                                        <a href="{{ route('front.nosBox.addons') }}?type=menu&product={{ $product->slug }}" class="btn btn-warning btn-sm" style="background: #ba68c8; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease; width: 100%; text-decoration: none;">
                                            <i class="fas fa-cog" style="margin-right: 5px;"></i>
                                            Menu
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center" style="color: white; padding: 40px;">
                                <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.5;"></i>
                                <p style="font-size: 1.1rem; margin: 0;">Aucun produit disponible pour le moment</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Information Section -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #9b59b6; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        INFORMATIONS IMPORTANTES
                    </h2>
                    
                    <div class="info-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; text-align: center;">
                            <i class="fas fa-users" style="font-size: 2.5rem; color: #9b59b6; margin-bottom: 15px; display: block;"></i>
                            <h4 style="color: white; margin-bottom: 10px;">Parfait pour Partager</h4>
                            <p style="color: white; opacity: 0.9; margin: 0; font-size: 0.9rem;">Nos box sont idéales pour partager en famille ou entre amis</p>
                        </div>
                        <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; text-align: center;">
                            <i class="fas fa-clock" style="font-size: 2.5rem; color: #9b59b6; margin-bottom: 15px; display: block;"></i>
                            <h4 style="color: white; margin-bottom: 10px;">Économie de Temps</h4>
                            <p style="color: white; opacity: 0.9; margin: 0; font-size: 0.9rem;">Commandez une box et économisez du temps</p>
                        </div>
                        <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; text-align: center;">
                            <i class="fas fa-percentage" style="font-size: 2.5rem; color: #9b59b6; margin-bottom: 15px; display: block;"></i>
                            <h4 style="color: white; margin-bottom: 10px;">Prix Avantageux</h4>
                            <p style="color: white; opacity: 0.9; margin: 0; font-size: 0.9rem;">Nos box offrent un excellent rapport qualité-prix</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%); text-align: center; color: white;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
            Prêt à commander une box ?
        </h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">
            Commandez maintenant et profitez de nos formules box
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
    background-color: rgba(155, 89, 182, 0.1);
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(155, 89, 182, 0.3);
}

.menu-item:hover h4,
.menu-item:hover span {
    color: #9b59b6 !important;
    text-shadow: 0 0 10px rgba(155, 89, 182, 0.5);
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
// Set global price variable for cart.js
var pprice = 0.00;

function addToCartWithType(url, selectId) {
    const select = document.getElementById(selectId);
    const pieces = parseInt(select.value, 10) || 5;
    
    // Extract product id from url tail
    const matches = url.match(/add-to-cart\/(\d+)/);
    const productId = matches ? parseInt(matches[1], 10) : 0;
    
    // Determine unit price from option label
    const optionText = select.options[select.selectedIndex].text;
    const euroMatch = optionText.match(/([\d]+,[\d]{2})€/);
    let total = 0;
    if (euroMatch) {
        total = parseFloat(euroMatch[1].replace(',', '.'));
    }
    
    // Compose complex id for GET handler: id,,,qty,,,total,,,variant_json,,,addons_json
    const variantJson = encodeURIComponent(JSON.stringify({}));
    const addonsJson = encodeURIComponent(JSON.stringify([]));
    const complexId = `${productId},,,${pieces},,,${total},,,${variantJson},,,${addonsJson}`;
    
    // Call existing addToCart GET route with complex id so backend computes correctly
    window.location.href = '/add-to-cart/' + complexId;
}

function addToCartSimple(url) {
    // Set default price
    pprice = 0.00;
    addToCart(url, [], 1, []);
}
</script>

@endsection 