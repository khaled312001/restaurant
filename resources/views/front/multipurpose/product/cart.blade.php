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
                                        <th>{{__('Customizations')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Unit Price')}}</th>
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $cartKey => $item)
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
                                    <tr class="remove{{ $cartKey }}">
                                        <td>
                                            <div class="cart-product-info">
                                                <h5 class="cart-product-title">{{ $item['name'] }}</h5>
                                                <p class="cart-product-price">
                                                    {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}} {{number_format($item['product_price'], 2)}} {{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customization-details">
                                                @if(isset($item['customizations']) || isset($item['addons']))
                                                    @php
                                                        $customizations = $item['customizations'] ?? [];
                                                        
                                                        // If customizations is a JSON string, decode it
                                                        if (is_string($customizations)) {
                                                            $customizations = json_decode($customizations, true);
                                                        }
                                                        
                                                        // If no customizations but we have addons directly, use them
                                                        if (empty($customizations) && isset($item['addons']) && !empty($item['addons'])) {
                                                            // Try to use addons directly as customizations
                                                            $customizations = ['addons_direct' => $item['addons']];
                                                        }
                                                        
                                                        // First, try to get addons from cart item directly
                                                        $cartAddons = [];
                                                        if (isset($item['addons']) && is_array($item['addons'])) {
                                                            $cartAddons = $item['addons'];
                                                            
                                                            // If addons don't have proper structure, try to fix them
                                                            foreach ($cartAddons as $key => $addon) {
                                                                if (is_string($addon)) {
                                                                    // Convert simple string to proper addon structure
                                                                    $cartAddons[$key] = [
                                                                        'name' => $addon,
                                                                        'category' => 'other',
                                                                        'price' => 0
                                                                    ];
                                                                }
                                                            }
                                                        }
                                                        
                                                        // Then, try to get addons from database if customization_id exists
                                                        $dbAddons = [];
                                                        if (isset($item['customization_id'])) {
                                                            try {
                                                                $customizationModel = App\Models\Customization::find($item['customization_id']);
                                                                if ($customizationModel && $customizationModel->addons) {
                                                                    $dbAddons = $customizationModel->addons;
                                                                }
                                                            } catch (Exception $e) {
                                                                // Fallback to session data
                                                                $dbAddons = [];
                                                            }
                                                        }
                                                        
                                                        // Use cart addons if available, otherwise fallback to database addons
                                                        $allAddons = !empty($cartAddons) ? $cartAddons : $dbAddons;
                                                        
                                                        // If still no addons, try to construct from customizations data
                                                        if (empty($allAddons) && is_array($customizations)) {
                                                            $constructedAddons = [];
                                                            
                                                            // Add meat choice
                                                            if (!empty($customizations['meatChoice'])) {
                                                                $constructedAddons[] = [
                                                                    'name' => $customizations['meatChoice'],
                                                                    'category' => 'meat',
                                                                    'price' => 0
                                                                ];
                                                            }
                                                            
                                                            // Add vegetables
                                                            if (!empty($customizations['vegetables']) && is_array($customizations['vegetables'])) {
                                                                foreach ($customizations['vegetables'] as $vegetable) {
                                                                    $constructedAddons[] = [
                                                                        'name' => $vegetable,
                                                                        'category' => 'vegetables',
                                                                        'price' => 0
                                                                    ];
                                                                }
                                                            }
                                                            
                                                            // Add drinks
                                                            if (!empty($customizations['drinks']) && is_array($customizations['drinks'])) {
                                                                foreach ($customizations['drinks'] as $drink) {
                                                                    $constructedAddons[] = [
                                                                        'name' => $drink,
                                                                        'category' => 'drinks',
                                                                        'price' => 0
                                                                    ];
                                                                }
                                                            }
                                                            
                                                            // Add drink choice (backward compatibility)
                                                            if (!empty($customizations['drinkChoice'])) {
                                                                $constructedAddons[] = [
                                                                    'name' => $customizations['drinkChoice'],
                                                                    'category' => 'drinks',
                                                                    'price' => 0
                                                                ];
                                                            }
                                                            
                                                            // Add sauces
                                                            if (!empty($customizations['sauces']) && is_array($customizations['sauces'])) {
                                                                foreach ($customizations['sauces'] as $sauce) {
                                                                    $constructedAddons[] = [
                                                                        'name' => $sauce,
                                                                        'category' => 'sauces',
                                                                        'price' => 0
                                                                    ];
                                                                }
                                                            }
                                                            
                                                            // Add extras
                                                            if (!empty($customizations['extras']) && is_array($customizations['extras'])) {
                                                                foreach ($customizations['extras'] as $extra) {
                                                                    $constructedAddons[] = [
                                                                        'name' => $extra,
                                                                        'category' => 'extras',
                                                                        'price' => 0
                                                                    ];
                                                                }
                                                            }
                                                            
                                                            $allAddons = $constructedAddons;
                                                        }
                                                        
                                                        
                                                        // Group addons by category
                                                        $groupedAddons = [];
                                                        foreach ($allAddons as $addon) {
                                                            $category = $addon['category'] ?? 'other';
                                                            if (!isset($groupedAddons[$category])) {
                                                                $groupedAddons[$category] = [];
                                                            }
                                                            $groupedAddons[$category][] = $addon;
                                                        }
                                                    @endphp
                                                    
                                                    <!-- Display all addons grouped by category -->
                                                    @foreach($groupedAddons as $category => $addons)
                                                        @if(count($addons) > 0)
                                                            <div class="customization-item">
                                                                @switch($category)
                                                                    @case('meat')
                                                                        <strong><i class="fas fa-drumstick-bite text-danger"></i> Viande:</strong>
                                                                        @break
                                                                    @case('vegetables')
                                                                        <strong><i class="fas fa-leaf text-success"></i> Légumes:</strong>
                                                                        @break
                                                                    @case('drinks')
                                                                        <strong><i class="fas fa-glass-whiskey text-info"></i> Boisson:</strong>
                                                                        @break
                                                                    @case('sauces')
                                                                        <strong><i class="fas fa-fire text-warning"></i> Sauces:</strong>
                                                                        @break
                                                                    @case('extras')
                                                                        <strong><i class="fas fa-plus text-primary"></i> Suppléments:</strong>
                                                                        @break
                                                                    @default
                                                                        <strong><i class="fas fa-cog text-secondary"></i> {{ ucfirst($category) }}:</strong>
                                                                @endswitch
                                                                
                                                                @foreach($addons as $addon)
                                                                    @php
                                                                        $badgeClass = 'badge-secondary';
                                                                        switch($category) {
                                                                            case 'meat': $badgeClass = 'badge-danger'; break;
                                                                            case 'vegetables': $badgeClass = 'badge-success'; break;
                                                                            case 'drinks': $badgeClass = 'badge-info'; break;
                                                                            case 'sauces': $badgeClass = 'badge-warning'; break;
                                                                            case 'extras': $badgeClass = 'badge-primary'; break;
                                                                        }
                                                                        
                                                                        $addonName = $addon['name'] ?? $addon;
                                                                        $addonPrice = $addon['price'] ?? 0;
                                                                        $priceText = $addonPrice > 0 ? " (+" . number_format($addonPrice, 2) . "€)" : "";
                                                                    @endphp
                                                                    <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('-', ' ', $addonName)) }}{{ $priceText }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    
                                                        <!-- Show message if no addons found at all -->
                                                        @if(empty($groupedAddons))
                                                            <div class="customization-item">
                                                                <small class="text-muted">
                                                                    <i class="fas fa-info-circle"></i> 
                                                                    Aucune personnalisation ajoutée
                                                                </small>
                                                            </div>
                                                        @endif
                                                        
                                                    <!-- Fallback to old customization data if no database addons -->
                                                    @if(empty($dbAddons))
                                                        <!-- Meat Choice -->
                                                        @if(isset($customizations['meatChoice']) && $customizations['meatChoice'])
                                                            <div class="customization-item">
                                                                <strong><i class="fas fa-drumstick-bite text-danger"></i> Viande:</strong>
                                                                <span class="badge badge-primary">{{ ucfirst($customizations['meatChoice']) }}</span>
                                                            </div>
                                                        @endif
                                                        
                                                        <!-- Vegetables -->
                                                        @if(isset($customizations['vegetables']) && is_array($customizations['vegetables']) && count($customizations['vegetables']) > 0)
                                                            <div class="customization-item">
                                                                <strong><i class="fas fa-leaf text-success"></i> Légumes:</strong>
                                                                @foreach($customizations['vegetables'] as $vegetable)
                                                                    <span class="badge badge-success">{{ ucfirst(str_replace('-', ' ', $vegetable)) }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        
                                                        <!-- Drinks -->
                                                        @if(isset($customizations['drinkChoice']) && $customizations['drinkChoice'])
                                                            <div class="customization-item">
                                                                <strong><i class="fas fa-glass-whiskey text-info"></i> Boisson:</strong>
                                                                <span class="badge badge-info">{{ ucfirst(str_replace('-', ' ', $customizations['drinkChoice'])) }}</span>
                                                            </div>
                                                        @endif
                                                        
                                                        <!-- Sauces -->
                                                        @if(isset($customizations['sauces']) && is_array($customizations['sauces']) && count($customizations['sauces']) > 0)
                                                            <div class="customization-item">
                                                                <strong><i class="fas fa-fire text-warning"></i> Sauces:</strong>
                                                                @foreach($customizations['sauces'] as $sauce)
                                                                    <span class="badge badge-warning">{{ ucfirst(str_replace('-', ' ', $sauce)) }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endif
                                                @else
                                                    <!-- Fallback to old variations/addons system -->
                                                    @if (!empty($item["variations"]))
                                                        <div class="customization-item">
                                                            <strong><i class="fas fa-cog text-primary"></i> Variations:</strong>
                                                            @php
                                                                $variations = $item["variations"];
                                                            @endphp
                                                            @foreach ($variations as $vKey => $variation)
                                                                <span class="badge badge-primary">{{str_replace("_"," ",$vKey)}}: {{$variation["name"]}}</span>
                                                                @if (!$loop->last) @endif
                                                            @endforeach    
                                                        </div>
                                                    @endif
                                                    
                                                    @if (!empty($item["addons"]))
                                                        <div class="customization-item">
                                                            <strong><i class="fas fa-plus text-success"></i> Suppléments:</strong>
                                                            @php
                                                                $addons = $item["addons"];
                                                            @endphp
                                                            @foreach ($addons as $addon)
                                                                <span class="badge badge-success">{{$addon["name"]}}</span>
                                                                @if (!$loop->last) @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantity-controls">
                                                <input type="number" class="form-control qty-input" data-key="{{ $cartKey }}" value="{{ $item['qty'] }}" min="1" max="10" style="width: 80px; text-align: center;">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="unit-price">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($unitPrice, 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                                        </td>
                                        <td>
                                            <span class="item-total">{{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($item['total'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm remove-item" data-key="{{ $cartKey }}">
                                                <i class="fas fa-trash"></i> {{__('Remove')}}
                                            </button>
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
                                    <button class="btn btn-primary" id="cartUpdate" data-href="{{route('cart.update')}}" type="button">
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


@section('script')
<script>
    "use strict";
    
    $(document).ready(function() {
        // Handle quantity changes
        $(document).on('change', '.qty-input', function() {
            let qty = parseInt($(this).val());
            if (qty < 1) {
                $(this).val(1);
                qty = 1;
            }
            updateCartItem($(this).data('key'), qty);
        });
        
        // Handle remove item
        $(document).on('click', '.remove-item', function(e) {
            e.preventDefault();
            let key = $(this).data('key');
            // Ensure key is treated as a string (e.g., "0" stays valid)
            if (key !== undefined && key !== null) {
                key = String(key);
            }
            removeCartItem(key);
        });
        
        // Handle update cart button
        $(document).on('click', '#cartUpdate', function() {
            updateCart();
        });
    });
    
    function updateCartItem(key, qty) {
        // Escape the key for CSS selector (in case it contains special characters)
        let escapedKey = key.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~]/g, "\\$&");
        
        // Update the cart item quantity locally first
        let row = $(`.remove${escapedKey}`);
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
        // Prevent removal of invalid keys (allow "0")
        if (key === undefined || key === null || key === "") {
            console.error("Invalid cart key:", key);
            return;
        }
        
        // Escape the key for CSS selector (in case it contains special characters)
        let escapedKey = key.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~]/g, "\\$&");
        let button = $(`.remove${escapedKey} .remove-item`);
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Suppression...');
        
        console.log('Removing cart item with key:', key);
        console.log('Escaped key for selector:', escapedKey);
        
        $.ajax({
            url: '{{ route("cart.item.remove", ":key") }}'.replace(':key', encodeURIComponent(key)),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Remove response:', response);
                if (response && response.message) {
                    // Reload page after short delay
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    button.prop('disabled', false).html('<i class="fas fa-trash"></i> Supprimer');
                }
            },
            error: function(xhr, status, error) {
                console.error('Remove error:', xhr, status, error);
                button.prop('disabled', false).html('<i class="fas fa-trash"></i> Supprimer');
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
                // Handle error silently
            }
        });
    }
</script>
<!-- Temporarily disabled to avoid conflicts -->
<!-- <script src="{{asset('assets/front/js/jquery.ui.js')}}"></script> -->
<!-- <script src="{{asset('assets/front/js/product.js')}}"></script> -->
<!-- <script src="{{asset('assets/front/js/cart.js')}}"></script> -->
@endsection

<style>
.customization-details {
    padding: 10px;
}

.customization-item {
    margin-bottom: 8px;
    padding: 5px 0;
}

.customization-item strong {
    display: inline-block;
    margin-right: 8px;
    color: #2c3e50;
    font-size: 0.9rem;
}

.customization-item .badge {
    margin-right: 5px;
    margin-bottom: 3px;
    font-size: 0.8rem;
    padding: 4px 8px;
}

.badge-primary {
    background-color: #3498db;
    color: white;
}

.badge-success {
    background-color: #27ae60;
    color: white;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
}

.badge-warning {
    background-color: #f39c12;
    color: white;
}

.badge-danger {
    background-color: #e74c3c;
    color: white;
}

.cart-product-info h5 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-weight: 600;
}

.cart-product-info p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.quantity-controls {
    text-align: center;
}

.quantity-controls input {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
}

.btn-danger {
    background-color: #e74c3c;
    border-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
    border-color: #c0392b;
}

.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.main-btn-2 {
    background: linear-gradient(45deg, #f39c12, #e67e22);
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.main-btn-2:hover {
    background: linear-gradient(45deg, #e67e22, #d68910);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    color: white;
    text-decoration: none;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #2c3e50;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
    border-color: #dee2e6;
}

.total-item-info {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.total-item-info li {
    margin: 0;
    font-weight: 600;
    color: #2c3e50;
}

.cart-middle {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #dee2e6;
}
</style>

