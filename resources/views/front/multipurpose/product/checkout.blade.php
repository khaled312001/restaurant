@extends('front.layout')

@section('content')
<!--   hero area start   -->
<section class="page-title-area d-flex align-items-center lazy" data-bg="{{asset('assets/front/img/'.$bs->breadcrumb)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h2 class="title">{{convertUtf8($bs->checkout_title)}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('front.index')}}"><i class="flaticon-home"></i>{{__('Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{convertUtf8($bs->checkout_title)}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== PAGE TITLE PART ENDS ======-->
<!--   hero area end    -->

    <!--====== CHECKOUT PART START ======-->
    <section class="checkout-area">
        <form action="" method="POST" id="payment" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                <!-- Left Column - Order Details -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <!-- Serving Method Section -->
                    <div class="checkout-section">
                        <div class="section-header">
                            <h3><i class="fas fa-utensils"></i> {{ __('Serving Method') }}</h3>
                            </div>
                        <div class="serving-methods">
                                    @foreach ($smethods as $sm)
                                <div class="method-option {{ $sm->value == 'pick_up' ? 'selected' : '' }}">
                                                    <input type="radio" name="serving_method" class="shipping-charge"
                                           value="{{$sm->value}}" {{ $sm->value == 'pick_up' ? 'checked' : '' }} 
                                           data-gateways="{{$sm->gateways}}" id="method_{{ $sm->value }}">
                                    <label for="method_{{ $sm->value }}" class="method-label">
                                        <div class="method-icon">
                                            @if($sm->value == 'pick_up')
                                                <i class="fas fa-shopping-bag"></i>
                                            @elseif($sm->value == 'on_table')
                                                <i class="fas fa-chair"></i>
                                            @elseif($sm->value == 'home_delivery')
                                                <i class="fas fa-truck"></i>
                                        @endif
                        </div>
                                        <div class="method-info">
                                            <h4>{{ ucfirst(str_replace('_', ' ', $sm->value)) }}</h4>
                                            <p>{{ __('Select this option') }}</p>
                    </div>
                                    </label>
                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Items Section -->
                    <div class="checkout-section">
                        <div class="section-header">
                            <h3><i class="fas fa-shopping-cart"></i> {{ __('Order Items') }}</h3>
                </div>
                        <div class="order-items">
                            @if(!empty($cart))
                                @php $total = 0; @endphp
                                @foreach($cart as $item)
                                        @php
                                        $id = $item["id"];
                                        $product = App\Models\Product::findOrFail($id);
                                        $total += $item['total'];
                                        @endphp
                                    <div class="order-item" data-product-id="{{ $id }}">
                                        <div class="item-image">
                                            @if($product->feature_image)
                                                <img src="{{ asset('assets/front/img/products/'.$product->feature_image) }}" alt="{{ $item['name'] }}">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item-details">
                                            <h4 class="item-name">{{ $item['name'] }}</h4>
                                            <p class="item-price">
                                                    {{__('Base Price')}}: {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($item['product_price'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                </p>
                                            
                                            <!-- Customizations Display -->
                                            <div class="customizations">
                                                    @if(isset($item['customizations']) || isset($item['addons']))
                                                        @php
                                                            $customizations = $item['customizations'] ?? [];
                                                            
                                                            // If customizations is a JSON string, decode it
                                                            if (is_string($customizations)) {
                                                                $customizations = json_decode($customizations, true);
                                                            }
                                                            
                                                        // Get addons from various sources
                                                        $allAddons = [];
                                                        if (isset($item['addons']) && is_array($item['addons'])) {
                                                            $allAddons = $item['addons'];
                                                        } elseif (isset($item['customization_id'])) {
                                                                try {
                                                                    $customizationModel = App\Models\Customization::find($item['customization_id']);
                                                                    if ($customizationModel && $customizationModel->addons) {
                                                                    $allAddons = $customizationModel->addons;
                                                                    }
                                                                } catch (Exception $e) {
                                                                $allAddons = [];
                                                            }
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
                                                        
                                                        @foreach($groupedAddons as $category => $addons)
                                                            @if(count($addons) > 0)
                                                            <div class="customization-group">
                                                                <span class="group-label">
                                                                    @switch($category)
                                                                        @case('meat') <i class="fas fa-drumstick-bite"></i> {{ __('Meat') }} @break
                                                                        @case('vegetables') <i class="fas fa-leaf"></i> {{ __('Vegetables') }} @break
                                                                        @case('drinks') <i class="fas fa-glass-whiskey"></i> {{ __('Drinks') }} @break
                                                                        @case('sauces') <i class="fas fa-fire"></i> {{ __('Sauces') }} @break
                                                                        @case('extras') <i class="fas fa-plus"></i> {{ __('Extras') }} @break
                                                                        @default <i class="fas fa-cog"></i> {{ ucfirst($category) }}
                                                                    @endswitch
                                                                </span>
                                                                <div class="addon-tags">
                                                                    @foreach($addons as $addon)
                                                                        @php
                                                                            $addonName = $addon['name'] ?? $addon;
                                                                            $addonPrice = $addon['price'] ?? 0;
                                                                            $priceText = $addonPrice > 0 ? " (+" . number_format($addonPrice, 2) . "€)" : "";
                                                                        @endphp
                                                                        <span class="addon-tag">{{ ucfirst(str_replace('-', ' ', $addonName)) }}{{ $priceText }}</span>
                                                                    @endforeach
                                                                </div>
                                                                </div>
                                                            @endif
                                                                    @endforeach
                                                            @endif
                                                                </div>
                                                                </div>
                                        <div class="item-quantity">
                                            <span class="qty-label">{{ __('Qty') }}</span>
                                            <span class="qty-value">{{ $item['qty'] }}</span>
                                                            </div>
                                        <div class="item-total">
                                            <span class="total-label">{{ __('Total') }}</span>
                                            <span class="total-value">
                                                {{ $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{ number_format($item['total'], 2) }}{{ $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : '' }}
                                            </span>
                                                            </div>
                                        <input type="hidden" value="{{ $id }}" class="product_id">
                                                </div>
                                        @endforeach
                                        @else
                                <div class="empty-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                            <h5>{{ __('Cart is empty!') }}</h5>
                                    <a href="{{ route('front.index') }}" class="btn btn-primary">{{ __('Return to Website') }}</a>
                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>

                <!-- Right Column - Order Summary -->
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            @include('front.multipurpose.qrmenu.partials.order_total')
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!--====== CHECKOUT PART ENDS ======-->
@endsection

@section('script')
<script>
    // Function to refresh CSRF token
    function refreshCsrfToken() {
        return new Promise(function(resolve, reject) {
            $.get('/refresh-csrf-token')
                .done(function(data) {
                    $('input[name="_token"]').val(data.token);
                    resolve(data.token);
                })
                .fail(function() {
                    reject('Failed to refresh CSRF token');
                });
        });
    }
    
    // Function to validate CSRF token
    function validateCsrfToken() {
        var token = $('input[name="_token"]').val();
        if (!token || token.length < 10) {
            return false;
        }
        return true;
    }
    
    // Handle form submission from button click
    $("#placeOrderBtn").click(function(e){
        e.preventDefault();
        submitCheckout($(this));
    });

    // Handle direct form submission (e.g., Enter key)
    $("#payment").on('submit', function(e){
        e.preventDefault();
        submitCheckout($("#placeOrderBtn"));
    });

    function ensureGatewaySelectedAndSetAction() {
        var selectedGateway = $("input[name='gateway']:checked");
        if (!selectedGateway.length) {
            var first = $("input[name='gateway']").first();
            if (first.length) {
                first.prop('checked', true);
                selectedGateway = first;
            }
        }
        if (selectedGateway.length) {
            var actionUrl = selectedGateway.data('action');
            if (actionUrl) {
                $("#payment").attr('action', actionUrl);
            }
        }
        return selectedGateway.length > 0;
    }

    function submitCheckout(triggerBtn) {
        var hasGateway = ensureGatewaySelectedAndSetAction();
        if (!hasGateway) {
            alert('Please select a payment method.');
            return;
        }

        if (triggerBtn && triggerBtn.attr('disabled')) {
            return;
        }

        refreshCsrfToken().then(function() {
            if (!validateCsrfToken()) {
                alert('Invalid session. Please refresh the page and try again.');
                location.reload();
                return;
            }

            if (triggerBtn && triggerBtn.length) {
                triggerBtn.attr('disabled', 'true');
                triggerBtn.text('Processing...');
                triggerBtn.css('color', 'black');
            }

            $("#payment")[0].submit();
        }).catch(function() {
            alert('Session expired. Please refresh the page and try again.');
            location.reload();
        });
    }
    
    // Update form action when user changes payment gateway
    $(document).on('change', "input[name='gateway']", function(){
        var actionUrl = $(this).data('action');
        if (actionUrl) {
            $("#payment").attr('action', actionUrl);
        }
    });
    
    // Initialize form action with pre-selected gateway
    $(function(){
        ensureGatewaySelectedAndSetAction();
    });
</script>
@include('front.multipurpose.qrmenu.partials.scripts')
@endsection

<style>
/* Enhanced Checkout Styles */
.checkout-area {
    padding: 60px 0;
    background: #f8f9fa;
}

.checkout-section {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.section-header {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.section-header h3 {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 1.4rem;
}

.section-header i {
    color: #3498db;
    margin-right: 10px;
}

/* Serving Methods */
.serving-methods {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.method-option {
    position: relative;
}

.method-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.method-label {
    display: flex;
    align-items: center;
    padding: 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.method-option.selected .method-label,
.method-label:hover {
    border-color: #3498db;
    background: #f8f9ff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
}

.method-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    color: white;
    font-size: 1.2rem;
}

.method-info h4 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
}

.method-info p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

/* Order Items */
.order-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.order-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.item-image {
    width: 80px;
    height: 80px;
    margin-right: 20px;
    border-radius: 8px;
    overflow: hidden;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e9ecef;
    color: #6c757d;
    font-size: 1.5rem;
}

.item-details {
    flex: 1;
    margin-right: 20px;
}

.item-name {
    color: #2c3e50;
    font-weight: 600;
    margin: 0 0 8px 0;
    font-size: 1.1rem;
}

.item-price {
    color: #7f8c8d;
    margin: 0 0 10px 0;
    font-size: 0.9rem;
}

.customizations {
    margin-top: 10px;
}

.customization-group {
    margin-bottom: 8px;
}

.group-label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.85rem;
    display: block;
    margin-bottom: 5px;
}

.group-label i {
    margin-right: 5px;
    width: 12px;
}

.addon-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.addon-tag {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.item-quantity,
.item-total {
    text-align: center;
    min-width: 80px;
}

.qty-label,
.total-label {
    display: block;
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 5px;
    font-weight: 500;
}

.qty-value,
.total-value {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.qty-value {
    background: #3498db;
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    display: inline-block;
    min-width: 40px;
}

.total-value {
    color: #27ae60;
    font-size: 1.1rem;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-cart i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #bdc3c7;
}

.empty-cart h5 {
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-section {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .order-item {
        flex-direction: column;
        text-align: center;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .item-details {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .item-quantity,
    .item-total {
        margin: 10px 0;
    }
    
    .serving-methods {
        gap: 10px;
    }
    
    .method-label {
        padding: 15px;
    }
    
    .method-icon {
        width: 40px;
        height: 40px;
        margin-right: 15px;
        font-size: 1rem;
    }
}

/* Animation for smooth transitions */
.order-item,
.method-label {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Focus states for accessibility */
.method-option input[type="radio"]:focus + .method-label {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}
</style>
