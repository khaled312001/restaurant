<!doctype html>
<html lang="fr" @if ($rtl == 1) dir="rtl" @endif>
<head>
{{-- -Start of Google Analytics script --}}
@if ($bs->is_analytics == 1)
{!! $bs->google_analytics_script !!}
@endif
{{-- -End of Google Analytics script --}}
{{-- -====== Required meta tags ====== --}}
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Enhanced SEO Meta Tags --}}
<title>@yield('page-title', 'King Kebab Le Pouzin - Meilleur Kebab, Tacos, Burgers Halal | Restaurant Turc Authentique')</title>
<meta name="description" content="@yield('meta-description', 'King Kebab Le Pouzin ⭐ Restaurant kebab halal authentique depuis 20 ans. Spécialités: kebab, tacos, burgers, menus enfant. Ingrédients frais, viande 100% halal. Livraison et sur place.')">
<meta name="keywords" content="@yield('meta-keywords', 'King Kebab, kebab Le Pouzin, restaurant halal, tacos Le Pouzin, burger halal, kebab authentique, restaurant turc, viande halal, livraison kebab, menu enfant halal, assiettes kebab, sandwichs halal, nos box, salade halal, panini halal, King Kebab Le Pouzin, meilleur kebab Ardèche, restaurant Le Pouzin, cuisine turque, kebab grillé charbon, spécialités orientales')">
{{-- Geo Tags for Local SEO --}}
<meta name="geo.region" content="FR-07">
<meta name="geo.placename" content="Le Pouzin">
<meta name="geo.position" content="44.7522;4.7469">
<meta name="ICBM" content="44.7522, 4.7469">
{{-- Open Graph Tags for Social Media --}}
<meta property="og:site_name" content="King Kebab Le Pouzin">
<meta property="og:title" content="@yield('og-title', 'King Kebab Le Pouzin - Restaurant Kebab Halal Authentique')">
<meta property="og:description" content="@yield('og-description', 'Découvrez King Kebab Le Pouzin, restaurant kebab halal authentique depuis 20 ans. Spécialités turques, ingrédients frais, viande 100% halal. Livraison disponible.')">
<meta property="og:type" content="@yield('og-type', 'website')">
<meta property="og:url" content="@yield('og-url', url()->current())">
<meta property="og:image" content="@yield('og-image', asset('assets/front/img/king-kebab-og-image.jpg'))">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="fr_FR">
{{-- Twitter Card Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('twitter-title', 'King Kebab Le Pouzin - Restaurant Kebab Halal Authentique')">
<meta name="twitter:description" content="@yield('twitter-description', 'Restaurant kebab halal authentique depuis 20 ans. Spécialités turques, ingrédients frais, viande 100% halal.')">
<meta name="twitter:image" content="@yield('twitter-image', asset('assets/front/img/king-kebab-twitter-image.jpg'))">
{{-- Additional SEO Tags --}}
<meta name="author" content="King Kebab Le Pouzin">
<meta name="robots" content="@yield('robots', 'index, follow')">
<meta name="googlebot" content="index, follow">
<meta name="revisit-after" content="1 day">
<meta name="rating" content="general">
<meta name="distribution" content="global">
<meta name="language" content="French">
{{-- Canonical URL --}}
<link rel="canonical" href="@yield('canonical', url()->current())">
{{-- Alternate Language Tags --}}
<link rel="alternate" hreflang="fr" href="{{ url('/') }}">
<link rel="alternate" hreflang="fr-FR" href="{{ url('/') }}">
<link rel="alternate" hreflang="x-default" href="{{ url('/') }}">
{{-- -====== Favicon Icon ====== --}}
<link rel="shortcut icon" href="{{ asset('assets/front/img/' . $bs->favicon) }}" type="image/png">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/front/img/' . $bs->favicon) }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/front/img/' . $bs->favicon) }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/front/img/' . $bs->favicon) }}">
{{-- --=========Plugin common css===========- --}}
@include('front.plugin_css')
@include('front.themes_css')
@yield('style')
{{-- -=====Theme wise Header & Footer css == --}}
@include('front.themes_header_footer_css')
<link rel="stylesheet" href="{{ asset('assets/front/plugin_css/styles.php?color=' . str_replace('#', '', $bs->base_color)) }}">
{{-- --========Theme wise End Header & Footer css=======-- --}}
{{-- Custom CSS to hide Call Waiter and Login --}}
<link rel="stylesheet" href="{{ asset('css/hide-elements.css') }}">
{{-- Fix for whitespace issues --}}
<link rel="stylesheet" href="{{ asset('css/fix-whitespace.css') }}">
{{-- ---==================== Common js=======================---- --}}
@include('front.plugin_js')
{{-- --============= Common js===========================--- --}}
</head>
@php
$bodyClass = '';
if ($activeTheme == 'bakery') {
$bodyClass = 'theme-dark';
}
@endphp
<body class="{{ $bodyClass }}">
{{-- -====== PRELOADER PART START ====== --}}
@if ($bs->preloader_status == 1)
<div id="preloader">
<div class="loader revolve">
<img src="{{ asset('assets/front/img/' . $bs->preloader) }}" alt="">
</div>
</div>
@endif
{{-- -====== PRELOADER PART ENDS ====== --}}
{{-- Loader --}}
<div class="request-loader" id="">
<img src="{{ asset('assets/admin/img/loader.gif') }}" alt="">
</div>
{{-- Loader --}}
{{-- -======Theme wise  HEADER PART START ====== --}}
@include('front.themes_header')
{{-- -======Theme wise HEADER PART ENDS ====== --}}
@yield('content')
{{-- -====== FOOTER PART START ====== --}}
@include('front.themes_footer')
{{-- -====== FOOTER PART ENDS ====== --}}
{{-- Popups start --}}
@includeIf('front.partials.popups')
{{-- Popups end --}}
{{-- Variation Modal Starts --}}
@includeIf('front.partials.variation-modal')
{{-- Variation Modal Ends --}}
{{-- -====== GO TO TOP PART START ====== --}}
@if ($activeTheme == 'multipurpose')
<div class="go-top-area">
<div class="go-top-wrap">
<div class="go-top-btn-wrap">
<div class="go-top go-top-btn">
<i class="fa fa-angle-double-up"></i>
<i class="fa fa-angle-double-up"></i>
</div>
</div>
</div>
</div>
@else
{{-- -- other theme- --}}
<div class="go-top"><i class="fal fa-angle-up"></i></div>
@endif
{{-- -====== GO TO TOP PART ENDS ====== --}}
{{-- WhatsApp Chat Button --}}
<div id="WAButton"></div>
{{-- Cookie alert dialog start --}}
<div class="cookie">
@include('cookie-consent::index')
</div>
{{-- Cookie alert dialog end --}}
{{-- -- Themes  Moda Part-- --}}
@include('front.themes_model')
<script>
"use strict";
var mainurl = "{{ url('/') }}";
var lat = '{{ $bs->latitude }}';
var lng = '{{ $bs->longitude }}';
var rtl = {{ $rtl }};
var position = "{{ $be->base_currency_symbol_position }}";
var symbol = "{{ $be->base_currency_symbol }}";
var textPosition = "{{ $be->base_currency_text_position }}";
var currText = "{{ $be->base_currency_text }}";
var vap_pub_key = "{{ env('VAPID_PUBLIC_KEY') }}";
var select = "{{ __('Select') }}";
</script>
{{-- ------------==================Common js=============== - --}}
@include('front.themes_js')
{{-- ---========Theme wise Start Header and Footer  js---------------- --}}
@include('front.themes_header_footer_js')
{{-- ---======== End Header and Footer  js---------------- --}}
@yield('script')
{{-- ----------------- All Page requied Common js  ---------------------------- --}}
<script>
$(document).ready(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
</script>
{{-- whatsapp init code --}}
@if ($bs->is_whatsapp == 1)
<script type="text/javascript">
var whatsapp_popup = {{ $bs->whatsapp_popup }};
var whatsappImg = "{{ asset('assets/front/img/whatsapp.svg') }}";
$(function() {
$('#WAButton').floatingWhatsApp({
phone: "{{ $bs->whatsapp_number }}", //WhatsApp Business phone number
headerTitle: "{{ $bs->whatsapp_header_title }}", //Popup Title
popupMessage: `{!! nl2br($bs->whatsapp_popup_message) !!}`, //Popup Message
showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
position: "right" //Position: left | right
});
});
</script>
@endif
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
{{-- -Start of Tawk.to script --}}
@if ($bs->is_tawkto == 1)
{!! $bs->tawk_to_script !!}
@endif
{{-- -End of Tawk.to script --}}
{{-- -Start of AddThis script --}}
@if ($bs->is_addthis == 1)
{!! $bs->addthis_script !!}
@endif
{{-- -End of AddThis script --}}
{{-- Structured Data JSON-LD --}}
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Restaurant",
"name": "King Kebab Le Pouzin",
"image": "{{ asset('assets/front/img/' . $bs->favicon) }}",
"description": "Restaurant kebab halal authentique depuis 20 ans à Le Pouzin. Spécialités turques, ingrédients frais, viande 100% halal.",
"address": {
"@type": "PostalAddress",
"streetAddress": "Le Pouzin",
"addressLocality": "Le Pouzin",
"addressRegion": "Ardèche",
"postalCode": "07250",
"addressCountry": "FR"
},
"geo": {
"@type": "GeoCoordinates",
"latitude": 44.7522,
"longitude": 4.7469
},
"url": "https://kingkebablepouzin.fr",
"telephone": "+33 0426423743",
"email": "support@kingkebabrestaurant.com",
"priceRange": "€",
"servesCuisine": ["Turkish", "Mediterranean", "Middle Eastern", "Halal"],
"paymentAccepted": ["Cash", "Credit Card"],
"currenciesAccepted": "EUR",
"openingHours": "Mo-Fr 09:00-23:00",
"hasMenu": "https://kingkebablepouzin.fr/menu",
"acceptsReservations": true,
"aggregateRating": {
"@type": "AggregateRating",
"ratingValue": "4.8",
"reviewCount": "150"
}
}
</script>
</body>
</html>