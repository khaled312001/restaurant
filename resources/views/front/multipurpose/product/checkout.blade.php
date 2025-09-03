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
                <input type="hidden" name="ordered_from" value="website">
                <div class="form-container" id="pick_up">
                    @include('front.multipurpose.qrmenu.partials.pick_up_form')
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="field-label">{{ __('Order Notes') }} </div>
                        <div class="field-input">
                            <textarea name="order_notes" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Shipping methods section removed since home delivery is not available -->
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
                                                            
                                                            // Try to get addons from database if customization_id exists
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
                                                            
                                                            // Use database addons if available, otherwise fallback to session data
                                                            $allAddons = !empty($dbAddons) ? $dbAddons : [];
                                                            
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
                                            <td class="quantity">
                                                <span class="qty-display">{{ $item['qty'] }}</span>
                                            </td>
                                            <input type="hidden" value="{{ $id }}" class="product_id">
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
                                    <a href="{{ route('front.index') }}"
                                        class="main-btn main-btn-2">{{ __('Return to Website') }}</a>
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
    <!--====== CHECKOUT PART ENDS ======-->
@endsection


@section('script')
<!-- Include Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe with proper error handling
    let stripe;
    try {
        stripe = Stripe('{{ $stripe->information->stripe_key ?? "" }}');
    } catch (error) {
        console.error('Stripe initialization error:', error);
    }
    
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
    
    // Handle form submission
    $("#placeOrderBtn").click(function(e){
        e.preventDefault();
        
        var that = $(this);
        var selectedGateway = $("input[name='gateway']:checked").val();
        
        // Prevent multiple clicks
        if (that.attr('disabled')) {
            return;
        }
        
        // Refresh CSRF token before submission to prevent 419 error
        refreshCsrfToken().then(function() {
            // Validate the token before proceeding
            if (!validateCsrfToken()) {
                alert('Invalid session. Please refresh the page and try again.');
                location.reload();
                return;
            }
            
            if (selectedGateway === 'stripe') {
                // Check if Stripe is properly initialized
                if (!stripe) {
                    alert('Payment system not ready. Please refresh the page and try again.');
                    return;
                }
                
                // Handle Stripe payment
                that.attr('disabled', "true");
                that.text("Processing...");
                that.css("color", "black");
                
                // Clear previous errors
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = '';
                errorElement.style.display = 'none';
                
                // Create token only once
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        errorElement.textContent = result.error.message;
                        errorElement.style.display = 'block';
                        that.removeAttr('disabled');
                        that.text("Place Order");
                        that.css("color", "");
                    } else {
                        // Send the token to your server
                        var form = document.getElementById('payment');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        
                        // Disable the form to prevent multiple submissions
                        var formInputs = form.querySelectorAll('input, button, select, textarea');
                        formInputs.forEach(function(input) {
                            input.setAttribute('disabled', 'disabled');
                        });
                        
                        // Submit the form
                        form.submit();
                    }
                }).catch(function(error) {
                    console.error('Token creation error:', error);
                    errorElement.textContent = 'Payment processing failed. Please try again.';
                    errorElement.style.display = 'block';
                    that.removeAttr('disabled');
                    that.text("Place Order");
                    that.css("color", "");
                });
            } else {
                // Handle other payment methods
                that.attr('disabled', "true");
                that.text("Processing...");
                that.css("color", "black");
                
                // Disable the form to prevent multiple submissions
                var form = document.getElementById('payment');
                var formInputs = form.querySelectorAll('input, button, select, textarea');
                formInputs.forEach(function(input) {
                    input.setAttribute('disabled', 'disabled');
                });
                
                $("#payment").submit();
            }
        }).catch(function(error) {
            // If CSRF refresh fails, try to submit anyway
            alert('Session expired. Please refresh the page and try again.');
            location.reload();
        });
    });
    
    // Function to handle image loading errors
    function handleImageError(img) {
        if (img.naturalWidth < 100 || img.naturalHeight < 100) {
            img.src = '{{ asset("assets/front/img/placeholder.jpg") }}';
            img.classList.add('placeholder-image');
        }
    }
    
    // Function to handle checkout image errors specifically
    function handleCheckoutImageError(img, originalSrc) {
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
                        // Image loaded but too small
                    }
                });
            }
            img.addEventListener('error', function() {
                handleCheckoutImageError(this, this.src);
            });
        });
    });

    // Handle browser security warnings
    document.addEventListener('DOMContentLoaded', function() {
        // Monitor for security warnings and hide them
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            // Hide security warnings
                            var warnings = node.querySelectorAll('[data-stripe-security-warning], [data-autofill-warning]');
                            warnings.forEach(function(warning) {
                                warning.style.display = 'none';
                            });
                            
                            // Also hide any elements with security-related text
                            if (node.textContent && (
                                node.textContent.includes('secure connection') ||
                                node.textContent.includes('automatic payment methods filling is disabled')
                            )) {
                                node.style.display = 'none';
                            }
                        }
                    });
                }
            });
        });
        
        // Start observing
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
</script>
@include('front.multipurpose.qrmenu.partials.scripts')
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
}

/* Stripe Elements Styling */
#card-element {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: white;
    min-height: 40px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#card-element.StripeElement--focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

#card-element.StripeElement--invalid {
    border-color: #dc3545;
}

#card-errors {
    display: none;
    color: #dc3545;
    font-size: 14px;
    margin-top: 8px;
    padding: 8px;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
}

/* Hide browser security warnings for Stripe */
#card-element::-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px white inset !important;
}

/* Payment method selection styling */
.option-block {
    margin-bottom: 15px;
}

.gateway-details {
    margin-top: 15px;
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background-color: #f8f9fa;
}

/* Form validation styling */
.field-input input:invalid {
    border-color: #dc3545;
}

.field-input input:valid {
    border-color: #28a745;
}

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
