<!-- Infobar Section Start -->
<div class="infobar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cta-box">

                    <div class="row align-items-center">

                        <!-- CTA Image -->
                        <div class="col-lg-4">
                            <div class="cta-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('frontend/images/cta-image.jpg') }}"
                                        alt="Sunshine Solar solar energy solutions" loading="lazy">
                                </figure>
                            </div>
                        </div>

                        <!-- CTA Content -->
                        <div class="col-lg-8">
                            <div class="cta-content">

                                <div class="phone-icon">
                                    <figure>
                                        <img src="{{ asset('frontend/images/icon-cta-phone.svg') }}"
                                            alt="Call Sunshine Solar">
                                    </figure>
                                </div>

                                <h3 class="text-anime">
                                    Need Solar Solutions?
                                    <span>Call Sunshine Solar</span>
                                </h3>

                                <p class="wow fadeInUp" data-wow-delay="0.25s">
                                    Looking for reliable solar panel installation
                                    and renewable energy solutions? Contact
                                    Sunshine Solar for solar system consultation,
                                    installation, and energy-saving solutions for
                                    your home or business.
                                </p>

                                <a href="tel:+ {{ configSetting('contact_phone') }}" class="btn-default wow fadeInUp" data-wow-delay="0.5s">
                                    Call Now: {{ configSetting('contact_phone') }}
                                </a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Infobar Section End -->