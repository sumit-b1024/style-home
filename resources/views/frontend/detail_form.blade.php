@extends('layouts.frontend')
@section('content')
    <?php
    use App\Models\FormAnswer;
    use App\Models\QuizCategory;
    use App\Models\SubscriptionAddon;
    ?>

    <style>
        .error {
            color: #ff0000;
        }

        .selected-room .selected_list li {
            background-color: gray;
            margin-top: 5px;
            padding: 5px;
            color: white;
            text-align: center;
        }

        .selected-room .selected_list li .cross {
            float: right;
        }

        .selected-room .selected_list li .total {
            float: left;
            padding-left: 15px;
        }
    </style>
    <!---<section class="banner_inner">
                                                            <div class="bannerParallax_inner privacy"></div>
                                                            </section>-->
    <section class="designer_cont project_main inner_page_cont tittle_no_banner">
        <h4>{{ $page_title->title }}</h4>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
                    @endif
                    <div class="img_style1">
                        <img src="{{ asset('/public/img/mystyle1.jpg') }}" alt="style-A-home">
                    </div>
                    <div class="customer_form_details1">
                        <form class="interior_details_form" action="{{ route('frontend.detail.form.post') }}"
                            method="post">
                            @csrf

                            <div class="form-group class1">
                                <p>When would you need this project done?</p>
                                <input type="text" name="project_duration"
                                    value="{{ old('project_duration', optional(@$customer_temp5)->project_duration) }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('project_duration') }}</span>
                            </div>
                            <div class="form-group class1">
                                {{-- <p>Where are you located? <span class="asterisk" aria-hidden="true">*</span></p> --}}
                                <p>Where are you located?</p>

                                <select id="country" name="country" class="form-control">
                                    <option value="">Select Country</option>
                                    @if (count($countries) > 0)
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country', optional(@$customer_temp5)->country) == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block is-invalid error">{{ $errors->first('country') }}</span>
                            </div>

                            <div class="form-group class1">
                                <p>{{ $form_questions[0]['title'] }}</p>
                                <select id="country"name="space" class="form-control">
                                    <option value="">Select Space</option>
                                    <?php
                                    $form_answers = FormAnswer::where('status', 1)
                                        ->where('question_id', $form_questions[0]['id'])
                                        ->get();
                                    ?>
                                    @if (count($form_answers) > 0)
                                        @foreach ($form_answers as $form_answer)
                                            <option value="{{ $form_answer->id }}"
                                                {{ old('space', optional(@$customer_temp5)->space) == $form_answer->id ? 'selected' : '' }}>
                                                {{ $form_answer->title }}</option>
                                        @endforeach
                                    @endif

                                </select>
                                <span class="help-block is-invalid error">{{ $errors->first('space') }}</span>
                            </div>

                            <div class="form-group class1">
                                <input type="hidden" name="room" id="checkroomids">
                                <p>{{ $form_questions[1]['title'] }}</p>
                                <p style="margin-top: -20px; margin-bottom: 0px;">(10% discount on additional rooms)</p>
                                <select id="room_list" name="rooms" class="form-control">
                                    <option selected disabled value="">Select Room</option>
                                    <?php
                                    $form_answers1 = FormAnswer::where('status', 1)
                                        ->where('question_id', $form_questions[1]['id'])
                                        ->get();
                                    ?>
                                    @if (count($form_answers1) > 0)
                                        @foreach ($form_answers1 as $form_answer1)
                                            <option value="{{ $form_answer1->id }}" data-name="{{ $form_answer1->title }}"
                                                {{ old('room', optional(@$customer_temp5)->room) == $form_answer1->id ? 'selected' : '' }}>
                                                {{ $form_answer1->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="selected-room">
                                    <ul class="selected_list" id="selected_list">
                                        {{-- <li><span class="selected_option">Badroom</span><span class="total">1</span><span
                                                class="cross">X</span></li>
                                        <li><span class="selected_option">Ofice</span><span class="total">1</span><span
                                                class="cross">X</span></li> --}}
                                    </ul>
                                </div>
                                <span class="help-block is-invalid error">{{ $errors->first('room') }}</span>
                            </div>

                            <div class="form-group">
                                <p>Choose Designer</p>
                                <div class="row">
                                    @if (count($designers) > 0)
                                        @foreach ($designers as $designer)
                                            <div class="col-sm-4">
                                                <label class="checkcontainer1">
                                                    <input name="designer" type="radio" value="{{ $designer->user_id }}"
                                                        class="colorinput-input"
                                                        {{ old('designer', @$customer_temp5->designer) == $designer->user_id ? 'checked' : '' }}>
                                                    <div class="style_box colorinput-color ">
                                                        <a target="_blank"
                                                            href="{{ route('frontend.designer.bio', ['model' => $designer->user_id]) }}">
                                                            @if ($designer->profile_image)
                                                                <div class="img_box"><img
                                                                        src="{{ $designer->getProfileImage() }}"
                                                                        alt="Designer"></div>
                                                            @else
                                                                <div class="img_box"><img
                                                                        src="{{ asset('public/images/member_nopic.png') }}"
                                                                        alt="Designer"></div>
                                                            @endif
                                                            <span class="bg-azure">{{ $designer->first_name }}
                                                                {{ $designer->last_name }}</span>
                                                        </a>
                                                        @if ($designer->bio_type)
                                                            @php
                                                                $type = [];
                                                                $bio_ids = explode(',', $designer->bio_type);
                                                                $bio_types = QuizCategory::where('status', 1)
                                                                    ->whereIn('id', $bio_ids)
                                                                    ->get();
                                                            @endphp
                                                            @if (count($bio_types) > 0)
                                                                @foreach ($bio_types as $bio_type)
                                                                    @php
                                                                        $type[] = $bio_type->title;
                                                                    @endphp
                                                                @endforeach
                                                            @endif
                                                            {{-- <span class="bg-azure">({{ implode(',', $type) }})</span> --}}
                                                        @endif
                                                    </div>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <span class="help-block is-invalid error">{{ $errors->first('designer') }}</span>
                            </div>

                            <div class="form-group">

                                <p>Chosen Package</p>
                                <div class="row suscription_for_box">
                                    <div class="">
                                        <div class="session_cont mt-5 pt-4 pricing_area">
                                            <div class="row" style="display: flex;justify-content:center;align-items:center;">
                                                @if (count($subscriptions) > 0)
                                                    @foreach ($subscriptions as $subscription)
                                                    @if ($subscription->id == 2)
                                                        <div class="col-sm-6">
                                                            @if ($subscription->id == $customer_temp5->subscription)
                                                                <input type="hidden"
                                                                    name="addon_ids{{ $subscription->id }}"
                                                                    value="{{ $customer_temp5->addons ? $customer_temp5->addons : '' }}"
                                                                    id="addon_ids{{ $subscription->id }}">
                                                            @else
                                                                <input type="hidden"
                                                                    name="addon_ids{{ $subscription->id }}" value=""
                                                                    id="addon_ids{{ $subscription->id }}">
                                                            @endif
                                                            <label class="checkcontainer2">
                                                                <input name="subscription" type="radio" checked="checked"
                                                                    value="{{ $subscription->id }}"
                                                                    class="colorinput-input"
                                                                    {{ old('subscription', optional(@$customer_temp5)->subscription) == $subscription->id ? 'checked' : '' }}>
                                                                <div class="colorinput-color choose_box">
                                                                    <div class="box">
                                                                        <div class="price_box">
                                                                            <div class="liveSession">
                                                                                @if ($subscription->id == $customer_temp5->subscription)
                                                                                    <label class="mb-0"
                                                                                        id="amount_{{ $subscription->id }}">{{ $customer_temp5->amount ? $customer_temp5->amount : $subscription->fee_amount }}
                                                                                        AED</label>
                                                                                    <input type="hidden"
                                                                                        name="amount{{ $subscription->id }}"
                                                                                        value="{{ $customer_temp5->amount ? $customer_temp5->amount : $subscription->fee_amount }}"
                                                                                        id="main_amount{{ $subscription->id }}">
                                                                                @else
                                                                                    <label class="mb-0"
                                                                                        id="amount_{{ $subscription->id }}">{{ $subscription->fee_amount }}
                                                                                        AED</label>
                                                                                    <input type="hidden"
                                                                                        name="amount{{ $subscription->id }}"
                                                                                        value="{{ $subscription->fee_amount }}"
                                                                                        id="main_amount{{ $subscription->id }}">
                                                                                @endif
                                                                            </div>
                                                                            <h3>{{ $subscription->title }}</h3>
                                                                            {!! @optional($subscription)->facilities !!}
                                                                            {{-- <span class="size">Size :
                                                                                {{ $subscription->size }}</span> --}}


                                                                            <button type="button" class="addons_bt"
                                                                                data-toggle="collapse"
                                                                                data-target="#demo{{ $subscription->id }}">Addons</button>
                                                                            <?php
                                                                            if ($customer_temp5->subscription == $subscription->id && $customer_temp5->addons) {
                                                                                $qq = 'show';
                                                                            } else {
                                                                                $qq = '';
                                                                            }
                                                                            if (@$customer_temp5->addons) {
                                                                                $ind = explode(',', $customer_temp5->addons);
                                                                            } else {
                                                                                $ind = [];
                                                                            }
                                                                            ?>
                                                                            <div id="demo{{ $subscription->id }}"
                                                                                class="collapse {{ $qq }}">
                                                                                <div class="profile price_list">
                                                                                    @php
                                                                                        $subscriptions1 = SubscriptionAddon::where('status', 1)
                                                                                            ->where('subscription_id', $subscription->id)
                                                                                            ->get();
                                                                                    @endphp
                                                                                    @if (count($subscriptions1) > 0)
                                                                                        @foreach ($subscriptions1 as $subscription1)
                                                                                            <div class="form-check">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    name="addons{{ $subscription->id }}"
                                                                                                    type="checkbox"
                                                                                                    value="{{ $subscription1->id }},{{ $subscription1->price }}"
                                                                                                    @if (in_array($subscription1->id, @$ind)) checked @endif>
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="">{{ $subscription1->title }}
                                                                                                    ({{ $subscription1->price }}
                                                                                                    AED)
                                                                                                </label>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif


                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="">
                                                         <div class="session_cont mt-5 pt-4 pricing_area">
                                                                            <div class="row">


                                                         <div class="col-sm-4">
                                                                        <label class="checkcontainer2">
                                                             <input name="subscription" type="radio" value="{{ $subscription->id }}" class="colorinput-input">
                                                             <div class="colorinput-color choose_box">
                                                             <div class="box">
                                                         <div class="price_box">
                                                         <div class="liveSession">
                                                         <label class="mb-0">$350</label>
                                                         </div>
                                                         <h3>Decorate me</h3>
                                                         <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
                                                         <span class="size">Size : Per room</span>


                                                        <button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo4">Addons</button>
                                                          <div id="demo4" class="collapse">
                                                          <div class="profile price_list">
                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">2D layout  (+50) AED/ room) </label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">3D Model (+100 AED / room)</label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">Procurement (+100/ room, +50 AED for additional rooms)</label>
                                                        </div>

                                                        </div>

                                                         <p>Do you have the main furniture pieces and just need help decorating your space? Then Decorate me is for you!</p>
                                                           </div>

                                                         </div>
                                                         </div>
                                                             </div>
                                                             <span class="checkmark"></span>
                                                            </label>
                                                                         </div>



                                                         <div class="col-sm-4">
                                                                        <label class="checkcontainer2">
                                                             <input name="subscription" type="radio" value="{{ $subscription->id }}" class="colorinput-input">
                                                             <div class="colorinput-color choose_box">
                                                             <div class="box">
                                                         <div class="price_box">
                                                         <div class="liveSession">
                                                         <label class="mb-0">$350</label>
                                                         </div>
                                                         <h3>Decorate me</h3>
                                                         <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
                                                         <span class="size">Size : Per room</span>


                                                        <button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo5">Addons</button>
                                                          <div id="demo5" class="collapse">
                                                          <div class="profile price_list">
                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">2D layout  (+50) AED/ room) </label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">3D Model (+100 AED / room)</label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">Procurement (+100/ room, +50 AED for additional rooms)</label>
                                                        </div>

                                                        </div>

                                                         <p>Do you have the main furniture pieces and just need help decorating your space? Then Decorate me is for you!</p>
                                                           </div>

                                                         </div>
                                                         </div>
                                                             </div>
                                                             <span class="checkmark"></span>
                                                            </label>
                                                                         </div>

                                                         <div class="col-sm-4">
                                                                        <label class="checkcontainer2">
                                                             <input name="subscription" type="radio" value="{{ $subscription->id }}" class="colorinput-input">
                                                             <div class="colorinput-color choose_box">
                                                             <div class="box">
                                                         <div class="price_box">
                                                         <div class="liveSession">
                                                         <label class="mb-0">$350</label>
                                                         </div>
                                                         <h3>Decorate me</h3>
                                                         <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
                                                         <span class="size">Size : Per room</span>


                                                        <button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo6">Addons</button>
                                                          <div id="demo6" class="collapse">
                                                          <div class="profile price_list">
                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">2D layout  (+50) AED/ room) </label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">3D Model (+100 AED / room)</label>
                                                        </div>

                                                         <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="">
                                                          <label class="form-check-label" for="">Procurement (+100/ room, +50 AED for additional rooms)</label>
                                                        </div>

                                                        </div>

                                                         <p>Do you have the main furniture pieces and just need help decorating your space? Then Decorate me is for you!</p>
                                                           </div>

                                                         </div>
                                                         </div>
                                                             </div>
                                                             <span class="checkmark"></span>
                                                            </label>
                                                                         </div>



                                                             </div>

                                                                </div>         </div>-->


                                </div>


                                <span class="help-block is-invalid error">{{ $errors->first('subscription') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2 style_submit">Proceed To Checkout</button>



                        </form>
                    </div>
                </div>
            </div>
        </div>
        @extends('layouts.modal')
    </section>
    <script>
        $('input[name="subscription"]').click(function() {
            if ($("input[name='subscription']:checked").val()) {
                var chk_addon = $("input[name='subscription']:checked").val();
                <?php
			foreach($subscriptions as $subscription){
			?>
                if (chk_addon != '<?php echo $subscription->id; ?>') {
                    $('input[name="addons<?php echo $subscription->id; ?>"]').prop('checked', false);
                    $("#demo<?php echo $subscription->id; ?>").removeClass("show");
                }
                <?php
			}
			?>
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            localStorage.setItem("roomData", JSON.stringify([]));
            <?php
		$p=1;
		foreach($subscriptions as $subscription){
		?>
            $('input[name="addons<?php echo $subscription->id; ?>"]').click(function() {
                //alert();
                    var amount = $("#main_amount<?php echo $subscription->id; ?>").val();
                var yy = $("#addon_ids<?php echo $subscription->id; ?>").val();
                var addons = $(this).val();
                addons = addons.split(',');
                var addon_id = addons[0];
                var addon_amount = addons[1];
                if ($(this).is(":checked")) {
                    //alert("Checkbox is checked.");
                    var total = (parseInt(addon_amount) + parseInt(amount));
                    $("#amount_<?php echo $subscription->id; ?>").text(total + " AED");
                    $("#main_amount<?php echo $subscription->id; ?>").val(total);
                    if ((yy != "") && (yy.includes(addon_id))) {} else {
                        if (yy) {
                            var bla1 = yy + ',' + addon_id;
                        } else {
                            var bla1 = addon_id;
                        }
                        $("#addon_ids<?php echo $subscription->id; ?>").val(bla1);
                    }
                } else if ($(this).is(":not(:checked)")) {
                    //alert("Checkbox is unchecked.");
                    var bla1 = $("#addon_ids<?php echo $subscription->id; ?>").val();
                    var total = (parseInt(amount) - parseInt(addon_amount));
                    $("#amount_<?php echo $subscription->id; ?>").text(total + " AED");
                    $("#main_amount<?php echo $subscription->id; ?>").val(total);
                    var ee1 = bla1.replace(addon_id, "");
                    ee1 = ee1.replace(/^,|,$/g, '');
                    $("#addon_ids<?php echo $subscription->id; ?>").val(ee1);
                }
            });
            <?php
		$p++;
		}
		?>
            $("#room_list").change(function() {
                let index = $(this).val();
                let name = $(this).find(':selected').data('name');
                let roomData = JSON.parse(localStorage.getItem("roomData"));
                let check = roomData.find((e) => e.id == index);
                if (check != undefined) {
                    roomData.map(function(e) {
                        if (e.id == index) {
                            e.count++;
                        }
                    })
                } else {
                    let obj = {
                        id: index,
                        name: name,
                        count: 1
                    }
                    roomData.push(obj);
                }
                localStorage.setItem("roomData", JSON.stringify(roomData));
                $(this).val('');
                let html = '';
                $.each(roomData, function(index, value) {
                    // console.log(value);
                    html +=
                        `<li id="remove${index}"><span class="selected_option">${value.name}</span><span class="total">${value.count}</span><span class="cross" data-index="${index}">X</span></li>`;
                });
                $("#selected_list").html(html);
                $(".cross").click(function() {
                    let index = $(this).data('index');
                    $(`#remove${index}`).hide();
                    roomData.splice(index, 1);
                    if (roomData.length == 0) {
                        $("#checkroomids").val('');
                    }
                    // else if (roomData.length > 1) {
                    //     $("#discount10").show();
                    // } else {
                    //     $("#discount10").hide();
                    // }
                    $("#checkroomids").val(JSON.stringify(roomData));
                });
                if (roomData.length == 0) {
                    $("#checkroomids").val('');
                }
                // else if (roomData.length > 1) {
                //     $("#discount10").show();
                // } else {
                //     $("#discount10").hide();
                // }
                $("#checkroomids").val(JSON.stringify(roomData));
            });

        });
    </script>
@endsection
