<!-- Testimonial Section Start -->
<div class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">{{ $testimonialData['subtitle'] ?? 'Testimonials' }}</h3>
                    <h2 class="text-anime">{{ $testimonialData['title'] ?? 'Words From Our Customer' }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Testimonial Slider Start -->
                <div class="testimonial-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @php
                                $testimonials = $testimonialData['items'] ?? [
                                    [
                                        'name' => 'John Doe',
                                        'role' => 'Customer',
                                        'image' => 'author-1.jpg',
                                        'rating' => 5,
                                        'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                                    ],
                                    [
                                        'name' => 'Arita Benson',
                                        'role' => 'Customer',
                                        'image' => 'author-2.jpg',
                                        'rating' => 5,
                                        'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                                    ],
                                    [
                                        'name' => 'W. S. Gilbert',
                                        'role' => 'Customer',
                                        'image' => 'author-3.jpg',
                                        'rating' => 5,
                                        'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                                    ]
                                ];
                            @endphp

                            @foreach($testimonials as $testimonial)
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-author-img">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('frontend/images/'.$testimonial['image']) }}" alt="{{ $testimonial['name'] }}">
                                                </figure>

                                                <div class="icon-quote">
                                                    <img src="{{ asset('frontend/images/icon-quote.svg') }}" alt="Quote">
                                                </div>
                                            </div>

                                            <h2>{{ $testimonial['name'] }}</h2>
                                            <p>({{ $testimonial['role'] }})</p>

                                            <div class="testimonial-rating">
                                                {{-- @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++) --}}
                                                 {{-- @for($i = 0; $i < 5 ;$i++) --}}
                                                    <img src="{{ asset('frontend/images/icon-star.svg') }}" alt="Star">
                                                {{-- @endfor --}}
                                            </div>
                                        </div>

                                        <div class="testimonial-body">
                                            <p>{{ $testimonial['quote'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            @endforeach
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- Testimonial Slider End -->
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Section End -->