<!-- FAQs Start -->
<div class="faq-box">
    <h2 class="text-anime">{{ $service->faq_title ?? 'Frequently Asked Questions' }}</h2>

    <!-- FAQ Accordion Start -->
    <div class="faq-accordion">
        <div class="accordion" id="faq_accordion">
            @php
                $faqs = $service->faqs ?? [
                    [
                        'question' => 'Understanding Renewable Energy: A Beginners Guide ?',
                        'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                        'active' => true
                    ],
                    [
                        'question' => 'The Basics of Tidal and Wave Energy?',
                        'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                        'active' => false
                    ],
                    [
                        'question' => 'Educating for a Sustainable Future?',
                        'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                        'active' => false
                    ],
                    [
                        'question' => 'Staying Informed: Resources and Further Reading on Renewable Energy?',
                        'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                        'active' => false
                    ]
                ];
            @endphp

            @foreach($faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index + 1 }}">
                        <button class="accordion-button {{ !$faq['active'] ? 'collapsed' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse{{ $index + 1 }}" 
                                aria-expanded="{{ $faq['active'] ? 'true' : 'false' }}" 
                                aria-controls="collapse{{ $index + 1 }}">
                            {{ $faq['question'] }}
                        </button>
                    </h2>

                    <div id="collapse{{ $index + 1 }}" 
                         class="accordion-collapse collapse {{ $faq['active'] ? 'show' : '' }}" 
                         aria-labelledby="heading{{ $index + 1 }}" 
                         data-bs-parent="#faq_accordion">
                        <div class="accordion-body">
                            <p>{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- FAQ Accordion End -->
</div>
<!-- FAQs End -->