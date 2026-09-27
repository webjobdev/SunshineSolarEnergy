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
                   title="{{ $brand->name }}"
                   aria-label="{{ $brand->name }}">

                    <div class="brand-image">
                        @if($brand->image_url)
                            <img src="{{ $brand->image_url }}"
                                 alt="{{ $brand->name }}"
                                 loading="lazy">
                        @else
                            <div class="brand-placeholder">
                                <i class="fa-solid fa-award"></i>
                            </div>
                        @endif
                    </div>

                </a>
            @endforeach
        </div>
    </div>
</section>
<!-- Home Brands End -->

@push('styles')
<style>
/* =========================================================
   HOME BRANDS
   ========================================================= */
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

/* =========================================================
   GRID
   ========================================================= */
.brands-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}

/* =========================================================
   BRAND CARD — logo only
   ========================================================= */
.brand-card {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: #fff;
    border: 1.5px solid #f1f1f1;
    border-radius: 16px;
    text-decoration: none;
    transition: transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease,
                background 0.25s ease;
    height: 160px;                     /* fixed square-ish card */
    overflow: hidden;
}

.brand-card:hover {
    border-color: #d6efde;
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07);
    background: #fafffb;
}

/* Image container — holds the full logo */
.brand-card .brand-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* FULL logo — no crop, no padding trimming */
.brand-card .brand-image img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;               /* full logo visible */
    display: block;
    transition: transform 0.35s ease;
}

.brand-card:hover .brand-image img {
    transform: scale(1.06);
}

/* Fallback placeholder */
.brand-card .brand-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #28a745;
    font-size: 42px;
    opacity: 0.55;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 991px) {
    .home-brands {
        padding: 50px 0;
    }

    .home-brands .section-title h2 {
        font-size: 26px;
    }

    .brands-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
    }

    .brand-card {
        height: 140px;
        padding: 16px;
    }
}

@media (max-width: 575px) {
    .home-brands {
        padding: 40px 0;
    }

    .home-brands .section-title h2 {
        font-size: 22px;
    }

    .brands-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
    }

    .brand-card {
        height: 110px;
        padding: 12px;
        border-radius: 12px;
    }

    .brand-card .brand-placeholder {
        font-size: 32px;
    }
}
</style>
@endpush