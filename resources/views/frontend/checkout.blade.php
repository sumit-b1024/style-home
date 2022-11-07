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
            <a class="btn btn-warning" href="{{ route('frontend.detail.form') }}">Back <i
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
            
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <h4 class="card-header">Your basket</h4>
                            <article class="card-body">
                                <div class="form-group">
                                    <p><b>Selected package: </b> {{ $detail_form_latest->subscription_title }}</p>
                                    @if (@$detail_form_latest->addons)

                                        <div class="addon_box">
                                            <p><b>Addons: </b>
                                                @php
                                                    $addons2 = [];
                                                    $addons = $detail_form_latest->addons;

                                                    $addons1 = explode(',', $addons);
                                                    $subscription_addons = SubscriptionAddon::whereIn('id', $addons1)->get();
                                                @endphp
                                                @if (count($subscription_addons) > 0)
                                                    @foreach ($subscription_addons as $subscription_addon)
                                                        <span>{{ $subscription_addon->title }}
                                                            ({{ $subscription_addon->price }} AED)
                                                        </span>
                                                    @endforeach
                                                @endif
                                        </div>
                                    @endif
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
                                        @php
                                            $dis10 = 0;
                                            $free_amount = $detail_form_latest->fee_amount * $detail_form_rooms_count;
                                        @endphp
                                        <dl class="dlist-align">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <dt >Item Subtotal: </dt>
                                                <span class="">
                                                    {{ $free_amount }}
                                                    AED</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <dt >Addons Subtotal: </dt>
                                                <span class="">
                                                    {{ $detail_form_latest->amount - $detail_form_latest->fee_amount }}
                                                    AED</span>
                                            </div>
                                            <div class="">
                                                {{-- @if ($detail_form_rooms_count > 1) --}}
                                                    @php
                                                        $dis10 = ($free_amount * 10) / 100;
                                                    @endphp
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <dt>Additional Rooms Discount(10%): </dt>
                                                        <span class="">
                                                            {{ $dis10 }} AED</span>
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
                                                {{-- @endif --}}
                                            </div>
                                            <div class="">
                                                @if (@$setting->tax !== null)
                                                    <dt>Tax cost ({{ $setting->tax }}%): </dt>
                                                    <span class="">
                                                        {{ $tax = round(($detail_form_latest->amount * $setting->tax) / 100) }}
                                                        AED
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-danger" id="promocode-error"></div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <dt style="width: 70%;">Grand Total: </dt>
                                                <div class="" id="grand_total" style="display: none;">{{ round($free_amount + @$tax) + ($detail_form_latest->amount - $detail_form_latest->fee_amount) - $dis10 }}</div>
                                                <span class="" id="grand_total_new">
                                                    {{ round($free_amount + @$tax) + ($detail_form_latest->amount - $detail_form_latest->fee_amount) - $dis10 }}
                                                    AED
                                                </span>
                                            </div>
                                        </dl>
                                    </article>
                                    <div class="order_txt">Any applicable taxes and/or duties have been applied to your Bag
                                    </div>
                                </div>
                            </div>
                      
                            <div class="col-md-12">

                            </div>

                            <div class="col-md-12 mt-4">
                                <form action="{!! URL::route('paypal') !!}" method="POST" role="form">
                                @csrf

                                       <input type="hidden" name="detail_form_id" value="{{ $detail_form_latest->id }}" id="detail_form_id">   
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">
                                    <!--<img src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_m.png" alt="Pay with PayPal" />-->
                                    <img src="public/img/paypal_bt.png">

                                </button>
                                     </form>


                                       <form action="{!! URL::route('frontend.product.payment') !!}" method="POST" role="form">
                                @csrf

                                       <input type="hidden" name="detail_form_id" value="{{ $detail_form_latest->id }}" id="detail_form_id">   
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">
                                    <!--<img src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_m.png" alt="Pay with PayPal" />-->
                                    <img src="public/images/card.png">

                                </button>
                                     </form>



                            </div>
                        </div>
                    </div>
                </div>
       
        </div>
    </section>
    <script>
        $("#applypromocode").click(function() {
            let promocode = $("#promocode").val().trim();
            let grand_total = $("#grand_total").text();
            let detail_form_id = $("#detail_form_id").val();
            if (promocode != "") {
                $.ajax({
                    type: "post",
                    url: "{{ route('frontend.subscription.check_promocode') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "promocode": promocode,
                        "grand_total": grand_total,
                        "detail_form_id": detail_form_id,
                    },
                    success: function(data) {
                        if(data.message){
                            $("#promocode-error").text(data.message);
                        }
                        //do something with response data
                        if(data.result){
                            $("#promocode-error").text('');
                            if(data.result > 1){
                                let mix = Math.round(data.result).toFixed(2) + " AED";
                                $("#grand_total_new").text(mix);
                            }
                            else{
                                $("#grand_total_new").text(data.result);
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
