<!-- Services List Page Start -->
<div class="page-services">
    <div class="container">
        <div class="row">
            @php
                $services = $servicesData['items'] ?? [
                    [
                        'title' => 'Solar Maintenance',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-1.jpg',
                        'icon' => 'icon-service-1.svg',
                        'delay' => '0.25s',
                        'slug' => 'solar-maintenance'
                    ],
                    [
                        'title' => 'Energy Saving Devices',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-2.jpg',
                        'icon' => 'icon-service-2.svg',
                        'delay' => '0.5s',
                        'slug' => 'energy-saving-devices'
                    ],
                    [
                        'title' => 'Solar Solutions',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-3.jpg',
                        'icon' => 'icon-service-3.svg',
                        'delay' => '0.75s',
                        'slug' => 'solar-solutions'
                    ],
                    [
                        'title' => 'Solar PV Systems',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-4.jpg',
                        'icon' => 'icon-service-4.svg',
                        'delay' => '1.0s',
                        'slug' => 'solar-pv-systems'
                    ],
                    [
                        'title' => 'Hybrid Energy',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-5.jpg',
                        'icon' => 'icon-service-5.svg',
                        'delay' => '1.25s',
                        'slug' => 'hybrid-energy'
                    ],
                    [
                        'title' => 'Renewable Energy',
                        'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                        'image' => 'service-6.jpg',
                        'icon' => 'icon-service-6.svg',
                        'delay' => '1.5s',
                        'slug' => 'renewable-energy'
                    ]
                ];
            @endphp

            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="{{ $service['delay'] }}">
                        <a href="{{ route('service.single', $service['slug']) }}" class="service-box-link"></a>

                        <div class="service-image">
                            <figure>
                                <img src="{{ asset('frontend/images/'.$service['image']) }}" alt="{{ $service['title'] }}">
                            </figure>

                            <div class="service-icon">
                                <img src="{{ asset('frontend/images/'.$service['icon']) }}" alt="{{ $service['title'] }}">
                            </div>
                        </div>

                        <div class="service-content">
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['description'] }}</p>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Services List Page End -->