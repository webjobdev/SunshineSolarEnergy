<!-- Our Skills Section Start -->
<div class="our-skills">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Energy Progress</h3>
                    <h2 class="text-anime">Best Solution For Your Solar Energy</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.25s">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="skills-box">
                    @foreach([
                        ['title' => 'Solar Panels', 'percent' => '95%'],
                        ['title' => 'Hybrid Energy', 'percent' => '80%'],
                        ['title' => 'Marketing', 'percent' => '70%']
                    ] as $skill)
                        <div class="skillbar" data-percent="{{ $skill['percent'] }}">
                            <div class="skill-data">
                                <div class="title">{{ $skill['title'] }}</div>
                                <div class="count">{{ $skill['percent'] }}</div>
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