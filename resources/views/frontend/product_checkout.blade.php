@extends('layouts.frontend')
@section('content')
    <style>
        #applypromocode {
            color: red;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <?php
    use App\Models\FormAnswer;
    use App\Models\QuizCategory;
    use App\Models\SubscriptionAddon;
    ?>
    <section class="designer_cont project_main mb-5 tittle_no_banner purple checkout_tittle">
        <div class="container clearfix">
            <h4 class="title-page text-center">Checkout</h4>
            <a class="btn btn-warning" href="{{ route('frontend.product.index') }}">Back <i
                    class="fa fa-arrow-circle-left"></i></a>
        </div>
    </section>
    <section class="designer_cont project_main mb-5 checkout_box">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
            <form action="{!! URL::route('product.paypal') !!}" method="POST" role="form">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <h4 class="card-header">Product Details</h4>
                            <article class="card-body">
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Price</th>
                                          </tr>
                                        </thead>
                                        @php
                                            $total_price = 0;
                                        @endphp
                                        <tbody>
                                            @forelse ($addcarts as $key => $cart)
                                            @php
                                                $total_price += $cart->products->price;
                                            @endphp
                                            <tr>
                                                <th scope="row">{{++$key}}</th>
                                                <td><img src="{{asset('public/product'.'/'.$cart->products->product_images()->first()->image)}}" alt="" srcset="" height="50"></td>
                                                <td>{{$cart->products->title}}</td>
                                                <td>{{$cart->products->price}} AED</td>
                                              </tr>
                                            @empty
                                            <tr>
                                                <td>No list found</td>
                                              </tr>
                                            @endforelse

                                        </tbody>
                                      </table>
                                </div>



                            </article>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">

                                    <h4 class="card-header">Your Order</h4>

                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            {{-- <div class="d-flex justify-content-between align-items-center">
                                                <dt >Item Subtotal: </dt>
                                                <span class="">
                                                    10
                                                    AED</span>
                                            </div> --}}
                                            {{-- <div class="d-flex justify-content-between align-items-center">
                                                <dt >Addons Subtotal: </dt>
                                                <span class="">
                                                    5
                                                    AED</span>
                                            </div> --}}
                                            {{-- <div class="">

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <dt>Additional Rooms Discount(10%): </dt>
                                                        <span class="">
                                                            10 AED</span>
                                                    </div>
                                                    <div class="" style="display: flex; margin-top: 5px; margin-bottom: 5px;">
                                                        <dt style="width: 40%;">Add a promo code: </dt>
                                                        <div class="input-group" style="width: 59%;">
                                                            <input type="text" class="form-control" id="promocode"
                                                                placeholder="Enter your promocode">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text" id="applypromocode">Apply
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div> --}}
                                            {{-- <div class="">
                                                @if (@$setting->tax !== null)
                                                    <dt>Tax cost ({{ $setting->tax }}%): </dt>
                                                    <span class="">
                                                        {{ $tax = round(($detail_form_latest->amount * $setting->tax) / 100) }}
                                                        AED
                                                    </span>
                                                @endif
                                            </div> --}}
                                            <div class="d-flex justify-content-between align-items-center">
                                                <dt style="width: 70%;">Grand Total: </dt>
                                                <span class="" id="grand_total_new">
                                                    {{$total_price}} AED
                                                </span>
                                            </div>
                                        </dl>
                                    </article>
                                    <div class="order_txt">Any applicable taxes and/or duties have been applied to your Bag
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <div class="col-md-12">

                            </div>

                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">
                                    <!--<img src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_m.png" alt="Pay with PayPal" />-->
                                    <img src="public/img/paypal_bt.png">

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
