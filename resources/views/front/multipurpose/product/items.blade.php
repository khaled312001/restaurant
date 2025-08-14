@extends('front.layout')

@section('content')
    <!--====== PAGE TITLE PART START ======-->
    <section class="page-title-area d-flex align-items-center lazy"
        data-bg="{{ asset('assets/front/img/' . $bs->breadcrumb) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title">{{ convertUtf8($bs->items_title) }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('front.index') }}"><i
                                            class="flaticon-home"></i>{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ convertUtf8($bs->items_title) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== PAGE TITLE PART ENDS ======-->

    <!--====== SHOP BAR PART START ======-->

    <div class="shop-bar-area pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-search mt-30" >
                        <input type="text" placeholder="{{ __('Search Keywords') }}" class="input-search" name="search"
                            value="">
                        <i class="fas fa-search input-search-btn cursor-pointer"></i>
                    </div>
                </div>

                <div class="col-lg-7"></div>

                <div class="col-lg-2">
                    <div class="shop-dropdown mt-30 float-right">
                        <select name="type" id="type_sort" class="form-control">
                            <option value="new" {{ request()->input('type') == 'new' ? 'selected' : '' }}>
                                {{ __('Newest Product') }}</option>
                            <option value="old" {{ request()->input('type') == 'old' ? 'selected' : '' }}>
                                {{ __('Oldest Product') }}</option>
                            <option value="high-to-low"
                                {{ request()->input('type') == 'high-to-low' ? 'selected' : '' }}>
                                {{ __('Price: High To Low') }}</option>
                            <option value="low-to-high"
                                {{ request()->input('type') == 'low-to-high' ? 'selected' : '' }}>
                                {{ __('Price: Low To High') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== SHOP BAR PART ENDS ======-->

    <!--====== PRICING PART START ======-->

    <section class="pricing-area pt-20 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-box shop-category">
                            <div class="sidebar-title">
                                <h4 class="title">{{ __('Category') }}</h4>
                            </div>
                            <div class="category-item">
                                <ul>
                                    <li class="{{ request()->input('category_id') == '' ? 'active-search' : '' }}"><a href="{{ route('front.items') }}" class="cursor-pointer">{{ __('All') }}</a></li>
                                    @foreach ($categories as $category)
                                        <li
                                            class="{{ request()->input('category_id') == $category->id ? 'active-search' : '' }}">
                                            <a href="{{ route('front.items', ['category_id' => $category->id]) }}" class="cursor-pointer">{{ convertUtf8($category->name) }}</a>
                                        </li>
                                        @if ($category->subcategories && request('category_id') == $category->id)
                                            <ul class="subitem">
                                                @foreach ($category->subcategories as $sub)
                                                    <li class="{{ request()->input('subcategory_id') == $sub->id ? 'active-search' : '' }}" >
                                                        <a href="{{ route('front.items', ['category_id' => $category->id, 'subcategory_id' => $sub->id]) }}" class="cursor-pointer">
                                                            <i class="fa fa-angle-right"></i> {{ $sub->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="triggerImageRefresh()" title="Refresh product images">
                                    <i class="fas fa-sync-alt"></i> {{ __('Refresh Images') }}
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" onclick="debugImages()" title="Debug image loading issues">
                                    <i class="fas fa-bug"></i> {{ __('Debug Images') }}
                                </button>
                            </div>
                        </div>

                        <div class="shop-box shop-filter mt-30">
                            <div class="sidebar-title">
                                <h4 class="title">{{ __('Filter Products') }}</h4>
                            </div>
                            <div class="filter-item">
                                <ul class="checkbox_common checkbox_style2">
                                    <li>
                                        <input type="radio" class="review_val" name="review_value"
                                            {{ request()->input('review') == '' ? 'checked' : '' }} id="checkbox4"
                                            value="">
                                        <label for="checkbox4"><span></span> {{ __('Show All') }}</label>
                                    </li>

                                    <li>
                                        <input type="radio" class="review_val" name="review_value" id="checkbox5"
                                            value="4" {{ request()->input('review') == 4 ? 'checked' : '' }}
                                            id="checkbox4" value="all">
                                        <label for="checkbox5"><span></span>4 {{ __('Star and higher') }}</label>
                                    </li>

                                    <li>
                                        <input type="radio" class="review_val" name="review_value" id="checkbox6"
                                            value="3" {{ request()->input('review') == 3 ? 'checked' : '' }}
                                            id="checkbox4" value="all">
                                        <label for="checkbox6"><span></span>3 {{ __('Star and higher') }}</label>
                                    </li>

                                    <li>
                                        <input type="radio" class="review_val" name="review_value" id="checkbox7"
                                            value="2" {{ request()->input('review') == 2 ? 'checked' : '' }}
                                            id="checkbox4" value="all">
                                        <label for="checkbox7"><span></span>2 {{ __('Star and higher') }}</label>
                                    </li>

                                    <li>
                                        <input type="radio" class="review_val" name="review_value" id="checkbox8"
                                            value="1" {{ request()->input('review') == 1 ? 'checked' : '' }}
                                            id="checkbox4" value="all">
                                        <label for="checkbox8"><span></span>1 {{ __('Star and higher') }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="shop-box shop-price mt-30">
                            <div class="sidebar-title">
                                <h4 class="title">{{ __('Filter By Price') }}</h4>
                            </div>
                            <div class="price-item">
                                <div class="price-range-box ">
                                    <form action="#">
                                        <div id="slider-range"></div>
                                        <span>{{__('Price')}}: </span>
                                        <input type="text" name="text" id="amount">
                                        <button class="btn filter-button" type="button">{{ __('Filter') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row justify-content-start">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-pricing text-center mt-30">
                                        @if ($product->is_special == 1)
                                            <div class="flag" dir="ltr">
                                                <span class="text-white" style="color: #fff !important">{{ __('Special') }}</span>
                                            </div>
                                        @endif
                                        <a class="pricing-thumb"
                                            href="{{ route('front.product.details', [$product->slug, $product->id]) }}">
                                            <img class="wow fadeIn"
                                                data-src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                src="{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}"
                                                alt="{{ convertUtf8($product->title) }}" 
                                                data-wow-delay=".5s"
                                                data-product-id="{{ $product->id }}"
                                                onerror="handleImageError(this)"
                                                onload="validateAndLoadImage(this, '{{ asset('assets/front/img/product/featured/' . $product->feature_image) }}')">
                                        </a>
                                        <h3 class="title">
                                            {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->current_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                            @if (convertUtf8($product->previous_price))
                                                <small>
                                                    <del>
                                                        {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : '' }}{{ convertUtf8($product->previous_price) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                                    </del>
                                                </small>
                                            @endif

                                        </h3>
                                        <div class="rate" dir="ltr">

                                            <div class="rating" style="width:{{$product->rating * 20 }}%"></div>
                                        </div>
                                        <a
                                            href="{{ route('front.product.details', [$product->slug, $product->id]) }}"><span>{{ convertUtf8($product->title) }}</span></a>
                                        <p> {{ convertUtf8(strlen($product->summary)) > 48? convertUtf8(substr($product->summary, 0, 48)) . '...': convertUtf8($product->summary) }}
                                        </p>
                                        <a class="main-btn cart-link" data-product="{{ $product }}"
                                            data-href="{{ route('add.cart', $product->id) }}">{{ __('Add To Cart') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12">
                                <div class="bg-light py-5 mt-4">
                                    <h4 class="text-center">{{ __('Product Not Found') }}</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $products->appends(['minprice' => request()->input('minprice'),'maxprice' => request()->input('maxprice'),'category_id' => request()->input('category_id'),'type' => request()->input('type'),'tag' => request()->input('tag'),'review' => request()->input('review')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
    $maxprice = App\Models\Product::max('current_price');
    $minprice = 0;
    @endphp
    <form id="searchForm" class="d-none" action="{{ route('front.items') }}" method="get">
        <input type="hidden" id="search" name="search"
            value="{{ !empty(request()->input('search')) ? request()->input('search') : '' }}">
        <input type="hidden" id="minprice" name="minprice"
            value="{{ !empty(request()->input('minprice')) ? request()->input('minprice') : $minprice }}">
        <input type="hidden" id="maxprice" name="maxprice"
            value="{{ !empty(request()->input('maxprice')) ? request()->input('maxprice') : $maxprice }}">
        <input type="hidden" name="category_id" id="category_id"
            value="{{ !empty(request()->input('category_id')) ? request()->input('category_id') : null }}">

        <input type="hidden" name="subcategory_id" id="subcategory_id"
            value="{{ !empty(request()->input('subcategory_id')) ? request()->input('subcategory_id') : null }}">

        <input type="hidden" name="type" id="type"
            value="{{ !empty(request()->input('type')) ? request()->input('type') : 'new' }}">

        <input type="hidden" name="review" id="review"
            value="{{ !empty(request()->input('review')) ? request()->input('review') : '' }}">
        <button id="search-button" type="submit"></button>
    </form>

    <!--====== PRICING PART ENDS ======-->

    <!--====== SHOP BAR PART END ======-->


    {{-- Variation Modal Starts --}}
    @include('front.partials.variation-modal')
    {{-- Variation Modal Ends --}}
@endsection


@section('script')
    <script>
        "use strict";
        var position = "{{ $be->base_currency_symbol_position }}";
        var symbol = "{{ $be->base_currency_symbol }}";
        var sliderMinPrice = '{{ !empty(request()->input('minprice')) ? request()->input('minprice') : $minprice }}';
        var sliderMaxPrice = '{{ !empty(request()->input('maxprice')) ? request()->input('maxprice') : $maxprice }}';
        var sliderInitMax = '{{ $maxprice }}';
        
        // Function to handle image loading errors
        function handleImageError(img) {
            console.log('Image error for product:', img.dataset.productId);
            // Try to load the actual image from data-src first
            if (img.dataset.src && img.dataset.src !== img.src) {
                img.src = img.dataset.src;
                return;
            }
            // If that fails, use placeholder
            img.src = '{{ asset("assets/front/img/placeholder.jpg") }}';
            img.classList.add('placeholder-image');
        }
        
        // Function to validate and load images properly
        function validateAndLoadImage(img, originalSrc) {
            console.log('Validating image for product:', img.dataset.productId, 'Original src:', originalSrc);
            
            // Check if image is valid
            if (img.naturalWidth < 100 || img.naturalHeight < 100) {
                console.log('Image too small, using placeholder for product:', img.dataset.productId);
                img.src = '{{ asset("assets/front/img/placeholder.jpg") }}';
                img.classList.add('placeholder-image');
                return;
            }
            
            // If image is valid, remove placeholder styling and ensure correct src
            img.classList.remove('placeholder-image');
            if (img.src !== originalSrc) {
                img.src = originalSrc;
            }
            console.log('Image loaded successfully for product:', img.dataset.productId, 'Dimensions:', img.naturalWidth, 'x', img.naturalHeight);
        }
        
        // Function to refresh images for a specific product
        function refreshProductImage(productId, newImagePath) {
            const img = document.querySelector(`img[data-product-id="${productId}"]`);
            if (img) {
                img.src = newImagePath;
                img.classList.remove('placeholder-image');
                console.log('Image refreshed for product:', productId);
            }
        }
        
        // Check all images on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, checking images...');
            const images = document.querySelectorAll('.pricing-thumb img');
            console.log('Found', images.length, 'images to check');
            
            images.forEach(function(img, index) {
                console.log(`Image ${index + 1}:`, {
                    productId: img.dataset.productId,
                    src: img.src,
                    dataSrc: img.dataset.src,
                    naturalWidth: img.naturalWidth,
                    naturalHeight: img.naturalHeight
                });
                
                if (img.complete) {
                    validateAndLoadImage(img, img.dataset.src);
                } else {
                    img.addEventListener('load', function() {
                        validateAndLoadImage(this, this.dataset.src);
                    });
                }
                img.addEventListener('error', function() {
                    handleImageError(this);
                });
            });
            
            // Force check images after a short delay
            setTimeout(function() {
                console.log('Delayed image check...');
                images.forEach(function(img) {
                    validateAndLoadImage(img, img.dataset.src);
                });
            }, 1000);
        });
        
        // Listen for image updates (useful for admin updates)
        if (typeof EventSource !== 'undefined') {
            // This could be used to listen for real-time image updates
            console.log('EventSource available for real-time updates');
        }
        
        // Global function to refresh product images (can be called from admin panel)
        window.refreshProductImages = function() {
            console.log('Refreshing all product images...');
            const images = document.querySelectorAll('.pricing-thumb img');
            images.forEach(function(img) {
                const originalSrc = img.dataset.src;
                if (originalSrc) {
                    // Force reload the image
                    img.src = originalSrc + '?t=' + new Date().getTime();
                    img.classList.remove('placeholder-image');
                }
            });
        };
        
        // Function to refresh a specific product image
        window.refreshSpecificProductImage = function(productId) {
            const img = document.querySelector(`img[data-product-id="${productId}"]`);
            if (img) {
                const originalSrc = img.dataset.src;
                if (originalSrc) {
                    img.src = originalSrc + '?t=' + new Date().getTime();
                    img.classList.remove('placeholder-image');
                    console.log('Refreshed image for product:', productId);
                }
            }
        };

        // Function to manually trigger image refresh (can be called from admin panel)
        window.triggerImageRefresh = function() {
            console.log('Manual image refresh triggered');
            refreshAllProductImages();
            
            // Show success message
            if (typeof showNotification === 'function') {
                showNotification('Images refreshed successfully!', 'success');
            } else {
                alert('Images refreshed successfully!');
            }
        };
        
        // Function to debug image loading issues
        window.debugImages = function() {
            console.log('=== IMAGE DEBUG INFO ===');
            const images = document.querySelectorAll('.pricing-thumb img');
            console.log('Total images found:', images.length);
            
            images.forEach(function(img, index) {
                const info = {
                    index: index + 1,
                    productId: img.dataset.productId,
                    src: img.src,
                    dataSrc: img.dataset.src,
                    naturalWidth: img.naturalWidth,
                    naturalHeight: img.naturalHeight,
                    complete: img.complete,
                    hasError: img.classList.contains('placeholder-image')
                };
                console.log(`Image ${index + 1}:`, info);
                
                // Check if image file exists
                fetch(img.src, { method: 'HEAD' })
                    .then(response => {
                        console.log(`Image ${index + 1} fetch result:`, response.status, response.statusText);
                    })
                    .catch(error => {
                        console.error(`Image ${index + 1} fetch error:`, error);
                    });
            });
            
            // Check browser console for any errors
            console.log('Check browser console for any image loading errors');
        };
    </script>
    <script src="{{ asset('assets/front/js/items.js') }}"></script>
    <script src="{{ asset('assets/front/js/image-refresh-helper.js') }}"></script>
@endsection

<style>
.placeholder-image {
    opacity: 0.7;
    filter: grayscale(100%);
}
.pricing-thumb img {
    max-width: 100%;
    height: auto;
    min-height: 200px;
    object-fit: cover;
    transition: all 0.3s ease;
}
.pricing-thumb img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.pricing-thumb {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}
.pricing-thumb::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}
.pricing-thumb:hover::before {
    opacity: 1;
}
.image-loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}
@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>
