@extends('layouts.frontend')
@section('content')
    <?php
    use App\Models\QuizAnswer;
    use App\Models\SubscriptionAddon;
    use App\Models\QuizResult;
    ?>
    <!--<script type="text/javascript">
        (function(i, n, t, e, r, a, c) {
            i['InteractPromotionObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = n.createElement(t),
                c = n.getElementsByTagName(t)[0];
            a.async = 1;
            a.src = e;
            c.parentNode.insertBefore(a, c)
        })(window, document, 'script', 'https://i.tryinteract.com/promotions/init.js', 'i_promo');
        i_promo('init', 'h2zX9jB_4');
    </script>-->
    <section class="banner">
        <img src="{{ asset("public/uploads/banner/{$banner->path}") }}">
        <div class="banner_content">
            <div class="container">
                <div class="row">
                    <div class="content">
                        <h1>{{ $banner->title }}</h1>
                        @if (count($quiz_questions) > 0)
                            <button class="btn btn-secondary brown_btn" type="button" data-toggle="modal"
                                data-target="#myModal">
                                Find Your Style
                            </button>
                        @else
                            <button class="btn btn-secondary brown_btn" type="button" data-toggle="modal"
                                data-target="#myModal2">
                                Find Your Style
                            </button>
                        @endif
                        <!--When there is no question-->
                        <div class="modal fade" id="myModal2" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="card ">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="text-danger">No Question Available for Quiz!</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--When there is no question-->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog interior_box">
                                <form action="{{ route('frontend.preferred.bedroom') }}" method="post"
                                    id="preferred_bedroom_form" novalidate="novalidate">
                                    @csrf
                                    <input type="hidden" name="subscription" id="subscription" value="">
                                    <input type="hidden" name="subscription_ammount" id="subscription_ammount"
                                        value="">
                                    <input type="hidden" name="addons" id="addons" value="">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="card calulator-card first visible">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> What's your interior design style?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="interior_img">
                                                    <img src="{{ Request::root() }}/public/img/interior_banner.jpg">
                                                </div>
                                                {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s,</p> --}}
                                                <a class="next1 bt_score">Take the Quiz</a>
                                            </div>

                                        </div>


                                        @if (count($quiz_questions) > 0)
                                            @php
                                                $i = 2;
                                            @endphp
                                            @foreach ($quiz_questions as $quiz_question)
                                                <div class="card calulator-card first">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{ $quiz_question->title }}</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <input name="questions[]" type="hidden"
                                                            value="{{ $quiz_question->id }}" class="colorinput-input"
                                                            required>
                                                        <div class="style_list">
                                                            <ul>
                                                                <?php
                                                                $quiz_answers = QuizAnswer::where('status', 1)
                                                                    ->where('question_id', $quiz_question->id)
                                                                    ->get();
                                                                ?>
                                                                @if (count($quiz_answers) > 0)
                                                                    @foreach ($quiz_answers as $quiz_answer)
                                                                        <li>
                                                                            <label class="checkcontainer">

                                                                                <input name="answers_{{ $i }}[]"
                                                                                    id="preferred_bedroom_{{ $i }}"
                                                                                    type="radio"
                                                                                    value="{{ $quiz_answer->id }}"
                                                                                    class="colorinput-input" required>
                                                                                <div class="style_box colorinput-color ">
                                                                                    <div class="img_box"><img
                                                                                            src="{{ $quiz_answer->getQuizAnswerImage() }}"
                                                                                            alt="Quiz Answer"></div>
                                                                                    <span
                                                                                        class="bg-azure">{{ $quiz_answer->title }}</span>

                                                                                </div>
                                                                                <span class="checkmark"></span>
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                            </ul>
                                                            <span class="text-danger" role="alert"
                                                                id="err_preferred_bedroom_{{ $i }}"></span>
                                                        </div>
                                                        <?php
		  $user=auth()->user();
		  if(!empty($user) ){
			  if($user->role_id==2){
				  if((count($quiz_questions)+1)==$i){
					 ?>
                                                        <button type="submit" class="next bt_score1"
                                                            style="display:block;width: 10%;">Next</button>
                                                        <?php
				  }
				  else{
					  ?>
                                                        <a class="next{{ $i }} bt_score1"
                                                            style="display:block;width: 10%;">Next</a>
                                                        <?php
				  }
			  }
			  else{
				  ?>
                                                        <a class="next{{ $i }} bt_score1"
                                                            style="display:block;width: 10%;">Next</a>
                                                        <?php
			  }
		  }
		  else{
			  ?>
                                                        <a class="next{{ $i }} bt_score1"
                                                            style="display:block;width: 10%;">Next</a>
                                                        <?php
		  }
		  ?>
                                                        <!--<a class="next{{ $i }} bt_score1" style="display:block;width: 10%;">Next</a>-->

                                                        <a class="pre bt_score1">Previous</a>

                                                    </div>


                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        @endif

                                        <?php
		$user=auth()->user();
		if(!empty($user) ){
		if($user->role_id!=2){
		?>
                                        <!--Email -->
                                        <div class="card calulator-card first">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Customer Info</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="login_type" class="login_type"
                                                    value="signup">
                                                <div class="style_list customer_info_form">
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Name') }}</label>
                                                        <input type="text"
                                                            value="{{ old('name', optional(@$model)->name) }}"
                                                            name="name" id="name" placeholder="Enter Name"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert" id="err_name"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Email') }}</label>
                                                        <input type="text"
                                                            value="{{ old('email', optional(@$model)->email) }}"
                                                            id="email" name="email" placeholder="Enter Email"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert" id="err_email"></span>
                                                    </div>
                                                    <p class="sign_up_txt popup_sign">Already have an account? <a
                                                            class="next01 bt_score">Sign In</a></p>
                                                </div>


                                                <button type="submit" style="display:block;width: 10%;"
                                                    class="submit_bt bt_score1">Submit</button>

                                                <a class="pre bt_score1">Previous</a>
                                            </div>

                                        </div>
                                        <!--Email -->
                                        <?php
			}
			else{
			?>
                                        <?php
			}
			}
			else{
			?>
                                        <!--Email -->
                                        <div class="card calulator-card first">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Customer Info</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="login_type" class="login_type"
                                                    value="signup">
                                                <div class="style_list customer_info_form">
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Name') }}</label>
                                                        <input type="text"
                                                            value="{{ old('name', optional(@$model)->name) }}"
                                                            name="name" id="name" placeholder="Enter Name"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert" id="err_name"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Email') }}</label>
                                                        <input type="text"
                                                            value="{{ old('email', optional(@$model)->email) }}"
                                                            id="email" name="email" placeholder="Enter Email"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert" id="err_email"></span>
                                                    </div>
                                                    <p class="sign_up_txt popup_sign">Already have an account? <a
                                                            class="next01 bt_score">Sign In</a></p>
                                                </div>


                                                <button type="submit" style="display:block;width: 10%;"
                                                    class="submit_bt bt_score1">Submit</button>

                                                <a class="pre bt_score1">Previous</a>
                                            </div>

                                        </div>
                                        <!--Email -->
                                        <?php
			}
			?>
                                        <!--Login -->
                                        <?php
		$user=auth()->user();
		if(empty($user)){
		?>
                                        <div class="card calulator-card first">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Customer Login</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="login_type" class="login_type"
                                                    value="signup">
                                                <div class="style_list customer_info_form">
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Username or Email') }}</label>
                                                        <input type="text"
                                                            value="{{ old('username', optional(@$model)->username) }}"
                                                            name="username" id="username" placeholder="Enter Username"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert"
                                                            id="err_username"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company"
                                                            class=" form-control-label">{{ __('Password') }}</label>
                                                        <input type="password"
                                                            value="{{ old('password', optional(@$model)->password) }}"
                                                            id="password" name="password" placeholder="Enter Password"
                                                            class="form-control">
                                                        <span class="text-danger" role="alert"
                                                            id="err_password"></span>
                                                    </div>
                                                    <span class="text-danger" role="alert" id="err_account"></span>
                                                    <div class="form-group">
                                                        <span for="rememberme" class="inline pull-left"><input
                                                                name="rememberme" type="checkbox" id="rememberme"
                                                                value="forever"> Remember me </span><span
                                                            class="lost_password pull-right">
                                                            <a href="{{ route('frontend.reset.password') }}" style="color: #b68251;">Forgot your
                                                                password?</a>
                                                    </div>
                                                </div>
                                                <button type="submit" style="display:block;width: 10%;"
                                                    class="submit_bt bt_score1">Submit</button>

                                                <a class="pre bt_score1 pre01">Previous</a>
                                            </div>

                                        </div>
                                        <?php
		 }
		 ?>
                                        <!--Login -->
                                </form>

                                <div class="card calulator-card first">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">What's your interior design style? <span
                                                id="answer_category" style="color:#56e454"></span></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="interior_img">
                                            <img src="" id="answer_image">
                                        </div>
                                        <div id="answer_description">
                                        </div>
                                        <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->

                                        <div class="style_social_link">
                                            <h3>Share Your Results</h3>
                                            <span><a href="#"><i class="fab fa-facebook"></i></a></span>
                                            <span><a href="#"><i class="fab fa-twitter"></i></a></span>
                                            <span><a href="#"><i class="fab fa-instagram"></i></a></span>
                                        </div>
                                        {{-- <a href="{{ route('frontend.detail.form') }}" class="start_project">Are you ready
                                            to find a designer and start this project?</a> --}}
                                        <button class="btn btn-secondary brown_btn" type="button"
                                            onclick="showPackages()">
                                            {{-- Are you ready to find a designer and start this project? --}}
                                            Are you ready to choose a package and start your project?
                                        </button>
                                        <!--<form action="{{ route('frontend.start.project') }}"  method="post" id="start_project_form" novalidate="novalidate">
                      @csrf
                      <button type="submit" class="start_project">Are you ready to find a designer and start this project?</a>
                      </form>-->
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="packages" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row suscription_for_box">
                                        <div class="bg-white" style="padding: 10px">
                                            <div class="session_cont mt-5 pt-4 pricing_area">
                                                <div class="row"
                                                    style="display: flex;align-items: center;justify-content: center;">
                                                    @if (count($subscriptions) > 0)
                                                        @foreach ($subscriptions as $subscription)
                                                            <div class="col-sm-6">
                                                                @if (isset($subscription->id) &&
                                                                    isset($customer_temp5->subscription) &&
                                                                    $subscription->id == $customer_temp5->subscription)
                                                                    <input type="hidden"
                                                                        name="addon_ids{{ $subscription->id }}"
                                                                        value="{{ $customer_temp5->addons ? $customer_temp5->addons : '' }}"
                                                                        id="addon_ids{{ $subscription->id }}">
                                                                @else
                                                                    <input type="hidden"
                                                                        name="addon_ids{{ $subscription->id }}"
                                                                        value=""
                                                                        id="addon_ids{{ $subscription->id }}">
                                                                @endif
                                                                <label class="checkcontainer2">
                                                                    <input name="subscription" type="radio"
                                                                        data-amount="{{ $subscription->fee_amount }}"
                                                                        value="{{ $subscription->id }}"
                                                                        class="colorinput-input"
                                                                        {{ old('subscription', optional(@$customer_temp5)->subscription) == $subscription->id ? 'checked' : '' }}>
                                                                    <div class="colorinput-color choose_box">
                                                                        <div class="box">
                                                                            <div class="price_box">
                                                                                <div class="liveSession">
                                                                                    @if (isset($subscription->id) &&
                                                                                        isset($customer_temp5->subscription) &&
                                                                                        $subscription->id == $customer_temp5->subscription)
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
                                                                                <span>20 min consultation call in each package</span>
                                                                                {{-- <span class="size">Size :
                                                                                    {{ $subscription->size }}</span> --}}


                                                                                {{-- <button type="button" class="addons_bt"
                                                                                data-toggle="collapse"
                                                                                data-target="#demo{{ $subscription->id }}">Addons</button>
                                                                            <?php
                                                                            if (isset($subscription->id) && isset($customer_temp5->subscription) && isset($customer_temp5->addons) && $customer_temp5->subscription == $subscription->id && $customer_temp5->addons) {
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
                                                                            </div> --}}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="go_ahead_with_packages">Next</button>
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal fade" id="packages" role="dialog">
                        <div class="modal-dialog interior_box">
                            <div class="row suscription_for_box">
                                <div class="bg-white" style="padding: 10px">
                                    <div class="session_cont mt-5 pt-4 pricing_area">
                                        <div class="row">
                                            @if (count($subscriptions) > 0)
                                                @foreach ($subscriptions as $subscription)
                                                    <div class="col-sm-4">
                                                        <a href="https://havenly.com/shop/collection/tailored-organic">
                                                            <label class="checkcontainer2">
                                                                <div class="colorinput-color choose_box">
                                                                    <div class="box">
                                                                        <div class="price_box">
                                                                            <div class="liveSession">
                                                                                @if ($subscription->id == $customer_temp5->subscription)
                                                                                    <label class="mb-0"
                                                                                        id="amount_{{ $subscription->id }}">{{ $customer_temp5->amount ? $customer_temp5->amount : $subscription->fee_amount }}
                                                                                        AED</label>
                                                                                @else
                                                                                    <label class="mb-0"
                                                                                        id="amount_{{ $subscription->id }}">{{ $subscription->fee_amount }}
                                                                                        AED</label>
                                                                                @endif
                                                                            </div>
                                                                            <h3>{{ $subscription->title }}</h3>
                                                                            {!! @optional($subscription)->facilities !!}
                                                                            <span class="size">Size :
                                                                                {{ $subscription->size }}</span>


                                                                            <button type="button">Addons</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}



                </div>
            </div>
        </div>
        </div>
    </section>




    {!! @optional($section1)->html !!}
    <!--<section class="whatWeDo">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3 cont_left">
                                        <h5>What we do</h5>
                                        <h4>Style - A - Home</h4>
                                        <h4>Interior <span>Services</span></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                            the industry's standard dummy text ever since the 1500s,
                                        </p>
                                        <button class="btn btn-secondary brown_btn">View Service <i
                                                class="fas fa-long-arrow-alt-right"></i></button>
                                    </div>
                                    <div class="cont-right col-lg-9">
                                        <ul>
                                            <li>
                                                <img src="{{ Request::root() }}/public/images/whatWeDo1.jpg" alt="style-A-home">
                                                <div class="heading">
                                                    Living Room
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{ Request::root() }}/public/images/whatWeDo2.jpg" alt="style-A-home">
                                                <div class="heading">
                                                    Dining Rooms
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{ Request::root() }}/public/images/whatWeDo3.jpg" alt="style-A-home">
                                                <div class="heading">
                                                    Bedrooms
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>-->
    <div id="how_it_works">
        {!! @optional($section2)->html !!}
    </div>
    <!--<section class="simplerTalks">
                            <div class="simpler_banner">
                                <div class="container">
                                    <div class="row">
                                        <h2>Even Simpler Than You Think</h2>
                                        <ul>
                                            <li>
                                                <div class="talks_cont">
                                                    <img src="{{ Request::root() }}/public/images/simpler_icon1.png" alt="style-A-home">
                                                </div>
                                                <div class="content_talks">
                                                    <h1>1.</h1>
                                                    <label>Tell us what you need</label>
                                                </div>
                                                <p>
                                                    Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                                    full
                                                    overhaul, or just some ideas to pull it together.
                                                </p>
                                            </li>
                                            <li>
                                                <div class="talks_cont">
                                                    <img src="{{ Request::root() }}/public/images/simpler_icon2.png" alt="style-A-home">
                                                </div>
                                                <div class="content_talks">
                                                    <h1>2.</h1>
                                                    <label>Tell us what you need</label>
                                                </div>
                                                <p>
                                                    Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                                    full
                                                    overhaul, or just some ideas to pull it together.
                                                </p>
                                            </li>
                                            <li>
                                                <div class="talks_cont">
                                                    <img src="{{ Request::root() }}/public/images/simpler_icon3.png" alt="style-A-home">
                                                </div>
                                                <div class="content_talks">
                                                    <h1>3.</h1>
                                                    <label>Tell us what you need</label>
                                                </div>
                                                <p>
                                                    Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                                    full
                                                    overhaul, or just some ideas to pull it together.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>-->

    <section class="my_style">
        <div class="container">
            {!! @optional($section3)->html !!}
            <!--<div class="style_cont">
                                    <div class="row">
                                        <div class="img_style">
                                            <img src="{{ Request::root() }}/public/images/mystyle.jpg" alt="style-A-home">
                                        </div>
                                        <div class="myStyle_content">
                                            <h4>what’s my style</h4>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                                been
                                                the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                                galley
                                                of type and scrambled it to make a type specimen book. It has survived not only five
                                                centuries,
                                            </p>
                                            <button class="mt-5 brown_btn pl-4 pr-4 pt-1 pb-1">Pre Order</button>
                                        </div>
                                    </div>
                                </div>-->
            <div class="session_cont mt-5 pt-4" id="pricing">

                <div class="session_cont mt-5 pt-4 pricing_area">
                    <div class="row">
                        @if (count($subscriptions) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($subscriptions as $subscription)
                                <div class="col-lg-4 col-xs-12">
                                    <input type="hidden" name="addon_ids" value=""
                                        id="addon_ids{{ $subscription->id }}">
                                    <div class="box">
                                        <div class="price_box">
                                            <div class="liveSession">
                                                <label class="mb-0"
                                                    id="amount_{{ $i }}">{{ $subscription->fee_amount }}
                                                    AED</label>
                                                <input type="hidden" name="amount"
                                                    value="{{ $subscription->fee_amount }}"
                                                    id="main_amount{{ $subscription->id }}">
                                            </div>
                                            <h3>{{ $subscription->title }} </h3>
                                            <p>20 Minute Consulation Call with </p>
                                            <span class="size">Size : {{ $subscription->size }}</span>
                                            {!! @optional($subscription)->facilities !!}
                                            <!-- <button class="mt-3 brown_btn d-block">Get Started</button>-->
                                            <button class="mt-3 brown_btn d-block" type="button" data-toggle="modal"
                                                data-target="#myModal" onclick="test('{{ $subscription->id }}')">Get
                                                Started</button>
                                            <button type="button" class="addons_bt" data-toggle="collapse"
                                                data-target="#demo{{ $i }}">Addons</button>
                                            <div id="demo{{ $i }}" class="collapse">
                                                <form class="profile price_list">
                                                    @php
                                                        $subscriptions1 = SubscriptionAddon::where('status', 1)
                                                            ->where('subscription_id', $subscription->id)
                                                            ->get();
                                                    @endphp
                                                    @if (count($subscriptions1) > 0)
                                                        @foreach ($subscriptions1 as $subscription1)
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    name="addons{{ $i }}" type="checkbox"
                                                                    value="{{ $subscription1->id }},{{ $subscription1->price }}">
                                                                <label class="form-check-label" for="">
                                                                    {{ $subscription1->title }}
                                                                    ({{ $subscription1->price }} AED)
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <!--<div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="">
                                          <label class="form-check-label" for=""> Lorem ipsum dolor sit amet</label>
                                        </div>
                                          <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="">
                                          <label class="form-check-label" for=""> Lorem ipsum dolor sit amet</label>
                                        </div>-->
                                                </form>
                                                <!--<p>Do you need to furnish and decorate a room from scratch? Furnish me will help you design your room and elevate it to the next level!</p>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @endif
                    </div>
                </div>
                <!--<div class="col-lg-4 col-xs-12">
                                            <div class="box">
                                                <div class="liveSession">
                                                    <label class="mb-0">$350</label>
                                                </div>
                                                <h3>Decorate me</h3>
                                                <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>

                          <p>Do you have the main furniture pieces and just need help decorating your space? Then Decorate me is for you!</p>
                                                <button class="mt-3 brown_btn d-block">Get Started</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xs-12">
                                            <div class="box">
                                                <div class="liveSession">
                                                    <label class="mb-0">$500</label>
                                                </div>
                                                <h3>Furnish me</h3>
                                                <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
                                                <p>Do you need to furnish and decorate a room from scratch? Furnish me will help you design your room and elevate it to the next level!</p>
                                                <button class="mt-3 brown_btn d-block">Get Started</button>
                                            </div>
                                        </div>-->

            </div>


        </div>
    </section>

    <section class="testimonial">
        <div class="testimonial_img">
            <div class="container">
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                        <div class="carousel-inner">
                            @if (count($testimonials) > 0)
                                @php
                                    $k = 0;
                                @endphp
                                @foreach ($testimonials as $testimonial)
                                    <?php
                                    if ($k == 0) {
                                        $aa = 'active';
                                    } else {
                                        $aa = '';
                                    }
                                    ?>
                                    <div class="carousel-item {{ $aa }}">
                                        <div class="testimonialBox">
                                            <h3>{{ $testimonial->title }}</h3>
                                            <label>{{ $testimonial->position }}</label>
                                            @if ($testimonial->star)
                                                <ul>

                                                    @for ($i = 1; $i <= $testimonial->star; $i++)
                                                        <li><i class="fas fa-star"></i></li>
                                                    @endfor
                                                </ul>
                                            @endif
                                            {!! $testimonial->description !!}
                                        </div>
                                    </div>
                                    @php
                                        $k++;
                                    @endphp
                                @endforeach
                            @endif
                            <!--<div class="carousel-item">
                                                    <div class="testimonialBox">
                                                        <h3>Mind if we show off?</h3>
                                                        <label>Designed by Pamela Kilyk for Luigi P.</label>
                                                        <ul>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                        </ul>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                                            book.
                                                            It has survived not only five centuries,</p>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="testimonialBox">
                                                        <h3>Mind if we show off?</h3>
                                                        <label>Designed by Pamela Kilyk for Luigi P.</label>
                                                        <ul>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                        </ul>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                                            unknown printer took a galley of type and scrambled it to make a type specimen
                                                            book.
                                                            It has survived not only five centuries,</p>
                                                    </div>
                                                </div>-->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--<section class="clients">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3 col-xs-12">
                                        <h3>We work with top clients.</h3>
                                        <span>Partners</span>
                                    </div>
                                    <div class="col-lg-9 col-xs-12">
                                       <div class="partner_links">
                        <ul>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon1.png" alt=""></a></li>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon2.png" alt=""></a></li>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon3.png" alt=""></a></li>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon4.png" alt=""></a></li>
                          <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon5.png" alt=""></a></li>
                          <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon6.png" alt=""></a></li>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon7.png" alt=""></a></li>
                         <li><a href="#"> <img src="{{ Request::root() }}/public/images/partner_icon8.png" alt=""></a></li>
                         </ul>

                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php
	$k=2;
	foreach($quiz_questions as $quiz_question){
	?>
            $(".next<?php echo $k; ?>").click(function() {
                //var ans1 = $('input:radio[name="preferred_bedroom"]').val();
                var ans_<?php echo $k; ?> = $("#preferred_bedroom_<?php echo $k; ?>:checked").val();
                //alert(ans_<?php echo $k; ?>);
                //if ($('input:radio[name="preferred_bedroom"]').prop("checked")) {
                if (ans_<?php echo $k; ?>) {

                    $("#err_preferred_bedroom_<?php echo $k; ?>").html('');
                    //alert();
                    $('.pre').show();
                    $showing = $('.first.visible').first();
                    $next = $showing.next();
                    $showing.removeClass("visible").hide();
                    $next.addClass("visible").show();
                    if (!$next.next().length) {
                        $(this).hide();
                    }
                } else {
                    $("#err_preferred_bedroom_<?php echo $k; ?>").html('This filed is required');
                }
            });
            <?php
	$k++;
	}
	?>
        });
    </script>
    <script>
        (function($) {
            $("#preferred_bedroom_form").submit(function(e) {
                e.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();

                //$("#btn").text('Please wait...');
                //$("#btn").prop('disabled', true);
                var url = $(this).attr("action");
                //alert(url);
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#preferred_bedroom_form").serialize(),
                    success: function(response) {
                        //alert(response);
                        //alert(response.status);
                        //$("#btn").text('Submit');
                        //$("#btn").prop('disabled', false);
                        if (response.status == 'NOK') {
                            $("#err_email").html(response.errors.email ? response.errors.email :
                                '');
                            $("#err_name").html(response.errors.name ? response.errors.name : '');
                            return;
                        } else if (response.status == 'NOK1') {
                            $("#err_name").html('');
                            $("#err_email").html(response.msg ? response.msg :
                                'The email has already been taken.');
                            return;
                        } else if (response.status == 'NOK2') {
                            $("#err_account").html('');
                            $("#err_username").html(response.errors.username ? response.errors
                                .username : '');
                            $("#err_password").html(response.errors.password ? response.errors
                                .password : '');
                            return;
                        } else if (response.status == 'NOK3') {
                            $("#err_username").html('');
                            $("#err_password").html('');
                            $("#err_account").html(response.msg ? response.msg :
                                'Invalid account, please create an account by Signup');
                            return;
                        } else if (response.status == 'OK') {
                            //alert('submit');
                            if (response.category_image == "") {
                                $("#answer_image").css("display", "none");
                            } else {
                                $("#answer_image").css("display", "block");
                            }
                            $("#answer_category").text(response.category);
                            $("#answer_image").attr("src", response.category_image);
                            $("#answer_description").html(response.category_description);
                            //Show previous button
                            $('.pre').show();

                            //Find the element that's currently showing
                            $showing = $('.first.visible').first();

                            //Find the next element
                            $next = $showing.next();

                            //Change which div is showing
                            $showing.removeClass("visible").hide();
                            $next.addClass("visible").show();

                            //If there's no more elements, hide the NEXT button
                            if (!$next.next().length) {
                                $(this).hide();
                            }
                        }
                    }
                });

            });
        })(jQuery);
    </script>

    <script>
        (function($) {
            $("#diningroom_form").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#diningroom_form").serialize(),
                    success: function(response) {
                        if (response.status == 'NOK') {
                            $("#err_diningroom").html(response.errors.diningroom ? response.errors
                                .diningroom : '');
                            return;
                        } else if (response.status == 'OK') {
                            $("#err_diningroom").html('');
                            //Show previous button
                            $('.pre').show();
                            //Find the element that's currently showing
                            $showing = $('.first.visible').first();
                            //Find the next element
                            $next = $showing.next();
                            //Change which div is showing
                            $showing.removeClass("visible").hide();
                            $next.addClass("visible").show();
                            //If there's no more elements, hide the NEXT button
                            if (!$next.next().length) {
                                $(this).hide();
                            }
                        }

                    }
                });

            });
        })(jQuery);
    </script>

    <script>
        (function($) {
            $("#coffee_table_form").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#coffee_table_form").serialize(),
                    success: function(response) {
                        if (response.status == 'NOK') {
                            $("#err_coffee_table").html(response.errors.coffee_table ? response
                                .errors.coffee_table : '');
                            return;
                        } else if (response.status == 'OK') {
                            $("#err_coffee_table").html('');
                            //Show previous button
                            $('.pre').show();
                            //Find the element that's currently showing
                            $showing = $('.first.visible').first();
                            //Find the next element
                            $next = $showing.next();
                            //Change which div is showing
                            $showing.removeClass("visible").hide();
                            $next.addClass("visible").show();
                            //If there's no more elements, hide the NEXT button
                            if (!$next.next().length) {
                                $(this).hide();
                            }
                        }

                    }
                });

            });
        })(jQuery);
    </script>

    <script>
        (function($) {
            $("#home_feel_form").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#home_feel_form").serialize(),
                    success: function(response) {
                        if (response.status == 'NOK') {
                            $("#err_home_feel").html(response.errors.home_feel ? response.errors
                                .home_feel : '');
                            return;
                        } else if (response.status == 'OK') {
                            $("#err_home_feel").html('');
                            //Show previous button
                            $('.pre').show();
                            //Find the element that's currently showing
                            $showing = $('.first.visible').first();
                            //Find the next element
                            $next = $showing.next();
                            //Change which div is showing
                            $showing.removeClass("visible").hide();
                            $next.addClass("visible").show();
                            //If there's no more elements, hide the NEXT button
                            if (!$next.next().length) {
                                $(this).hide();
                            }
                        }

                    }
                });

            });
        })(jQuery);
    </script>

    <script>
        (function($) {
            $("#home_area_form").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#home_area_form").serialize(),
                    success: function(response) {
                        if (response.status == 'NOK') {
                            $("#err_home_area").html(response.errors.home_area ? response.errors
                                .home_area : '');
                            return;
                        } else if (response.status == 'OK') {
                            $("#err_home_area").html('');
                            //Show previous button
                            $('.pre').show();
                            //Find the element that's currently showing
                            $showing = $('.first.visible').first();
                            //Find the next element
                            $next = $showing.next();
                            //Change which div is showing
                            $showing.removeClass("visible").hide();
                            $next.addClass("visible").show();
                            //If there's no more elements, hide the NEXT button
                            if (!$next.next().length) {
                                $(this).hide();
                            }
                        }

                    }
                });

            });
        })(jQuery);
    </script>
    <script>
        (function($) {
            $("#start_project_form").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "post",
                    data: $("#start_project_form").serialize(),
                    success: function(response) {
                        if (response.status == 'OK') {
                            window.location = response.url;
                        }
                    }
                });

            });
        })(jQuery);
    </script>

    <script>
        function test(data) {
            var susbcription_id = data;
            var subscription_ammount = $("#main_amount" + susbcription_id).val();
            var addons = $("#addon_ids" + susbcription_id).val();
            $("#subscription").val(susbcription_id);
            $("#subscription_ammount").val(subscription_ammount);
            $("#addons").val(addons);
        }
    </script>
    <script>
        function test2(data, data1) {
            var addon_amount = data;
            var amount_id = data1;
            var amount = $("#main_amount" + amount_id).val();
            //alert(amount);
            //if($('input[name=thename]').is(":checked")){
            if ($('input:checkbox[name="addons' + data1 + '"]').prop("checked")) {

                //alert('checked');
                var total = (parseInt(addon_amount) + parseInt(amount));
                $("#amount_" + amount_id).text("$" + total);
                $("#main_amount" + amount_id).val(total);
            } else {
                //alert('Unchecked');
                var total = (parseInt(amount) - parseInt(addon_amount));
                $("#amount_" + amount_id).text("$" + total);
                $("#main_amount" + amount_id).val(total);
            }
        }
        $(document).ready(function() {
            <?php
		$p=1;
		foreach($subscriptions as $subscription){
		?>
            $('input[name="addons<?php echo $p; ?>"]').click(function() {
                var amount = $("#main_amount<?php echo $subscription->id; ?>").val();
                var yy = $("#addon_ids<?php echo $subscription->id; ?>").val();
                var addons = $(this).val();
                addons = addons.split(',');
                var addon_id = addons[0];
                var addon_amount = addons[1];
                if ($(this).is(":checked")) {
                    //alert("Checkbox is checked.");
                    var total = (parseInt(addon_amount) + parseInt(amount));
                    $("#amount_<?php echo $p; ?>").text(total + " AED");
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
                    $("#amount_<?php echo $p; ?>").text(total + " AED");
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
        });
    </script>

    <script>
        $(".next01").click(function() {
            $(".login_type").val('login');
        });
        $(".pre01").click(function() {
            $(".login_type").val('signup');
        });

        function showPackages() {
            $("#myModal").modal('hide');
            $("#packages").modal('show');
        }

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

        $("#go_ahead_with_packages").click(function() {
            // var chk_addon = $("input[name='subscription']:checked").val();
            var chk_addon = $("input[name='subscription']:checked").attr("data-amount");
            // console.log(chk_addon);
            if (chk_addon == undefined || chk_addon == "" || chk_addon == null) {
                alert('Please choose an option to proceed');
            } else {
                if (chk_addon >= 1) {
                    window.location.href = "{{ route('frontend.detail.form') }}";
                } else {
                    window.location.href = "{{ route('frontend.product.index') }}";
                }
            }
        });

        //modal show
        $('#packages').on("shown.bs.modal", function() {
            $("body").addClass("modal-open");
        });

        //modal hide
        $('#packages').on("hide.bs.modal", function() {
            $("body").addClass("modal-open");
        });
    </script>
@endsection
