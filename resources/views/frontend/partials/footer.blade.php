<!-- Footer Start -->
@php
    use App\Models\Admin\ProductBrand;

    $footerBrands = ProductBrand::query()
        ->orderBy('name')
        ->limit(5)
        ->get();
@endphp
<footer class="main-footer">
    <!-- Footer Contact -->
    <!-- Footer Contact Start -->
    <div class="footer-contact">
        <div class="container">
            <div class="row">

                <!-- Email -->
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.25s">

                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-email.svg') }}" alt="Sunshine Solar Email">
                        </div>

                        <div class="footer-contact-info">
                            <h3>Support & Email</h3>

                            <p>
                                <a class="text-light" target="_blank"
                                    href="mailto:{{ configSetting('contact_email') }}">
                                    {{ configSetting('contact_email') }}
                                </a>
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Phone -->
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.5s">

                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-phone.svg') }}" alt="Sunshine Solar Phone">
                        </div>

                        <div class="footer-contact-info">
                            <h3>Customer Support</h3>

                            <p>
                                <a class="text-light" target="_blank" href="tel:{{ configSetting('contact_phone') }}">
                                    {{ configSetting('contact_phone') }}
                                </a>
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Location -->
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.75s">

                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-location.svg') }}" alt="Sunshine Solar Location">
                        </div>

                        <div class="footer-contact-info">
                            <h3>Our Location</h3>
                            <p>
                                {{ configSetting('contact_address') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Contact End -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Mega Footer -->
                <div class="mega-footer">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">

                            {{-- Footer About --}}
                            <div class="footer-about">
                                <figure>
                                    <img style="height: 100px;" src="{{ configImage('web_logo') }}"
                                        alt="{{ configSetting('web_name', 'Sunshine Solar') }}">
                                </figure>

                                <p>
                                    Sunshine Solar provides reliable solar energy solutions, solar panel systems,
                                    professional installation, and dedicated support for homes and businesses.
                                </p>
                            </div>

                            {{-- Footer Social Links --}}
                            @if(
                                    configSetting('social_facebook') ||
                                    configSetting('social_twitter') ||
                                    configSetting('social_instagram') ||
                                    configSetting('social_linkedin') ||
                                    configSetting('social_youtube') ||
                                    configSetting('whatsapp_number')
                                )
                                <div class="footer-social-links">
                                    <ul>

                                        {{-- Facebook --}}
                                        @if(configSetting('social_facebook'))
                                            <li>
                                                <a href="{{ configSetting('social_facebook') }}" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Facebook">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Twitter / X --}}
                                        @if(configSetting('social_twitter'))
                                            <li>
                                                <a href="{{ configSetting('social_twitter') }}" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Twitter / X">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- LinkedIn --}}
                                        @if(configSetting('social_linkedin'))
                                            <li>
                                                <a href="{{ configSetting('social_linkedin') }}" target="_blank"
                                                    rel="noopener noreferrer" aria-label="LinkedIn">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Instagram --}}
                                        @if(configSetting('social_instagram'))
                                            <li>
                                                <a href="{{ configSetting('social_instagram') }}" target="_blank"
                                                    rel="noopener noreferrer" aria-label="Instagram">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- YouTube --}}
                                        @if(configSetting('social_youtube'))
                                            <li>
                                                <a href="{{ configSetting('social_youtube') }}" target="_blank"
                                                    rel="noopener noreferrer" aria-label="YouTube">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- WhatsApp --}}
                                        @if(configSetting('whatsapp_number'))
                                            <li>
                                                <a href="{{ whatsappUrl('Hello Sunshine Solar, I would like to know more about your solar services.') }}"
                                                    target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Quick Links</h2>

                                <ul>
                                    <li>
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('services') }}">Services</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('products') }}">Products</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Brands</h2>
                                <ul>
                                    @forelse($footerBrands as $brand)
                                        <li>
                                            <a href="{{ route('products', ['brand' => $brand->id]) }}">
                                                {{ $brand->name }}
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            <a href="{{ route('products') }}">
                                                Solar Brands
                                            </a>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Useful Links</h2>
                                <ul>
                                    <li><a href="{{ route('legal.privacy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('legal.terms') }}">Term & Conditions</a></li>
                                    <li><a href="{{ route('legal.disclaimer') }}">Disclaimer</a></li>
                                    <li><a href="{{ route('legal.refund') }}">Refund & Cancellation</a></li>
                                    <li><a href="{{ route('faq') }}">Support & FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                {{-- <div class="footer-copyright">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer-copyright-text">
                                <p>
                                    Copyright © {{ date('Y') }}
                                    {{ configSetting('web_name', 'Sunshine Solar') }}.
                                    All rights reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->