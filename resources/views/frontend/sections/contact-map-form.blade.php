<!-- Google Map & Contact Form Section Start -->
<div class="google-map-form">
    <!-- Google Map -->
    <div class="google-map">
        @if(isset($contactData['map_embed']))
            {!! $contactData['map_embed'] !!}
        @else
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d56481.31329163797!2d-82.30112043759952!3d27.776444959332093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sUnited%20States%20solar!5e0!3m2!1sen!2sin!4v1706008331370!5m2!1sen!2sin"
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        @endif
    </div>

    <!-- Contact Form Overlay -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="contact-form-box">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">{{ $contactData['form_subtitle'] ?? 'Contact Now' }}</h3>
                        <h2 class="text-anime">{{ $contactData['form_title'] ?? 'Get In Touch With Us' }}</h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Form start -->
                    <div class="contact-form wow fadeInUp" data-wow-delay="0.75s">
                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" data-toggle="validator">
                            @csrf
                            
                            <!-- Form Message Container -->
                            <div class="form-message"></div>
                            
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="name" class="form-control" id="name" 
                                           placeholder="Name" required value="{{ old('name') }}">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Email" required value="{{ old('email') }}">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone"
                                           placeholder="Phone" required value="{{ old('phone') }}">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="subject" class="form-control" id="subject"
                                           placeholder="Subject" required value="{{ old('subject') }}">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <textarea name="message" class="form-control" id="message" rows="4"
                                              placeholder="Write a Message" required>{{ old('message') }}</textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-default">Submit Now</button>
                                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Google Map & Contact Form Section End -->