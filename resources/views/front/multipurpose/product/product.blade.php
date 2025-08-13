@extends('front.layout')

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
    <section class="menu-categories-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <span>Découvrez notre carte
                            <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                        <h3 class="title">Choisissez parmi nos délicieuses catégories</h3>
                        <p class="text">Explorez notre sélection complète de plats préparés avec des ingrédients frais et de qualité</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card h-100">
                            <div class="category-image">
                                @if (!empty($category->image))
                                    <img class="lazy wow fadeIn" 
                                         data-src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                         data-wow-delay=".3s" 
                                         alt="{{ convertUtf8($category->name) }}">
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
                                            Plats complets servis avec riz, légumes et sauces
                                            @break
                                        @case('Sandwichs')
                                            Délicieux sandwiches et wraps fraîchement préparés
                                            @break
                                        @case('Menus')
                                            Menus complets avec boisson et accompagnement
                                            @break
                                        @case('Salade')
                                            Salades fraîches et équilibrées
                                            @break
                                        @case('Menus Enfant')
                                            Portions adaptées aux plus petits
                                            @break
                                        @case('Nos Box')
                                            Formules repas pratiques et gourmandes
                                            @break
                                        @default
                                            Découvrez nos délicieuses spécialités
                                    @endswitch
                                </p>
                                
                                <div class="category-stats">
                                    <span class="meal-count">
                                        <i class="fas fa-utensils"></i>
                                        {{ $category->products()->where('status', 1)->count() }} plats disponibles
                                    </span>
                                </div>
                                
                                <div class="category-actions">
                                    @if($category->name === 'Sandwichs' || $category->name === 'Menus')
                                        <a href="{{ route('front.sandwiches') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @else
                                        <a href="{{ route('front.items', ['category_id' => $category->id]) }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Section d'information supplémentaire -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="menu-info-card text-center">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h4>Informations importantes</h4>
                        <p>Tous nos plats sont préparés à la commande avec des ingrédients frais et de qualité. 
                           N'hésitez pas à nous demander des informations sur les allergènes ou à personnaliser votre commande.</p>
                        <div class="contact-info">
                            <span><i class="fas fa-phone"></i> Pour toute question : contactez-nous</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== CATÉGORIES DU MENU PART ENDS ======-->

    <style>
        .menu-categories-area {
            background: #f8f9fa;
        }
        
        .category-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .category-image {
            height: 200px;
            overflow: hidden;
            position: relative;
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
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .meal-count i {
            margin-right: 0.5rem;
        }
        
        .category-actions {
            text-align: center;
        }
        
        .view-menu-btn {
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
        
        .view-menu-btn:hover {
            background: linear-gradient(45deg, #e55a2b, #e0851a);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }
        
        .view-menu-btn i {
            margin-right: 0.5rem;
        }
        
        .menu-info-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border: 2px solid #e3f2fd;
        }
        
        .info-icon {
            font-size: 3rem;
            color: #1976d2;
            margin-bottom: 1rem;
        }
        
        .menu-info-card h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        
        .menu-info-card p {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .contact-info {
            color: #1976d2;
            font-weight: 500;
        }
        
        .contact-info i {
            margin-right: 0.5rem;
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
        }
    </style>
@endsection
