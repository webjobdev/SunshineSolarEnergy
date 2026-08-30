<div class="service-sidebar">
    <!-- Service List Box Start -->
    <div class="services-list-box wow fadeInUp">
        <ul>
            @foreach($allServices ?? [] as $serviceItem)
                <li class="{{ $serviceItem->slug == ($service->slug ?? '') ? 'active' : '' }}">
                    <a href="{{ route('service.single', $serviceItem->slug) }}">
                        {{ $serviceItem->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- Service List Box End -->

    <!-- Sidebar CTA Box Start -->
    <div class="sidebar-cta-box wow fadeInUp">
        <div class="cta-image">
            <figure class="image-anime">
                <img src="{{ asset('frontend/images/service-cta.jpg') }}" alt="Get Professional Help">
            </figure>
        </div>

        <div class="cta-content">
            <div class="cta-icon">
                <img src="{{ asset('frontend/images/icon-phone.svg') }}" alt="Phone">
            </div>

            <h3>Get Professional Help</h3>
            <p>(+0) 123 456 789</p>
            
            <a href="#" class="btn-default">Contact Us</a>
        </div>
    </div>
    <!-- Sidebar CTA Box End -->
</div>