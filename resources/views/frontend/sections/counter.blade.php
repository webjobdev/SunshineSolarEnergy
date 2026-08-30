<!-- Counter Section Start -->
<div class="stat-counter">
    <div class="container">
        <div class="row">
            @foreach([
                ['label' => 'Project Done', 'icon' => 'icon-project.svg', 'count' => '1000'],
                ['label' => 'Happy Clients', 'icon' => 'icon-happy-clients.svg', 'count' => '1200'],
                ['label' => 'Award Winning', 'icon' => 'icon-award.svg', 'count' => '850'],
                ['label' => 'Rating Customer', 'icon' => 'icon-ratting.svg', 'count' => '1100']
            ] as $stat)
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">
                        <div class="counter-icon">
                            <img src="{{ asset('frontend/images/'.$stat['icon']) }}" alt="">
                        </div>
                        <div class="counter-content">
                            <h3><span class="counter">{{ $stat['count'] }}</span>+</h3>
                            <p>{{ $stat['label'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Counter Section End -->