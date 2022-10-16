@extends('layouts.frontend')
@section('content')
    {{-- <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> --}}
    <!-- ======= Hero Section ======= -->


    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">Product </h4>
        <h3><a href="{{route('frontend.home')}}">Back</a></h3>
        <div class="container">
            <div class="row">
                <section class="product-section">

                    <div class="container">
                        <div class="card">
                            <div class="container-fliud">
                                <div class="wrapper row">
                                    <div class="preview col-md-6">
                                        <div class="preview-pic tab-content">
                                            @if (sizeof($product_images) > 0)
                                                <div class="tab-pane active m-2 p-2 d-flex flex-wrap" id="pic-1">
                                                    @foreach ($product_images as $prd)
                                                        <div class="m-2">
                                                            <img src="{{ asset('/public/product') . '/' . $prd->image }}"
                                                                height="200" width="200" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>


                                    </div>
                                    <div class="details col-md-6">
                                        <h3 class="product-title">{{ $products->title }}</h3>

                                        <div class="price">${{ $products->price }}</div>


                                        <p class="product-description">{{ $products->description }}</p>

                                        <div class="pro_sect2">
                                            <h3>What you'll get</h3>
                                            <ul>
                                                <li> A MoodBoard/ Design Concept</li>
                                                <li>A 2 D layout based on a standard room size</li>
                                                <li>A shopping list with links to each item</li>


                                            </ul>

                                        </div>

                                        <div class="action">
                                            @if (isset($checkcart))
                                                <button class="add-to-cart btn btn-default brown_btn" type="button"
                                                    id="added">Added</button>
                                            @else
                                                <button class="add-to-cart btn btn-default brown_btn" type="button"
                                                    id="addtocart">Add
                                                    to
                                                    cart</button>
                                            @endif

                                        </div>

                                        <div class="pro_sect2">
                                            <h3>Dimension & Details</h3>
                                            <ul>
                                                <li>Color:{{ $products->color_scheme }}</li>
                                                <li>material:{{ $products->materials }}</li>
                                                <li>Dimensions:{{ $products->dimensions }}</li>


                                            </ul>

                                        </div>

                                     


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    {{-- <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}


    <script>
        // For Filters
        document.addEventListener("DOMContentLoaded", function() {
            var filterBtn = document.getElementById('filter-btn');
            var btnTxt = document.getElementById('btn-txt');
            var filterAngle = document.getElementById('filter-angle');

            $('#filterbar').collapse(false);
            var count = 0,
                count2 = 0;

            function changeBtnTxt() {
                $('#filterbar').collapse(true);
                count++;
                if (count % 2 != 0) {
                    filterAngle.classList.add("fa-angle-right");
                    btnTxt.innerText = "show filters"
                    filterBtn.style.backgroundColor = "#36a31b";
                } else {
                    filterAngle.classList.remove("fa-angle-right")
                    btnTxt.innerText = "hide filters"
                    filterBtn.style.backgroundColor = "#ff935d";
                }

            }

            // For Applying Filters
            $('#inner-box').collapse(false);
            $('#inner-box2').collapse(false);

            // For changing NavBar-Toggler-Icon
            var icon = document.getElementById('icon');

            function chnageIcon() {
                count2++;
                if (count2 % 2 != 0) {
                    icon.innerText = "";
                    icon.innerHTML = '<span class="far fa-times-circle" style="width:100%"></span>';
                    icon.style.paddingTop = "5px";
                    icon.style.paddingBottom = "5px";
                    icon.style.fontSize = "1.8rem";


                } else {
                    icon.innerText = "";
                    icon.innerHTML = '<span class="navbar-toggler-icon"></span>';
                    icon.style.paddingTop = "5px";
                    icon.style.paddingBottom = "5px";
                    icon.style.fontSize = "1.2rem";
                }
            }

        });

        $("#addtocart").click(function() {
            let product_id = {{ $products->id }};
            let user_id = {{ $user->id }};
            let url = "{{ route('frontend.product.addtocart') }}"
            $.ajax({
                url: url,
                type: "post",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': user_id,
                    'product_id': product_id,
                },
                success: function(response) {
                    window.location.reload();
                },
            });

        });

        $("#added").click(function() {
            let product_id = {{ $products->id }};
            let user_id = {{ $user->id }};
            let url = "{{ route('frontend.product.removetocart') }}"
            $.ajax({
                url: url,
                type: "post",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'user_id': user_id,
                    'product_id': product_id,
                },
                success: function(response) {
                    window.location.reload();
                },
            });

        });
    </script>

@endsection
