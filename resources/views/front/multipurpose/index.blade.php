@extends('front.layout')

@section('page-title', 'King Kebab Le Pouzin - Meilleur Restaurant Kebab Halal Authentique | Tacos, Burgers, Livraison')
@section('meta-description', 'King Kebab Le Pouzin ⭐ Restaurant kebab halal authentique depuis 20 ans. Spécialités: kebab grillé charbon, tacos, burgers halal, menus enfant. Ingrédients frais 100% halal. Livraison rapide Le Pouzin Ardèche.')
@section('meta-keywords', 'King Kebab Le Pouzin, kebab halal Le Pouzin, restaurant turc authentique, tacos Le Pouzin, burger halal Ardèche, livraison kebab Le Pouzin, meilleur kebab Ardèche, viande halal grillée charbon, restaurant halal Le Pouzin, cuisine turque authentique, spécialités orientales, menu enfant halal, assiettes kebab, nos box kebab, salade halal, panini halal, King Kebab Ardèche, kebab authentique depuis 20 ans')
@section('og-title', 'King Kebab Le Pouzin - Restaurant Kebab Halal Authentique depuis 20 ans')
@section('og-description', 'Découvrez King Kebab Le Pouzin, restaurant kebab halal authentique depuis 20 ans. Spécialités turques grillées au charbon, ingrédients frais 100% halal. Livraison disponible.')

