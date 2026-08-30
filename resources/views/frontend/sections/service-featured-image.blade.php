<!-- Service Featured Image Start -->
<div class="service-featured-image">
    <figure class="image-anime">
        <img src="{{ asset('frontend/images/'.$service->featured_image ?? 'service-feature-img.jpg') }}" 
             alt="{{ $service->title ?? 'Service' }}">
    </figure>
</div>
<!-- Service Featured Image End -->