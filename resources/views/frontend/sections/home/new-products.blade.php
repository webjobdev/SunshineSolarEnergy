<!-- New Products Start -->
<section class="home-new-products">
    <div class="container">
        <div class="products-header-row">
            <div class="section-title">
                <h3 class="wow fadeInUp">Fresh Arrivals</h3>
                <h2 class="text-anime">New Products</h2>
            </div>
            <a href="{{ route('products') }}" class="btn-view-link">
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
<!-- New Products End -->

@push('styles')
<style>
.home-new-products {
    padding: 60px 0;
    background: #fff;
}

.home-new-products .products-header-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.home-new-products .section-title h3 {
    color: #28a745;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.home-new-products .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    letter-spacing: -0.5px;
}

.btn-view-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #28a745;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    padding: 10px 18px;
    border: 1.5px solid #d6efde;
    border-radius: 10px;
    background: #f0fdf4;
    transition: all 0.2s;
}

.btn-view-link:hover {
    background: #28a745;
    color: #fff;
    border-color: #28a745;
    transform: translateY(-2px);
}

@media (max-width: 767px) {
    .home-new-products {
        padding: 40px 0;
    }
    .home-new-products .section-title h2 {
        font-size: 24px;
    }
}
</style>
@endpush