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
                                            <th class="prod-column" width="10%">{{ __('Product') }}</th>
                                            <th width="70%">{{ __('Product Title') }}</th>
                                            <th>{{ __('Variations') }}</th>
                                            <th>{{ __('Addons') }}</th>
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
                                            <td class="prod-column">
                                                <div class="prod-thumb">
                                                    <img src="{{ asset('assets/images/products/'.$item['photo']) }}" alt="{{ $item['name'] }}" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                            </td>
                                            <td class="prod-title">
                                                <h4 class="title">{{ $item['name'] }}</h4>
                                                <p class="base-price">
                                                    {{__('Base Price')}}: {{$be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''}}{{number_format($item['product_price'], 2)}}{{$be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''}}
                                                </p>
                                            </td>
                                            <td class="variations">
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
                                            <td class="addons">
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
                                            <td class="qty">
                                                {{ $item['qty'] }}
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
    var stripeKey = '{{ $stripe && $stripe->status == 1 ? json_decode($stripe->information, true)["key"] : "" }}';
    var stripe = null;
    var elements = null;
    var card = null;
    
    if (stripeKey) {
        try {
            stripe = Stripe(stripeKey);
            elements = stripe.elements();
            
            // Create card element with better styling
            card = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#424770',
                        '::placeholder': {
                            color: '#aab7c4',
                        },
                        ':-webkit-autofill': {
                            color: '#fce883',
                        },
                    },
                    invalid: {
                        color: '#9e2146',
                    },
                },
                hidePostalCode: true, // Hide postal code field for better UX
            });
            
            // Mount the card element
            card.mount('#card-element');
            
            // Handle real-time validation errors
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    displayError.style.display = 'block';
                } else {
                    displayError.textContent = '';
                    displayError.style.display = 'none';
                }
            });
            
            // Handle card element focus for better UX
            card.addEventListener('focus', function(event) {
                // Remove any security warnings if they appear
                var securityWarnings = document.querySelectorAll('[data-stripe-security-warning]');
                securityWarnings.forEach(function(warning) {
                    warning.style.display = 'none';
                });
                
                // Also try to hide browser autofill warnings
                var autofillWarnings = document.querySelectorAll('[data-autofill-warning]');
                autofillWarnings.forEach(function(warning) {
                    warning.style.display = 'none';
                });
            });
            
        } catch (error) {
            console.error('Stripe initialization error:', error);
            document.getElementById('card-errors').textContent = 'Payment system initialization failed. Please try again.';
        }
    } else {
        document.getElementById('card-errors').textContent = 'Payment gateway not configured.';
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
                if (!stripe || !card) {
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
</style>
