<!-- FAQs Page Start -->
<div class="page-faqs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title text-center">
                    <h3 class="wow fadeInUp">Frequently Asked Questions</h3>
                    <h2 class="text-anime">Find Answers to Your Questions</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.25s">
                        Browse through our most commonly asked questions about solar energy, installation, and our services.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <!-- Category Filters -->
                <div class="faq-filters wow fadeInUp" data-wow-delay="0.25s">
                    <button class="filter-btn active" data-filter="all">All</button>
                    @foreach($faqCategories ?? [] as $category)
                        <button class="filter-btn" data-filter="{{ $category['slug'] }}">
                            {{ $category['name'] }}
                        </button>
                    @endforeach
                </div>

                <!-- FAQ Accordion Start -->
                <div class="faq-accordion wow fadeInUp" data-wow-delay="0.5s">
                    <div class="accordion" id="faq_accordion">
                        @php
                            $faqs = $faqData['items'] ?? [
                                [
                                    'id' => 1,
                                    'question' => 'Understanding Renewable Energy: A Beginners Guide ?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'general',
                                    'active' => true
                                ],
                                [
                                    'id' => 2,
                                    'question' => 'The Basics of Tidal and Wave Energy?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'general',
                                    'active' => false
                                ],
                                [
                                    'id' => 3,
                                    'question' => 'Educating for a Sustainable Future?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'education',
                                    'active' => false
                                ],
                                [
                                    'id' => 4,
                                    'question' => 'Staying Informed: Resources and Further Reading on Renewable Energy?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'resources',
                                    'active' => false
                                ],
                                [
                                    'id' => 5,
                                    'question' => 'Solar Panel Types: Choosing the Right Technology for Your Installation ?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'installation',
                                    'active' => false
                                ],
                                [
                                    'id' => 6,
                                    'question' => 'Installation Process Unveiled: What to Expect During Solar Panel Setup ?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'installation',
                                    'active' => false
                                ],
                                [
                                    'id' => 7,
                                    'question' => 'Permitting and Paperwork: Navigating the Regulatory Landscape for Solar?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'regulatory',
                                    'active' => false
                                ],
                                [
                                    'id' => 8,
                                    'question' => 'Solar Inverters: Understanding Their Role in Your System?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'equipment',
                                    'active' => false
                                ],
                                [
                                    'id' => 9,
                                    'question' => 'How Much Can I Save with Solar Energy?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'savings',
                                    'active' => false
                                ],
                                [
                                    'id' => 10,
                                    'question' => 'What Maintenance Does a Solar System Require?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'maintenance',
                                    'active' => false
                                ],
                                [
                                    'id' => 11,
                                    'question' => 'Is My Roof Suitable for Solar Panel Installation?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'installation',
                                    'active' => false
                                ],
                                [
                                    'id' => 12,
                                    'question' => 'What is the Lifespan of Solar Panels?',
                                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                                    'category' => 'general',
                                    'active' => false
                                ]
                            ];
                        @endphp

                        @foreach($faqs as $index => $faq)
                            <!-- FAQ Item Start -->
                            <div class="accordion-item" data-category="{{ $faq['category'] }}">
                                <h2 class="accordion-header" id="heading{{ $faq['id'] }}">
                                    <button class="accordion-button {{ !$faq['active'] ? 'collapsed' : '' }}" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse{{ $faq['id'] }}" 
                                            aria-expanded="{{ $faq['active'] ? 'true' : 'false' }}" 
                                            aria-controls="collapse{{ $faq['id'] }}">
                                        <i class="fa-solid fa-question-circle"></i>
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>

                                <div id="collapse{{ $faq['id'] }}" 
                                     class="accordion-collapse collapse {{ $faq['active'] ? 'show' : '' }}" 
                                     aria-labelledby="heading{{ $faq['id'] }}" 
                                     data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>{{ $faq['answer'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        @endforeach
                    </div>
                </div>
                <!-- FAQ Accordion End -->
            </div>
        </div>
    </div>
</div>
<!-- FAQs Page End -->