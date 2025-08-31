{{-- eslint-disable --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $bs->website_title }}</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('assets/front/img/' . $bs->favicon) }}" type="image/png">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/css/qr-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/qr-menu.css') }}">
    @if ($currentLang->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/front/css/qr-rtl.css') }}">
    @endif
    <link rel="stylesheet"
        href="{{ asset('assets/front/css/qr-styles.php?color=' . str_replace('#', '', $bs->base_color)) }}">
    <!--====== jquery js ======-->
    <script src="{{ asset('assets/front/js/vendor/jquery.3.2.1.min.js') }}"></script>
</head>

<body class="qr-menu">
    <div class="header">
        <div class="container">


            <div class="row no-gutters align-items-center">

                <div class="col-3">

                    <div class="logo-wrapper">
                        <a href="{{ route('front.qrmenu') }}"><img src="{{ asset('assets/front/img/' . $bs->logo) }}"
                                alt="Logo"></a>
                    </div>
                </div>

                <div class="col-9 d-flex justify-content-end">
                    <form id="langForm" action="" class='mr-2'>
                        <select class="form-control form-control-md"
                            onchange="document.getElementById('langForm').setAttribute('action', '{{ url('changelanguage') }}' + '/' + this.value + '/qr'); document.getElementById('langForm').submit()">
                            @foreach ($langs as $lang)
                                <option value="{{ $lang->code }}"
                                    {{ $currentLang->code == $lang->code ? 'selected' : '' }}>{{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    @if (Auth::check() || $bs->qr_call_waiter == 1)
                        <div class="dropdown">
                            <button class="btn base-btn text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @if ($bs->qr_call_waiter == 1)
                                    <a class="dropdown-item call-waiter-hidden" data-toggle="modal"
                                        data-target="#callWaiterModal">{{ __('Call Waiter') }}</a>
                                @endif
                                @auth
                                    <a class="dropdown-item"
                                        href="{{ route('front.qrmenu.logout') }}">{{ __('Logout') }}</a>
                                @endauth
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="qr-breadcrumb lazy" data-bg="{{ asset('assets/front/img/' . $bs->breadcrumb) }}">
        <div class="container">
            <div class="qr-breadcrumb-details">
                <h2>{{ $bs->website_title }}</h2>
                <small>{{ __('Working Hours') }}: {{ $bs->office_time }}</small>
            </div>
            <h4 class="qr-page-heading">
                @yield('page-heading')
            </h4>
        </div>
    </div>


    @yield('content')

    {{-- Loader --}}
    <div class="request-loader">
        <img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
    </div>
    {{-- Loader --}}

    {{-- START: Cart Icon --}}
    <div class="cart-icon" style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px; cursor: pointer;">
        <div id="cartQuantity" class="cartQuantity" style="display: flex; align-items: center; gap: 8px;">
            <img src="{{ asset('assets/front/img/static/cart-icon.png') }}" alt="Cart Icon" style="width: 45px; height: 45px; object-fit: contain;">
            <span class="cart-count" style="background: #dc3545; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; min-width: 20px; text-align: center;">{{ $itemsCount }}</span>
            <span class="cart-text" style="font-size: 16px; color: #333; font-weight: 500; margin-right: 5px; background: linear-gradient(45deg, #f8f9fa, #e9ecef); padding: 8px 12px; border-radius: 6px; border: 1px solid #dee2e6;">Aperçu de mes commandes</span>
        </div>
    </div>
    {{-- END: Cart Icon --}}


    {{-- START: Cart Sidebar --}}
    @include('front.qrmenu.partials.qr-cart-sidebar')
    {{-- END: Cart Sidebar --}}


    {{-- START: Call Waiter Modal --}}
    <div class="modal fade" id="callWaiterModal" tabindex="-1" role="dialog" aria-labelledby="callWaiterModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Call Waiter') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $tables = \App\Table::where('status', 1)->get();
                    @endphp
                    <form id="callWaiterForm" action="{{ route('front.callwaiter') }}" method="GET">
                        <select class="form-control" name="table" required>
                            <option value="" disabled selected>{{ __('Select a Table') }}</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->table_no }}">{{ __('Table') }} - {{ $table->table_no }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="callWaiterForm"
                        class="btn base-btn text-white">{{ __('Call Waiter') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END: Call Waiter Modal --}}

    {{-- global variables --}}
    <script>
        var mainurl = "{{ url('/') }}";
        var position = "{{ $be->base_currency_symbol_position }}";
        var symbol = "{{ $be->base_currency_symbol }}";
        var textPosition = "{{ $be->base_currency_text_position }}";
        var currText = "{{ $be->base_currency_text }}";
        var select = "{{ __('Select') }}";
    </script>
    
    <style>
    .cart-icon {
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .cart-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        background: #e9ecef !important;
    }
    
    .cart-icon img {
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
    
    .cart-count {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* Cart Sidebar Styles */
    .cart-sidebar {
        position: fixed;
        top: 0;
        right: -400px;
        width: 400px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        transition: right 0.3s ease;
        z-index: 9999;
        overflow-y: auto;
    }
    
    .cart-sidebar.show {
        right: 0;
    }
    
    .cart-sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .cart-sidebar-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    .cart-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
    }
    
    .cart-header h3 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }
    
    .cart-header .close {
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        transition: background 0.3s ease;
    }
    
    .cart-header .close:hover {
        background: #e9ecef;
    }
    
    .cart-body {
        padding: 20px;
        max-height: 60vh;
        overflow-y: auto;
    }
    
    .cart-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        position: relative;
    }
    
    .cart-item .thumb img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .cart-item .details {
        flex: 1;
    }
    
    .cart-item .details h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
        color: #333;
    }
    
    .cart-item .details p {
        margin: 5px 0;
        font-size: 14px;
        color: #666;
    }
    
    .cart-total {
        padding: 20px;
        border-top: 1px solid #eee;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
        font-weight: 600;
    }
    
    .cart-footer {
        padding: 20px;
        display: flex;
        gap: 10px;
    }
    
    .cart-button {
        flex: 1;
        padding: 12px;
        text-align: center;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .cart-button.cart {
        background: #6c757d;
        color: white;
    }
    
    .cart-button.checkout {
        background: #28a745;
        color: white;
    }
    
    .cart-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .pulse-animation {
        animation: pulse 0.5s ease-in-out;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    /* Responsive design for mobile */
    @media (max-width: 768px) {
        .cart-sidebar {
            width: 100%;
            right: -100%;
        }
        
        .cart-icon {
            padding: 8px !important;
        }
        
        .cart-icon img {
            width: 35px !important;
            height: 35px !important;
        }
        
        .cart-text {
            font-size: 14px !important;
        }
    }
    </style>
    
    <script>
    $(document).ready(function() {
        // Open cart sidebar when cart icon is clicked
        $('.cart-icon').on('click', function() {
            $('.cart-sidebar').addClass('show');
            $('.cart-sidebar-overlay').addClass('show');
            $('body').css('overflow', 'hidden'); // Prevent body scroll
        });
        
        // Close cart sidebar when overlay is clicked
        $('.cart-sidebar-overlay').on('click', function() {
            $('.cart-sidebar').removeClass('show');
            $('.cart-sidebar-overlay').removeClass('show');
            $('body').css('overflow', 'auto'); // Restore body scroll
        });
        
        // Close cart sidebar when close button is clicked
        $('.cart-sidebar .close').on('click', function() {
            $('.cart-sidebar').removeClass('show');
            $('.cart-sidebar-overlay').removeClass('show');
            $('body').css('overflow', 'auto'); // Restore body scroll
        });
        
        // Close cart sidebar when ESC key is pressed
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) { // ESC key
                $('.cart-sidebar').removeClass('show');
                $('.cart-sidebar-overlay').removeClass('show');
                $('body').css('overflow', 'auto');
            }
        });
        
        // Update cart count animation
        function updateCartCount() {
            $('.cart-count').addClass('pulse-animation');
            setTimeout(function() {
                $('.cart-count').removeClass('pulse-animation');
            }, 1000);
        }
        
        // Call updateCartCount when cart is updated
        $(document).on('cartUpdated', function() {
            updateCartCount();
        });
    });
    </script>
    @if ($bs->is_recaptcha == 1)
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    @endif
    <!--====== Bootstrap js ======-->
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/qr-plugins.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("input.datepicker").datepicker();
            $('input.timepicker').timepicker();

            var $foodItems;


            function initSubcatIsotope() {
                setTimeout(function() {
                    $foodItems = $('.food-menu-items').isotope({
                        itemSelector: '.single-menu-item',
                        layoutMode: 'vertical'
                    });
                }, 100);
            }

            initSubcatIsotope();


            $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                initSubcatIsotope();
                setTimeout(function() {
                    let id = $(e.target).attr('href');
                    $(id + " button.is-checked").trigger('click');
                }, 200);
            });


            // bind filter button click
            $('.filters-button-group').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $foodItems.isotope({
                    filter: filterValue
                });
            });
            // change is-checked class on buttons
            $('.button-group').each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $(this).addClass('is-checked');
                });
            });
        });

        $(document).on('click', '.qty-add', function() {
            $(".cart-sidebar-loader-container").addClass('show');

            let $this = $(this);
            let key = $(this).data('key');
            let $input = $this.prev('input');
            $input.val(parseInt($input.val()) + 1);
            let qty = $input.val();

            changeQty(key, qty);
        });

        $(document).on('click', '.qty-sub', function() {
            $(".cart-sidebar-loader-container").addClass('show');

            let $this = $(this);
            let key = $(this).data('key');
            let $input = $this.next('input');
            if ($input.val() <= 1) {
                toastr["error"]("Quantity must be minimum 1");
                $(".cart-sidebar-loader-container").removeClass('show');
                return;
            }
            $input.val(parseInt($input.val()) - 1);
            let qty = $input.val();

            changeQty(key, qty);
        });

        function changeQty(key, qty) {
            let fd = new FormData();
            fd.append('qty', qty);
            fd.append('key', key);
            $.ajax({
                url: "{{ route('front.qr.qtyChange') }}",
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    toastr['success']('Quantity updated');
                    $(".cartQuantity").load(location.href + " .cartQuantity");
                    $("#refreshDiv").load(location.href + " #refreshDiv", function() {
                        setTimeout(function() {
                            $(".cart-sidebar-loader-container").removeClass('show');
                        }, 100);
                    });
                }
            })
        }


        $(document).on('click', '.cart-item .close', function() {
            $(".cart-sidebar-loader-container").addClass('show');
            let $this = $(this);
            let key = $this.data('key');
            let fd = new FormData();
            fd.append('key', key);

            $.ajax({
                url: "{{ route('front.qr.remove') }}",
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    toastr['success']('Item removed');
                    $(".cartQuantity").load(location.href + " .cartQuantity");
                    $("#refreshDiv").load(location.href + " #refreshDiv", function() {
                        setTimeout(function() {
                            $(".cart-sidebar-loader-container").removeClass('show');
                        }, 100);
                    })
                }
            })
        })
    </script>
    <script src="{{ asset('assets/front/js/qr-cart.js') }}"></script>

    @if (session()->has('success'))
        <script>
            "use strict";
            toastr["success"]("{{ __(session('success')) }}");
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            "use strict";
            toastr["warning"]("{{ __(session('warning')) }}");
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            "use strict";
            toastr["error"]("{{ __(session('error')) }}");
        </script>
    @endif

<!---- g-recaptcha -->
    @if ($bs->is_recaptcha == 1)
        <script type="text/javascript">
            var recaptchaCount = $('#g-recaptcha').length;
            if (recaptchaCount) {
                var onloadCallback = function() {
                    grecaptcha.render('g-recaptcha', {
                        'sitekey': '{{ $bs->google_recaptcha_site_key }}'
                    });
                };
            }
        </script>
    @endif

    @yield('script')
</body>

</html>
