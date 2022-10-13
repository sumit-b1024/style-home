@extends('layouts.frontend')
@section('content')
    <?php
    use App\Models\QuizAnswer;
    use App\Models\SubscriptionAddon;
    use App\Models\QuizResult;
    ?>
    <section class="banner_inner">
        <div class="bannerParallax_inner"><img src="{{ asset("public/uploads/banner/{$banner->path}") }}"></div>
    </section>
    <section class="designer_cont project_main">
        @if (count($quiz_questions) > 0)
            <button class="create_button btn btn-secondary brown_btn mt-5 mb-3 mx-auto d-block pl-5 pr-5 pt-3 pb-3"
                data-toggle="modal" data-target="#myModal">Create New Project</button>
        @else
            <button class="create_button btn btn-secondary brown_btn mt-5 mb-3 mx-auto d-block pl-5 pr-5 pt-3 pb-3"
                data-toggle="modal" data-target="#myModal2">Create New Project</button>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        @endif
        <h4>Recent Projects </h4>
        <div class="container">
            <div class="row">
                <div class="tabs_cont">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" id="pills-all-tab"
                                data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all"
                                aria-selected="true">All</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-living-tab"
                                data-toggle="pill" href="#pills-living" role="tab" aria-controls="pills-living"
                                aria-selected="false">Under Progress</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-kitchen-tab"
                                data-toggle="pill" href="#pills-kitchen" role="tab" aria-controls="pills-kitchen"
                                aria-selected="false">Completed </a></li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                            aria-labelledby="pills-all-tab">
                            <ul class="project_listing">
                                @if (count($allprojects) > 0)
                                    @foreach ($allprojects as $project)
                                        <li>
                                            <div class="project_details">
                                                <h4>{{ $project->title }}</h4>
                                                <a target="_blank"
                                                    href="{{ route('frontend.designer.bio', ['model' => $project->userId]) }}"><span>{{ $project->first_name }}
                                                        {{ $project->last_name }}</span></a>
                                            </div>
                                            @if ($project->room_picture)
                                                <?php
                                                $x = explode(',', $project->room_picture);
                                                ?>
                                                <div class="proj_img"><img src="{{ asset("public/uploads/{$x[0]}") }}"
                                                        alt=""></div>
                                            @endif
                                            <div class="project_view_bt">
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.view', ['model' => $project->id]) }}">View
                                                    Project</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.updates', ['model' => $project->id]) }}">View
                                                    Updates</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.designer.chat', ['model' => $project->id]) }}">chat</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>

                        </div>

                        <div class="tab-pane fade" id="pills-living" role="tabpanel" aria-labelledby="pills-living-tab">
                            <ul class="project_listing">
                                @if (count($projects) > 0)
                                    @foreach ($projects as $project)
                                        <li>
                                            <div class="project_details">
                                                <h4>{{ $project->title }}</h4>
                                                <a target="_blank"
                                                    href="{{ route('frontend.designer.bio', ['model' => $project->userId]) }}"><span>{{ $project->first_name }}
                                                        {{ $project->last_name }}</span></a>
                                            </div>
                                            @if ($project->room_picture)
                                                <?php
                                                $x = explode(',', $project->room_picture);
                                                ?>
                                                <div class="proj_img"><img src="{{ asset("public/uploads/{$x[0]}") }}"
                                                        alt=""></div>
                                            @endif
                                            <div class="project_view_bt">
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.view', ['model' => $project->id]) }}">View
                                                    Project</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.updates', ['model' => $project->id]) }}">View
                                                    Updates</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.designer.chat', ['model' => $project->id]) }}">chat</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>

                        </div>

                        <div class="tab-pane fade" id="pills-kitchen" role="tabpanel" aria-labelledby="pills-kitchen-tab">
                            <ul class="project_listing">
                                @if (count($complete_projects) > 0)
                                    @foreach ($complete_projects as $complete_project)
                                        <li>
                                            <div class="project_details">
                                                <h4>{{ $complete_project->title }}</h4>
                                                <a target="_blank"
                                                    href="{{ route('frontend.designer.bio', ['model' => $complete_project->userId]) }}"><span>{{ $complete_project->first_name }}
                                                        {{ $project->last_name }}</span> </a>
                                            </div>
                                            @if ($complete_project->room_picture)
                                                <?php
                                                $x = explode(',', $complete_project->room_picture);
                                                ?>
                                                <div class="proj_img"><img src="{{ asset("public/uploads/{$x[0]}") }}"
                                                        alt=""></div>
                                            @endif
                                            <div class="project_view_bt">
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.view', ['model' => $project->id]) }}">View
                                                    Project</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.project.updates', ['model' => $project->id]) }}">View
                                                    Updates</a>
                                                <a class="view_project"
                                                    href="{{ route('frontend.designer.chat', ['model' => $complete_project->id]) }}">chat</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                    </div>

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
                                            {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since the
                                                1500s,</p> --}}
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
                                            <input type="hidden" name="login_type" class="login_type" value="signup">
                                            <div class="style_list customer_info_form">
                                                <div class="form-group">
                                                    <label for="company"
                                                        class=" form-control-label">{{ __('Name') }}</label>
                                                    <input type="text"
                                                        value="{{ old('name', optional(@$model)->name) }}" name="name"
                                                        id="name" placeholder="Enter Name" class="form-control">
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
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Customer Info</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="login_type" class="login_type" value="signup">
                                            <div class="style_list customer_info_form">
                                                <div class="form-group">
                                                    <label for="company"
                                                        class=" form-control-label">{{ __('Name') }}</label>
                                                    <input type="text"
                                                        value="{{ old('name', optional(@$model)->name) }}" name="name"
                                                        id="name" placeholder="Enter Name" class="form-control">
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
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Customer Login</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="login_type" class="login_type" value="signup">
                                            <div class="style_list customer_info_form">
                                                <div class="form-group">
                                                    <label for="company"
                                                        class=" form-control-label">{{ __('Username or Email') }}</label>
                                                    <input type="text"
                                                        value="{{ old('username', optional(@$model)->username) }}"
                                                        name="username" id="username" placeholder="Enter Username"
                                                        class="form-control">
                                                    <span class="text-danger" role="alert" id="err_username"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="company"
                                                        class=" form-control-label">{{ __('Password') }}</label>
                                                    <input type="password"
                                                        value="{{ old('password', optional(@$model)->password) }}"
                                                        id="password" name="password" placeholder="Enter Password"
                                                        class="form-control">
                                                    <span class="text-danger" role="alert" id="err_password"></span>
                                                </div>
                                                <span class="text-danger" role="alert" id="err_account"></span>
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
                                    <h4 class="modal-title"> What's your interior design style? <span id="answer_category"
                                            style="color:#56e454"></span></h4>
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
                                    {{-- <a href="{{route('frontend.detail.form')}}" class="start_project">Are you ready to find a designer and start this project?</a> --}}
                                    <button class="btn btn-secondary brown_btn" type="button" onclick="showPackages()">
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
            </div>

            <div class="modal fade" id="packages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                                        <div class="row" style="display: flex;align-items: center;justify-content: center;">
                                            @if (count($subscriptions) > 0)
                                                @foreach ($subscriptions as $subscription)
                                                    <div class="col-sm-6">
                                                        @if ($subscription->id == $customer_temp5->subscription)
                                                            <input type="hidden" name="addon_ids{{ $subscription->id }}"
                                                                value="{{ $customer_temp5->addons ? $customer_temp5->addons : '' }}"
                                                                id="addon_ids{{ $subscription->id }}">
                                                        @else
                                                            <input type="hidden" name="addon_ids{{ $subscription->id }}"
                                                                value="" id="addon_ids{{ $subscription->id }}">
                                                        @endif
                                                        <label class="checkcontainer2">
                                                            <input name="subscription" type="radio"
                                                                data-amount="{{ $subscription->fee_amount }}"
                                                                value="{{ $subscription->id }}" class="colorinput-input"
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
                                                                        <span>20 min consultation call in each package</span>
                                                                        {{-- <span class="size">Size :
                                                                            {{ $subscription->size }}</span> --}}


                                                                        {{-- <button type="button" class="addons_bt"
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


    </section>




    {{-- <div class="flashBannerCont">        <div class="container">            <div class="row">                <div class="flashBanner"><button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>                </div>            </div>        </div>    </div> --}}
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
