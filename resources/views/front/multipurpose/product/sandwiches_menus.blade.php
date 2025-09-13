@extends('front.layout')

@section('page-title', 'Sandwichs & Menus Kebab Halal - King Kebab Le Pouzin | Livraison Ardèche')
@section('meta-description', 'Découvrez nos sandwichs kebab halal et menus complets King Kebab Le Pouzin. Kebab classique, maxi kebab, tacos, burgers halal. Viande grillée charbon, ingrédients frais 100% halal. Livraison Le Pouzin.')
@section('meta-keywords', 'sandwichs kebab halal Le Pouzin, menus kebab complets, kebab classique halal, maxi kebab Le Pouzin, tacos halal Ardèche, burgers halal Le Pouzin, King Kebab sandwichs, livraison kebab Le Pouzin, viande grillée charbon, menu complet halal')
@section('og-title', 'Sandwichs & Menus Kebab Halal - King Kebab Le Pouzin')
@section('og-description', 'Savourez nos délicieux sandwichs kebab halal et menus complets. Viande grillée au charbon, ingrédients frais 100% halal, préparés avec passion depuis 20 ans.')

@section('style')
<style>
/* Enhanced Menu Categories Styles */
.menu-categories-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.menu-categories-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ff6b35" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ff6b35" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ff6b35" opacity="0.05"/><circle cx="10" cy="60" r="0.5" fill="%23ff6b35" opacity="0.05"/><circle cx="90" cy="40" r="0.5" fill="%23ff6b35" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
    z-index: 1;
}

.menu-categories-section .container {
    position: relative;
    z-index: 2;
}

.menu-category-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255, 107, 53, 0.1);
    position: relative;
    height: 100%;
}

.menu-category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(255, 165, 0, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.menu-category-card:hover::before {
    opacity: 1;
}

.menu-category-card:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    border-color: #ff6b35;
}

.card-image {
    height: 220px;
    position: relative;
    overflow: hidden;
    background: linear-gradient(45deg, #ff6b35, #f7931e);
}

.card-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.2) 100%);
    z-index: 1;
}

.card-image > div {
    position: relative;
    z-index: 2;
}

.menu-category-card:hover .card-image::before {
    background: linear-gradient(45deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.3) 100%);
}

.card-content {
    padding: 2rem;
    position: relative;
    z-index: 3;
}

.card-content h4 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 1.2rem;
    text-align: center;
    font-size: 1.5rem;
    line-height: 1.3;
}

.card-content p {
    color: #6c757d;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 1.8rem;
    font-weight: 600;
    line-height: 1.4;
}

.card-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.card-content li {
    padding: 15px 0;
    border-bottom: 1px solid #f1f3f4;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    margin: 0 5px;
}

.card-content li:hover {
    background: rgba(255, 107, 53, 0.08);
    padding-left: 15px;
    padding-right: 15px;
    border-radius: 12px;
    margin: 0 -10px;
    transform: translateX(5px);
}

.card-content li:last-child {
    border-bottom: none;
}

.card-content li span:first-child {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.05rem;
    flex: 1;
    text-align: left;
}

.card-content li span:last-child {
    font-weight: 700;
    font-size: 1.3rem;
    margin-left: 15px;
}

