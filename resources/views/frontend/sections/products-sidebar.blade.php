<div class="products-sidebar">
    <!-- Filter Form -->
    <form action="{{ route('products') }}" method="GET" class="filter-form">
        <!-- Search Filter -->
        <div class="filter-widget wow fadeInUp">
            <h3>Search Products</h3>
            <div class="search-box">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search products..." 
                       value="{{ request('search') }}">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="filter-widget wow fadeInUp" data-wow-delay="0.25s">
            <h3>Categories</h3>
            <ul class="filter-list">
                @foreach($categories ?? [] as $category)
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="categories[]" value="{{ $category->id ?? $category['id'] }}"
                                   {{ in_array($category->id ?? $category['id'], request('categories', [])) ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="checkmark"></span>
                            {{ $category->name ?? $category['name'] }}
                            <span class="count">({{ $category->count ?? 0 }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Brand Filter -->
        <div class="filter-widget wow fadeInUp" data-wow-delay="0.5s">
            <h3>Brands</h3>
            <ul class="filter-list">
                @foreach($brands ?? [] as $brand)
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="brands[]" value="{{ $brand->id ?? $brand['id'] }}"
                                   {{ in_array($brand->id ?? $brand['id'], request('brands', [])) ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="checkmark"></span>
                            {{ $brand->name ?? $brand['name'] }}
                            <span class="count">({{ $brand->count ?? 0 }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Price Range Filter -->
        <div class="filter-widget wow fadeInUp" data-wow-delay="0.75s">
            <h3>Price Range</h3>
            <div class="price-range">
                <div class="price-inputs">
                    <div class="price-input">
                        <label>Min</label>
                        <input type="number" name="min_price" class="form-control" 
                               placeholder="$0" value="{{ request('min_price') }}">
                    </div>
                    <div class="price-input">
                        <label>Max</label>
                        <input type="number" name="max_price" class="form-control" 
                               placeholder="$1000" value="{{ request('max_price') }}">
                    </div>
                </div>
                <button type="submit" class="btn-default btn-sm mt-2">Apply Filter</button>
            </div>
        </div>

        <!-- Rating Filter -->
        <div class="filter-widget wow fadeInUp" data-wow-delay="1.0s">
            <h3>Rating</h3>
            <ul class="filter-list">
                @for($i = 4; $i >= 1; $i--)
                    <li>
                        <label class="filter-checkbox">
                            <input type="checkbox" name="ratings[]" value="{{ $i }}"
                                   {{ in_array($i, request('ratings', [])) ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="checkmark"></span>
                            <span class="stars">
                                @for($j = 1; $j <= 5; $j++)
                                    <i class="fa-solid fa-star {{ $j <= $i ? 'active' : '' }}"></i>
                                @endfor
                            </span>
                            <span class="count">&amp; Up</span>
                        </label>
                    </li>
                @endfor
            </ul>
        </div>

        <!-- Reset Filters -->
        <div class="filter-actions wow fadeInUp" data-wow-delay="1.25s">
            <a href="{{ route('products') }}" class="btn-default btn-border btn-sm">Reset All</a>
        </div>
    </form>
</div>