<!-- Topbar Section Start -->
{{-- SunshineSolarEnergy\resources\views\frontend\partials\topbar.blade.php --}}
<div class="topbar wow fadeInUp">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="topbar-contact-info">
                    <ul>
                        <!-- Email -->
                        <li>
                            <a href="mailto:{{ configSetting('contact_email') }}">
                                <i class="fa-solid fa-envelope"></i>
                                {{ configSetting('contact_email') }}
                            </a>
                        </li>

                        <!-- Phone -->
                        <li>
                            <a href="tel:{{ configSetting('contact_phone') }}">
                                <i class="fa-solid fa-phone"></i>
                                {{ configSetting('contact_phone') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="topbar-right d-flex align-items-center justify-content-md-end">

                    <!-- Custom Language Switcher (drives Google Translate) -->
                    <div class="lang-switcher" id="langSwitcher">
                        <button type="button" class="lang-switcher-toggle" id="langSwitcherToggle">
                            <i class="fa-solid fa-language ms-2 fs-6"></i>
                            <span id="langSwitcherLabel">ગુજરાતી</span>
                            <i class="fa-solid fa-caret-down ms-2 mb-2 fs-6"></i>
                        </button>
                        <ul class="lang-switcher-menu" id="langSwitcherMenu">
                            <li data-lang="gu" data-label="ગુજરાતી" class="active"><i
                                    class="fa-solid fa-language text-warning me-2"></i>🇮🇳 ગુજરાતી</li>
                            <li data-lang="hi" data-label="हिंदी"><i
                                    class="fa-solid fa-language text-warning me-2"></i>हिंदी</li>
                            <li data-lang="en" data-label="English"><i
                                    class="fa-solid fa-earth-americas text-warning me-2"></i>English</li>
                        </ul>
                    </div>

                    <!-- Hidden Google widget - never shown to user -->
                    <div id="google_translate_element" style="display:none;"></div>

                    @if(
                            configSetting('social_facebook') ||
                            configSetting('social_twitter') ||
                            configSetting('social_instagram') ||
                            configSetting('social_linkedin') ||
                            configSetting('social_youtube') ||
                            configSetting('whatsapp_number')
                        )
                        <div class="header-social-links">
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

                                {{-- Instagram --}}
                                @if(configSetting('social_instagram'))
                                    <li>
                                        <a href="{{ configSetting('social_instagram') }}" target="_blank"
                                            rel="noopener noreferrer" aria-label="Instagram">
                                            <i class="fa-brands fa-instagram"></i>
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
            </div>
        </div>
    </div>
</div>
<!-- Topbar Section End -->