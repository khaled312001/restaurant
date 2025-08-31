@extends('front.layout')

@section('page-title', 'Notre Carte - King Kebab Le Pouzin | Menu Kebab Halal, Tacos, Burgers')
@section('meta-description', 'Découvrez notre carte complète King Kebab Le Pouzin: 48 plats halal disponibles. Sandwichs kebab, menus complets, tacos, burgers halal, assiettes, menus enfant, salades fraîches. Ingrédients 100% halal.')
@section('meta-keywords', 'menu King Kebab Le Pouzin, carte kebab halal, sandwichs kebab Le Pouzin, menus kebab complets, tacos halal Ardèche, burgers halal Le Pouzin, assiettes kebab, menus enfant halal, salades halal, nos box kebab, panini halal, 48 plats halal, carte restaurant Le Pouzin')
@section('og-title', 'Notre Carte Complète - King Kebab Le Pouzin | 48 Plats Halal Disponibles')
@section('og-description', 'Explorez notre carte de 48 plats halal: sandwichs kebab, menus complets, tacos, burgers, assiettes, menus enfant et salades fraîches. Tous préparés avec des ingrédients frais 100% halal.')

@section('content')
    <!--====== PAGE TITLE PART START ======-->
    <section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title">Notre Carte</h2>
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

    <!--====== HERO SECTION START ======-->
    <section class="hero-section" style="padding: 80px 0; background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="hero-content">
                        <h1 class="hero-title" style="font-size: 3rem; font-weight: 700; margin-bottom: 20px;">
                            Choisissez parmi nos délicieuses catégories King Kebab
                        </h1>
                        <p class="hero-description" style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">
                            Explorez notre sélection complète de <strong>48 plats halal authentiques</strong> préparés avec des ingrédients frais et de qualité supérieure.
                        </p>
                        <div class="hero-stats" style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; display: inline-block;">
                            <span style="font-size: 1.3rem; font-weight: 600; color: #ff6b35;">
                                ✨ 48 plats halal disponibles au total ✨
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== HERO SECTION ENDS ======-->

    <!--====== CATÉGORIES DU MENU PART START ======-->
    <section class="categories-section" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card-enhanced">
                            <div class="category-header">
                                <div class="category-icon">
                                    @switch($category->name)
                                        @case('Sandwichs')
                                            <i class="fas fa-hamburger"></i>
                                            @break
                                        @case('Menus')
                                            <i class="fas fa-utensils"></i>
                                            @break
                                        @case('Assiettes')
                                            <i class="fas fa-plate-wheat"></i>
                                            @break
                                        @case('Salade')
                                            <i class="fas fa-leaf"></i>
                                            @break
                                        @case('Menus Enfant')
                                            <i class="fas fa-child"></i>
                                            @break
                                        @case('Nos Box')
                                            <i class="fas fa-box"></i>
                                            @break
                                        @default
                                            <i class="fas fa-utensils"></i>
                                    @endswitch
                                </div>
                                <div class="category-badge">
                                    @switch($category->name)
                                        @case('Sandwichs')
                                            8 plats
                                            @break
                                        @case('Menus')
                                            22 plats
                                            @break
                                        @case('Assiettes')
                                            2 plats
                                            @break
                                        @case('Menus Enfant')
                                            4 plats
                                            @break
                                        @case('Salade')
                                            4 plats
                                            @break
                                        @case('Nos Box')
                                            4 plats
                                            @break
                                        @default
                                            {{ $category->products()->where('status', 1)->count() }} plats
                                    @endswitch
                                </div>
                            </div>
                            
                            <div class="category-body">
                                <h3 class="category-title">{{ convertUtf8($category->name) }}</h3>
                                <p class="category-description">
                                    @switch($category->name)
                                        @case('Assiettes')
                                            Assiettes kebab halal complètes avec riz basmati, légumes frais et sauces maison authentiques
                                            @break
                                        @case('Sandwichs')
                                            Sandwichs kebab halal et wraps fraîchement préparés avec viande grillée au charbon
                                            @break
                                        @case('Menus')
                                            Menus kebab complets halal avec boisson fraîche et accompagnement de votre choix
                                            @break
                                        @case('Salade')
                                            Salades fraîches et équilibrées avec ingrédients halal de qualité supérieure
                                            @break
                                        @case('Menus Enfant')
                                            Menus enfant halal spécialement conçus pour les plus petits gourmets
                                            @break
                                        @case('Nos Box')
                                            Nos Box King Kebab: formules repas halal pratiques et généreuses
                                            @break
                                        @default
                                            Découvrez nos délicieuses spécialités halal authentiques King Kebab
                                    @endswitch
                                </p>
                                
                                <div class="category-features">
                                    @switch($category->name)
                                        @case('Sandwichs')
                                            <span class="feature-tag">Viande grillée</span>
                                            <span class="feature-tag">Pain frais</span>
                                            @break
                                        @case('Menus')
                                            <span class="feature-tag">Complet</span>
                                            <span class="feature-tag">Boisson incluse</span>
                                            @break
                                        @case('Assiettes')
                                            <span class="feature-tag">Riz basmati</span>
                                            <span class="feature-tag">Légumes frais</span>
                                            @break
                                        @case('Salade')
                                            <span class="feature-tag">Frais</span>
                                            <span class="feature-tag">Équilibré</span>
                                            @break
                                        @case('Menus Enfant')
                                            <span class="feature-tag">Jouet inclus</span>
                                            <span class="feature-tag">Portion adaptée</span>
                                            @break
                                        @case('Nos Box')
                                            <span class="feature-tag">Partage</span>
                                            <span class="feature-tag">Économique</span>
                                            @break
                                        @default
                                            <span class="feature-tag">Halal</span>
                                            <span class="feature-tag">Frais</span>
                                    @endswitch
                                </div>
                            </div>
                            
                            <div class="category-footer">
                                @if($category->name === 'Sandwichs')
                                    <a href="{{ route('front.sandwiches') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @elseif($category->name === 'Menus')
                                    <a href="{{ route('front.menus') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @elseif($category->name === 'Assiettes')
                                    <a href="{{ route('front.assiettes') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @elseif($category->name === 'Menus Enfant')
                                    <a href="{{ route('front.menusEnfant') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @elseif($category->name === 'Salade')
                                    <a href="{{ route('front.salade') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @elseif($category->name === 'Nos Box')
                                    <a href="{{ route('front.nosBox') }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @else
                                    <a href="{{ route('front.product', ['category_id' => $category->id]) }}" class="category-btn">
                                        <i class="fas fa-eye"></i>
                                        Voir le menu
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--====== CATÉGORIES DU MENU PART ENDS ======-->

    <!--====== INFORMATION SECTION START ======-->
    <section class="info-section" style="padding: 80px 0; background: #2c3e50; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="info-card">
                        <div class="info-header text-center">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h2>King Kebab Le Pouzin - Informations importantes</h2>
                        </div>
                        
                        <div class="info-content">
                            <p>Tous nos plats <strong>King Kebab</strong> sont préparés à la commande avec des <strong>ingrédients frais 100% halal</strong> et de qualité supérieure. Notre viande est grillée au charbon pour un goût authentique unique. Depuis 20 ans, nous respectons les traditions culinaires turques tout en garantissant la fraîcheur de nos produits.</p>
                            
                            <div class="info-features">
                                <div class="info-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Ingrédients 100% halal</span>
                                </div>
                                <div class="info-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Viande grillée au charbon</span>
                                </div>
                                <div class="info-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Préparé à la commande</span>
                                </div>
                                <div class="info-feature">
                                    <i class="fas fa-check-circle"></i>
                                    <span>20 ans d'expérience</span>
                                </div>
                            </div>
                            
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <strong>Commandes et renseignements</strong>
                                        <span>+33 0426423743</span>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Heures d'ouverture</strong>
                                        <span>Lun à Ven 9h - 23h</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== INFORMATION SECTION ENDS ======-->

    <!--====== PRODUITS DE LA CATÉGORIE SÉLECTIONNÉE PART START ======-->
    @if(isset($selectedCategory))
        <section class="category-products-area pt-80 pb-80" style="background: white;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center">
                            <span>Menu {{ convertUtf8($selectedCategory->name) }}
                                <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">{{ convertUtf8($selectedCategory->name) }}</h3>
                            <p class="text">Découvrez tous nos délicieux plats de la catégorie {{ convertUtf8($selectedCategory->name) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bouton retour aux catégories -->
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('front.product') }}" class="back-to-categories-btn">
                            <i class="fas fa-arrow-left"></i>
                            Retour aux catégories
                        </a>
                    </div>
                </div>

                <!-- Liste des produits -->
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="product-card-enhanced">
                                <div class="product-image">
                                    @if (!empty($product->feature_image))
                                        <img class="lazy wow fadeIn" 
                                             data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                             data-wow-delay=".3s" 
                                             alt="{{ convertUtf8($product->title) }}">
                                    @else
                                        <div class="product-placeholder">
                                            <i class="flaticon-burger"></i>
                                        </div>
                                    @endif
                                    
                                    @if($product->is_feature)
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Populaire
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="product-content">
                                    <h4 class="product-title">{{ convertUtf8($product->title) }}</h4>
                                    <p class="product-description">
                                        {{ Str::limit(convertUtf8($product->summary), 100) }}
                                    </p>
                                    
                                    <div class="product-details">
                                        <div class="product-price">
                                            <span class="price">{{ $product->current_price }}€</span>
                                            @if($product->previous_price && $product->previous_price > $product->current_price)
                                                <span class="old-price">{{ $product->previous_price }}€</span>
                                            @endif
                                        </div>
                                        
                                        <div class="product-actions">
                                            <a href="{{ route('front.product.details', ['slug' => $product->slug, 'id' => $product->id]) }}" 
                                               class="view-product-btn">
                                                <i class="fas fa-eye"></i>
                                                Voir détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="no-products-message">
                                <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                                <h4>Aucun produit disponible</h4>
                                <p>Il n'y a actuellement aucun produit dans cette catégorie.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="row">
                        <div class="col-12">
                            <div class="pagination-wrapper text-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif
    <!--====== PRODUITS DE LA CATÉGORIE SÉLECTIONNÉE PART ENDS ======-->

    <style>
        /* Hero Section */
        .hero-section {
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        /* Enhanced Category Cards */
        .category-card-enhanced {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .category-card-enhanced:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .category-header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            padding: 30px 25px 20px;
            position: relative;
            color: white;
        }
        
        .category-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }
        
        .category-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.2);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }
        
        .category-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .category-description {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
            flex-grow: 1;
        }
        
        .category-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .feature-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .category-footer {
            padding: 0 25px 25px;
        }
        
        .category-btn {
            display: block;
            width: 100%;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 15px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
        }
        
        .category-btn:hover {
            background: linear-gradient(45deg, #e55a2b, #e0851a);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }
        
        .category-btn i {
            margin-right: 8px;
        }
        
        /* Info Section */
        .info-card {
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .info-header {
            margin-bottom: 30px;
        }
        
        .info-icon {
            font-size: 4rem;
            color: #ff6b35;
            margin-bottom: 20px;
        }
        
        .info-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }
        
        .info-content p {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .info-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .info-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }
        
        .info-feature i {
            color: #27ae60;
            font-size: 1.2rem;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 15px;
        }
        
        .contact-item i {
            font-size: 1.5rem;
            color: #ff6b35;
        }
        
        .contact-item div {
            display: flex;
            flex-direction: column;
        }
        
        .contact-item strong {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .contact-item span {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        /* Enhanced Product Cards */
        .product-card-enhanced {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
        }
        
        .product-card-enhanced:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .product-card-enhanced:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #6c757d;
            font-size: 3rem;
        }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .product-content {
            padding: 25px;
        }
        
        .product-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .product-description {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .product-price {
            text-align: center;
        }
        
        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6b35;
        }
        
        .old-price {
            font-size: 1.1rem;
            color: #6c757d;
            text-decoration: line-through;
            margin-left: 8px;
        }
        
        .product-actions {
            text-align: center;
        }
        
        .view-product-btn {
            display: inline-block;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 12px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.95rem;
        }
        
        .view-product-btn:hover {
            background: linear-gradient(45deg, #e55a2b, #e0851a);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }
        
        .view-product-btn i {
            margin-right: 8px;
        }
        
        /* Back to categories button */
        .back-to-categories-btn {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 15px 25px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        .back-to-categories-btn:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
        }
        
        .back-to-categories-btn i {
            margin-right: 8px;
        }
        
        /* No products message */
        .no-products-message {
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .no-products-message i {
            margin-bottom: 20px;
        }
        
        .no-products-message h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        /* Pagination */
        .pagination-wrapper {
            margin-top: 40px;
        }
        
        .pagination-wrapper .pagination {
            justify-content: center;
        }
        
        .pagination-wrapper .page-link {
            color: #ff6b35;
            border-color: #ff6b35;
            border-radius: 10px;
            margin: 0 5px;
        }
        
        .pagination-wrapper .page-item.active .page-link {
            background-color: #ff6b35;
            border-color: #ff6b35;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem !important;
            }
            
            .hero-description {
                font-size: 1rem !important;
            }
            
            .category-card-enhanced {
                margin-bottom: 30px;
            }
            
            .category-title {
                font-size: 1.3rem;
            }
            
            .info-card {
                padding: 30px 20px;
            }
            
            .info-card h2 {
                font-size: 2rem;
            }
            
            .info-features {
                grid-template-columns: 1fr;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
            
            .product-details {
                flex-direction: column;
                text-align: center;
            }
            
            .product-title {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem !important;
            }
            
            .category-header {
                padding: 25px 20px 15px;
            }
            
            .category-icon {
                font-size: 2.5rem;
            }
            
            .category-body {
                padding: 20px;
            }
            
            .product-content {
                padding: 20px;
            }
        }
    </style>
@endsection
