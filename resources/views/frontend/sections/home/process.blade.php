<!-- Our Process Section Start -->
<div class="our-process">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Our Latest Process</h3>
                    <h2 class="text-anime">Our Work Process</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach([
                ['step' => '01', 'title' => 'Project Planing', 'icon' => 'icon-step-1.svg', 'delay' => '0.25s'],
                ['step' => '02', 'title' => 'Research & Analysis', 'icon' => 'icon-step-2.svg', 'delay' => '0.5s'],
                ['step' => '03', 'title' => 'Solar Installation', 'icon' => 'icon-step-3.svg', 'delay' => '0.75s']
            ] as $process)
                <div class="col-md-4">
                    <div class="step-item step-{{ $loop->iteration }} wow fadeInUp" data-wow-delay="{{ $process['delay'] }}">
                        <div class="step-header">
                            <div class="step-icon">
                                <figure>
                                    <img src="{{ asset('frontend/images/'.$process['icon']) }}" alt="">
                                </figure>
                                <span class="step-no">{{ $process['step'] }}</span>
                            </div>
                        </div>
                        <div class="step-content">
                            <h3>{{ $process['title'] }}</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Process Section End -->