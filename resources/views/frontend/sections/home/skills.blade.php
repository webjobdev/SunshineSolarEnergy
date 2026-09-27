<!-- Our Skills Section Start -->
<div class="our-skills">
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <div class="section-title">

                    <h3 class="wow fadeInUp">
                        Our Solar Expertise
                    </h3>

                    <h2 class="text-anime">
                        Reliable Solar Solutions for a
                        <span>Brighter Future</span>
                    </h2>

                    <p class="wow fadeInUp" data-wow-delay="0.25s">
                        Sunshine Solar provides reliable solar energy solutions
                        for homes, businesses, and commercial properties. From
                        solar panel selection and system planning to professional
                        installation, we help customers move toward clean,
                        renewable, and cost-effective energy.
                    </p>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="skills-box">

                    @foreach([
                        [
                            'title' => 'Solar Panel Solutions',
                            'percent' => '95%'
                        ],
                        [
                            'title' => 'Rooftop Solar Systems',
                            'percent' => '90%'
                        ],
                        [
                            'title' => 'Solar Installation & Support',
                            'percent' => '90%'
                        ]
                    ] as $skill)

                        <div class="skillbar"
                             data-percent="{{ $skill['percent'] }}">

                            <div class="skill-data">

                                <div class="title">
                                    {{ $skill['title'] }}
                                </div>

                                <div class="count">
                                    {{ $skill['percent'] }}
                                </div>

                            </div>

                            <div class="skill-progress">
                                <div class="count-bar"></div>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Our Skills Section End -->