.btn {
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    color: white;
    padding: 15px 35px;
    border-radius: 35px;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    border: none;
    cursor: pointer;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn:hover {
    background: linear-gradient(45deg, #ffa500, #ff6b35);
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 12px 35px rgba(255, 107, 53, 0.5);
    color: white;
    text-decoration: none;
}

.btn i {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.btn:hover i {
    transform: translateX(3px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .menu-categories-section {
        padding: 60px 0;
    }
    
    .menu-category-card {
        margin-bottom: 2rem;
    }
    
    .card-image {
        height: 180px;
    }
    
    .card-content {
        padding: 1.5rem;
    }
    
    .card-content h4 {
        font-size: 1.2rem;
    }
    
    .btn {
        padding: 10px 25px;
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .card-content li {
        flex-direction: column;
        text-align: center;
        gap: 5px;
    }
    
    .card-content li span:last-child {
        font-size: 1rem;
    }
}

/* Animation Enhancements */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.menu-category-card {
    animation: slideInUp 0.6s ease-out;
}

/* Hover Effects */
.menu-category-card:hover .card-image i {
    transform: scale(1.1) rotate(5deg);
    transition: transform 0.3s ease;
}

.menu-category-card:hover .card-image h3 {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

/* Page Title Enhancement */
.page-title-area .title {
    background: linear-gradient(45deg, #2c3e50, #34495e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
    font-size: 2.5rem;
}

/* Enhanced Section Header */
.menu-categories-section .container::before {
    content: '';
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    border-radius: 2px;
    z-index: 3;
}

/* Section Title Enhancement */
.section-title {
    text-align: center;
    margin-bottom: 4rem;
    position: relative;
}

.section-title h2 {
    background: linear-gradient(45deg, #2c3e50, #34495e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
    font-size: 2.8rem;
    margin-bottom: 1rem;
}

.section-title p {
    color: #6c757d;
    font-size: 1.2rem;
    font-weight: 500;
    max-width: 600px;
    margin: 0 auto;
}

/* Enhanced Card Icons */
.card-image i {
    font-size: 5rem;
    margin-bottom: 25px;
    display: block;
    transition: all 0.3s ease;
    text-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

.card-image h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    transition: all 0.3s ease;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

/* Enhanced Hover Effects */
.menu-category-card:hover .card-image i {
    transform: scale(1.2) rotate(10deg);
    filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
}

.menu-category-card:hover .card-image h3 {
    transform: translateY(-8px);
    text-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

/* Enhanced Price Display */
.card-content li span:last-child {
    font-weight: 700;
    font-size: 1.4rem;
    padding: 6px 16px;
    border-radius: 20px;
    background: rgba(255, 107, 53, 0.15);
    transition: all 0.3s ease;
    color: #ff6b35;
    box-shadow: 0 2px 8px rgba(255, 107, 53, 0.2);
    min-width: 80px;
    text-align: center;
}

.menu-category-card:hover .card-content li span:last-child {
    background: rgba(255, 107, 53, 0.25);
    transform: scale(1.08);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
    color: #e55a2b;
}

/* Enhanced Button Styles */
.btn {
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

/* Loading Animation Enhancement */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(60px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.menu-category-card {
    animation: slideInUp 0.8s ease-out;
}

/* Staggered Animation */
.menu-category-card:nth-child(1) { animation-delay: 0.1s; }
.menu-category-card:nth-child(2) { animation-delay: 0.2s; }
.menu-category-card:nth-child(3) { animation-delay: 0.3s; }
.menu-category-card:nth-child(4) { animation-delay: 0.4s; }
.menu-category-card:nth-child(5) { animation-delay: 0.5s; }
.menu-category-card:nth-child(6) { animation-delay: 0.6s; }

/* Enhanced Info Section */
.enhanced-info-section {
    background: white;
    border-radius: 25px;
    padding: 4rem 3rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 107, 53, 0.1);
    position: relative;
    overflow: hidden;
    margin-top: 3rem;
}

.enhanced-info-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
}

.info-icon-wrapper {
    width: 100px;
    height: 100px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
    }
    50% {
        box-shadow: 0 15px 40px rgba(255, 107, 53, 0.5);
        transform: scale(1.05);
    }
    100% {
        box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
    }
}

.info-item {
    padding: 1.5rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    height: 100%;
}

.info-item:hover {
    background: rgba(255, 107, 53, 0.05);
    transform: translateY(-5px);
}

.info-item h5 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.info-item p {
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

/* Enhanced Mobile Responsiveness */
@media (max-width: 768px) {
    .section-title h2 {
        font-size: 2.2rem;
    }
    
    .section-title p {
        font-size: 1rem;
    }
    
    .card-image i {
        font-size: 4rem;
    }
    
    .card-image h3 {
        font-size: 1.6rem;
    }
    
    .card-content h4 {
        font-size: 1.3rem;
    }
    
    .card-content p {
        font-size: 1rem;
    }
    
    .card-content li span:first-child {
        font-size: 1rem;
    }
    
    .card-content li span:last-child {
        font-size: 1.2rem;
    }
    
    .btn {
        padding: 12px 28px;
        font-size: 0.9rem;
    }
    
    .enhanced-info-section {
        padding: 2.5rem 2rem;
    }
    
    .info-icon-wrapper {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .section-title h2 {
        font-size: 1.8rem;
    }
    
    .menu-category-card {
        margin-bottom: 2rem;
    }
    
    .card-image {
        height: 180px;
    }
    
    .card-image i {
        font-size: 3.5rem;
    }
    
    .card-image h3 {
        font-size: 1.4rem;
    }
    
    .card-content {
        padding: 1.5rem;
    }
    
    .card-content h4 {
        font-size: 1.2rem;
    }
    
    .card-content p {
        font-size: 0.95rem;
    }
    
    .card-content li {
        padding: 12px 0;
    }
    
    .card-content li span:first-child {
        font-size: 0.95rem;
    }
    
    .card-content li span:last-child {
        font-size: 1.1rem;
        padding: 4px 12px;
    }
    
    .btn {
        padding: 10px 25px;
        font-size: 0.85rem;
    }
    
    .enhanced-info-section {
        padding: 2rem 1.5rem;
    }
    
    .info-icon-wrapper {
        width: 70px;
        height: 70px;
        font-size: 1.8rem;
    }
    
    .info-item h5 {
        font-size: 1.1rem;
    }
}
</style>
@endsection

@section('content')

<!--====== PAGE TITLE PART START ======--><section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}"><div class="container"><div class="row"><div class="col-lg-12"><div class="page-title-item text-center"><h1 class="title">Sandwichs & Menus Kebab Halal - King Kebab Le Pouzin</h1><nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li><li class="breadcrumb-item active" aria-current="page">Notre Carte</li></ol></nav></div></div></div></div></section><!--====== PAGE TITLE PART ENDS ======-->

<!-- Menu Categories Section -->
<div class="menu-categories-section">
    <div class="container">
        <!-- Section Header -->
        <div class="section-title">
            <h2>Découvrez nos délicieuses catégories</h2>
            <p>Choisissez parmi notre sélection complète de plats préparés avec des ingrédients frais et de qualité</p>
        </div>
        
        <div class="row">
            <!-- Kebab et Galette -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.kebabGalette') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card-image" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                            <div>
                                <i class="fas fa-hamburger"></i>
                                <h3>Kebab & Galette</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Nos Spécialités Kebab</h4>
                            <p>{{ $kebabProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($kebabProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #ff6b35;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Americain et Kofte -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.americainKofte') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card-image" style="background: linear-gradient(45deg, #e74c3c, #c0392b);">
                            <div>
                                <i class="fas fa-hotdog"></i>
                                <h3>Americain & Kofte</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Classiques Américains</h4>
                            <p>{{ $americainProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($americainProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #e74c3c;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn" style="background: linear-gradient(45deg, #e74c3c, #c0392b);">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tacos -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.tacos') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.3s">
                        <div class="card-image" style="background: linear-gradient(45deg, #27ae60, #2ecc71);">
                            <div>
                                <i class="fas fa-utensils"></i>
                                <h3>Tacos</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Tacos Mexicains</h4>
                            <p>{{ $tacosProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($tacosProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #27ae60;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn" style="background: linear-gradient(45deg, #27ae60, #2ecc71);">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Burgers -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.burgers') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card-image" style="background: linear-gradient(45deg, #e67e22, #f39c12);">
                            <div>
                                <i class="fas fa-hamburger"></i>
                                <h3>Burgers</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Burgers Gourmets</h4>
                            <p>{{ $burgersProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($burgersProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #e67e22;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn" style="background: linear-gradient(45deg, #e67e22, #f39c12);">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Panini -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.panini') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.5s">
                        <div class="card-image" style="background: linear-gradient(45deg, #f39c12, #e67e22);">
                            <div>
                                <i class="fas fa-bread-slice"></i>
                                <h3>Panini</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Panini Gourmets</h4>
                            <p>{{ $paniniProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($paniniProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #f39c12;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn" style="background: linear-gradient(45deg, #f39c12, #e67e22);">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Assiettes -->
            <div class="col-lg-4 col-md-6 mb-5">
                <a href="{{ route('front.assiettes') }}" class="card-link">
                    <div class="menu-category-card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card-image" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                            <div>
                                <i class="fas fa-utensils"></i>
                                <h3>Assiettes</h3>
                            </div>
                        </div>
                        <div class="card-content">
                            <h4>Assiettes Complètes</h4>
                            <p>{{ $assiettesProducts->count() }} plats disponibles</p>
                            <ul>
                                @foreach($assiettesProducts as $product)
                                <li>
                                    <span>{{ $product->title }}</span>
                                    <span style="color: #3498db;">{{ number_format($product->current_price, 2, ',', '') }}€</span>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center mt-4">
                                <span class="btn" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                                    <i class="fas fa-eye"></i>
                                    Voir le menu complet
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Additional Info Section -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="enhanced-info-section">
                    <div class="info-icon-wrapper">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-center mb-4">Pourquoi choisir King Kebab Le Pouzin ?</h3>
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="info-item">
                                <i class="fas fa-leaf" style="font-size: 2.5rem; color: #27ae60; margin-bottom: 1rem;"></i>
                                <h5>Ingrédients Frais</h5>
                                <p>Nous utilisons uniquement des ingrédients frais et de qualité supérieure</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="info-item">
                                <i class="fas fa-fire" style="font-size: 2.5rem; color: #e74c3c; margin-bottom: 1rem;"></i>
                                <h5>Grillé au Charbon</h5>
                                <p>Notre viande est grillée au charbon pour un goût authentique et délicieux</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-4">
                            <div class="info-item">
                                <i class="fas fa-truck" style="font-size: 2.5rem; color: #3498db; margin-bottom: 1rem;"></i>
                                <h5>Livraison Rapide</h5>
                                <p>Service de livraison rapide et efficace dans toute la région</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
