@extends('front.layout')

@section('page-title', 'King Kebab Le Pouzin - Meilleur Restaurant Kebab Halal Authentique | Tacos, Burgers, Livraison')
@section('meta-description', 'King Kebab Le Pouzin ⭐ Restaurant kebab halal authentique depuis 20 ans. Spécialités: kebab grillé charbon, tacos, burgers halal, menus enfant. Ingrédients frais 100% halal. Livraison rapide Le Pouzin Ardèche.')
@section('meta-keywords', 'King Kebab Le Pouzin, kebab halal Le Pouzin, restaurant turc authentique, tacos Le Pouzin, burger halal Ardèche, livraison kebab Le Pouzin, meilleur kebab Ardèche, viande halal grillée charbon, restaurant halal Le Pouzin, cuisine turque authentique, spécialités orientales, menu enfant halal, assiettes kebab, nos box kebab, salade halal, panini halal, King Kebab Ardèche, kebab authentique depuis 20 ans')
@section('og-title', 'King Kebab Le Pouzin - Restaurant Kebab Halal Authentique depuis 20 ans')
@section('og-description', 'Découvrez King Kebab Le Pouzin, restaurant kebab halal authentique depuis 20 ans. Spécialités turques grillées au charbon, ingrédients frais 100% halal. Livraison disponible.')

@section('style')
<style>
/* Enhanced Category Cards Styles */
.nos-menus-area {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.nos-menus-area::before {
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

.nos-menus-area .container {
    position: relative;
    z-index: 2;
}

.section-badge {
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.total-meals-badge {
    background: white;
    color: #ff6b35;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 600;
    display: inline-block;
    margin-top: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid #ff6b35;
}

.total-meals-badge i {
    margin-right: 8px;
    font-size: 18px;
}

.category-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255, 107, 53, 0.1);
    position: relative;
    height: 100%;
}

.category-card::before {
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

.category-card:hover::before {
    opacity: 1;
}

.category-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: #ff6b35;
}

.category-image {
    height: 220px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.8) 0%, rgba(255, 165, 0, 0.8) 100%);
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}

.category-card:hover .category-overlay {
    opacity: 1;
}

