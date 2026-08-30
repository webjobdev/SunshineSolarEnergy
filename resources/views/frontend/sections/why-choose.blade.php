<!-- Why Choose us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Why Choose Us</h3>
                    <h2 class="text-anime">Providing Solar Energy Solutions</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach([
                ['title' => 'Efficiency & Power', 'icon' => 'icon-whyus-1.svg', 'image' => 'whyus-1.jpg', 'delay' => '0.25s'],
                ['title' => 'Trust & Warranty', 'icon' => 'icon-whyus-2.svg', 'image' => 'whyus-2.jpg', 'delay' => '0.5s'],
                ['title' => 'High Quality Work', 'icon' => 'icon-whyus-3.svg', 'image' => 'whyus-3.jpg', 'delay' => '0.75s'],
                ['title' => '24*7 Support', 'icon' => 'icon-whyus-4.svg', 'image' => 'whyus-4.jpg', 'delay' => '1.0s']
            ] as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="{{ $item['delay'] }}">
                        <div class="why-choose-image">
                            <img src="{{ asset('frontend/images/'.$item['image']) }}" alt="">
                        </div>
                        <div class="why-choose-content">
                            <div class="why-choose-icon">
                                <img src="{{ asset('frontend/images/'.$item['icon']) }}" alt="">
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Why Choose us Section End -->