@section('content')
    <!--====== HERO SECTION PART START ======-->
    @if ($bs->home_version == 'static')
        @include('front.multipurpose.hero.static')
    @elseif ($bs->home_version == 'slider')
        @include('front.multipurpose.hero.slider')
    @elseif ($bs->home_version == 'video')
        @include('front.multipurpose.hero.video')
    @elseif ($bs->home_version == 'water')
        @include('front.multipurpose.hero.water')
    @elseif ($bs->home_version == 'particles')
        @include('front.multipurpose.hero.particles')
    @elseif ($bs->home_version == 'parallax')
        @include('front.multipurpose.hero.parallax')
    @endif
    <!--====== HERO SECTION PART END ======-->


    <!--====== FREES PART START ======-->

            <div class="fress-area" style="padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        @if ($bs->home_version == 'slider')
                            @if (!empty($be->slider_bottom_img))
                                <div class="fress-thumb text-center mb-90">
                                    <img src="{{ asset('assets/front/img/' . $be->slider_bottom_img) }}" alt="fress">
                                </div>
                            @endif
                        @else
                            @if (!empty($be->hero_bottom_img))
                                <div class="fress-thumb text-center mb-90">
                                    <img src="{{ asset('assets/front/img/' . $be->hero_bottom_img) }}" alt="fress">
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="fress-shape">
            @if ($bs->home_version == 'slider')
                @if (!empty($be->slider_shape_img))
                    <img class="lazy" data-src="{{ asset('assets/front/img/' . $be->slider_shape_img) }}"
                        alt="shape">
                @endif
            @else
                @if (!empty($be->hero_shape_img))
                    <img class="lazy" data-src="{{ asset('assets/front/img/' . $be->hero_shape_img) }}"
                        alt="shape">
                @endif
            @endif
        </div>
    </div>

    <!--====== FREES PART ENDS ======-->

    <!--====== EXPERIENCE PART START ======-->
    @if ($bs->intro_section == 1)
        <section class="experience-area">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-lg-6 col-md-8">
                        <div class="experience-content">
                            @if ($bs->intro_section_title)
                                <div class="flag"><span>{{ convertUtf8($bs->intro_section_title) }}</span></div>
                            @endif
                            <h3 class="title wow fadeIn" data-wow-duration="2000ms" data-wow-delay="0ms">
                                {{ convertUtf8($bs->intro_title) }}</h3>
                            <p class=" wow fadeIns" data-wow-duration="2000ms" data-wow-delay="300ms">
                                {{ convertUtf8($bs->intro_text) }}</p>

                            @if (!empty($bs->intro_signature))
                                <img class="lazy wow fadeIn" data-wow-duration="2000ms" data-wow-delay="600ms"
                                    data-src="{{ asset('assets/front/img/' . $bs->intro_signature) }}" alt="autograph">
                            @endif
                            <i class="flaticon-burger"></i>
                        </div>

                    </div>
                </div>
                <div class="row align-items-end">
                    @if ($bs->intro_contact_text && $bs->intro_contact_number)
                        <div class="col-lg-4 col-md-7">
                            <div class="experience-contact mb-50 wow fadeIn animated" data-wow-duration="2000ms"
                                data-wow-delay="300ms">
                                <span>{{ convertUtf8($bs->intro_contact_text) }}</span>
                                <p>{{ convertUtf8($bs->intro_contact_number) }}</p>
                                <i class="flaticon-phone-call"></i>
                            </div>
                        </div>
                    @endif
                    @if ($bs->intro_video_image && $bs->intro_video_link)
                        <div class="col-lg-1"></div>
                        <div class="col-lg-7">
                            <div class="experience-play-item mt-70">
                                @php
                                    $videobg = str_replace('core', '', base_path()) . '/public/assets/front/img/' . $bs->intro_video_image;
                                    
                                @endphp
                                @if (file_exists($videobg))
                                    <img class="lazy wow fadeIn"
                                        data-src="{{ asset('assets/front/img/' . $bs->intro_video_image) }}"
                                        alt="experience">
                                @endif
                                <div class="experience-overlay">
                                    <a class="video-popup" href="{{ getYouTubeEmbedUrl($bs->intro_video_link) }}" 
                                       data-video-url="{{ $bs->intro_video_link }}"
                                       onclick="return openVideoPopup('{{ getYouTubeEmbedUrl($bs->intro_video_link) }}', '{{ $bs->intro_video_link }}')">
                                        <i class="flaticon-arrow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if ($bs->intro_main_image)
                <div class="experience-bg">
                    <img class="lazy wow fadeIn" data-src="{{ asset('assets/front/img/' . $bs->intro_main_image) }}"
                        alt="experience">
                </div>
            @endif

        </section>
    @endif
    <!--====== EXPERIENCE PART ENDS ======-->

    <!--====== FOOD MENU PART START ======-->
    @if ($bs->menu_section == 1)
        @if ($be->menu_version == 1)
            <section class="food-menu-area food-menu-2-area food-menu-3-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span>{{ convertUtf8($be->menu_section_title) }}
                                    <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}"
                                        alt=""></span>
                                <h3 class="title">{{ convertUtf8($be->menu_section_subtitle) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    @foreach ($categories as $keys => $category)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $keys == 0 ? 'active' : '' }}"
                                                id="{{ $category->slug }}-tab" data-toggle="pill"
                                                href="#{{ $category->slug }}" role="tab"
                                                aria-controls="{{ $category->slug }}" aria-selected="true">
                                                @if (!empty($category->image))
                                                    <img class="lazy wow fadeIn"
                                                        data-src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                                        data-wow-delay=".5s" alt="menu">
                                                @endif
                                                <input type="hidden" value="{{ $category->id }}" class="id">
                                                <p @if (empty($category->image)) style="padding-top: 0px;" @endif>
                                                    {{ convertUtf8($category->name) }}
                                                    ({{ $category->products()->where('is_feature', 1)->count() }})
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($categories as $key => $category)
                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                        id="{{ $category->slug }}" role="tabpanel"
                                        aria-labelledby="{{ $category->slug }}-tab">
                                        
                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*" @if ($category->subcategories()->where('is_feature', 1)->count() == 0) style="display:none;" @endif>{{__('All')}}</button>
                                            @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subcat)
                                                <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                            @endforeach
                                        </div>

                                        <div class="row justify-content-center">

                                            {{-- Loader --}}
                                            <div class="food-items-loader">
                                                <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
                                            </div>
                                            {{-- Loader --}}  
                                            
                                            @if ($category->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                                @foreach ($category->products()->where('is_feature', 1)->where('status', 1)->get() as $product)
                                                    <div class="col-lg-6">
                                                        <div class="food-menu-items">

                                                            <div class="single-menu-item mt-30 sub{{$product->subcategory_id}}">
                                                                <div class="item-details">
                                                                    <div class="menu-thumb">
                                                                        <img class="lazy wow fadeIn"
                                                                            data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                            src="{{ asset('assets/front/img/placeholder.jpg') }}"
                                                                            alt="menu" data-wow-delay=".5s"
                                                                            onerror="this.onerror=null; this.src='{{ asset('assets/front/img/placeholder.jpg') }}'; this.classList.add('placeholder-image');">
                                                                        <div class="thumb-overlay">
                                                                            <a
                                                                                href="{{ route('front.product.details', [$product->slug, $product->id]) }}"><i
                                                                                    class="flaticon-add"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="menu-content ml-30">
                                                                        <a class="title"
                                                                            href="{{ route('front.product.details', [$product->slug, $product->id]) }}">{{ convertUtf8($product->title) }}</a>
                                                                        <p>{{ convertUtf8(strlen($product->summary)) > 70? convertUtf8(substr($product->summary, 0, 70)) . '...': convertUtf8($product->summary) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="menu-price-btn">
                                                                    <a class="cart-link d-md-none d-block btn mobile"
                                                                    data-product="{{ json_encode($product) }}"
                                                                    data-href="{{ route('add.cart', $product->id) }}">+</a>
                                                                    <a class="cart-link d-none d-md-block"
                                                                        data-product="{{ json_encode($product) }}"
                                                                        data-href="{{ route('add.cart', $product->id) }}">{{ __('Add to Cart') }}</a>

                                                                    <span>{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                                                    </span>
                                                                    @if ($product->previous_price)
                                                                        <del>
                                                                            {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</del>
                                                                    @endif
                                                                </div>
                                                                @if ($product->is_special == 1)
                                                                    <div class="flag flag-2">
                                                                        <span>{{ __('Special') }}</span>
                                                                    </div>
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12">
                                                    <div class="menu-more-btn text-center mt-40">
                                                        <a
                                                            href="{{ route('front.items', ['category_id' => $category->id]) }}">{{ __('View All Items') }}</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">{{ __('Product Not Found') }}</h4>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            @if (!empty($be->menu_section_img))
                <style>
                    .food-menu-area .food-menu-items.menu-2::before {
                        background-image: url("{{ asset('assets/front/img/' . $be->menu_section_img) }}");
                    }

                </style>
            @endif
            <section class="food-menu-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <span>{{ convertUtf8($be->menu_section_title) }} <img
                                        src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                                <h3 class="title">{{ convertUtf8($be->menu_section_subtitle) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-btn pb-20">
                                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                    @foreach ($categories as $keys => $category)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $keys == 0 ? 'active' : '' }}"
                                                id="{{ convertUtf8($category->slug) }}-tab" data-toggle="pill"
                                                href="#{{ convertUtf8($category->slug) }}" role="tab"
                                                aria-controls="{{ convertUtf8($category->slug) }}" aria-selected="true">
                                                @if (!empty($category->image))
                                                    <img class="lazy wow fadeIn"
                                                        src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                                        data-wow-delay=".5s" alt="menu">
                                                @endif
                                                <p @if (empty($category->image)) style="padding-top: 0px;" @endif>
                                                    {{ convertUtf8($category->name) }}
                                                    ({{ $category->products()->where('is_feature', 1)->count() }})
                                                </p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pills-tabContent">
                                @foreach ($categories as $key => $category)
                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                        id="{{ convertUtf8($category->slug) }}" role="tabpanel"
                                        aria-labelledby="{{ convertUtf8($category->slug) }}-tab">

                                        <div class="button-group filters-button-group">
                                            <button class="button is-checked" data-filter="*" @if ($category->subcategories()->where('is_feature', 1)->count() == 0) style="display:none;" @endif>{{__('All')}}</button>
                                            @foreach ($category->subcategories()->where('is_feature', 1)->get() as $subcat)
                                                <button class="button" data-filter=".sub{{$subcat->id}}">{{$subcat->name}}</button>
                                            @endforeach
                                        </div>

                                        <div class="food-menu-items menu-2">

                                            {{-- Loader --}}
                                            <div class="food-items-loader">
                                                <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
                                            </div>
                                            {{-- Loader --}}    

                                            @if ($category->products()->where('is_feature', 1)->where('status', 1)->count() > 0)
                                                @foreach ($category->products()->where('is_feature', 1)->where('status', 1)->get()  as $product)
                                                    <div class="single-menu-item mt-30 sub{{$product->subcategory_id}}">
                                                        <div class="menu-thumb">
                                                            <img class="lazy wow fadeIn"
                                                                data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                                data-wow-delay=".5s" alt="menu">
                                                            <div class="thumb-overlay">
                                                                <a
                                                                    href="{{ route('front.product.details', [$product->slug, $product->id]) }}"><i
                                                                        class="flaticon-add"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="menu-content ml-30">
                                                            <a class="title"
                                                                href="{{ route('front.product.details', [$product->slug, $product->id]) }}">{{ convertUtf8($product->title) }}</a>
                                                            <p>{{ convertUtf8(strlen($product->summary)) > 180? convertUtf8(substr($product->summary, 0, 180)) . '...': convertUtf8($product->summary) }}
                                                            </p>
                                                        </div>
                                                        <div class="menu-price-btn menu-2">
                                                            <span>{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                                            </span>
                                                            @if ($product->previous_price)
                                                                <del>
                                                                    {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</del>
                                                            @endif
                                                            <a class="cart-link d-md-none d-block btn mobile"
                                                            data-product="{{ json_encode($product) }}"
                                                            data-href="{{ route('add.cart', $product->id) }}">+</a>
                                                            <a class="cart-link d-none d-md-block"
                                                                data-product="{{ json_encode($product) }}"
                                                                data-href="{{ route('add.cart', $product->id) }}">{{ __('Add to Cart') }}</a>
                                                        </div>
                                                        @if ($product->is_special == 1)
                                                            <div class="flag flag-2"><span>{{ __('Special') }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-lg-12 bg-light py-5 mt-4">
                                                    <h4 class="text-center">{{ __('Product Not Found') }}</h4>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="menu-more-btn text-center mt-75">
                                                    <a
                                                        href="{{ route('front.items', ['category_id' => $category->id]) }}">{{ __('View All Items') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        @endif
    @endif
    <!--====== FOOD MENU PART ENDS ======-->

    <!--====== NOS MENUS SECTION START ======-->
    <section class="nos-menus-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <span>Découvrez notre carte
                            <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                        <h3 class="title">Choisissez parmi nos délicieuses catégories</h3>
                        <p class="text">Explorez notre sélection complète de plats préparés avec des ingrédients frais et de qualité</p>
                        <p class="text" style="font-size: 1.1rem; font-weight: 600; color: #ff6b35; margin-top: 10px;">48 plats disponibles au total</p>
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
                                        @switch($category->name)
                                            @case('Sandwichs')
                                                8 plats disponibles
                                                @break
                                            @case('Menus')
                                                26 plats disponibles
                                                @break
                                            @case('Assiettes')
                                                2 plats disponibles
                                                @break
                                            @case('Menus Enfant')
                                                4 plats disponibles
                                                @break
                                            @case('Salade')
                                                4 plats disponibles
                                                @break
                                            @case('Nos Box')
                                                4 plats disponibles
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
                                    @if($category->name === 'Sandwichs')
                                        <a href="{{ route('front.sandwiches') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Menus')
                                        <a href="{{ route('front.menus') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Assiettes')
                                        <a href="{{ route('front.assiettes') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Menus Enfant')
                                        <a href="{{ route('front.menusEnfant') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Salade')
                                        <a href="{{ route('front.salade') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Nos Box')
                                        <a href="{{ route('front.nosBox') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @elseif($category->name === 'Panini')
                                        <a href="{{ route('front.panini') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            Voir le menu
                                        </a>
                                    @else
                                        <a href="{{ route('front.product', ['category_id' => $category->id]) }}" class="view-menu-btn">
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

            <!-- Section d'information importante -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="enhanced-info-section">
                        <div class="info-header text-center mb-4">
                            <div class="info-icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="info-title">Informations importantes</h3>
                            <div class="info-subtitle">Votre satisfaction est notre priorité</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <h5>Ingrédients Frais</h5>
                                    <p>Tous nos plats sont préparés à la commande avec des ingrédients frais et de qualité supérieure. Nous sélectionnons rigoureusement nos fournisseurs pour garantir la fraîcheur de nos produits.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-allergies"></i>
                                    </div>
                                    <h5>Allergènes & Personnalisation</h5>
                                    <p>Nous prenons très au sérieux les allergies alimentaires. N'hésitez pas à nous demander des informations détaillées sur les allergènes ou à personnaliser votre commande selon vos besoins.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h5>Préparation & Délais</h5>
                                    <p>Nos plats sont préparés à la commande pour garantir fraîcheur et qualité. Les délais de préparation varient selon l'affluence (généralement 10-15 minutes).</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-halal"></i>
                                    </div>
                                    <h5>Certification Halal</h5>
                                    <p>Tous nos produits sont certifiés halal. Nous respectons scrupuleusement les règles d'hygiène et de préparation conformes aux standards halal.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <h5>Spécialités Maison</h5>
                                    <p>Découvrez nos recettes traditionnelles turques transmises de génération en génération. Chaque plat est préparé avec passion et authenticité.</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-card-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <h5>Service Client</h5>
                                    <p>Notre équipe est à votre disposition pour répondre à toutes vos questions. N'hésitez pas à nous contacter pour des demandes spéciales ou des informations complémentaires.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-section text-center mt-4">
                            <div class="contact-info-wrapper">
                                <h5>Besoin d'aide ?</h5>
                                <div class="contact-methods">
                                    <div class="contact-method">
                                        <i class="fas fa-phone"></i>
                                        <span>Appelez-nous</span>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-comments"></i>
                                        <span>Posez vos questions</span>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-heart"></i>
                                        <span>Demandes spéciales</span>
                                    </div>
                                </div>
                                <p class="contact-note">Notre équipe est disponible pour vous accompagner dans le choix de vos plats et répondre à toutes vos demandes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== NOS MENUS SECTION ENDS ======-->

    <!--====== GOOD FOOD PART START ======-->
    @if ($bs->special_section == 1)
        <section class="good-food-area pt-180 pb-120 gray-bg">
            <style>
                .good-food-area::before {
                    background-image: url("{{ asset('assets/front/img/' . $be->special_section_bg) }}");
                }
            </style>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8">
                        <div class="special-items">
                            @foreach ($special_product as $sproduct)
                                <div class="good-food-item white-bg text-center">
                                    <div class="food-shape">
                                        <img class="food-shape-img"
                                            src="{{ asset('assets/front/img/good-food-shape.png') }}" alt="shape">
                                    </div>
                                    <h3 class="title">
                                        {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($sproduct->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                    </h3>
                                    @if (!empty(convertUtf8($sproduct->previous_price)))
                                        <del
                                            class="preprice">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($sproduct->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</del>
                                    @endif
                                    <a class="title"
                                        href="{{ route('front.product.details', [$sproduct->slug, $sproduct->id]) }}">{{ convertUtf8($sproduct->title) }}</a>
                                    <p>{{ convertUtf8(strlen($sproduct->summary)) > 70? convertUtf8(substr($sproduct->summary, 0, 70)) . '...': convertUtf8($sproduct->summary) }}
                                    </p>
                                    <img class="lazy wow fadeIn"
                                        data-src="{{ asset('assets/front/img/product/featured/' . $sproduct->feature_image) }}"
                                        alt="">
                                    <div class="special-btns">
                                        <a class="cart-link" data-product="{{ json_encode($sproduct) }}"
                                            data-href="{{ route('add.cart', $sproduct->id) }}">{{ __('Add to Cart') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== GOOD FOOD PART ENDS ======-->

    <!--====== TESTIMONIAL PART START ======-->
    @if ($bs->testimonial_section == 1)
        <section class="testimonial-area pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{ convertUtf8($be->testimonial_section_title) }} <img
                                    src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">{{ convertUtf8($be->testimonial_section_subtitle) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="testimonial-slider">
                            @foreach ($testimonials as $testimonial)
                                <div class="single-testimonial">
                                    <div class="testimonial-content">
                                        <p>{{ convertUtf8($testimonial->comment) }}</p>
                                        <div class="testimonial-author">
                                            <div class="author-thumb">
                                                <img class="lazy"
                                                    data-src="{{ asset('assets/front/img/testimonial/' . $testimonial->image) }}"
                                                    alt="testimonial">
                                            </div>
                                            <div class="author-info">
                                                <h5 class="name">{{ convertUtf8($testimonial->name) }}</h5>
                                                <span class="designation">{{ convertUtf8($testimonial->designation) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== TESTIMONIAL PART ENDS ======-->

    <!--====== BLOG PART START ======-->
    @if ($bs->blog_section == 1)
        <section class="blog-area pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{ convertUtf8($be->blog_section_title) }} <img
                                    src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">{{ convertUtf8($be->blog_section_subtitle) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog mt-30">
                                <div class="blog-thumb">
                                    <img class="lazy wow fadeIn"
                                        data-src="{{ asset('assets/front/img/blog/' . $blog->main_image) }}"
                                        data-wow-delay=".5s" alt="blog">
                                    <div class="thumb-overlay">
                                        <a href="{{ route('front.blog.details', $blog->slug) }}"><i
                                                class="flaticon-add"></i></a>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span><i class="far fa-calendar-alt"></i>
                                            {{ $blog->created_at->format('d M Y') }}</span>
                                        <span><i class="far fa-user"></i> {{ __('Admin') }}</span>
                                    </div>
                                    <h4 class="title"><a
                                            href="{{ route('front.blog.details', $blog->slug) }}">{{ convertUtf8($blog->title) }}</a>
                                    </h4>
                                    <p>{{ convertUtf8(strlen($blog->content)) > 120? convertUtf8(substr($blog->content, 0, 120)) . '...': convertUtf8($blog->content) }}
                                    </p>
                                    <a class="read-more"
                                        href="{{ route('front.blog.details', $blog->slug) }}">{{ __('Read More') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--====== BLOG PART ENDS ======-->

    <!--====== CONTACT PART START ======-->
    @if ($bs->contact_section == 1)
        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>{{ convertUtf8($be->contact_section_title) }} <img
                                    src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">{{ convertUtf8($be->contact_section_subtitle) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <form action="{{ route('front.contact.send') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="{{ __('Name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="{{ __('Email') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" placeholder="{{ __('Phone') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="subject" placeholder="{{ __('Subject') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" placeholder="{{ __('Message') }}" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit">{{ __('Send Message') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-info">
                            @if ($be->contact_address)
                                <div class="single-contact-info">
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h5 class="title">{{ __('Address') }}</h5>
                                        <p>{{ convertUtf8($be->contact_address) }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($be->contact_phone)
                                <div class="single-contact-info">
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="content">
                                        <h5 class="title">{{ __('Phone') }}</h5>
                                        <p>{{ convertUtf8($be->contact_phone) }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($be->contact_email)
                                <div class="single-contact-info">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="content">
                                        <h5 class="title">{{ __('Email') }}</h5>
                                        <p>{{ convertUtf8($be->contact_email) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== CONTACT PART ENDS ======-->

@endsection