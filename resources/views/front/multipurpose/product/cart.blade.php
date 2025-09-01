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
                    @if($cart != null && count($cart) > 0)
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
                            <li style="direction: ltr;"><span>{{__('Total')}} :</span> {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} <span class="cart-total-view">{{number_format($cartTotal, 2)}}</span> {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{__('Product')}}</th>
                                        <th>{{__('Product Title')}}</th>
                                        <th>{{__('Variations')}}</th>
                                        <th>{{__('Addons')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Unit Price')}}</th>
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $key => $item)
                                    @php
                                        $id = $item["id"];
                                        $product = App\Models\Product::find($id);
                                        if (!$product) continue;
                                        
                                        // Calculate unit price
                                        $unitPrice = (float)$item['product_price'];
                                        if (isset($item['variations']) && is_array($item['variations'])) {
                                            foreach ($item['variations'] as $variation) {
                                                if (is_array($variation) && array_key_exists('price', $variation)) {
                                                    $unitPrice += (float)$variation["price"];
                                                }
                                            }
                                        }
                                        if (isset($item['addons']) && is_array($item['addons'])) {
                                            foreach ($item['addons'] as $addon) {
                                                if (is_array($addon) && array_key_exists('price', $addon)) {
                                                    $unitPrice += (float)$addon["price"];
                                                }
                                            }
                                        }
                                    @endphp
                                    <tr class="remove{{ $key }}">
                                        <td>
                                            <div class="cart-product">
                                                <div class="cart-product-img">
                                                    <img src="{{ asset('assets/images/products/'.$item['photo']) }}" alt="{{ $item['name'] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-product-info">
                                                <h5 class="cart-product-title">{{ $item['name'] }}</h5>
                                                <p class="cart-product-price">
                                                    {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} {{number_format($item['product_price'], 2)}} {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($item['variations']) && is_array($item['variations']) && count($item['variations']) > 0)
                                                <div class="variations-list">
                                                    @foreach($item['variations'] as $varKey => $variation)
                                                        @if(is_array($variation) && array_key_exists('name', $variation))
                                                            <span class="badge badge-info">
                                                                {{ $variation['name'] }}
                                                                @if(array_key_exists('price', $variation))
                                                                    (+{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($variation['price'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}})
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($item['addons']) && is_array($item['addons']) && count($item['addons']) > 0)
                                                <div class="addons-list">
                                                    @foreach($item['addons'] as $addonKey => $addon)
                                                        @if(is_array($addon) && array_key_exists('name', $addon))
                                                            <span class="badge badge-success">
                                                                {{ $addon['name'] }}
                                                                @if(array_key_exists('price', $addon))
                                                                    (+{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($addon['price'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}})
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="cart-quantity">
                                                <input type="number" value="{{ $item['qty'] }}" min="1" class="form-control qty-input" data-key="{{ $key }}" data-product-id="{{ $id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="unit-price">
                                                {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} {{number_format($unitPrice, 2)}} {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="item-total">
                                                {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} {{number_format($item['total'], 2)}} {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                <button type="button" class="btn btn-sm btn-danger remove-item" data-key="{{ $key }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row cart-middle">
                            <div class="col-lg-6 offset-lg-6 col-sm-12">
                                <div class="update-cart float-right d-inline-block ml-4">
                                    <a class="main-btn main-btn-2 proceed-checkout-btn" href="{{route('front.checkout')}}">
                                        <span>{{__('Checkout')}}</span>
                                    </a>
                                </div>
                                <div class="update-cart float-right d-inline-block">
                                    <button class="main-btn main-btn-2" id="cartUpdate" data-href="{{route('cart.update')}}" type="button">
                                        <span>{{__('Update Cart')}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-light py-5 text-center">
                            <h3 class="text-uppercase">{{__('Cart is empty!')}}</h3>
                            <p class="mt-3">
                                <a href="{{ route('front.index') }}" class="main-btn main-btn-2">{{__('Continue Shopping')}}</a>
                            </p>
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
    
    $(document).ready(function() {
        // Handle quantity changes
        $('.qty-input').on('change', function() {
            let qty = parseInt($(this).val());
            if (qty < 1) {
                $(this).val(1);
                qty = 1;
            }
            updateCartItem($(this).data('key'), qty);
        });
        
        // Handle remove item
        $('.remove-item').on('click', function() {
            let key = $(this).data('key');
            if (confirm('Are you sure you want to remove this item?')) {
                removeCartItem(key);
            }
        });
        
        // Handle update cart button
        $('#cartUpdate').on('click', function() {
            updateCart();
        });
    });
    
    function updateCartItem(key, qty) {
        // Update the cart item quantity locally first
        let row = $(`.remove${key}`);
        let unitPrice = parseFloat(row.find('.unit-price').text().replace(/[^\d.-]/g, ''));
        let newTotal = unitPrice * qty;
        row.find('.item-total').text('€' + newTotal.toFixed(2));
        
        // Update cart totals
        updateCartTotals();
    }
    
    function updateCartTotals() {
        let total = 0;
        let count = 0;
        
        $('.item-total').each(function() {
            let itemTotal = parseFloat($(this).text().replace(/[^\d.-]/g, ''));
            total += itemTotal;
        });
        
        $('.qty-input').each(function() {
            count += parseInt($(this).val());
        });
        
        $('.cart-item-view').text(count);
        $('.cart-total-view').text(total.toFixed(2));
    }
    
    function removeCartItem(key) {
        $.ajax({
            url: '{{ route("cart.item.remove", "") }}/' + key,
            type: 'GET',
            success: function(response) {
                if (response.message) {
                    location.reload();
                }
            },
            error: function() {
                alert('Error removing item');
            }
        });
    }
    
    function updateCart() {
        let qtys = [];
        $('.qty-input').each(function() {
            qtys.push($(this).val());
        });
        
        $.ajax({
            url: '{{ route("cart.update") }}',
            type: 'POST',
            data: {
                qty: qtys,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.message) {
                    location.reload();
                }
            },
            error: function() {
                alert('Error updating cart');
            }
        });
    }
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

