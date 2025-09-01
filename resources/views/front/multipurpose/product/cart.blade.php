@extends('front.layout')

@section('pagename')
 -
 {{__('Product')}}
@endsection


@section('styles')
<link rel="stylesheet" href="{{asset('assets/front/css/jquery-ui.min.css')}}">
@endsection


@section('content')


  <section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/' . $bs->breadcrumb)}}" style="background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">{{convertUtf8($bs->cart_title)}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{convertUtf8($bs->cart_title)}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->

<!--====== SHOPPING CART PART START ======-->

<section class="cart-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div id="refreshDiv">
                    @if($cart != null)
                        <!-- Debug: Show cart contents -->
                        @if(config('app.debug'))
                            <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 15px; margin-bottom: 20px; font-family: monospace; font-size: 12px;">
                                <strong>Debug - Cart Contents:</strong><br>
                                <pre>{{ print_r($cart, true) }}</pre>
                            </div>
                        @endif
                        
                        <ul class="total-item-info">
                            @php
                                $cartTotal = 0;
                                $countitem = 0;
                                if($cart){
                                foreach($cart as $p){
                                    if (isset($p['total']) && is_numeric($p['total'])) {
                                        $cartTotal += (float)$p['total'];
                                    }
                                    if (isset($p['qty']) && is_numeric($p['qty'])) {
                                        $countitem += (int)$p['qty'];
                                    }
                                }
                            }
                            @endphp
                            <li><span>{{__('Your Cart')}}:</span> <span class="cart-item-view">{{$cart ? $countitem : 0}}</span> {{__('Items')}}</li>
                            <li style="direction: ltr;"><span>{{__('Total')}} :</span> {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span class="cart-total-view">{{$cartTotal}}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</li>
                        </ul>

                    @endif
                    <div class="table-outer">
                        @if($cart != null)
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th>{{__('Product Title')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th class="price">{{__('Price')}}</th>
                                    <th>{{__('Total')}}</th>
                                    <th>{{__('Remove')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart as $key => $item)
                                @php
                                    $id = $item["id"];
                                    $product = App\Models\Product::findOrFail($id);
                                @endphp
                                <tr class="remove{{$id}}">
                                    <td>
                                        <div class="title">
                                            <a target="_blank" href="{{route('front.product.details',[$product->slug,$product->id])}}">
                                                <h5 class="prod-title">{{convertUtf8($item['name'])}}</h5>
                                            </a>
                                            @if (!empty($item["variations"]))
                                                <p><strong>{{__("Variation")}}:</strong> <br>
                                                    @php
                                                        $variations = $item["variations"];
                                                    @endphp
                                                    @foreach ($variations as $vKey => $variation)
                                                        <span class="text-capitalize">{{str_replace("_"," ",$vKey)}}:</span> {{$variation["name"]}}
                                                        @if (!$loop->last)
                                                        ,
                                                        @endif
                                                    @endforeach    
                                                </p>
                                            @endif
                                            @if (!empty($item["addons"]))
                                                <p>
                                                    <strong>{{__("Add On's")}}:</strong><br>
                                                    @php
                                                        $addons = $item["addons"];
                                                    @endphp
                                                    @foreach ($addons as $addon)
                                                        {{$addon["name"]}}
                                                        @if (!$loop->last)
                                                        ,
                                                        @endif
                                                    @endforeach
                                                </p>
                                            @endif
                                            @if (!empty($item["customizations"]))
                                                <div class="customizations-display" style="margin-top: 10px;">
                                                    <strong style="color: #f39c12; font-size: 0.9rem;">{{__("Customizations")}}:</strong>
                                                    <div class="customization-items" style="margin-top: 8px;">
                                                        @php
                                                            $customizations = $item["customizations"];
                                                            if (is_string($customizations)) {
                                                                $customizations = json_decode($customizations, true);
                                                            }
                                                        @endphp
                                                        @if (is_array($customizations))
                                                            @if (!empty($customizations['meatChoice']))
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-drumstick-bite" style="margin-right: 5px;"></i>
                                                                    {{__("Meat")}}: {{ucfirst($customizations['meatChoice'])}}
                                                                </div>
                                                            @endif
                                                            @if (!empty($customizations['vegetables']) && is_array($customizations['vegetables']))
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #27ae60, #2ecc71); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-leaf" style="margin-right: 5px;"></i>
                                                                    {{__("Vegetables")}}: 
                                                                    @foreach ($customizations['vegetables'] as $veg)
                                                                        @if ($veg === 'no-vegetables')
                                                                            {{__("No Vegetables")}}
                                                                        @else
                                                                            {{ucfirst(str_replace('-', ' ', $veg))}}
                                                                        @endif
                                                                        @if (!$loop->last), @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            @if (!empty($customizations['drinkChoice']))
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #3498db, #2980b9); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-glass-whiskey" style="margin-right: 5px;"></i>
                                                                    {{__("Drink")}}: {{ucfirst(str_replace('-', ' ', $customizations['drinkChoice']))}}
                                                                </div>
                                                            @endif
                                                            @if (!empty($customizations['sauces']) && is_array($customizations['sauces']))
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #f39c12, #e67e22); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-tint" style="margin-right: 5px;"></i>
                                                                    {{__("Sauces")}}: 
                                                                    @foreach ($customizations['sauces'] as $sauce)
                                                                        {{ucfirst(str_replace('-', ' ', $sauce))}}
                                                                        @if (!$loop->last), @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif (!empty($item["customization_id"]))
                                                <!-- Display customizations from database -->
                                                @php
                                                    $customization = \App\Models\Customization::find($item["customization_id"]);
                                                @endphp
                                                @if($customization)
                                                    <div class="customizations-display" style="margin-top: 10px;">
                                                        <strong style="color: #f39c12; font-size: 0.9rem;">{{__("Customizations")}}:</strong>
                                                        <div class="customization-items" style="margin-top: 8px;">
                                                            @if($customization->meat_choice)
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-drumstick-bite" style="margin-right: 5px;"></i>
                                                                    {{__("Meat")}}: {{ucfirst($customization->meat_choice)}}
                                                                </div>
                                                            @endif
                                                            @if($customization->vegetables && count($customization->vegetables) > 0)
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #27ae60, #2ecc71); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-leaf" style="margin-right: 5px;"></i>
                                                                    {{__("Vegetables")}}: {{$customization->vegetables_text}}
                                                                </div>
                                                            @endif
                                                            @if($customization->drink_choice)
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #3498db, #2980b9); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-glass-whiskey" style="margin-right: 5px;"></i>
                                                                    {{__("Drink")}}: {{$customization->drink_text}}
                                                                </div>
                                                            @endif
                                                            @if($customization->sauces && count($customization->sauces) > 0)
                                                                <div class="customization-badge" style="display: inline-block; background: linear-gradient(45deg, #f39c12, #e67e22); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; margin: 2px 4px; font-weight: 600;">
                                                                    <i class="fas fa-tint" style="margin-right: 5px;"></i>
                                                                    {{__("Sauces")}}: {{$customization->sauces_text}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <!-- Debug: Show when no customizations -->
                                                <div style="margin-top: 10px; color: #999; font-size: 0.8rem;">
                                                    <em>No customizations found for this item</em>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="qty">
                                        <div class="product-quantity d-flex" id="quantity">
                                            <button type="button" id="sub" class="sub">-</button>
                                            <input type="text" class="cart_qty" id="1" value="{{$item['qty']}}" />
                                            <button type="button" id="add" class="add">+</button>
                                        </div>
                                    </td>
                                    <input type="hidden" value="{{$id}}" class="product_id">
                                    <td class="price cart_price">
                                        <p>
                                            <strong>{{__("Product")}}:</strong>
                                            {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}<span>{{$item['product_price'] * $item["qty"]}}</span>{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                        </p>
                                        @if (!empty($item['variations']))
                                            <p>

                                                <strong>{{__("Variation")}}: </strong>
                                                @php
                                                    $variations = $item['variations'];
                                                    $price = 0;
                                                    foreach ($variations as $vKey => $variation) {
                                                        if (is_array($variation) && array_key_exists('price', $variation)) {
                                                            $price += $variation['price'];
                                                        }
                                                    }
                                                @endphp
                                                {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}<span>{{$price * $item["qty"]}}</span>{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </p>
                                        @endif
                                        @if (!empty($item['addons']))
                                            <p>
                                                <strong>{{__("Add On's")}}: </strong>
                                                @php
                                                    $addons = $item['addons'];
                                                    $addonTotal = 0;
                                                    foreach ($addons as $addon) {
                                                        $addonTotal += $addon["price"];
                                                    }
                                                @endphp
                                                {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}<span>{{$addonTotal * $item["qty"]}}</span>{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="sub-total">
                                        {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{$item['total']}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                    </td>
                                    <td>
                                        <div class="remove">
                                            <div class="checkbox">
                                            <span class="fas fa-times item-remove" data-href="{{route('cart.item.remove',$key)}}"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @else
                            <div class="bg-light py-5 text-center">
                                <h3 class="text-uppercase">{{__('Cart is empty!')}}</h3>
                            </div>
                        @endif
                    </div>
                    @if ($cart != null)
                        <div class="row cart-middle">
                            <div class="col-lg-6 offset-lg-6 col-sm-12">
                                <div class="update-cart float-right d-inline-block ml-4">
                                    <a class="main-btn main-btn-2 proceed-checkout-btn" href="{{route('front.checkout')}}"><span>{{__('Checkout')}}</span></a>
                                </div>
                                <div class="update-cart float-right d-inline-block">
                                    <button class="main-btn main-btn-2" id="cartUpdate" data-href="{{route('cart.update')}}" type="button"><span>{{__('Update Cart')}}</span></button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<!--====== SHOPPING CART PART ENDS ======-->

@endsection


@section('scripts')
<script>
    "use strict";
    var symbol = "{{$be->base_currency_symbol}}";
    var position = "{{$be->base_currency_symbol_position}}";
    
    // Function to handle image loading errors
    function handleImageError(img) {
        if (img.naturalWidth < 100 || img.naturalHeight < 100) {
            img.src = '{{ asset("assets/front/img/placeholder.jpg") }}';
            img.classList.add('placeholder-image');
        }
    }
    
    // Function to handle cart image errors specifically
    function handleCartImageError(img, originalSrc) {
        console.log('Cart image error for:', originalSrc);
        // Try to reload the original image first
        if (img.src !== originalSrc) {
            img.src = originalSrc;
            return;
        }
        // If that fails, use placeholder
        img.src = '{{ asset("assets/front/img/placeholder.jpg") }}';
        img.classList.add('placeholder-image');
    }
    
    // Check all images on page load
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.prod-thumb img');
        images.forEach(function(img) {
            if (img.complete) {
                // Check if image loaded successfully
                if (img.naturalWidth < 100 || img.naturalHeight < 100) {
                    console.log('Image too small, trying to reload:', img.src);
                    // Force reload the image
                    const originalSrc = img.src;
                    img.src = '';
                    setTimeout(() => {
                        img.src = originalSrc;
                    }, 100);
                }
            } else {
                img.addEventListener('load', function() {
                    if (this.naturalWidth < 100 || this.naturalHeight < 100) {
                        console.log('Loaded image too small:', this.src);
                    }
                });
            }
            img.addEventListener('error', function() {
                console.log('Image failed to load:', this.src);
                handleCartImageError(this, this.src);
            });
        });
    });
</script>
<script src="{{asset('assets/front/js/jquery.ui.js')}}"></script>
<script src="{{asset('assets/front/js/product.js')}}"></script>
<script src="{{asset('assets/front/js/cart.js')}}"></script>
@endsection

<style>
.placeholder-image {
    opacity: 0.7;
    filter: grayscale(100%);
}
.prod-thumb img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
    min-height: 80px;
}
</style>