.overlay-content {
    color: white;
    font-size: 2rem;
    animation: bounce 1s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.category-placeholder {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #ff6b35;
    font-size: 4rem;
}

.category-content {
    padding: 2rem;
    position: relative;
    z-index: 3;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.category-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    flex: 1;
}

.category-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.category-description {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    min-height: 3rem;
}

.category-stats {
    text-align: center;
    margin-bottom: 1.5rem;
}

.meal-count {
    background: linear-gradient(45deg, #e3f2fd, #bbdefb);
    color: #1976d2;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-block;
    box-shadow: 0 2px 10px rgba(25, 118, 210, 0.2);
}

.meal-count i {
    margin-right: 6px;
    color: #ff6b35;
}

.category-actions {
    text-align: center;
}

.view-menu-btn {
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    border: none;
    cursor: pointer;
}

.view-menu-btn:hover {
    background: linear-gradient(45deg, #ffa500, #ff6b35);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
    color: white;
    text-decoration: none;
}

.view-menu-btn i {
    font-size: 1rem;
}

/* Enhanced Info Section */
.enhanced-info-section {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 107, 53, 0.1);
    position: relative;
    overflow: hidden;
}

.enhanced-info-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
}

.info-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

/* Testimonial Styles */
.testimonial-area {
    background: #f8f9fa;
    position: relative;
}

.testimonial-area .section-title {
    margin-bottom: 60px;
}

.testimonial-area .section-title span {
    color: #ff6b35;
    font-weight: 600;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
    display: block;
}

.testimonial-area .section-title .title {
    color: #000;
    font-size: 36px;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}

.testimonial-slider {
    position: relative;
}

.single-testimonial {
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    margin: 15px;
    transition: all 0.3s ease;
    position: relative;
}

.single-testimonial:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.single-testimonial::before {
    content: '"';
    font-size: 80px;
    color: #ff6b35;
    position: absolute;
    top: -10px;
    left: 20px;
    font-family: "Playfair Display", serif;
    opacity: 0.3;
}

.testimonial-content p {
    font-size: 16px;
    line-height: 1.8;
    color: #64656a;
    margin-bottom: 25px;
    font-style: italic;
    position: relative;
    z-index: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-thumb {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #ff6b35;
    background: linear-gradient(45deg, #ff6b35, #ffa500);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 18px;
}

.author-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info h5.name {
    font-size: 18px;
    font-weight: 700;
    color: #000;
    margin: 0 0 5px 0;
    font-family: "Playfair Display", serif;
}

.author-info .designation {
    font-size: 14px;
    color: #ff6b35;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 767px) {
    .single-testimonial {
        padding: 30px 20px;
        margin: 10px;
    }
    
    .testimonial-content p {
        font-size: 14px;
        line-height: 1.6;
    }
    
    .author-thumb {
        width: 50px;
        height: 50px;
        font-size: 16px;
    }
    
    .author-info h5.name {
        font-size: 16px;
    }
    
    .author-info .designation {
        font-size: 12px;
    }
    
    .testimonial-area .section-title .title {
        font-size: 24px;
    }
    
    .testimonial-area .section-title span {
        font-size: 16px;
    }
}
</style>
@endsection

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
                                                                            alt="menu" data-wow-delay=".5s">
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
                        <span class="section-badge">Découvrez notre carte
                            <img class="lazy" data-src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                        <h3 class="title">Choisissez parmi nos délicieuses catégories</h3>
                        <p class="text">Explorez notre sélection complète de plats préparés avec des ingrédients frais et de qualité</p>
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
                @foreach ($categories as $index => $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card h-100 wow fadeInUp" data-wow-delay="{{ ($index * 0.1) + 0.2 }}s">
                            <div class="category-image">
                                @if (!empty($category->image))
                                    <img class="lazy" 
                                         data-src="{{ asset('assets/front/img/category/' . $category->image) }}"
                                         alt="{{ convertUtf8($category->name) }}">
                                @else
                                    <div class="category-placeholder">
                                        <i class="flaticon-burger"></i>
                                    </div>
                                @endif
                                <div class="category-overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="category-content">
                                <div class="category-header">
                                    <h4 class="category-title">{{ convertUtf8($category->name) }}</h4>
                                    <div class="category-icon">
                                        @switch($category->name)
                                            @case('Assiettes')
                                                <i class="fas fa-drumstick-bite"></i>
                                                @break
                                            @case('Sandwichs')
                                                <i class="fas fa-hamburger"></i>
                                                @break
                                            @case('Menus')
                                                <i class="fas fa-utensils"></i>
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
                                            @case('Panini')
                                                <i class="fas fa-bread-slice"></i>
                                                @break
                                            @default
                                                <i class="fas fa-utensils"></i>
                                        @endswitch
                                    </div>
                                </div>
                                
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
                                    @if($category->name === 'Sandwichs')
                                        <a href="{{ route('front.sandwiches') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Menus')
                                        <a href="{{ route('front.menus') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Assiettes')
                                        <a href="{{ route('front.assiettes') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Menus Enfant')
                                        <a href="{{ route('front.menusEnfant') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Salade')
                                        <a href="{{ route('front.salade') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Nos Box')
                                        <a href="{{ route('front.nosBox') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @elseif($category->name === 'Panini')
                                        <a href="{{ route('front.panini') }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
                                        </a>
                                    @else
                                        <a href="{{ route('front.product', ['category_id' => $category->id]) }}" class="view-menu-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>Voir le menu</span>
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
    <style>
    /* Testimonial Styles */
    .testimonial-area {
        background: #f8f9fa;
        position: relative;
    }

    .testimonial-area .section-title {
        margin-bottom: 60px;
    }

    .testimonial-area .section-title span {
        color: #ff6b35;
        font-weight: 600;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: block;
    }

    .testimonial-area .section-title .title {
        color: #000;
        font-size: 36px;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    .testimonial-slider {
        position: relative;
    }

    .single-testimonial {
        background: #fff;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin: 15px;
        transition: all 0.3s ease;
        position: relative;
    }

    .single-testimonial:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .single-testimonial::before {
        content: '"';
        font-size: 80px;
        color: #ff6b35;
        position: absolute;
        top: -10px;
        left: 20px;
        font-family: "Playfair Display", serif;
        opacity: 0.3;
    }

    .testimonial-content p {
        font-size: 16px;
        line-height: 1.8;
        color: #64656a;
        margin-bottom: 25px;
        font-style: italic;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .author-thumb {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #ff6b35;
        background: linear-gradient(45deg, #ff6b35, #ffa500);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }

    .author-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h5.name {
        font-size: 18px;
        font-weight: 700;
        color: #000;
        margin: 0 0 5px 0;
        font-family: "Playfair Display", serif;
    }

    .author-info .designation {
        font-size: 14px;
        color: #ff6b35;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Custom Slick Slider Button Styles */
    .testimonial-slider .slick-prev,
    .testimonial-slider .slick-next {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #ff6b35, #ffa500);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }

    .testimonial-slider .slick-prev:hover,
    .testimonial-slider .slick-next:hover {
        background: linear-gradient(45deg, #ffa500, #ff6b35);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
    }

    .testimonial-slider .slick-prev {
        left: -60px;
    }

    .testimonial-slider .slick-next {
        right: -60px;
    }

    .testimonial-slider .slick-prev:before {
        content: "‹";
        font-size: 30px;
        line-height: 1;
    }

    .testimonial-slider .slick-next:before {
        content: "›";
        font-size: 30px;
        line-height: 1;
    }

    /* Responsive Design for Category Cards */
    @media (max-width: 768px) {
        .nos-menus-area {
            padding: 60px 0;
        }
        
        .category-card {
            margin-bottom: 2rem;
        }
        
        .category-image {
            height: 180px;
        }
        
        .category-content {
            padding: 1.5rem;
        }
        
        .category-title {
            font-size: 1.3rem;
        }
        
        .category-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .view-menu-btn {
            padding: 10px 20px;
            font-size: 0.85rem;
        }
        
        .enhanced-info-section {
            padding: 2rem 1.5rem;
        }
        
        .info-icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .section-badge {
            font-size: 12px;
            padding: 6px 15px;
        }
        
        .total-meals-badge {
            font-size: 14px;
            padding: 10px 20px;
        }
        
        .category-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .category-title {
            font-size: 1.2rem;
        }
        
        .category-description {
            font-size: 0.9rem;
            min-height: 2.5rem;
        }
        
        .meal-count {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    }

    /* Animation Enhancements */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .wow.fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Hover Effects for Better UX */
    .category-card:hover .category-icon {
        transform: rotate(360deg);
        transition: transform 0.6s ease;
    }

    .category-card:hover .meal-count {
        background: linear-gradient(45deg, #ff6b35, #ffa500);
        color: white;
        transform: scale(1.05);
    }

    /* Loading Animation */
    .category-card {
        animation: slideInUp 0.6s ease-out;
    }

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

    /* Enhanced Section Title */
    .nos-menus-area .section-title .title {
        background: linear-gradient(45deg, #2c3e50, #34495e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .nos-menus-area .section-title .text {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    /* Gradient Text Effect */
    .gradient-text {
        background: linear-gradient(45deg, #ff6b35, #ffa500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
        content: "›";
        font-size: 30px;
        line-height: 1;
    }

    /* Custom Slick Dots Styles */
    .testimonial-slider .slick-dots {
        bottom: -40px;
        list-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin: 0;
        padding: 0;
    }

    .testimonial-slider .slick-dots li {
        margin: 0;
    }

    .testimonial-slider .slick-dots li button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        border: none;
        font-size: 0;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    /* Custom Pagination Dots Styling */
    .testimonial-slider .slick-dots {
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 40px;
        list-style: none;
        padding: 0;
    }

    .testimonial-slider .slick-dots li {
        display: inline-block;
        margin: 0 5px;
    }

    .testimonial-slider .slick-dots li button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #ff6b35;
        background: transparent;
        color: #ff6b35;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-indent: 0;
        line-height: 1;
    }

    .testimonial-slider .slick-dots li button:hover {
        background: #ff6b35;
        color: white;
        transform: scale(1.1);
    }

    .testimonial-slider .slick-dots li.slick-active button {
        background: #ff6b35;
        color: white;
        transform: scale(1.2);
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }

    .testimonial-slider .slick-dots li button:before {
        display: none;
    }

    @media (max-width: 767px) {
        .single-testimonial {
            padding: 30px 20px;
            margin: 10px;
        }
        
        .testimonial-content p {
            font-size: 14px;
            line-height: 1.6;
        }
        
        .author-thumb {
            width: 50px;
            height: 50px;
            font-size: 16px;
        }
        
        .author-info h5.name {
            font-size: 16px;
        }
        
        .author-info .designation {
            font-size: 12px;
        }
        
        .testimonial-area .section-title .title {
            font-size: 24px;
        }
        
        .testimonial-area .section-title span {
            font-size: 16px;
        }

        .testimonial-slider .slick-prev,
        .testimonial-slider .slick-next {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .testimonial-slider .slick-prev {
            left: -50px;
        }

        .testimonial-slider .slick-next {
            right: -50px;
        }

        .testimonial-slider .slick-dots {
            margin-top: 30px;
            gap: 8px;
        }

        .testimonial-slider .slick-dots li button {
            width: 35px;
            height: 35px;
            font-size: 14px;
        }
    }
    </style>
        <section class="testimonial-area pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <span>Avis de nos clients <img
                                    src="{{ asset('assets/front/img/title-icon.png') }}" alt=""></span>
                            <h3 class="title">Ce que disent nos clients</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="testimonial-slider">
                            <div class="single-testimonial">
                                <div class="testimonial-content">
                                    <p>Le rapport qualité-prix est excellent, surtout pour la quantité généreuse servie. Les portions sont copieuses, et on sent vraiment que les produits utilisés sont de haute qualité. C'est l'endroit idéal pour un repas rapide mais savoureux, que ce soit seul ou entre amis.</p>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <span>EW</span>
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">Emma Watson</h5>
                                            <span class="designation">Cliente fidèle</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="single-testimonial">
                                <div class="testimonial-content">
                                    <p>L'accueil chaleureux et le service impeccable font de chaque visite une expérience agréable. Le personnel est toujours à l'écoute et prêt à conseiller les clients, ce qui rend ce lieu unique et convivial. Sans oublier la qualité exceptionnelle des plats qui me donne envie d'y retourner souvent.</p>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <span>MR</span>
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">Marcos Reus</h5>
                                            <span class="designation">Client régulier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="single-testimonial">
                                <div class="testimonial-content">
                                    <p>Le King Kebab est un véritable joyau culinaire. Chaque bouchée est une explosion de saveurs grâce à des ingrédients frais et une préparation soignée qui respecte la tradition. Je recommande vivement ce restaurant à tous les amateurs de kebab authentique.</p>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <span>RI</span>
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">Rebeca Isabella</h5>
                                            <span class="designation">Gastronome</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="single-testimonial">
                                <div class="testimonial-content">
                                    <p>Ce que j'adore chez King Kebab, c'est la cuisson parfaite de la viande, juteuse et tendre à la fois. Les épices sont bien dosées, ce qui offre un équilibre parfait entre goût relevé et saveur douce. Un vrai régal pour les papilles et un incontournable de la ville.</p>
                                    <div class="testimonial-author">
                                        <div class="author-thumb">
                                            <span>AH</span>
                                        </div>
                                        <div class="author-info">
                                            <h5 class="name">Amelia Hanna</h5>
                                            <span class="designation">Critique culinaire</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <script>
        $(document).ready(function() {
            // Initialize testimonial slider
            if($(".testimonial-slider").length) {
                $(".testimonial-slider").slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    arrows: true,
                    customPaging: function(slider, i) {
                        return '<button type="button" data-role="none">' + (i + 1) + '</button>';
                    },
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        });
        </script>
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

    <style>
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
        
        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
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
    </style>

@endsection