<!-- Latest Project Section Start -->
<div class="latest-projects">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $projectsData['subtitle'] ?? 'Latest Project' }}</h3>
                    <h2 class="text-anime">{{ $projectsData['title'] ?? 'Our Latest Projects' }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @php
                $projects = $projectsData['items'] ?? [
                    [
                        'title' => 'Photon Fusion',
                        'category' => 'Solar Power',
                        'image' => 'project-1.jpg',
                        'delay' => '0.25s'
                    ],
                    [
                        'title' => 'LuxSolar Dynamics',
                        'category' => 'Wind Energy',
                        'image' => 'project-2.jpg',
                        'delay' => '0.5s'
                    ],
                    [
                        'title' => 'HelioHarbor Dynamics',
                        'category' => 'Geothermal Energy',
                        'image' => 'project-3.jpg',
                        'delay' => '0.75s'
                    ],
                    [
                        'title' => 'SolarLoom Energy',
                        'category' => 'Solar Power',
                        'image' => 'project-4.jpg',
                        'delay' => '1.0s'
                    ]
                ];
            @endphp

            @foreach($projects as $project)
                <div class="col-lg-3 col-md-6">
                    <!-- Project Item Start -->
                    <div class="project-item wow fadeInUp" data-wow-delay="{{ $project['delay'] }}">
                        <div class="project-image">
                            <figure>
                                <img src="#" alt="{{ $project['title'] }}">
                            </figure>
                        </div>

                        <div class="project-content">
                            <h2><a href="#">{{ $project['title'] }}</a></h2>
                            <p>{{ $project['category'] }}</p>
                        </div>

                        <div class="project-link">
                            <a href="#">
                                <img src="{{ asset('frontend/images/icon-link.svg') }}" alt="View Project">
                            </a>
                        </div>
                    </div>
                    <!-- Project Item End -->
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Latest Project Section End -->