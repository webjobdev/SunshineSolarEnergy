<!-- Topbar Section Start -->
{{-- SunshineSolarEnergy\resources\views\frontend\partials\topbar.blade.php --}}
<div class="topbar wow fadeInUp">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="topbar-contact-info">
                    <ul>
                        <li><a href="mailto:info@domain.com"><i class="fa-solid fa-envelope"></i> info@domain.com</a></li>
                        <li><a href="tel:+012482482481"><i class="fa-solid fa-phone"></i> +01 248 248 2481</a></li>
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
                            <li data-lang="gu" data-label="ગુજરાતી" class="active"><i class="fa-solid fa-language text-warning me-2"></i>🇮🇳 ગુજરાતી</li>
                            <li data-lang="hi" data-label="हिंदी"><i class="fa-solid fa-language text-warning me-2"></i>हिंदी</li>
                            <li data-lang="en" data-label="English"><i class="fa-solid fa-earth-americas text-warning me-2"></i>English</li>
                        </ul>
                    </div>

                    <!-- Hidden Google widget - never shown to user -->
                    <div id="google_translate_element" style="display:none;"></div>

                    <div class="header-social-links">
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar Section End -->