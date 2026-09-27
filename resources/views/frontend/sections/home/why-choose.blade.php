<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="section-title">

                    <h3 class="wow fadeInUp">
                        Why Choose Sunshine Solar
                    </h3>

                    <h2 class="text-anime">
                        Reliable Solar Energy Solutions
                    </h2>

                </div>
            </div>
        </div>

        <div class="row">

            @foreach([
                    [
                        'title' => 'Energy Efficient Solutions',
                        'icon' => 'icon-whyus-1.svg',
                        'image' => 'whyus-1.jpg',
                        'delay' => '0.25s',
                        'description' => 'We provide solar solutions designed to help homes and businesses generate clean energy and reduce their dependence on conventional electricity.'
                    ],
                    [
                        'title' => 'Quality Solar Products',
                        'icon' => 'icon-whyus-2.svg',
                        'image' => 'whyus-2.jpg',
                        'delay' => '0.5s',
                        'description' => 'We focus on reliable solar panels, system components, and solar products selected for practical and long-term energy requirements.'
                    ],
                    [
                        'title' => 'Professional Installation',
                        'icon' => 'icon-whyus-3.svg',
                        'image' => 'whyus-3.jpg',
                        'delay' => '0.75s',
                        'description' => 'Our solar installation process is planned around your property, energy requirements, available space, and system specifications.'
                    ],
                    [
                        'title' => 'Customer Support',
                        'icon' => 'icon-whyus-4.svg',
                        'image' => 'whyus-4.jpg',
                        'delay' => '1.0s',
                        'description' => 'We stay connected with our customers and provide support throughout the solar installation journey and beyond.'
                    ]
                ] as $item)

                <div class="col-lg-3 col-md-6">
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="{{ $item['delay'] }}">

                        <div class="why-choose-image">
                            <img src="{{ asset('frontend/images/' . $item['image']) }}"
                                alt="{{ $item['title'] }} - Sunshine Solar" loading="lazy">
                        </div>

                        <div class="why-choose-content">

                            <div class="why-choose-icon">
                                <img src="{{ asset('frontend/images/' . $item['icon']) }}" alt="{{ $item['title'] }}"
                                    loading="lazy">
                            </div>

                            <h3>{{ $item['title'] }}</h3>

                            <p>
                                {{ $item['description'] }}
                            </p>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->