<!-- Featured Products Carousel Start -->
<section class="home-featured-products">
    <div class="container">
        <div class="products-header-row">
            <div class="section-title">
                <h3 class="wow fadeInUp">Featured Products</h3>
                <h2 class="text-anime">Our Best Sellers</h2>
            </div>

            <div class="carousel-controls">
                <button type="button" class="carousel-btn" id="featuredPrev" aria-label="Previous">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" class="carousel-btn" id="featuredNext" aria-label="Next">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="products-carousel-wrap">
            <div class="products-carousel" id="featuredCarousel">
                @foreach($products as $product)
                    <div class="carousel-item">
                        @include('frontend.sections.product-item', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>

        <div class="view-all-row">
            <a href="{{ route('products') }}" class="btn-view-all">
                View All Products
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- Featured Products Carousel End -->

@push('styles')
<style>
.home-featured-products {
    padding: 60px 0;
    background: #fafbfc;
}

.products-header-row {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.products-header-row .section-title h3 {
    color: #28a745;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.products-header-row .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    letter-spacing: -0.5px;
}

/* Carousel controls */
.carousel-controls {
    display: flex;
    gap: 10px;
}

.carousel-btn {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #fff;
    color: #1a1a1a;
    border: 1.5px solid #e5e5e5;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.carousel-btn:hover {
    background: #28a745;
    color: #fff;
    border-color: #28a745;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.3);
}

.carousel-btn:disabled,
.carousel-btn.is-disabled {
    opacity: 0.4;
    cursor: not-allowed;
    background: #f8f9fa;
    color: #999;
    border-color: #e5e5e5;
    transform: none;
    box-shadow: none;
}

/* Carousel */
.products-carousel-wrap {
    position: relative;
    margin: 0 -12px;
}

.products-carousel {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 8px 12px 20px;
    scrollbar-width: none;
    -ms-overflow-style: none;
    scroll-snap-type: x mandatory;
}

.products-carousel::-webkit-scrollbar {
    display: none;
}

.products-carousel .carousel-item {
    flex: 0 0 auto;
    width: 290px;
    scroll-snap-align: start;
}

/* View all */
.view-all-row {
    text-align: center;
    margin-top: 30px;
}

.btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: #28a745;
    color: #fff !important;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 6px 18px rgba(40, 167, 69, 0.25);
}

.btn-view-all:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 10px 26px rgba(40, 167, 69, 0.4);
}

.btn-view-all i {
    transition: transform 0.2s;
}

.btn-view-all:hover i {
    transform: translateX(4px);
}

@media (max-width: 767px) {
    .home-featured-products {
        padding: 40px 0;
    }
    .products-header-row .section-title h2 {
        font-size: 24px;
    }
    .products-carousel .carousel-item {
        width: 240px;
    }
    .carousel-btn {
        width: 42px;
        height: 42px;
        font-size: 13px;
    }
}

@media (max-width: 575px) {
    .products-carousel .carousel-item {
        width: 200px;
    }
    .products-carousel {
        gap: 16px;
    }
    .carousel-controls {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    var $carousel = $('#featuredCarousel');
    var $prev = $('#featuredPrev');
    var $next = $('#featuredNext');
    var scrollAmount = 320;

    function updateButtonState() {
        var scrollLeft = $carousel.scrollLeft();
        var scrollWidth = $carousel[0].scrollWidth;
        var clientWidth = $carousel[0].clientWidth;

        $prev.toggleClass('is-disabled', scrollLeft <= 5);
        $next.toggleClass('is-disabled', scrollLeft + clientWidth >= scrollWidth - 5);
    }

    $prev.on('click', function () {
        $carousel[0].scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    $next.on('click', function () {
        $carousel[0].scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    $carousel.on('scroll', updateButtonState);
    $(window).on('resize', updateButtonState);

    // Initial state
    setTimeout(updateButtonState, 100);
});
</script>
@endpush