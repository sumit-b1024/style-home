<div class="row mx-0">
    @forelse ($products as $product)
        <div class="col-md-4 col-sm-6">
            <div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
                    <div class="inner">
                        <div class="main-img">
                            @isset($product->product_images()->first()->image)
                                <img src="{{ asset('public/product') . '/' . $product->product_images()->first()->image }}"
                                    width="225" height="225" alt="product image">
                            </div>
                        @endisset
                    </div>
                </a>
                <div class="card-body text-center">
                    <h4 class="card-title">{{ $product->title }}</h4>
                    <p class="text-muted">${{ $product->price }}</p><a class="btn btn-outline-primary btn-sm pro_bt"
                        href="{{ route('frontend.product.product_details', $product->id) }}" data-abc="true">View
                        Products</a>
                </div>
            </div>
        </div>

    @empty
        <div class="col-xl-12 col-md-4 col-sm-6 text-center">
            <div class="card mb-30">
                <h1>No List Found</h1>
            </div>
        </div>
    @endforelse

</div>
