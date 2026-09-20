@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="related-products-section">
    <div class="container">
        <div class="related-header">
            <span class="related-eyebrow">You Might Also Like</span>
            <h2 class="related-title">Related Products</h2>
        </div>

        <div class="row g-3 g-md-4">
            @foreach($relatedProducts as $product)
                <div class="col-6 col-md-6 col-lg-3">
                    @include('frontend.sections.product-item', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
.related-products-section {
    padding: 60px 0 40px;
    background: #fff;
    border-top: 1px solid #f5f5f5;
}

.related-header {
    text-align: center;
    margin-bottom: 32px;
}

.related-eyebrow {
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #28a745;
    margin-bottom: 8px;
}

.related-title {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.25;
    letter-spacing: -0.5px;
}

@media (max-width: 767px) {
    .related-products-section { padding: 40px 0 30px; }
    .related-title            { font-size: 24px; }
    .related-header           { margin-bottom: 24px; }
}

@media (max-width: 575px) {
    .related-title            { font-size: 20px; }
    .related-eyebrow          { font-size: 11px; }
}
</style>
@endpush