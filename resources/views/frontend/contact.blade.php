@extends('layouts.frontend')
@section('content')
    <style>
	.thankyou{display:none;text-align: center;vertical-align: middle;line-height: 90px;font-size: 25px;color: #1c943b;}
	.error{
	    color:#ff0000;
	}
	</style>
	<!--<section class="banner_inner">
        <div class="bannerParallax_inner privacy">        </div>
    </section>-->

    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">{{$page_title->title}}</h4>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="box_contact">
                        <label>Contact Us</label>
                       {{-- <p>Beyond more stoic this along this sed ipsum flusterdys impressive man dolor farcrud open
                            after wasteful teling.</p>
                        <div class="line_cont">
                            <div class="img_size mr-3">
                                <img src="{{Request::root()}}/public/images/contact_icon1.png" alt="style-A-home">
                            </div>
                            <div class="paras">
                                <span>123-456-7890</span>
                                <span>
                                    <p>Mon - Friday:</p> 9.00am to 6.00pm
                                </span>
                            </div>
                        </div>
                        <div class="line_cont">
                            <div class="img_size mr-3">
                                <img src="{{Request::root()}}/public/images/contact_icon2.png" alt="style-A-home">
                            </div>
                            <div class="paras">
                                <span style="width: 80%;">Beyond more stoic this along goodness this sed ipsum mongos
                                </span>
                            </div>
                        </div>--}}
                        <div class="line_cont noLine">
                            <div class="img_size mr-3">
                                <img src="{{Request::root()}}/public/images/contact_icon3.png" alt="style-A-home">
                            </div>
                            <div class="paras">
                                <span><a href="mailto:{{$setting->contact_email}}">{{$setting->contact_email}}</a></span>
                            </div>
                        </div>
                        <div class="contact_social">
                            <label>Follow us</label>
                            <div class="paras">
                                <ul>
                                    <li><a target="_blank" href="{{$setting->facebook_page_link}}"> <i class="fab fa-facebook-f"></i> </a></li>
                                    {{--<li><a target="_blank" href="{{$setting->twitter_page_link}}"> <i class="fab fa-twitter"></i> </a></li>--}}
                                    <li><a target="_blank" href="{{$setting->instagram_page_link}}"> <i class="fab fa-instagram"></i> </a></li>
                                    <li><a target="_blank" href="{{$setting->pinterest_page_link}}"> <i class="fab fa-pinterest-square"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    @if(session()->has('success'))
					<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
					@endif
					@if(session()->has('error'))
					<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
					@endif
                    <div class="form_contact">
                        <label>Do you need our help  for your next home makeover? Get in touch!</label>
                        <form action="{{route('frontend.contactUs.post')}}"  method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
								<span class="help-block is-invalid error">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email Address" required>
								<span class="help-block is-invalid error">{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject">
								<span class="help-block is-invalid">{{$errors->first('subject')}}</span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="3" placeholder="Message"></textarea>
								<span class="help-block is-invalid">{{$errors->first('message')}}</span>
                            </div>
                            <input type="submit" id="btn" value="SEND MESSAGE" class="btn btn-secondary pt-2 pb-2">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @extends('layouts.modal')
    </section>

    <div class="flashBannerCont">
        <div class="container">
            <div class="row">
                <div class="flashBanner">
                    <h2>
                        Learn more about our Design packages
                    </h2>
                    <button class="btn btn-secondary brown_btn pl-5 pr-5" id="contactreadmore">Read more</button>
                    <p id="readmore_contact" style="display: none;" class="text-white"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non nobis, ipsa repellendus repellat quam perferendis architecto iure tempore. Rem quos vel ratione porro aut tenetur. Vero atque est rem reiciendis.</p>
                </div>
            </div>
        </div>
    </div
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	$("#contact_us_form").submit(function(e){
		e.preventDefault();
		$("#btn").text('Please wait...');
		$("#btn").prop('disabled', true);
		var url=$(this).attr("action");

		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#contact_us_form").serialize(),
			  success: function(response){
				$("#btn").text('SEND MESSAGE');
				$("#btn").prop('disabled', false);
				 if(response.status=='NOK')
				 {
					$("#err_name").html(response.errors.name?response.errors.name:'');
					$("#err_email").html(response.errors.email?response.errors.email:'');
					$("#err_subject").html(response.errors.subject?response.errors.subject:'');
					$("#err_message").html(response.errors.message?response.errors.message:'');
					return ;
				 }
				 else
				 {
					$("#contact_us_form").css("display","none");
					$(".thankyou").show();
					setTimeout(function() {
						location.reload();
					}, 2000);
				}
			  }
			});

	});

    $("#contactreadmore").click(function(){
        $("#readmore_contact").toggle();
    });
	</script>
@endsection
