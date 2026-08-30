<!-- Related Services Section Start -->
<div class="related-services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Related Services</h3>
                    <h2 class="text-anime">You Might Also Like</h2>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($relatedServices as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                        <a href="{{ route('service.single', $service->slug) }}" class="service-box-link"></a>
                        
                        <div class="service-image">
                            <figure>
                                <img src="{{ asset('frontend/images/'.$service->image) }}" alt="{{ $service->title }}">
                            </figure>
                            <div class="service-icon">
                                <img src="{{ asset('frontend/images/'.$service->icon) }}" alt="{{ $service->title }}">
                            </div>
                        </div>
                        
                        <div class="service-content">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ Str::limit($service->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Related Services Section End -->