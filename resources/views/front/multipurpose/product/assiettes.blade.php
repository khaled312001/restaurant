@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Nos Assiettes</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('front.sandwiches')}}">Notre Carte</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nos Assiettes</li>
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
                <!-- Main Assiettes Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #3498db; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS ASSIETTES
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #3498db;">
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Plat</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Seul</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Menu</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE KEBAB</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">12,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">15,00€</span>
                            <div style="text-align: center;">
                                <select id="assiette-type-69" class="form-control mb-2" style="background: rgba(255,255,255,0.9); border: none; border-radius: 10px; padding: 5px; font-size: 0.9rem; margin-bottom: 8px;">
                                    <option value="seul">Seul (12,00€)</option>
                                    <option value="menu">Menu (15,00€)</option>
                                </select>
                                <button onclick="addToCartWithType('{{ route('add.cart', 69) }}', 'assiette-type-69')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">ASSIETTE GRILLÉE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">14,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem; text-align: center;">17,00€</span>
                            <div style="text-align: center;">
                                <select id="assiette-type-70" class="form-control mb-2" style="background: rgba(255,255,255,0.9); border: none; border-radius: 10px; padding: 5px; font-size: 0.9rem; margin-bottom: 8px;">
                                    <option value="seul">Seul (14,00€)</option>
                                    <option value="menu">Menu (17,00€)</option>
                                </select>
                                <button onclick="addToCartWithType('{{ route('add.cart', 70) }}', 'assiette-type-70')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Orders Menu -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #3498db; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        SUPPLEMENTS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #3498db;">
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Article</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem;">Prix</span>
                            <span style="color: #3498db; font-weight: 600; font-size: 1.1rem; text-align: center;">Commander</span>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">2,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCartSimple('{{ route('add.cart', 134) }}')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">GRANDE FRITE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">4,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCartSimple('{{ route('add.cart', 135) }}')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">PETITE VIANDE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">5,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCartSimple('{{ route('add.cart', 136) }}')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                        
                        <div class="menu-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; align-items: center; padding: 15px 0;">
                            <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">GRANDE VIANDE</h4>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">10,00€</span>
                            <div style="text-align: center;">
                                <button onclick="addToCartSimple('{{ route('add.cart', 137) }}')" class="btn btn-warning btn-sm" style="background: #3498db; border: none; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; transition: all 0.3s ease;">
                                    <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Food Images -->
            <div class="col-lg-4">
                <div class="food-images" style="position: sticky; top: 20px;">
                    <!-- Assiette Kebab Image -->
                    <div class="food-item" style="margin-bottom: 30px; text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 300px; background: linear-gradient(45deg, #3498db, #2980b9); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden;">
                                <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-utensils" style="font-size: 5rem; color: white; z-index: 2;"></i>
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(52,152,219,0.3), rgba(52,152,219,0.1)); z-index: 1;"></div>
                                </div>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(52,152,219,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Assiette Kebab</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Plat complet avec riz et légumes</p>
                    </div>

                    <!-- Assiette Grillée Image -->
                    <div class="food-item" style="text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 200px; background: linear-gradient(45deg, #e67e22, #d35400); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <i class="fas fa-fire" style="font-size: 4rem; color: white;"></i>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(52,152,219,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Assiette Grillée</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Viandes grillées au choix</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Section -->
<div class="info-section" style="padding: 60px 0; background: #34495e; color: white;">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: #3498db;">
                    Informations importantes
                </h2>
                <div class="info-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 40px;">
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-utensils" style="font-size: 3rem; color: #3498db; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Ingrédients Frais</h4>
                        <p style="opacity: 0.9; margin: 0;">Toutes nos assiettes sont préparées avec des ingrédients frais et de qualité</p>
                    </div>
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-clock" style="font-size: 3rem; color: #3498db; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Préparation Rapide</h4>
                        <p style="opacity: 0.9; margin: 0;">Vos commandes sont préparées rapidement à la demande</p>
                    </div>
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-leaf" style="font-size: 3rem; color: #3498db; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Options Végétariennes</h4>
                        <p style="opacity: 0.9; margin: 0;">Nous proposons des alternatives végétariennes délicieuses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); text-align: center; color: white;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
            Prêt à déguster ?
        </h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">
            Commandez maintenant et profitez de nos délicieuses assiettes
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

.menu-item a:hover .menu-item {
    background-color: rgba(52, 152, 219, 0.1);
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

.menu-item a:hover h4,
.menu-item a:hover span {
    color: #3498db !important;
    text-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
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

function addToCartSimple(url) {
    addToCart(url, [], 1, []);
}
</script>

@endsection 