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

    <!--====== CATÉGORIES DU MENU PART START ======-->
    <section class="nos-menus-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <span>Découvrez notre carte
                            <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                        <h1 class="title">Choisissez parmi nos délicieuses catégories King Kebab</h1>
                        <p class="text">Explorez notre sélection complète de <strong>64 plats halal authentiques</strong> préparés avec des ingrédients frais et de qualité supérieure. Depuis 20 ans, King Kebab Le Pouzin vous propose les meilleures spécialités turques et orientales.</p>
                        <div class="total-count-highlight">
                            <div class="highlight-content">
                                <i class="fas fa-utensils"></i>
                                <span class="count-number">64</span>
                                <span class="count-text">plats halal disponibles au total</span>
                                <i class="fas fa-utensils"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card h-100">
                            @if($category->name === 'Sandwichs')
                                <a href="{{ route('front.sandwiches') }}" class="card-link">
                            @elseif($category->name === 'Menus')
                                <a href="{{ route('front.menus') }}" class="card-link">
                            @elseif($category->name === 'Assiettes')
                                <a href="{{ route('front.assiettes') }}" class="card-link">
                            @elseif($category->name === 'Menus Enfant')
                                <a href="{{ route('front.menusEnfant') }}" class="card-link">
                            @elseif($category->name === 'Salade')
                                <a href="{{ route('front.salade') }}" class="card-link">
                            @elseif($category->name === 'Nos Box')
                                <a href="{{ route('front.nosBox') }}" class="card-link">
                            @else
                                <a href="{{ route('front.product', ['category_id' => $category->id]) }}" class="card-link">
                            @endif
                                <div class="category-image">
                                    @if (!empty($category->image) && file_exists(public_path('assets/front/img/category/' . $category->image)))
                                        <img class="lazy wow fadeIn" 
                                             data-src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                             data-wow-delay=".3s" 
                                             alt="{{ convertUtf8($category->name) }}"
                                             onerror="this.parentElement.innerHTML='<div class=&quot;category-placeholder&quot;><i class=&quot;flaticon-burger&quot;></i></div>'">
                                    @else
                                        <div class="category-placeholder">
                                            <i class="flaticon-burger"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="category-content">
                                    <h4 class="category-title">{{ convertUtf8($category->name) }}</h4>
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
                                    
                                    <div class="category-stats">
                                        <span class="meal-count">
                                            <i class="fas fa-utensils"></i>
                                            @switch($category->name)
                                                @case('Sandwichs')
                                                    22 plats disponibles
                                                    @break
                                                @case('Menus')
                                                    16 plats disponibles
                                                    @break
                                                @case('Assiettes')
                                                    10 plats disponibles
                                                    @break
                                                @case('Menus Enfant')
                                                    4 plats disponibles
                                                    @break
                                                @case('Salade')
                                                    4 plats disponibles
                                                    @break
                                                @case('Nos Box')
                                                    8 plats disponibles
                                                    @break
                                                @case('Panini')
                                                    4 plats disponibles
                                                    @break
                                                @default
                                                    {{ $category->products()->where('status', 1)->count() }} plats disponibles
                                            @endswitch
                                        </span>
                                    </div>
                                    
                                    <div class="category-actions">
                                        <span class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

           
        </div>
    </section>
    <!--====== CATÉGORIES DU MENU PART ENDS ======-->

    <!--====== PRODUITS DE LA CATÉGORIE SÉLECTIONNÉE PART START ======-->
    @if(isset($selectedCategory))
        <section class="category-products-area pt-80 pb-80">
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
                            <div class="product-card h-100">
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
        .nos-menus-area {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }
        
        .nos-menus-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ff6b35" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23f7931e" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%231976d2" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="%231976d2" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="%23ff6b35" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }
        
        .category-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #e9ecef;
            position: relative;
            backdrop-filter: blur(10px);
        }
        
        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }
        
        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }
        
        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 0%, rgba(255, 107, 53, 0.05) 50%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .category-card:hover::before {
            opacity: 1;
        }
        
        .category-image {
            height: 220px;
            overflow: hidden;
            position: relative;
            border-radius: 20px 20px 0 0;
        }
        
        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .category-card:hover .category-image img {
            transform: scale(1.05);
        }
        
        .category-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #6c757d;
            font-size: 3rem;
        }
        
        .category-content {
            padding: 1.5rem;
        }
        
        .category-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            text-align: center;
        }
        
        .category-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            text-align: center;
            min-height: 3rem;
        }
        
        .category-stats {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .meal-count {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1976d2;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(25, 118, 210, 0.2);
            border: 2px solid rgba(25, 118, 210, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .meal-count::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }
        
        .meal-count:hover::before {
            left: 100%;
        }
        
        .meal-count i {
            margin-right: 0.5rem;
        }
        
        .category-actions {
            text-align: center;
        }
        
        .view-menu-btn {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #ff8a65 100%);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        
        .view-menu-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .view-menu-btn:hover {
            background: linear-gradient(135deg, #e55a2b 0%, #e0851a 50%, #ff7043 100%);
            color: white;
            text-decoration: none;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
        }
        
        .view-menu-btn:hover::before {
            left: 100%;
        }
        
        .view-menu-btn i {
            margin-right: 0.5rem;
        }
        
        .total-count-highlight {
            margin: 2rem 0;
            display: flex;
            justify-content: center;
        }
        
        .highlight-content {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #ff8a65 100%);
            color: white;
            padding: 1.5rem 3rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
            border: 3px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: pulse 2s infinite;
        }
        
        .highlight-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 3s infinite;
        }
        
        .count-number {
            font-size: 2rem;
            font-weight: 900;
            margin: 0 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .count-text {
            margin: 0 1rem;
            font-size: 1.1rem;
        }
        
        .highlight-content i {
            font-size: 1.5rem;
            animation: bounce 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .menu-info-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 2px solid #e3f2fd;
        }
        
        .info-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .info-icon {
            font-size: 3rem;
            color: #1976d2;
            margin-right: 1rem;
        }
        
        .info-header h2 {
            color: #2c3e50;
            margin-bottom: 0;
        }
        
        .info-content {
            margin-bottom: 1.5rem;
        }
        
        .main-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .info-features {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            width: calc(50% - 0.75rem); /* Two columns */
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #ff6b35;
            margin-right: 1rem;
        }
        
        .feature-text h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.3rem;
        }
        
        .feature-text p {
            font-size: 0.85rem;
            color: #6c757d;
            line-height: 1.4;
        }
        
        .info-contact {
            border-top: 1px solid #e9ecef;
            padding-top: 1.5rem;
        }
        
        .contact-header h3 {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .contact-header i {
            margin-right: 0.5rem;
        }
        
        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
        }
        
        .contact-item i {
            font-size: 1.5rem;
            color: #1976d2;
            margin-right: 1rem;
        }
        
        .contact-info strong {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .phone-number {
            color: #ff6b35;
            font-weight: 500;
        }
        
        .highlight-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #ff6b35;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .category-card {
                margin-bottom: 2rem;
            }
            
            .category-title {
                font-size: 1.2rem;
            }
            
            .category-description {
                min-height: auto;
            }

            .feature-item {
                width: 100%; /* Full width on small screens */
            }
        }

        /* Styles pour la section des produits de catégorie */
        .category-products-area {
            background: white;
        }

        .back-to-categories-btn {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .back-to-categories-btn:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .back-to-categories-btn i {
            margin-right: 0.5rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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

        .product-card:hover .product-image img {
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
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .product-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            text-align: center;
            min-height: 3rem;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .product-price {
            text-align: center;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ff6b35;
        }

        .old-price {
            font-size: 1rem;
            color: #6c757d;
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        .product-actions {
            text-align: center;
        }

        .view-product-btn {
            display: inline-block;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .view-product-btn:hover {
            background: linear-gradient(45deg, #e55a2b, #e0851a);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .view-product-btn i {
            margin-right: 0.5rem;
        }

        .no-products-message {
            padding: 3rem;
            color: #6c757d;
        }

        .pagination-wrapper {
            margin-top: 2rem;
        }

        .pagination-wrapper .pagination {
            justify-content: center;
        }

        .pagination-wrapper .page-link {
            color: #ff6b35;
            border-color: #ff6b35;
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: #ff6b35;
            border-color: #ff6b35;
        }

        @media (max-width: 768px) {
            .product-details {
                flex-direction: column;
                text-align: center;
            }
            
            .product-title {
                font-size: 1.1rem;
            }
            
            .product-description {
                min-height: auto;
            }
        }
    </style>
@endsection
