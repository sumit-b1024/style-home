<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicons -->
	<link href="{{Request::root()}}/public/images/footerLogo.jpg" rel="icon">
	<link href="{{Request::root()}}/public/images/footerLogo.jpg}" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/290940a338.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">
	 <link rel="stylesheet" href="{{URL::asset('public/css/all.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Style-Home</title>
		<script>
$(document).ready(function() {

    /*$(".next").click(function() {
        $('.pre').show();
        $showing = $('.first.visible').first();
        $next = $showing.next();
        $showing.removeClass("visible").hide();
        $next.addClass("visible").show();
        if (!$next.next().length) {
            $(this).hide();
        }
    });*/
    $(".next1").click(function() {
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
    });

    $(".pre").click(function() {
        $('.next').show();

        $showing = $('.first.visible').first();
        $next = $showing.prev();
        $showing.removeClass("visible").hide();
        $next.addClass("visible").show();

        if (!$next.prev().length) {
            $(this).hide();
        }
    });

});

</script>

</head>
<body>
<!-- ======= Top Bar ======= -->

	<header>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg w-100">
                   <a class="navbar-brand" href="{{route('frontend.home')}}"> 
					<img src="{{Request::root()}}/public/images/logo.png" alt="style-A-home">
					</a>
				
					
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse top_right" id="navbarSupportedContent">
                        

						<ul class="top_menu">
                            <li class="nav-item active"><a href="{{route('frontend.how.it.work')}}">Pricing</a></li>
                            <li class="nav-item"><a href="#" class="drop_down">Explore <span class="down_arrow"><i class="fas fa-chevron-down"></i></span></a>
							 <ul class="sub_menu">
							 <li><a href="{{route('frontend.explore')}}">Living Rooms</a></li>
							 <li><a href="{{route('frontend.explore')}}">Dining Rooms</a></li>
							 <li><a href="{{route('frontend.explore')}}">Bedrooms</a></li>
							 <li><a href="{{route('frontend.explore')}}">Nurseries</a></li>
							 <li><a href="{{route('frontend.explore')}}">Offices</a></li>
							 </ul>
							
							</li>
                            <li class="nav-item">
                                <a href="{{route('frontend.career')}}">Career</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('frontend.project')}}">Find your Style</a>
                            </li>
                        </ul>
                        <?php
						$user=auth()->user();
						if(!empty($user) ){
						if($user->role_id==2){
						?>
						<a href="{{route('admin.customer.logout')}}" class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Logout</a>
						<?php
						}
						else{
						?>
						<ul class="my-2 my-lg-0 account_bt">
                            <a href="{{route('frontend.login')}}" class="btn btn-outline-success my-2 my-sm-0 login_btn">Login</a>
                            <a href="{{route('frontend.signup')}}" class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Sign Up</a>
                        </ul>
						<?php
						}
						}
						else{
						?>
                        <ul class="my-2 my-lg-0 account_bt">
                            <a href="{{route('frontend.login')}}" class="btn btn-outline-success my-2 my-sm-0 login_btn">Login</a>
                            <a href="{{route('frontend.signup')}}" class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Sign Up</a>
                        </ul>
						<?php
						}
						?>
                        
                    </div>
				
                </nav>
            </div>
        </div>
    </header>
		<div id="entry-content">
			@yield('content') 
		</div>
	<!-- ======= Footer ======= -->
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img src="{{Request::root()}}/public/images/footerLogo.png" alt="style-A-home">
                    <!---<p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    </p>-->
                    <ul class="social">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-4">
                    <ul class="company">
                        <label>Company</label>
                        <li><a href="{{route('frontend.contact')}}">Contact us </a></li>
                        
                        <li><a href="{{route('frontend.faq')}}">FAQ </a></li>
                        <li><a href="{{route('frontend.privacy.policy')}}">Privacy Policy </a></li>
                        <li><a href="{{route('frontend.term.condition')}}">Terms and Conditions </a></li>
                        <li><a href="{{route('frontend.career')}}">Careers </a></li>
                        <!--<li><a href="{{route('frontend.design.career')}}">Design Careers </a></li>
                        <li><a href="{{route('frontend.our.book')}}">Our Book </a></li>-->
                    </ul>
					   </div>
					   
					 <!-- <div class="col-lg-2 col-md-6 col-sm-4">
                    <ul class="company">
					
					
                        <label>Explore</label>
                        <li><a href="{{route('frontend.financing')}}">Financing </a></li>
                        <li><a href="{{route('frontend.stories')}}">Stories </a></li>
                        <li><a href="{{route('frontend.gift.card')}}">Gift Cards </a></li>
                        <li><a href="{{route('frontend.refer.earn')}}">Refer & Earn </a></li>
                        <li><a href="{{route('frontend.help.center')}}">Help Center </a></li>
                        <li><a href="{{route('frontend.current.promotion')}}">Current Promotions </a></li>
                        <li><a href="{{route('frontend.review')}}">Reviews </a></li>
                        
                    </ul></div>-->
					
					<div class="col-lg-3 col-md-6 col-sm-4">
                    <ul class="company">
                        <label>Contact us</label>
                        <li><a href="tel:{{$setting->contact_number}}">call: {{$setting->contact_number}} </a></li>
                        <!--<li><a href="#">email </a></li>-->
                        <li><a href="mailto:{{$setting->contact_email}}">email: {{$setting->contact_email}} </a></li>
                        <li><a href="#">Address: {{$setting->office_address}} </a></li>
                    </ul>
             </div>
            </div>
        </div>
    </footer>
    <div class="footerEnd">
        <div class="container">
            <div class="row">
                <p>© 2021 , All Rights Reserved.</p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $needle='chat';
    if(strpos($actual_link, $needle ) == false){
    ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <?php
    }
    ?>
</body>

</html>
