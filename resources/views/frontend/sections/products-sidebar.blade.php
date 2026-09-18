<!-- Products Sidebar Start -->
<div class="products-sidebar wow fadeInUp">
    <form id="productsFilterForm" method="GET" action="{{ route('products') }}">
        @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        <!-- Search -->
        <div class="sidebar-widget">
            <h4 class="widget-title">Search</h4>
            <div class="search-box">
                <input type="text" name="search" class="form-control"
                       placeholder="Search products..."
                       value="{{ request('search') }}">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>

        <!-- Categories -->
        @if($categories->count() > 0)
            <div class="sidebar-widget">
                <h4 class="widget-title">Categories</h4>
                <ul class="filter-list">
                    @foreach($categories as $category)
                        <li>
                            <label>
                                <input type="checkbox" name="categories[]"
                                       value="{{ $category->id }}"
                                       {{ in_array($category->id, (array) request('categories', [])) ? 'checked' : '' }}>
                                <span>{{ $category->name }}</span>
                                <span class="count">({{ $category->products_count }})</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Brands -->
        @if($brands->count() > 0)
            <div class="sidebar-widget">
                <h4 class="widget-title">Brands</h4>
                <ul class="filter-list">
                    @foreach($brands as $brand)
                        <li>
                            <label>
                                <input type="checkbox" name="brands[]"
                                       value="{{ $brand->id }}"
                                       {{ in_array($brand->id, (array) request('brands', [])) ? 'checked' : '' }}>
                                <span>{{ $brand->name }}</span>
                                <span class="count">({{ $brand->products_count }})</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Price Range -->
        <div class="sidebar-widget">
            <h4 class="widget-title">Price Range</h4>
            <div class="price-range-inputs">
                <input type="number" name="min_price" class="form-control"
                       placeholder="Min" min="0"
                       value="{{ request('min_price') }}">
                <span>-</span>
                <input type="number" name="max_price" class="form-control"
                       placeholder="Max" min="0"
                       value="{{ request('max_price') }}">
            </div>
        </div>

        <!-- Actions -->
        <div class="sidebar-widget">
            <button type="submit" class="btn-default w-100">Apply Filters</button>
            <a href="{{ route('products') }}" class="btn-outline w-100 mt-2 text-center d-block">Reset All</a>
        </div>
    </form>
</div>
<!-- Products Sidebar End -->

@push('styles')
<style>
    .products-sidebar .sidebar-widget {
        background: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .products-sidebar .widget-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    .products-sidebar .filter-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .products-sidebar .filter-list li {
        margin-bottom: 10px;
    }
    .products-sidebar .filter-list label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
    }
    .products-sidebar .filter-list .count {
        margin-left: auto;
        color: #999;
        font-size: 12px;
    }
    .products-sidebar .search-box {
        display: flex;
        gap: 8px;
    }
    .products-sidebar .search-box .form-control {
        flex: 1;
    }
    .products-sidebar .search-box button {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 0 14px;
        border-radius: 6px;
        cursor: pointer;
    }
    .products-sidebar .price-range-inputs {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .products-sidebar .price-range-inputs input {
        flex: 1;
    }
    .products-sidebar .btn-outline {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 6px;
        color: #333;
        text-decoration: none;
    }
    .products-sidebar .btn-outline:hover {
        background: #f5f5f5;
    }

    /* WhatsApp button */
    .btn-whatsapp {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #25D366;
        color: #fff !important;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .btn-whatsapp:hover {
        background: #128C7E;
        color: #fff !important;
        transform: translateY(-1px);
    }
    .btn-whatsapp i { font-size: 1.1em; }

    .product-item .product-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }
    .product-item .product-actions .btn-default {
        flex: 1;
    }
</style>
@endpush