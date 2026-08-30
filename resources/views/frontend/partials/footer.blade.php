<!-- Footer Start -->
<footer class="main-footer">
    <!-- Footer Contact -->
    <div class="footer-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.25s">
                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-email.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-info">
                            <h3>Support & Email</h3>
                            <p>info@domainname.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.5s">
                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-phone.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-info">
                            <h3>Customer Support</h3>
                            <p>+01 547 547 5478</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-contact-box wow fadeInUp" data-wow-delay="0.75s">
                        <div class="contact-icon-box">
                            <img src="{{ asset('frontend/images/icon-location.svg') }}" alt="">
                        </div>
                        <div class="footer-contact-info">
                            <h3>Our Location</h3>
                            <p>Street no, City, Country 123456</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Mega Footer -->
                <div class="mega-footer">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <div class="footer-about">
                                <figure>
                                    <img src="{{ asset('frontend/images/footer-logo.svg') }}" alt="">
                                </figure>
                                <p>Green Energy is a long established fact that a reader will be distracted by the
                                    readable content of a page when.</p>
                            </div>
                            <div class="footer-social-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Quick Links</h2>
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Services</h2>
                                <ul>
                                    <li><a href="#">Consultancy</a></li>
                                    <li><a href="#">Solar System</a></li>
                                    <li><a href="#">Solar Panel</a></li>
                                    <li><a href="#">Style Guide</a></li>
                                    <li><a href="#">License</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-links">
                                <h2>Useful Links</h2>
                                <ul>
                                    <li><a href="{{ route('legal.privacy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('legal.terms') }}">Term & Conditions</a></li>
                                    <li><a href="{{ route('legal.disclaimer') }}">Disclaimer</a></li>
                                    <li><a href="{{ route('legal.refund') }}">Refund & Cancellation</a></li>
                                    <li><a href="{{ route('faq') }}">Support & FAQs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="footer-copyright">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer-copyright-text">
                                <p>Copyright © {{ date('Y') }} Solor. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->