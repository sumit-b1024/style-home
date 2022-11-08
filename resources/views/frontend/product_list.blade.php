@extends('layouts.frontend')
@section('content')
    <!-- Google Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> --}}
    <!-- ======= Hero Section ======= -->

    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">Product</h4><h3><a href="{{route('frontend.home')}}">Back</a></h3>
        <div class="container">




            <section class="product-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="content" class="my-5">
                                <div id="filterbar" class="collapse">


                                    <div class="box1 border-bottom">

                                        <div class="box-label text-uppercase d-flex align-items-center">Style type:
                                            <button class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#inner-box" aria-expanded="false" aria-controls="inner-box"
                                                id="out">
                                                <span class="fas fa-plus"></span> </button>
                                        </div>
                                        <div id="inner-box" class="collapse mt-2 mr-1">
                                            @foreach ($style_types as $st)
                                                <div class="my-1">
                                                    <label class="tick" for="style_type{{ $st->id }}"> <input
                                                            type="checkbox" name="style_type{{ $st->id }}"
                                                            value="{{ $st->id }}" onclick="prdwithstyletype(this)">
                                                        <span class="check"></span> {{ $st->name }}</label>
                                                </div>
                                            @endforeach

                                            {{-- <div class="my-1"> <label class="tick"><input type="checkbox">
                                            <span class="check"></span> etc.. </label> </div> --}}

                                        </div>
                                    </div>

                                    <div class="box1 border-bottom">
                                        <div class="box-label text-uppercase d-flex align-items-center">Room layout: <button
                                                class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#inner-box2" aria-expanded="false"
                                                aria-controls="inner-box2"><span class="fas fa-plus"></span></button> </div>

                                        <div id="inner-box2" class="collapse mt-2 mr-1">

                                            {{-- <div class="my-1"> <label class="tick"> <input type="checkbox" checked="checked">
                                            <span class="check"></span> Square</label> </div> --}}
                                            @foreach ($room_layouts as $rl)
                                                <div class="my-1"> <label class="tick"
                                                        for="room_layout{{ $rl->id }}"> <input type="checkbox"
                                                            name="room_layout{{ $rl->id }}"
                                                            value="{{ $rl->id }}" onclick="prdwithroomlayout(this)">
                                                        <span class="check"></span> {{ $rl->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>


                                    <div class="box1 border-bottom">
                                        <div class="box-label text-uppercase d-flex align-items-center">Room type: <button
                                                class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#layout" aria-expanded="false" aria-controls="inner-box2"><span
                                                    class="fas fa-plus"></span></button> </div>

                                        <div id="layout" class="collapse mt-2 mr-1">
                                            {{-- <div class="my-1"> <label class="tick"> <input type="checkbox" checked="checked">
                                            <span class="check"></span> Bedroom</label> </div>
                                    <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                class="check"></span>Balcony </label>
                                    </div> --}}
                                            @foreach ($room_types as $rt)
                                                <div class="my-1"> <label class="tick"
                                                        for="room_type{{ $rt->id }}"> <input type="checkbox"
                                                            name="room_type{{ $rt->id }}" value="{{ $rt->id }}"
                                                            onclick="prdwithroomtype(this)"> <span
                                                            class="check"></span>{{ $rt->name }} </label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>




                                    {{-- <div class="box1 border-bottom">
                                        <div class="box-label text-uppercase d-flex align-items-center">Budget: <button
                                                class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#budget" aria-expanded="false" aria-controls="inner-box2"><span
                                                    class="fas fa-plus"></span></button> </div>

                                        <div id="budget" class="collapse mt-2 mr-1">
                                            <div class="my-1"> <label class="tick"> <input type="checkbox"
                                                        checked="checked">
                                                    <span class="check"></span> Low to mid end</label> </div>
                                            <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                        class="check"></span>High end </label>
                                            </div>

                                            <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                        class="check"></span>etc.. </label>
                                            </div>

                                        </div>

                                    </div> --}}



                                    <div class="box1 border-bottom">
                                        <div class="box-label text-uppercase d-flex align-items-center">Country: <button
                                                class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#country" aria-expanded="false"
                                                aria-controls="inner-box2"><span class="fas fa-plus"></span></button>
                                        </div>

                                        <div id="country" class="collapse mt-2 mr-1">
                                            {{-- <div class="my-1"> <label class="tick"> <input type="checkbox"
                                                checked="checked">
                                            <span class="check"></span>India</label> </div> --}}
                                            {{-- <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                class="check"></span>America</label>
                                    </div> --}}
                                            @foreach ($countries as $con)
                                                <div class="my-1"> <label class="tick"
                                                        for="country{{ $con->id }}"> <input type="checkbox"
                                                            name="country{{ $con->id }}" value="{{ $con->id }}"
                                                            onclick="prdwithcountry(this)">
                                                        <span class="check"></span>{{ $con->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                    @if (isset($add_filters) && sizeof($add_filters) > 0)
                                        @foreach ($add_filters as $filt)
                                            <div class="box1 border-bottom">
                                                <div class="box-label text-uppercase d-flex align-items-center">{{$filt->name}}:
                                                    <button class="btn ml-auto" type="button" data-toggle="collapse"
                                                        data-target="#inner-box2{{$filt->id}}" aria-expanded="false"
                                                        aria-controls="inner-box2{{$filt->id}}"><span
                                                            class="fas fa-plus"></span></button>
                                                </div>

                                                <div id="inner-box2{{$filt->id}}" class="collapse mt-2 mr-1">

                                                    @foreach ($filt->filter_groupitems as $gitem)
                                                        <div class="my-1"> <label class="tick"
                                                                for="additional_filter[{{$filt->id}}][{{ $gitem->id }}]"> <input
                                                                    type="checkbox" name="additional_filter[{{$filt->id}}][{{ $gitem->id }}]"
                                                                    value="{{ $gitem->id }}"
                                                                    onclick="additionalfilters(this,{{$filt->id}})">
                                                                <span class="check"></span> {{ ucfirst($gitem->item_name) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                    {{-- <div class="box1 border-bottom">
                                        <div class="box-label text-uppercase d-flex align-items-center">Color Scheme:
                                            <button class="btn ml-auto" type="button" data-toggle="collapse"
                                                data-target="#color" aria-expanded="false"
                                                aria-controls="inner-box2"><span class="fas fa-plus"></span></button>
                                        </div>

                                        <div id="color" class="collapse mt-2 mr-1">
                                            <div class="my-1"> <label class="tick"> <input type="checkbox"
                                                        checked="checked">
                                                    <span class="check"></span>India</label> </div>
                                            <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                        class="check"></span>America</label>
                                            </div>

                                            <div class="my-1"> <label class="tick"> <input type="checkbox"> <span
                                                        class="check"></span>etc.. </label>
                                            </div>

                                        </div>

                                    </div> --}}


                                </div>
                            </div>

                            <div id="products">
                                

                               
                                
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
            </section>
        </div>

        @extends('layouts.modal')
    </section>

    {{-- <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script> --}}



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
    </script>


<script> 
$(document).on('click','#addtocart',function(){
          let product_id = $(this).attr("product-id");
            let user_id = {{ auth()->user()->id }};
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

$(document).on('click','#added',function(){
           let product_id =  $(this).attr("product-id");
            let user_id = {{ auth()->user()->id }};
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
 



    <script>
        $(document).ready(function() {
            $(".dropdown-menu").click(function() {
                $(".dropdown-menu").toggleClass("show");
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            getProducts();
        });



        function getProducts() {
            $("#products").html('');
            $.ajax({
                type: "post",
                url: "{{ route('frontend.product.productlist') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $("#products").html(data.html);
                }
            });
        }

        let styletype = [];
        let roomtype = [];
        let roomlayout = [];
        let country = [];
        let addi_filter = [];
        function prdwithstyletype(e) {
            if ($(e).prop('checked') == true) {
                styletype.push($(e).val());
            } else {
                styletype = $.grep(styletype, function(value) {
                    return value != $(e).val();
                });
            }
            allproducts();
            // if (styletype.length > 0) {
            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('frontend.product.prdwithstyletype') }}",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             styletype: styletype,
            //         },
            //         success: function(data) {
            //             $("#products").html(data.html);
            //         }
            //     });
            // }
            // else{
            //     getProducts();
            // }
        }

        function prdwithroomtype(e) {
            if ($(e).prop('checked') == true) {
                roomtype.push($(e).val());
            } else {
                roomtype = $.grep(roomtype, function(value) {
                    return value != $(e).val();
                });
            }
            allproducts();
            // if (roomtype.length > 0) {
            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('frontend.product.prdwithroomtype') }}",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             roomtype: roomtype,
            //         },
            //         success: function(data) {
            //             $("#products").html(data.html);
            //         }
            //     });
            // }
            // else{
            //     getProducts();
            // }

        }

        function prdwithroomlayout(e) {
            if ($(e).prop('checked') == true) {
                roomlayout.push($(e).val());
            } else {
                roomlayout = $.grep(roomlayout, function(value) {
                    return value != $(e).val();
                });
            }
            allproducts();
            // if (roomlayout.length > 0) {
            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('frontend.product.prdwithroomlayout') }}",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             roomlayout: roomlayout,
            //         },
            //         success: function(data) {
            //             $("#products").html(data.html);
            //         }
            //     });
            // }
            // else{
            //     getProducts();
            // }
        }

        function prdwithcountry(e) {
            if ($(e).prop('checked') == true) {
                country.push($(e).val());
            } else {
                country = $.grep(country, function(value) {
                    return value != $(e).val();
                });
            }
            allproducts();
            // if (country.length > 0) {
            //     $.ajax({
            //         type: "post",
            //         url: "{{ route('frontend.product.prdwithcountry') }}",
            //         data: {
            //             "_token": "{{ csrf_token() }}",
            //             country: country,
            //         },
            //         success: function(data) {
            //             $("#products").html(data.html);
            //         }
            //     });
            // }
            // else{
            //     getProducts();
            // }
        }

        function additionalfilters(e,id){
            if ($(e).prop('checked') == true) {
                addi_filter.push($(e).val());
            } else {
                addi_filter = $.grep(addi_filter, function(value) {
                    return value != $(e).val();
                });
            }
            // console.log($(e).val());
            console.log(addi_filter);
            allproducts();
        }

        function allproducts() {
            $.ajax({
                type: "post",
                url: "{{ route('frontend.product.allproducts') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    country: country,
                    roomlayout: roomlayout,
                    roomtype: roomtype,
                    styletype: styletype,
                    addi_filter: addi_filter,
                },
                success: function(data) {
                    $("#products").html(data.html);
                }
            });
        }
    </script>
@endsection
