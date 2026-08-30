<!-- Service Benefits Start -->
<div class="service-benefits">
    <div class="row">
        <div class="col-md-12">
            <div class="service-benefits-title">
                <h2 class="text-anime">{{ $service->benefits_title ?? 'Benefits of Solar Energy' }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        @php
            $benefits = $service->benefits ?? [
                [
                    'icon' => 'icon-benefits-1.svg',
                    'title' => 'Renewable Energy',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-2.svg',
                    'title' => 'Energy Saving',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-3.svg',
                    'title' => 'Easy Installation',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-4.svg',
                    'title' => 'Energy Solution',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-5.svg',
                    'title' => 'Technical Support',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-6.svg',
                    'title' => 'Solar Maintenance',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ]
            ];
        @endphp

        @foreach($benefits as $benefit)
            <div class="col-lg-4 col-md-6">
                <!-- Benefits Item Start -->
                <div class="benefits-item">
                    <div class="icon-box">
                        <img src="{{ asset('frontend/images/'.$benefit['icon']) }}" alt="{{ $benefit['title'] }}">
                    </div>

                    <h3>{{ $benefit['title'] }}</h3>
                    <p>{{ $benefit['description'] }}</p>
                </div>
                <!-- Benefits Item End -->
            </div>
        @endforeach
    </div>
</div>
<!-- Service Benefits End -->