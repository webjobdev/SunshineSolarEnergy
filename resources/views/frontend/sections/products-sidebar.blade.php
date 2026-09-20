<!-- Products Sidebar Start -->
<div class="products-sidebar">
    <form id="productsFilterForm" method="GET" action="{{ route('products') }}" onsubmit="return false;">
        @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif

        {{-- Search --}}
        <div class="sidebar-widget">
            <h4 class="widget-title">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search
            </h4>
            <div class="search-box">
                <input type="text" name="search" class="form-control"
                       placeholder="Search products..."
                       value="{{ request('search') }}">
                <button type="button" class="search-btn" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        {{-- Categories --}}
        @if(isset($categories) && $categories->count() > 0)
            <div class="sidebar-widget">
                <h4 class="widget-title">
                    <i class="fa-solid fa-tags"></i>
                    Categories
                </h4>
                <ul class="filter-list">
                    @foreach($categories as $category)
                        <li>
                            <label class="filter-item">
                                <input type="checkbox" name="categories[]"
                                       value="{{ $category->id }}"
                                       {{ in_array($category->id, (array) request('categories', [])) ? 'checked' : '' }}>
                                <span class="filter-label">{{ $category->name }}</span>
                                <span class="count">{{ $category->products_count }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Brands --}}
        @if(isset($brands) && $brands->count() > 0)
            <div class="sidebar-widget">
                <h4 class="widget-title">
                    <i class="fa-solid fa-award"></i>
                    Brands
                </h4>
                <ul class="filter-list">
                    @foreach($brands as $brand)
                        <li>
                            <label class="filter-item">
                                <input type="checkbox" name="brands[]"
                                       value="{{ $brand->id }}"
                                       {{ in_array($brand->id, (array) request('brands', [])) ? 'checked' : '' }}>
                                <span class="filter-label">{{ $brand->name }}</span>
                                <span class="count">{{ $brand->products_count }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Actions --}}
        <div class="sidebar-widget filter-actions">
            <button type="button" class="btn-apply" onclick="window.ProductsFilter && window.ProductsFilter.fetchProducts(null)">
                <i class="fa-solid fa-check"></i>
                Apply Filters
            </button>
            <button type="button" class="btn-reset" onclick="window.ProductsFilter && window.ProductsFilter.reset()">
                <i class="fa-solid fa-rotate-right"></i>
                Reset All
            </button>
        </div>
    </form>
</div>
<!-- Products Sidebar End -->

@push('styles')
<style>
/* =========================================================
   SIDEBAR
   ========================================================= */
.products-sidebar {
    position: sticky;
    top: 20px;
}

.products-sidebar .sidebar-widget {
    background: #fff;
    padding: 20px;
    margin-bottom: 16px;
    border-radius: 14px;
    border: 1px solid #f1f1f1;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
}

.products-sidebar .widget-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 14px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f5f5f5;
    letter-spacing: 0.2px;
}

.products-sidebar .widget-title i {
    color: #28a745;
    font-size: 14px;
}

/* -------- Filter list -------- */
.products-sidebar .filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 260px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #d4d4d4 transparent;
}

.products-sidebar .filter-list::-webkit-scrollbar { width: 5px; }
.products-sidebar .filter-list::-webkit-scrollbar-thumb {
    background: #d4d4d4;
    border-radius: 3px;
}

.products-sidebar .filter-list li { margin-bottom: 4px; }

.products-sidebar .filter-item {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 9px 12px;
    border-radius: 10px;
    font-size: 14px;
    transition: background 0.15s;
    min-height: 42px;
    margin: 0;
    color: #333;
}

.products-sidebar .filter-item:hover {
    background: #f7fbf9;
}

.products-sidebar .filter-item input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #28a745;
    flex-shrink: 0;
    cursor: pointer;
    margin: 0;
}

.products-sidebar .filter-label {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 500;
}

.products-sidebar .count {
    background: #f1f3f5;
    color: #666;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 10px;
    min-width: 28px;
    text-align: center;
    flex-shrink: 0;
    transition: background 0.15s, color 0.15s;
}

.products-sidebar .filter-item:hover .count {
    background: #e6f4ea;
    color: #28a745;
}

/* -------- Search -------- */
.products-sidebar .search-box {
    display: flex;
    gap: 8px;
}

.products-sidebar .search-box .form-control {
    flex: 1;
    min-width: 0;
    height: 44px;
    border-radius: 10px;
    border: 1.5px solid #e5e5e5;
    font-size: 14px;
    padding: 0 14px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.products-sidebar .search-box .form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1);
    outline: none;
}

.products-sidebar .search-btn {
    background: #28a745;
    color: #fff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.products-sidebar .search-btn:hover {
    background: #218838;
    transform: translateY(-1px);
}

/* -------- Actions -------- */
.products-sidebar .filter-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.products-sidebar .btn-apply {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 46px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    background: #28a745;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.products-sidebar .btn-apply:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.35);
}

.products-sidebar .btn-reset {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 46px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    background: #fff;
    color: #666;
    border: 1.5px solid #e5e5e5;
    cursor: pointer;
    transition: all 0.2s;
}

.products-sidebar .btn-reset:hover {
    background: #f8f9fa;
    color: #333;
    border-color: #d4d4d4;
}

/* -------- Mobile -------- */
@media (max-width: 991px) {
    .products-sidebar {
        position: static;
    }

    .products-sidebar form {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 10px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .products-sidebar form::-webkit-scrollbar { height: 4px; }
    .products-sidebar form::-webkit-scrollbar-thumb {
        background: #d4d4d4;
        border-radius: 2px;
    }

    .products-sidebar .sidebar-widget {
        flex: 0 0 auto;
        min-width: 260px;
        max-width: 300px;
        margin-bottom: 0;
        scroll-snap-align: start;
    }

    .products-sidebar .filter-actions {
        min-width: 220px;
        justify-content: center;
    }
}

@media (max-width: 575px) {
    .products-sidebar .sidebar-widget {
        min-width: 240px;
        padding: 16px;
    }
}
</style>
@endpush