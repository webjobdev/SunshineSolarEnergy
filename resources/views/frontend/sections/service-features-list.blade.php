<!-- Service Features List Start -->
<div class="service-features">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="service-feature-image">
                <figure class="image-anime">
                    <img src="{{ asset('frontend/images/'.$service->feature_image ?? 'planning.jpg') }}" 
                         alt="{{ $service->feature_title ?? 'Planning & Strategy' }}">
                </figure>
            </div>
        </div>

        <div class="col-md-6">
            <div class="service-feature-content">
                <h2>{{ $service->feature_title ?? 'Planning & Strategy' }}</h2>
                <p>{{ $service->feature_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text ever since the 1500s.' }}</p>
                <ul>
                    @foreach($service->feature_list ?? [
                        'Research beyond the business plan',
                        'Marketing options and rates',
                        'The ability to turnaround consulting',
                        'It was popularised in the 1960s with the.'
                    ] as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Service Features List End -->