<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime">{{ $title ?? 'Page Title' }}</h1>
                    <nav class="wow fadeInUp" data-wow-delay="0.25s">
                        <ol class="breadcrumb">
                            @foreach($breadcrumbs ?? [] as $breadcrumb)
                                @if($loop->last)
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $breadcrumb['label'] }}
                                    </li>
                                @else
                                    <li class="breadcrumb-item">
                                        <a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['label'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->