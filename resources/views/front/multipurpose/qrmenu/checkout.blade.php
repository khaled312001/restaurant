@extends('front.qrmenu.layout')

@section('page-heading')
    {{ __('Checkout') }}
@endsection

@section('content')
<section class="checkout-area">
    <form action="" method="POST" id="payment" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="table">
                        <div class="shop-title-box">
                            <h3>{{ __('Serving Method') }}</h3>
                        </div>
                        <table class="cart-table shipping-method">
                            <thead class="cart-header">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Method') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($smethods as $sm)
                                    @if ($sm->value == 'pick_up')
                                        <tr>
                                            <td>
                                                <input type="radio" name="serving_method" class="shipping-charge"
                                                value="{{$sm->value}}" checked data-gateways="{{$sm->gateways}}">
                                            </td>
                                            <td>
                                                <p class="mb-1"><strong>{{ __($sm->name) }}</strong></p>
                                                <p class="mb-0"><small>{{ __($sm->note) }}</small></p>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" name="ordered_from" value="qr_menu">
            <div class="form-container" id="pick_up">
                @include('front.multipurpose.qrmenu.partials.pick_up_form')
            </div>
            <div class="form-container d-none" id="on_table">
                @include('front.multipurpose.qrmenu.partials.on_table_form')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="field-label">{{ __('Order Notes') }} </div>
                    <div class="field-input">
                        <textarea name="order_notes" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div id="paymentInputs"></div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="table">
                            <div class="shop-title-box">
                                <h3>{{ __('Order Summary') }}</h3>
                            </div>
                            @php
                            $total = 0;
                            @endphp
                            @if (!empty($cart))
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>
                                        <th width="70%">{{ __('Product Title') }}</th>
                                        <th>{{ __('Customizations') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $key => $item)
                                    @php
                                    $id = $item["id"];
                                    $product = App\Models\Product::findOrFail($id);
                                    $total += $item['total'];
                                    @endphp
                                    <tr class="remove{{ $id }}">
                                        <td class="prod-title">
                                            <h4 class="title">{{ $item['name'] }}</h4>
                                            <p class="base-price">
                                                {{__('Base Price')}}: {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($item['product_price'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                            </p>
                                        </td>
                                        <td class="customizations">
                                            <div class="customization-details">
                                                @if(isset($item['customizations']))
                                                    @php
                                                        $customizations = $item['customizations'];
                                                    @endphp
                                                    
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
                                        <td class="quantity">
                                            <span class="qty-display">{{ $item['qty'] }}</span>
                                        </td>
                                        <td class="sub-total">
                                            <span dir="ltr">{{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{ number_format($item['total'], 2) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <div class="py-5 bg-light text-center">
                                        <h5>{{ __('Cart is empty!') }}</h5>
                                    </div>
                                    @endif
                                </tbody>
                            </table>
                            <div class="text-center my-4">
                                <a href="{{ route('front.qrmenu') }}"
                                    class="main-btn main-btn-2">{{ __('Return to Menu') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        @include('front.multipurpose.qrmenu.partials.order_total')
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

@section('script')
@include('front.multipurpose.qrmenu.partials.scripts')
@endsection

<style>
.customization-details {
    padding: 8px;
}

.customization-item {
    margin-bottom: 6px;
    padding: 3px 0;
}

.customization-item strong {
    display: inline-block;
    margin-right: 6px;
    color: #2c3e50;
    font-size: 0.85rem;
}

.customization-item .badge {
    margin-right: 4px;
    margin-bottom: 2px;
    font-size: 0.75rem;
    padding: 3px 6px;
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

.prod-title h4 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-weight: 600;
    font-size: 1rem;
}

.prod-title p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.85rem;
}

.quantity .qty-display {
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #dee2e6;
    font-weight: 600;
    color: #2c3e50;
}

.cart-table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #2c3e50;
    font-weight: 600;
    font-size: 0.9rem;
}

.cart-table td {
    vertical-align: middle;
    border-color: #dee2e6;
    padding: 12px 8px;
}

.shop-title-box h3 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
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
</style>
