<!-- Our Process Section Start -->
<div class="our-process">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">How Sunshine Solar Works</h3>
                    <h2 class="text-anime">Our Solar Installation Process</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach([
                [
                    'step' => '01',
                    'title' => 'Site Survey & Consultation',
                    'icon' => 'icon-step-1.svg',
                    'delay' => '0.25s',
                    'description' => 'We understand your energy requirements and assess your property to recommend the right solar solution for your home or business.'
                ],
                [
                    'step' => '02',
                    'title' => 'Solar System Planning',
                    'icon' => 'icon-step-2.svg',
                    'delay' => '0.5s',
                    'description' => 'Our team plans a suitable solar power system based on your electricity usage, available space, system capacity, and installation requirements.'
                ],
                [
                    'step' => '03',
                    'title' => 'Professional Installation',
                    'icon' => 'icon-step-3.svg',
                    'delay' => '0.75s',
                    'description' => 'We professionally install your solar panels and system components with a focus on reliable performance, safety, and long-term solar energy generation.'
                ]
            ] as $process)

                <div class="col-md-4">
                    <div class="step-item step-{{ $loop->iteration }} wow fadeInUp"
                         data-wow-delay="{{ $process['delay'] }}">

                        <div class="step-header">
                            <div class="step-icon">
                                <figure>
                                    <img
                                        src="{{ asset('frontend/images/'.$process['icon']) }}"
                                        alt="{{ $process['title'] }} - Sunshine Solar"
                                        loading="lazy"
                                    >
                                </figure>

                                <span class="step-no">
                                    {{ $process['step'] }}
                                </span>
                            </div>
                        </div>

                        <div class="step-content">
                            <h3>{{ $process['title'] }}</h3>

                            <p>
                                {{ $process['description'] }}
                            </p>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>
<!-- Our Process Section End -->