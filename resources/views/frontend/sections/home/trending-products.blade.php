<!-- Trending Products Start -->
<section class="home-trending-products">
    <div class="container">
        <div class="products-header-row">
            <div class="section-title">
                <h3 class="wow fadeInUp">Hot Right Now</h3>
                <h2 class="text-anime">Trending Products</h2>
            </div>
            <a href="{{ route('products', ['sort' => 'popular']) }}" class="btn-view-link">
                View All <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3 g-md-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('frontend.sections.product-item', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Trending Products End -->

@push('styles')
<style>
.home-trending-products {
    padding: 60px 0;
    background: #fafbfc;
}

.home-trending-products .products-header-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.home-trending-products .section-title h3 {
    color: #fd7e14;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.home-trending-products .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    letter-spacing: -0.5px;
}

@media (max-width: 767px) {
    .home-trending-products {
        padding: 40px 0;
    }
    .home-trending-products .section-title h2 {
        font-size: 24px;
    }
}
</style>
@endpush