<!-- About Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- About us Image Start -->
                <div class="about-image">
                    <div class="about-img-1">
                        <figure class="reveal image-anime">
                            <img src="{{ asset('frontend/images/about-1.jpg') }}" alt="About Solar Energy">
                        </figure>
                    </div>

                    <div class="about-img-2">
                        <figure class="reveal image-anime">
                            <img src="{{ asset('frontend/images/about-2.jpg') }}" alt="Solar Installation">
                        </figure>
                    </div>
                </div>
                <!-- About us Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $aboutData['subtitle'] ?? 'About Us' }}</h3>
                    <h2 class="text-anime">{{ $aboutData['title'] ?? 'About Green Energy Solar' }}</h2>
                </div>
                <!-- Section Title End -->

                <!-- About us Content Start -->
                <div class="about-content wow fadeInUp" data-wow-delay="0.25s">
                    <p>{{ $aboutData['description1'] ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.' }}</p>

                    <p>{{ $aboutData['description2'] ?? 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.' }}</p>

                    <ul>
                        @foreach($aboutData['features'] ?? [
                            'Solar Inverter Setup',
                            'Battery Storage Solutions',
                            'Solar Material Financing',
                            '24 X 7 Call & Chat Support',
                            'Proven Track Record',
                            'Customer-Centric Approach'
                        ] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- About us Content End -->
            </div>
        </div>
    </div>
</div>
<!-- About Section End -->