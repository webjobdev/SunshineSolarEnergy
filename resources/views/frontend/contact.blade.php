@extends('frontend.layouts.app')

@section('title', $contactPage->meta_title ?? 'Contact Us - Solor Solar & Renewable Energy')
@section('meta_description', $contactPage->meta_description ?? 'Get in touch with Solor for all your solar and renewable energy needs. We\'re here to help with your solar energy questions.')
@section('meta_keywords', $contactPage->meta_keywords ?? 'contact us, solar energy, renewable energy, solar support')


@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => 'Contact us',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact us', 'url' => null]
        ]
    ])
    
    <!-- Contact Information -->
    @include('frontend.sections.contact-information')
    
    <!-- Google Map & Contact Form -->
    @include('frontend.sections.contact-map-form')

    @include('frontend.sections.contact-form-js')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize WOW.js
        new WOW().init();
        
        // Contact Form Validation and Submission
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var submitBtn = form.find('button[type="submit"]');
            var originalText = submitBtn.text();
            
            // Validate form
            var isValid = true;
            form.find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (!isValid) {
                return false;
            }
            
            // Show loading state
            submitBtn.text('Sending...').prop('disabled', true);
            
            // Send AJAX request
            $.ajax({
                url: '{{ route("contact.submit") }}',
                type: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        // Show success message
                        form.find('.form-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        form[0].reset();
                    }
                },
                error: function(xhr) {
                    var message = 'Something went wrong. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    form.find('.form-message').html('<div class="alert alert-danger">' + message + '</div>');
                },
                complete: function() {
                    submitBtn.text(originalText).prop('disabled', false);
                    
                    // Auto hide message after 5 seconds
                    setTimeout(function() {
                        form.find('.form-message').fadeOut(function() {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            });
        });
        
        // Clear invalid state on input
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
@endpush