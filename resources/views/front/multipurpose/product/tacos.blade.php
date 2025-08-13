@extends('front.layout')
@section('content')

<!-- Page Header -->
<div class="page-header" style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); padding: 60px 0; text-align: center; color: white;">
    <div class="container">
        <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            NOS TACOS
        </h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin: 0;">
            Découvrez nos délicieux tacos préparés avec des ingrédients frais
        </p>
    </div>
</div>

<!-- Menu Section -->
<div class="menu-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Side - Menu Items -->
            <div class="col-lg-8">
                <!-- Tacos Section -->
                <div class="menu-category" style="background: #2c3e50; border-radius: 20px; padding: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h2 style="color: #f39c12; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center;">
                        NOS TACOS
                    </h2>
                    
                    <div class="menu-table" style="background: rgba(255,255,255,0.1); border-radius: 15px; padding: 20px;">
                        <div class="table-header" style="display: flex; justify-content: space-between; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #f39c12;">
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">Plat</span>
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">Seul</span>
                            <span style="color: #f39c12; font-weight: 600; font-size: 1.1rem;">Menu</span>
                        </div>
                        
                        <div class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div>
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">TACOS</h4>
                                <p style="color: #bdc3c7; margin: 5px 0 0 0; font-size: 0.9rem;">1 VIANDE AU CHOIX</p>
                            </div>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">8,00€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">11,00€</span>
                        </div>
                        
                        <div class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div>
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">TACOS MIXTE</h4>
                                <p style="color: #bdc3c7; margin: 5px 0 0 0; font-size: 0.9rem;">2 VIANDES AU CHOIX</p>
                            </div>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">9,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">12,50€</span>
                        </div>
                        
                        <div class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <div>
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">MEGA TACOS</h4>
                                <p style="color: #bdc3c7; margin: 5px 0 0 0; font-size: 0.9rem;">1 VIANDE AU CHOIX</p>
                            </div>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">12,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">15,50€</span>
                        </div>
                        
                        <div class="menu-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0;">
                            <div>
                                <h4 style="color: white; font-weight: 600; margin: 0; font-size: 1.1rem;">MEGA TACOS MIXTE</h4>
                                <p style="color: #bdc3c7; margin: 5px 0 0 0; font-size: 0.9rem;">2 VIANDES AU CHOIX</p>
                            </div>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">14,50€</span>
                            <span style="color: white; font-weight: 600; font-size: 1.2rem;">17,50€</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Food Images -->
            <div class="col-lg-4">
                <div class="food-images" style="position: sticky; top: 20px;">
                    <!-- Tacos Images -->
                    <div class="food-item" style="margin-bottom: 30px; text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 200px; background: linear-gradient(45deg, #e67e22, #f39c12); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <i class="fas fa-utensils" style="font-size: 4rem; color: white;"></i>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(255,193,7,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Tacos Mexicains</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Frais et délicieux</p>
                    </div>

                    <div class="food-item" style="margin-bottom: 30px; text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 200px; background: linear-gradient(45deg, #e67e22, #f39c12); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <i class="fas fa-utensils" style="font-size: 4rem; color: white;"></i>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(255,193,7,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Tacos Garnis</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Ingrédients frais</p>
                    </div>

                    <div class="food-item" style="margin-bottom: 30px; text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 200px; background: linear-gradient(45deg, #e67e22, #f39c12); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <i class="fas fa-utensils" style="font-size: 4rem; color: white;"></i>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(255,193,7,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Mega Tacos</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">Portions généreuses</p>
                    </div>

                    <div class="food-item" style="text-align: center;">
                        <div class="image-container" style="position: relative; margin-bottom: 20px;">
                            <div class="food-image" style="width: 100%; height: 200px; background: linear-gradient(45deg, #e67e22, #f39c12); border-radius: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <i class="fas fa-utensils" style="font-size: 4rem; color: white;"></i>
                            </div>
                            <div class="glow-effect" style="position: absolute; top: -10px; left: -10px; right: -10px; bottom: -10px; background: radial-gradient(circle, rgba(255,193,7,0.3) 0%, transparent 70%); border-radius: 25px; z-index: -1;"></div>
                        </div>
                        <h4 style="color: #2c3e50; font-weight: 600; margin: 0;">Tacos Mixte</h4>
                        <p style="color: #7f8c8d; margin: 5px 0 0 0; font-size: 0.9rem;">2 viandes au choix</p>
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
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: #f39c12;">
                    Informations importantes
                </h2>
                <div class="info-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 40px;">
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-utensils" style="font-size: 3rem; color: #f39c12; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Ingrédients Frais</h4>
                        <p style="opacity: 0.9; margin: 0;">Tous nos tacos sont préparés avec des ingrédients frais et de qualité</p>
                    </div>
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-clock" style="font-size: 3rem; color: #f39c12; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Préparation Rapide</h4>
                        <p style="opacity: 0.9; margin: 0;">Vos commandes sont préparées rapidement à la demande</p>
                    </div>
                    <div class="info-item" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 15px; backdrop-filter: blur(10px);">
                        <i class="fas fa-leaf" style="font-size: 3rem; color: #f39c12; margin-bottom: 15px; display: block;"></i>
                        <h4 style="margin-bottom: 10px;">Options Végétariennes</h4>
                        <p style="opacity: 0.9; margin: 0;">Nous proposons des alternatives végétariennes délicieuses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); text-align: center; color: white;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px;">
            Prêt à déguster ?
        </h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">
            Commandez maintenant et profitez de nos délicieux tacos
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
    transition: background-color 0.3s ease;
}

.menu-item:hover {
    background-color: rgba(255,255,255,0.05);
    border-radius: 10px;
    padding-left: 15px;
    padding-right: 15px;
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

@endsection

