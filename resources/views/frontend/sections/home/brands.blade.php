<!-- Home Brands Start -->
<section class="home-brands">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="wow fadeInUp">Trusted By</h3>
            <h2 class="text-anime">Shop by Brand</h2>
        </div>

        <div class="brands-grid">
            @foreach($homeBrands as $brand)
                <a href="{{ route('products', ['brands' => [$brand->id]]) }}"
                   class="brand-card wow fadeInUp"
                   data-wow-delay="{{ $loop->iteration * 0.05 }}s"
                   title="{{ $brand->name }}">

                    <div class="brand-image">
                        @if($brand->image_url)
                            <img src="{{ $brand->image_url }}" alt="{{ $brand->name }}" loading="lazy">
                        @else
                            <div class="brand-placeholder">
                                <i class="fa-solid fa-award"></i>
                            </div>
                        @endif
                    </div>

                    <div class="brand-info">
                        <h4>{{ $brand->name }}</h4>
                        <span>{{ $brand->products_count }}
                            {{ Str::plural('Product', $brand->products_count) }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<!-- Home Brands End -->

@push('styles')
<style>
.home-brands {
    padding: 60px 0;
    background: #fff;
}

.home-brands .section-title {
    margin-bottom: 40px;
}

.home-brands .section-title h3 {
    color: #28a745;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.home-brands .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    letter-spacing: -0.5px;
}

.brands-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 20px;
}

.brand-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
    background: #fff;
    border: 1.5px solid #f1f1f1;
    border-radius: 14px;
    text-decoration: none;
    transition: all 0.25s ease;
    text-align: center;
}

.brand-card:hover {
    border-color: #d6efde;
    transform: translateY(-4px);
    box-shadow: 0 10px 26px rgba(0, 0, 0, 0.06);
}

.brand-card .brand-image {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    overflow: hidden;
    transition: background 0.2s;
}

.brand-card:hover .brand-image {
    background: #f0fdf4;
}

.brand-card .brand-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}

.brand-card .brand-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #28a745;
    font-size: 32px;
    opacity: 0.6;
}

.brand-card .brand-info h4 {
    font-size: 15px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 4px;
    transition: color 0.2s;
}

.brand-card:hover .brand-info h4 {
    color: #28a745;
}

.brand-card .brand-info span {
    font-size: 12px;
    color: #999;
}

@media (max-width: 767px) {
    .home-brands {
        padding: 40px 0;
    }
    .home-brands .section-title h2 {
        font-size: 24px;
    }
    .brands-grid {
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 12px;
    }
    .brand-card {
        padding: 18px 12px;
    }
    .brand-card .brand-image {
        width: 70px;
        height: 70px;
        margin-bottom: 10px;
    }
    .brand-card .brand-info h4 {
        font-size: 13px;
    }
    .brand-card .brand-info span {
        font-size: 11px;
    }
}
</style>
@endpush