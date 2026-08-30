<!-- Related Products Section Start -->
<div class="related-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="wow fadeInUp">Related Products</h3>
                    <h2 class="text-anime">You Might Also Like</h2>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($relatedProducts as $product)
                <div class="col-lg-3 col-md-6">
                    @include('frontend.sections.product-item', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Related Products Section End -->