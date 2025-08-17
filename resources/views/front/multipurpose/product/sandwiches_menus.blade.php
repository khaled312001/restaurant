@extends('front.layout')
@section('content')

<!--====== PAGE TITLE PART START ======-->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">Notre Carte - Sandwichs & Menus</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notre Carte</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->



<!-- Menu Categories Section -->
<div class="menu-categories-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Kebab et Galette -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #ff6b35, #f7931e); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-hamburger" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Kebab & Galette</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Nos Spécialités</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Kebab Classique</span>
                                <span style="font-weight: 600; color: #ff6b35;">7.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Maxi Kebab</span>
                                <span style="font-weight: 600; color: #ff6b35;">12.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Galette (Viande au choix)</span>
                                <span style="font-weight: 600; color: #ff6b35;">7.50€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Maxi Galette</span>
                                <span style="font-weight: 600; color: #ff6b35;">12.00€</span>
                            </li>
                        </ul>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('front.kebabGalette') }}" class="btn btn-warning" style="background: #ff6b35; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-eye" style="margin-right: 8px;"></i>
                                Voir le menu complet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Americain et Kofte -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #e74c3c, #c0392b); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-hotdog" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Americain & Kofte</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Classiques Américains</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Americain</span>
                                <span style="font-weight: 600; color: #e74c3c;">7.50€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Kofte</span>
                                <span style="font-weight: 600; color: #e74c3c;">7.50€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Menu Americain</span>
                                <span style="font-weight: 600; color: #e74c3c;">10.50€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Menu Kofte</span>
                                <span style="font-weight: 600; color: #e74c3c;">10.50€</span>
                            </li>
                        </ul>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('front.americainKofte') }}" class="btn btn-danger" style="background: #e74c3c; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-eye" style="margin-right: 8px;"></i>
                                Voir le menu complet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tacos -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #27ae60, #2ecc71); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-utensils" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Tacos</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Tacos Mexicains</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Tacos (1 viande)</span>
                                <span style="font-weight: 600; color: #27ae60;">8.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Tacos Mixte (2 viandes)</span>
                                <span style="font-weight: 600; color: #27ae60;">9.50€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Mega Tacos (1 viande)</span>
                                <span style="font-weight: 600; color: #27ae60;">12.50€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Mega Tacos Mixte</span>
                                <span style="font-weight: 600; color: #27ae60;">14.50€</span>
                            </li>
                        </ul>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('front.tacos') }}" class="btn btn-success" style="background: #27ae60; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-eye" style="margin-right: 8px;"></i>
                                Voir le menu complet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Burgers -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #e67e22, #f39c12); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-hamburger" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Burgers</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Burgers Gourmets</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Cheese Burger</span>
                                <span style="font-weight: 600; color: #e67e22;">5.50€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Double Cheese</span>
                                <span style="font-weight: 600; color: #e67e22;">7.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Chicken</span>
                                <span style="font-weight: 600; color: #e67e22;">5.50€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Veggie Burger</span>
                                <span style="font-weight: 600; color: #e67e22;">4.00€</span>
                            </li>
                        </ul>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('front.burgers') }}" class="btn btn-warning" style="background: #e67e22; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-eye" style="margin-right: 8px;"></i>
                                Voir le menu complet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panini -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #f39c12, #e67e22); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-bread-slice" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Panini</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Panini Gourmets</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Panini 3 fromages</span>
                                <span style="font-weight: 600; color: #f39c12;">7.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Panini viande choix (Kebab-steak-kofté-tenders-cordons-bleus)</span>
                                <span style="font-weight: 600; color: #f39c12;">7.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Menu Panini 3 fromages</span>
                                <span style="font-weight: 600; color: #f39c12;">10.00€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Menu Panini viande choix</span>
                                <span style="font-weight: 600; color: #f39c12;">10.00€</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Assiettes -->
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="menu-category-card" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                    <div class="card-image" style="height: 200px; background: linear-gradient(45deg, #3498db, #2980b9); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                            <i class="fas fa-utensils" style="font-size: 4rem; margin-bottom: 15px; display: block;"></i>
                            <h3 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Assiettes</h3>
                        </div>
                    </div>
                    <div class="card-content" style="padding: 25px;">
                        <h4 style="color: #333; font-weight: 600; margin-bottom: 15px; text-align: center;">Assiettes Complètes</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Assiette Kebab</span>
                                <span style="font-weight: 600; color: #3498db;">12.00€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Assiette Mixte</span>
                                <span style="font-weight: 600; color: #3498db;">13.50€</span>
                            </li>
                            <li style="padding: 8px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between;">
                                <span>Assiette Végétarienne</span>
                                <span style="font-weight: 600; color: #3498db;">11.00€</span>
                            </li>
                            <li style="padding: 8px 0; display: flex; justify-content: space-between;">
                                <span>Assiette Famille</span>
                                <span style="font-weight: 600; color: #3498db;">18.00€</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Section -->
<div class="info-section" style="padding: 60px 0; background: #2c3e50; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: #ecf0f1;">
                    Tous nos plats incluent
                </h2>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 1.1rem;">
                    <li style="padding: 10px 0; border-bottom: 1px solid #34495e;">
                        <i class="fas fa-check-circle" style="color: #27ae60; margin-right: 15px;"></i>
                        Frites fraîches ou riz
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid #34495e;">
                        <i class="fas fa-check-circle" style="color: #27ae60; margin-right: 15px;"></i>
                        Salade fraîche
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid #34495e;">
                        <i class="fas fa-check-circle" style="color: #27ae60; margin-right: 15px;"></i>
                        Sauce au choix
                    </li>
                    <li style="padding: 10px 0;">
                        <i class="fas fa-check-circle" style="color: #27ae60; margin-right: 15px;"></i>
                        Boisson (33cl)
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 text-center">
                <div style="background: rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; backdrop-filter: blur(10px);">
                    <i class="fas fa-gift" style="font-size: 4rem; color: #e74c3c; margin-bottom: 20px; display: block;"></i>
                    <h3 style="font-size: 1.8rem; margin-bottom: 15px;">Offre Spéciale</h3>
                    <p style="font-size: 1.1rem; margin-bottom: 20px; opacity: 0.9;">
                        Commandez 2 menus et obtenez une boisson supplémentaire gratuite !
                    </p>
                    <div style="background: #e74c3c; padding: 15px 30px; border-radius: 25px; display: inline-block;">
                        <span style="font-weight: 600; font-size: 1.2rem;">-20% sur la 2ème boisson</span>
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
            Commandez maintenant et profitez de nos délicieux sandwichs et menus
        </p>
        <a href="{{ route('front.index') }}" class="btn btn-light btn-lg" style="padding: 15px 40px; font-size: 1.1rem; font-weight: 600; border-radius: 30px; text-decoration: none; transition: all 0.3s ease;">
            <i class="fas fa-home" style="margin-right: 10px;"></i>
            Retour à l'accueil
        </a>
    </div>
</div>

<style>
.menu-category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-image {
    position: relative;
}

.card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.1);
    transition: opacity 0.3s ease;
}

.menu-category-card:hover .card-image::before {
    opacity: 0;
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 2rem;
    }
    
    .menu-categories-section {
        padding: 40px 0;
    }
    
    .info-section h2 {
        font-size: 2rem;
    }
}
</style>

@endsection
