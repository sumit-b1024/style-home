<div class="row mx-0">
    @forelse ($products as $product)
        <div class="col-md-4 col-sm-6">
            <div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
                    <div class="inner">
                        <div class="main-img">
                            @isset($product->product_images()->first()->image)
                                <a href="{{ route('frontend.product.product_details', $product->id) }}"><img src="{{ asset('public/product') . '/' . $product->product_images()->first()->image }}"
                                    width="225" height="225" alt="product image"></a>
                            </div>
                        @endisset
                    </div>
                </a>
                <div class="card-body text-center">
                    <a href="{{ route('frontend.product.product_details', $product->id) }}"><h4 class="card-title">{{ $product->title }}</h4></a>
                    <p class="text-muted">${{ $product->price }}</p> 

                                <div class="action">
                                            @if ($product->cartCurrentUser)
                                                <button product-id="{{ $product->id }}" class="add-to-cart btn btn-default brown_btn" type="button"
                                                    id="added">Added</button>
                                            @else
                                                <button product-id="{{ $product->id }}" class="add-to-cart btn btn-default brown_btn" type="button"
                                                    id="addtocart">Add
                                                    to
                                                    cart</button>
                                            @endif

                                        </div>



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
