<!-- Our Services Section Start -->
<div class="our-services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Our Services</h3>
                    <h2 class="text-anime">Best Offer For Renewable Energy</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="services-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($services ?? [] as $service)
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-image">
                                            <figure>
                                                <img src="{{ asset('frontend/images/service-'.$loop->iteration.'.jpg') }}" alt="">
                                            </figure>
                                            <div class="service-icon">
                                                <img src="{{ asset('frontend/images/icon-service-'.$loop->iteration.'.svg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="service-content">
                                            <h3>{{ $service['title'] ?? 'Solar Maintenance' }}</h3>
                                            <p>{{ $service['description'] ?? 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Services Section End -->