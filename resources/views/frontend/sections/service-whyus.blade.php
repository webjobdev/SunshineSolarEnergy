<!-- Why Us Start -->
<div class="service-whyus">
    <h2 class="text-anime">Why Us !</h2>
    <p>{{ $service->why_us ?? 'but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.' }}</p>

    <!-- Service Video Box Start -->
    @if(isset($service->video_url))
        <div class="intro-video-box">
            <div class="video-image">
                <img src="{{ asset('frontend/images/'.$service->video_thumbnail ?? 'video-bg.jpg') }}" alt="Video">
            </div>

            <div class="video-play-button">
                <a href="{{ $service->video_url }}" class="popup-video">
                    <img src="{{ asset('frontend/images/play.svg') }}" alt="Play Video">
                </a>
            </div>
        </div>
    @endif
    <!-- Service Video Box End-->
</div>
<!-- Why Us End -->