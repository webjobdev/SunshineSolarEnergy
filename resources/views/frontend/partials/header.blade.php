<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('frontend/images/logo.svg') }}" alt="Logo">
                </a>

                <!-- Main Menu -->
                <div class="collapse navbar-collapse main-menu">
                    <ul class="navbar-nav mr-auto" id="menu">
                        {{-- <li class="nav-item submenu">
                            <a class="nav-link" href="#">Home</a>
                            <ul>
                                <li class="nav-item"><a class="nav-link" href="#">Home 01 - Image</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 01 - Video</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 01 - Slider</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 02 - Image</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 02 - Video</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 02 - Slider</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 03 - Image</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 03 - Video</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Home 03 - Slider</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        {{-- contact --}}
                        {{-- <li class="nav-item submenu">
                            <a class="nav-link" href="#">Pages</a>
                            <ul>
                                <li class="nav-item"><a class="nav-link" href="#">Service Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Project Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Blog Single</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Our Team</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Team Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">FAQs</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">404</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="nav-item"><a class="nav-link" href="#">Contact</a></li> --}}
                        <li class="nav-item highlighted-menu"><a class="nav-link" href="{{ route('contact') }}">Book Now</a></li>
                    </ul>
                </div>

                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->