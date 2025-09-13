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
                            <div class="method-option selected">
                                <input type="radio" name="serving_method" class="shipping-charge"
                                       value="pick_up" checked data-gateways="" id="method_pick_up">
                                <label for="method_pick_up" class="method-label">
                                    <div class="method-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div class="method-info">
                                        <h4>Pick up</h4>
                                        <p>{{ __('Select this option') }}</p>
                                    </div>
                                </label>
                            </div>
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

                <!-- Right Column - Customer Information & Order Summary -->
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <!-- Customer Information Section -->
                            <div class="checkout-section">
                                <div class="section-header">
                                    <h3><i class="fas fa-user"></i> {{ __('Customer Information') }}</h3>
                                </div>
                                
                                <div class="new-customer-form">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="first_name">{{ __('First Name') }} <span class="required">*</span></label>
                                            <input type="text" id="first_name" name="billing_fname" 
                                                   value="{{ old('billing_fname', auth()->user()->first_name ?? '') }}" 
                                                   placeholder="{{ __('Enter your first name') }}" required>
                                            <div class="error-message" id="first_name_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">{{ __('Last Name') }} <span class="required">*</span></label>
                                            <input type="text" id="last_name" name="billing_lname" 
                                                   value="{{ old('billing_lname', auth()->user()->last_name ?? '') }}" 
                                                   placeholder="{{ __('Enter your last name') }}" required>
                                            <div class="error-message" id="last_name_error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email Address') }} <span class="required">*</span></label>
                                            <input type="email" id="email" name="billing_email" 
                                                   value="{{ old('billing_email', auth()->user()->email ?? '') }}" 
                                                   placeholder="{{ __('Enter your email address') }}" required>
                                            <div class="error-message" id="email_error"></div>
                                        </div>
                                        <div class="form-group phone-group">
                                            <label for="phone">{{ __('Phone Number') }} <span class="required">*</span></label>
                                            <div class="phone-input">
                                                <select id="country_code" name="billing_country_code" class="country-select">
                                                    <option value="+33" {{ old('billing_country_code', '+33') == '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                                    <option value="+1" {{ old('billing_country_code') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                                    <option value="+44" {{ old('billing_country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                                    <option value="+49" {{ old('billing_country_code') == '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                                    <option value="+39" {{ old('billing_country_code') == '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                                    <option value="+34" {{ old('billing_country_code') == '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                                    <option value="+32" {{ old('billing_country_code') == '+32' ? 'selected' : '' }}>🇧🇪 +32</option>
                                                    <option value="+41" {{ old('billing_country_code') == '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                                </select>
                                                <input type="tel" id="phone" name="billing_number" 
                                                       value="{{ old('billing_number', auth()->user()->phone ?? '') }}" 
                                                       placeholder="123456789" required>
                                            </div>
                                            <div class="error-message" id="phone_error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="address">{{ __('Address') }} <span class="required">*</span></label>
                                        <textarea id="address" name="billing_address" 
                                                  placeholder="{{ __('Enter your full address') }}" required>{{ old('billing_address', auth()->user()->address ?? '') }}</textarea>
                                        <div class="error-message" id="address_error"></div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="city">{{ __('City') }} <span class="required">*</span></label>
                                            <input type="text" id="city" name="billing_city" 
                                                   value="{{ old('billing_city', auth()->user()->city ?? '') }}" 
                                                   placeholder="{{ __('Enter your city') }}" required>
                                            <div class="error-message" id="city_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="zip">{{ __('ZIP Code') }} <span class="required">*</span></label>
                                            <input type="text" id="zip" name="billing_zip" 
                                                   value="{{ old('billing_zip', auth()->user()->zip ?? '') }}" 
                                                   placeholder="{{ __('Enter ZIP code') }}" required>
                                            <div class="error-message" id="zip_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country">{{ __('Country') }} <span class="required">*</span></label>
                                            <select id="country" name="billing_country" class="country-select" required>
                                                <option value="">{{ __('Select Country') }}</option>
                                                <option value="France" {{ old('billing_country', 'France') == 'France' ? 'selected' : '' }}>🇫🇷 France</option>
                                                <option value="Belgium" {{ old('billing_country') == 'Belgium' ? 'selected' : '' }}>🇧🇪 Belgium</option>
                                                <option value="Switzerland" {{ old('billing_country') == 'Switzerland' ? 'selected' : '' }}>🇨🇭 Switzerland</option>
                                                <option value="Canada" {{ old('billing_country') == 'Canada' ? 'selected' : '' }}>🇨🇦 Canada</option>
                                                <option value="United States" {{ old('billing_country') == 'United States' ? 'selected' : '' }}>🇺🇸 United States</option>
                                                <option value="United Kingdom" {{ old('billing_country') == 'United Kingdom' ? 'selected' : '' }}>🇬🇧 United Kingdom</option>
                                                <option value="Germany" {{ old('billing_country') == 'Germany' ? 'selected' : '' }}>🇩🇪 Germany</option>
                                                <option value="Italy" {{ old('billing_country') == 'Italy' ? 'selected' : '' }}>🇮🇹 Italy</option>
                                                <option value="Spain" {{ old('billing_country') == 'Spain' ? 'selected' : '' }}>🇪🇸 Spain</option>
                                            </select>
                                            <div class="error-message" id="country_error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="notes">{{ __('Order Notes') }} <span class="optional">({{ __('Optional') }})</span></label>
                                        <textarea id="notes" name="order_notes" 
                                                  placeholder="{{ __('Any special instructions for your order?') }}">{{ old('order_notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Summary -->
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
        
        // New Form Handler
        class CheckoutForm {
            constructor() {
                this.init();
            }
            
            init() {
                this.setupSelects();
                this.setupValidation();
                this.setupPhoneInput();
                this.setupCountryCode();
            }
            
            setupSelects() {
                // Handle all select elements
                $('.country-select').each(function() {
                    const $select = $(this);
                    
                    // Check if element exists and has value method
                    if ($select.length && typeof $select.val === 'function') {
                        try {
                            const value = $select.val();
                            
                            if (value && value !== '') {
                                $select.addClass('selected');
                                this.updateSelectDisplay($select, value);
                            }
                        } catch (error) {
                            console.log('Error reading select value:', error);
                        }
                    }
                }.bind(this));
                
                // Handle select changes
                $('.country-select').on('change', function() {
                    const $select = $(this);
                    
                    if ($select.length && typeof $select.val === 'function') {
                        try {
                            const value = $select.val();
                            
                            if (value && value !== '') {
                                $select.addClass('selected');
                                this.updateSelectDisplay($select, value);
                            } else {
                                $select.removeClass('selected');
                            }
                        } catch (error) {
                            console.log('Error handling select change:', error);
                        }
                    }
                }.bind(this));
            }
            
            updateSelectDisplay($select, value) {
                try {
                    // Check if element exists and has DOM properties
                    if ($select.length && $select[0]) {
                        // Force visual update
                        $select[0].selectedIndex = $select[0].selectedIndex;
                        
                        // Add visual feedback
                        $select.css({
                            'color': '#2c3e50',
                            'font-weight': '600',
                            'background-color': '#f8f9fa',
                            'border-color': '#27ae60'
                        });
                        
                        console.log('Select updated:', $select.attr('id'), 'Value:', value);
                    }
                } catch (error) {
                    console.log('Error updating select display:', error);
                }
            }
            
            setupValidation() {
                // Real-time validation
                $('input[required], select[required], textarea[required]').on('blur', function() {
                    this.validateField($(this));
                }.bind(this));
                
                // Form submission validation
                $('#payment').on('submit', function(e) {
                    if (!this.validateForm()) {
                        e.preventDefault();
                    }
                }.bind(this));
            }
            
            validateField($field) {
                try {
                    if (!$field.length || typeof $field.val !== 'function') {
                        return false;
                    }
                    
                    const value = $field.val() ? $field.val().trim() : '';
                    const fieldName = $field.attr('id');
                    const $error = $('#' + fieldName + '_error');
                    
                    let isValid = true;
                    let errorMessage = '';
                    
                    if (!value) {
                        isValid = false;
                        errorMessage = 'This field is required';
                    } else if (fieldName === 'email' && !this.isValidEmail(value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid email address';
                    } else if (fieldName === 'phone' && !this.isValidPhone(value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid phone number';
                    }
                    
                    if (isValid) {
                        $field.removeClass('error');
                        if ($error.length) {
                            $error.text('').hide();
                        }
                    } else {
                        $field.addClass('error');
                        if ($error.length) {
                            $error.text(errorMessage).show();
                        }
                    }
                    
                    return isValid;
                } catch (error) {
                    console.log('Error validating field:', error);
                    return false;
                }
            }
            
            validateForm() {
                let isValid = true;
                
                $('input[required], select[required], textarea[required]').each(function() {
                    if (!this.validateField($(this))) {
                        isValid = false;
                    }
                }.bind(this));
                
                return isValid;
            }
            
            isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            isValidPhone(phone) {
                const phoneRegex = /^[0-9\s\-\+\(\)]{8,}$/;
                return phoneRegex.test(phone);
            }
            
            setupPhoneInput() {
                $('#phone').on('input', function() {
                    let value = $(this).val().replace(/\D/g, '');
                    if (value.length > 10) {
                        value = value.substring(0, 10);
                    }
                    $(this).val(value);
                });
            }
            
            setupCountryCode() {
                // Auto-sync country code with country selection
                $('#country').on('change', function() {
                    try {
                        const $countrySelect = $(this);
                        if (!$countrySelect.length || typeof $countrySelect.val !== 'function') {
                            return;
                        }
                        
                        const country = $countrySelect.val();
                        const countryCodeMap = {
                            'France': '+33',
                            'Belgium': '+32',
                            'Switzerland': '+41',
                            'Canada': '+1',
                            'United States': '+1',
                            'United Kingdom': '+44',
                            'Germany': '+49',
                            'Italy': '+39',
                            'Spain': '+34'
                        };
                        
                        if (country && countryCodeMap[country]) {
                            const $countryCodeSelect = $('#country_code');
                            if ($countryCodeSelect.length && typeof $countryCodeSelect.val === 'function') {
                                $countryCodeSelect.val(countryCodeMap[country]).trigger('change');
                            }
                        }
                    } catch (error) {
                        console.log('Error syncing country code:', error);
                    }
                });
            }
        }
        
        // Initialize the form with error handling
        try {
            new CheckoutForm();
        } catch (error) {
            console.log('Error initializing CheckoutForm:', error);
            
            // Fallback: Simple select handling
            $('.country-select').on('change', function() {
                const $select = $(this);
                if ($select.val()) {
                    $select.addClass('selected');
                } else {
                    $select.removeClass('selected');
                }
            });
        }
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

/* New Customer Form Styles */
.new-customer-form {
    padding: 0;
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row .form-group {
    flex: 1;
}

.form-group {
    margin-bottom: 20px;
    position: relative;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 14px;
}

.required {
    color: #e74c3c;
    font-weight: bold;
}

.optional {
    color: #7f8c8d;
    font-weight: normal;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: white;
    color: #2c3e50;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.form-group input.error,
.form-group select.error,
.form-group textarea.error {
    border-color: #e74c3c;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
}

/* Phone Input Styles */
.phone-group {
    position: relative;
}

.phone-input {
    display: flex;
    gap: 0;
}

.phone-input .country-select {
    flex: 0 0 120px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-right: 1px solid #e9ecef;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

.phone-input input {
    flex: 1;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

/* Country Select Styles */
.country-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
    cursor: pointer;
}

.country-select:focus {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233498db' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
}

.country-select.selected {
    color: #2c3e50 !important;
    font-weight: 600 !important;
    background-color: #f8f9fa !important;
    border-color: #27ae60 !important;
}

.country-select option {
    padding: 8px 12px;
    background: white;
    color: #2c3e50;
}

.country-select option:checked {
    background: #3498db;
    color: white;
}

/* Textarea Styles */
.form-group textarea {
    resize: vertical;
    min-height: 80px;
    font-family: inherit;
}

/* Error Message Styles */
.error-message {
    color: #e74c3c;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

.error-message.show {
    display: block;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .phone-input {
        flex-direction: column;
    }
    
    .phone-input .country-select {
        border-radius: 8px 8px 0 0;
        border-right: 2px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }
    
    .phone-input input {
        border-radius: 0 0 8px 8px;
        border-top: none;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Additional styling for serving method */
.serving-methods .method-option.selected .method-info {
    color: white !important;
}

.serving-methods .method-option.selected .method-info h4 {
    color: white !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
    margin: 0 0 5px 0 !important;
}

.serving-methods .method-option.selected .method-info p {
    color: rgba(255, 255, 255, 0.9) !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
    margin: 0 !important;
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

/* Single method option styling */
.serving-methods .method-option.selected {
    background: linear-gradient(135deg, #27ae60, #2ecc71) !important;
    border: 2px solid #27ae60 !important;
    box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3) !important;
    border-radius: 12px !important;
}

.serving-methods .method-option.selected .method-label {
    color: white !important;
    background: transparent !important;
}

.serving-methods .method-option.selected .method-icon {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
}

.serving-methods .method-option.selected .method-info h4 {
    color: white !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}

.serving-methods .method-option.selected .method-info p {
    color: rgba(255, 255, 255, 0.9) !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}

.method-option {
    position: relative;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.method-option.selected {
    transform: scale(1.02);
    cursor: default;
}

.method-option.selected:hover {
    transform: scale(1.02) !important;
    box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4) !important;
}

/* Force override for selected method */
.serving-methods .method-option.selected {
    background: linear-gradient(135deg, #27ae60, #2ecc71) !important;
    border: 2px solid #27ae60 !important;
    box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3) !important;
    border-radius: 12px !important;
    padding: 20px !important;
}

.serving-methods .method-option.selected .method-label {
    color: white !important;
    background: transparent !important;
    display: flex !important;
    align-items: center !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
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
    transition: all 0.3s ease;
}

.serving-methods .method-option.selected .method-icon {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    font-size: 1.8rem !important;
    transform: scale(1.1) !important;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3) !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
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


.item-details {
    flex: 1;
    margin-right: 20px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
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
