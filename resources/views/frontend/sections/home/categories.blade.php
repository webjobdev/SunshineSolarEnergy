<!-- Home Categories Start -->
<section class="home-categories">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="wow fadeInUp">Shop by Category</h3>
            <h2 class="text-anime">Explore Our Categories</h2>
        </div>

        <div class="row g-3 g-md-4">
            @foreach($homeCategories as $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('products', ['categories' => [$category->id]]) }}"
                       class="category-card wow fadeInUp"
                       data-wow-delay="{{ $loop->iteration * 0.06 }}s">

                        <div class="category-image">
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <div class="category-placeholder">
                                    <i class="fa-solid fa-solar-panel"></i>
                                </div>
                            @endif
                        </div>

                        <div class="category-info">
                            <h4>{{ $category->name }}</h4>
                            <span class="category-count">
                                {{ $category->products_count }}
                                {{ Str::plural('Product', $category->products_count) }}
                            </span>
                        </div>

                        <span class="category-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Home Categories End -->

@push('styles')
<style>
.home-categories {
    padding: 60px 0;
    background: #fff;
}

.home-categories .section-title {
    margin-bottom: 40px;
}

.home-categories .section-title h3 {
    color: #28a745;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.home-categories .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    letter-spacing: -0.5px;
}

/* Category card */
.category-card {
    position: relative;
    display: flex;
    flex-direction: column;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 20px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    height: 100%;
    overflow: hidden;
}

.category-card:hover {
    transform: translateY(-6px);
    border-color: #d6efde;
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
}

.category-card .category-image {
    width: 100%;
    aspect-ratio: 4 / 3;
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-card .category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.08);
}

.category-card .category-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
}

.category-card .category-placeholder i {
    font-size: 40px;
    color: #28a745;
    opacity: 0.6;
}

.category-card .category-info h4 {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 4px;
    line-height: 1.3;
    transition: color 0.2s;
}

.category-card:hover .category-info h4 {
    color: #28a745;
}

.category-card .category-count {
    font-size: 12px;
    color: #999;
    font-weight: 500;
}

.category-card .category-arrow {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #fff;
    color: #28a745;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    opacity: 0;
    transform: translateX(-6px);
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 2;
}

.category-card:hover .category-arrow {
    opacity: 1;
    transform: translateX(0);
}

@media (max-width: 767px) {
    .home-categories {
        padding: 40px 0;
    }
    .home-categories .section-title h2 {
        font-size: 24px;
    }
    .category-card {
        padding: 14px;
    }
    .category-card .category-info h4 {
        font-size: 14px;
    }
    .category-card .category-count {
        font-size: 11px;
    }
}
</style>
@endpush