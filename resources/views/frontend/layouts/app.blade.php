<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Solor - Solar & Renewable Energy HTML Template')">
    <meta name="keywords" content="@yield('meta_keywords', 'solar, renewable, energy')">
    <meta name="author" content="Awaiken">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Page Title -->
    <title>@yield('title', 'Solor - Solar & Renewable Energy')</title>
    
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/slicknav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>

<body class="tt-magic-cursor">
    
    <!-- Preloader -->
    @include('frontend.partials.preloader')
    
    <!-- Magic Cursor -->
    @include('frontend.partials.magic-cursor')
    
    <!-- Topbar -->
    @include('frontend.partials.topbar')
    
    <!-- Header -->
    @include('frontend.partials.header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer Ticker -->
    @include('frontend.partials.footer-ticker')
    
    <!-- Footer -->
    @include('frontend.partials.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/validator.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('frontend/js/parallaxie.js') }}"></script>
    <script src="{{ asset('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magiccursor.js') }}"></script>
    <script src="{{ asset('frontend/js/splitType.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/js/function.js') }}"></script>
    
    @stack('scripts')
</body>
</html>