<!-- Our Team Section Start -->
<div class="our-team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $teamData['subtitle'] ?? 'Our Team' }}</h3>
                    <h2 class="text-anime">{{ $teamData['title'] ?? 'Our Best Experts' }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @php
                $teamMembers = $teamData['members'] ?? [
                    [
                        'name' => 'John Doe',
                        'position' => 'Solar Engineer',
                        'image' => 'team-1.jpg',
                        'delay' => '0.25s'
                    ],
                    [
                        'name' => 'Arita Benson',
                        'position' => 'Solar Engineer',
                        'image' => 'team-2.jpg',
                        'delay' => '0.5s'
                    ],
                    [
                        'name' => 'W. S. Gilbert',
                        'position' => 'Solar Engineer',
                        'image' => 'team-3.jpg',
                        'delay' => '0.75s'
                    ],
                    [
                        'name' => 'Alpa Silva',
                        'position' => 'Solar Engineer',
                        'image' => 'team-4.jpg',
                        'delay' => '1.0s'
                    ]
                ];
            @endphp

            @foreach($teamMembers as $member)
                <div class="col-lg-3 col-md-6">
                    <!-- Team Item Start -->
                    <div class="team-item wow fadeInUp" data-wow-delay="{{ $member['delay'] }}">
                        <div class="team-image">
                            <figure class="image-anime">
                                <img src="{{ asset('frontend/images/'.$member['image']) }}" alt="{{ $member['name'] }}">
                            </figure>
                        </div>

                        <div class="team-content">
                            <h2>{{ $member['name'] }}</h2>
                            <p>{{ $member['position'] }}</p>
                            <a href="#" class="btn-team-link">
                                <img src="{{ asset('frontend/images/icon-link-dark.svg') }}" alt="View Profile">
                            </a>
                        </div>
                    </div>
                    <!-- Team Item End -->
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Team Section End -->