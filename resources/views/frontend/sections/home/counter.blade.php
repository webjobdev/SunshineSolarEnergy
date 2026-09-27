<!-- Counter Section Start -->
<div class="stat-counter">
    <div class="container">
        <div class="row">

            @foreach([
                [
                    'label' => 'Solar Solutions',
                    'icon' => 'icon-project.svg',
                    'count' => '40'
                ],
                [
                    'label' => 'Solar Products',
                    'icon' => 'icon-happy-clients.svg',
                    'count' => '20'
                ],
                [
                    'label' => 'Service Support',
                    'icon' => 'icon-award.svg',
                    'count' => '24'
                ],
                [
                    'label' => 'Clean Energy Focus',
                    'icon' => 'icon-ratting.svg',
                    'count' => '100'
                ]
            ] as $stat)

                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">

                        <div class="counter-icon">
                            <img
                                src="{{ asset('frontend/images/'.$stat['icon']) }}"
                                alt="{{ $stat['label'] }} - Sunshine Solar"
                                loading="lazy"
                            >
                        </div>

                        <div class="counter-content">
                            <h3>
                                <span class="counter">{{ $stat['count'] }}</span>
                                <span>+</span>
                            </h3>

                            <p>{{ $stat['label'] }}</p>
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
<!-- Counter Section End -->