@extends('layouts.frontend')
@section('content')
<?php 
use App\Models\QuizAnswer;
?>
<!--<script type="text/javascript">
  (function(i,n,t,e,r,a,c) { i['InteractPromotionObject']=r; i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date(); a=n.createElement(t),
  c=n.getElementsByTagName(t)[0]; a.async=1; a.src=e; c.parentNode.insertBefore(a,c)
  })(window, document, 'script', 'https://i.tryinteract.com/promotions/init.js', 'i_promo');
  i_promo('init', 'h2zX9jB_4');
</script>-->
<section class="banner">
 <img src="{{Request::root()}}/public/images/banner.jpg">
        <div class="banner_content">
            <div class="container">
                <div class="row">
                    <div class="content">
                        <h1>I need to furnish my new house on a realistic budget.</h1>
                        <?php
						$user=auth()->user();
						if(!empty($user) ){
						if($user->role_id==2){
						?>
                        <button class="btn btn-secondary brown_btn" type="button" data-toggle="modal" data-target="#myModal">
                            Find Your Style
                        </button>
						<?php
						}
						else{
						?>
						<a class="btn btn-secondary brown_btn" type="button" href="{{route('frontend.login')}}">
                            Find Your Style
                        </a>
						<?php
						}
						}
						else{
						?>
						<a class="btn btn-secondary brown_btn" type="button" href="{{route('frontend.login')}}">
                            Find Your Style
                        </a>
						<?php
						}
						?>
						
						
     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog interior_box">
    
      <!-- Modal content-->
      <div class="modal-content">
	  <div class="card calulator-card first visible">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> What's your interior design style?</h4>
        </div>
        <div class="modal-body">
          <div class="interior_img">		  
		  <img src="{{Request::root()}}/public/img/interior_banner.jpg">
		  </div>
		  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
		  <button class="next1 bt_score">Take the Quiz</button>
        </div>
		
        </div>
		
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_questions[0]['title']}}</h4>
        </div>
		
		<div class="modal-body">
		<form action="{{route('frontend.preferred.bedroom')}}"  method="post" id="preferred_bedroom_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers = QuizAnswer::where('status',1)->where('question_id',$quiz_questions[0]['id'])->get();
	        ?>
	        @if(count($quiz_answers)>0)
	        @foreach($quiz_answers as $quiz_answer)
			  <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="{{$quiz_answer->id}}" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="{{$quiz_answer->getQuizAnswerImage()}}" alt="Quiz Answer"></div>
						<span class="bg-azure">{{$quiz_answer->title}}</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
		   @endforeach
		   @endif
			  
			</ul>
			<span class="text-danger" role="alert" id="err_preferred_bedroom"></span>
		  </div>
		  
            <button type="submit" class="next bt_score1">Next</button>
			</form>
			<button class="pre bt_score1">Previous</button>
			
		</div>
		
		
		 </div>
		
		
		<div class="card calulator-card first">
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_questions[1]['title']}}</h4>
        </div>
		
		<div class="modal-body">
		<form action="{{route('frontend.diningroom')}}"  method="post" id="diningroom_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers1 = QuizAnswer::where('status',1)->where('question_id',$quiz_questions[1]['id'])->get();
	        ?>
	        @if(count($quiz_answers1)>0)
	        @foreach($quiz_answers1 as $quiz_answer1)
			  <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="{{$quiz_answer1->id}}" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="{{$quiz_answer1->getQuizAnswerImage()}}" alt="Quiz Answer"></div>
						<span class="bg-azure">{{$quiz_answer1->title}}</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
		   @endforeach
		   @endif
			  
			</ul>
		  <span class="text-danger" role="alert" id="err_diningroom"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
			</form>
			<button class="pre bt_score1">Previous</button>
		</div>
		
		
		 </div>
		
		
			 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_questions[2]['title']}}</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.coffee.table')}}"  method="post" id="coffee_table_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers2 = QuizAnswer::where('status',1)->where('question_id',$quiz_questions[2]['id'])->get();
	        ?>
	        @if(count($quiz_answers2)>0)
	        @foreach($quiz_answers2 as $quiz_answer2)
			  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="{{$quiz_answer2->id}}" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="{{$quiz_answer2->getQuizAnswerImage()}}" alt="Quiz Answer"></div>
						<span class="bg-azure">{{$quiz_answer2->title}}</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
		   @endforeach
		   @endif
			   
			</ul>
			<span class="text-danger" role="alert" id="err_coffee_table"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_questions[3]['title']}}</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.home.feel')}}"  method="post" id="home_feel_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers3 = QuizAnswer::where('status',1)->where('question_id',$quiz_questions[3]['id'])->get();
	        ?>
	        @if(count($quiz_answers3)>0)
	        @foreach($quiz_answers3 as $quiz_answer3)
			  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="{{$quiz_answer3->id}}" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="{{$quiz_answer3->getQuizAnswerImage()}}" alt="Quiz Answer"></div>
						<span class="bg-azure">{{$quiz_answer3->title}}</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
		   @endforeach
		   @endif

			</ul>
			<span class="text-danger" role="alert" id="err_home_feel"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_questions[4]['title']}}</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.home.area')}}"  method="post" id="home_area_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers4 = QuizAnswer::where('status',1)->where('question_id',$quiz_questions[4]['id'])->get();
	        ?>
	        @if(count($quiz_answers4)>0)
	        @foreach($quiz_answers4 as $quiz_answer4)
			  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="{{$quiz_answer4->id}}" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="{{$quiz_answer4->getQuizAnswerImage()}}" alt="Quiz Answer"></div>
						<span class="bg-azure">{{$quiz_answer4->title}}</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
		   @endforeach
		   @endif

			</ul>
			<span class="text-danger" role="alert" id="err_home_area"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		<div class="card calulator-card first">        
		<div class="modal-header">          
		<button type="button" class="close" data-dismiss="modal">×</button>          
		<h4 class="modal-title"> What's your interior design style?</h4>
		</div>        
		<div class="modal-body">         
		<div class="interior_img">		  		  
		<img src="http://learning.neuronsit.in/style-home/public/img/inerior_banner1.jpg">		  
		</div>		  
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>		  
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>	
		
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>	
		
		<div class="style_social_link">
		 <h3>Share Your Results</h3>
		  <span><a href="#"><i class="fab fa-facebook"></i></a></span>
		  <span><a href="#"><i class="fab fa-twitter"></i></a></span>
		</div>
		<form action="{{route('frontend.start.project')}}"  method="post" id="start_project_form" novalidate="novalidate">
		@csrf
		<button type="submit" class="start_project">Are you ready to find a designer and start this project?</a>
		</form>
		</div>		        
		</div>
		
		
      </div>
      
    </div>
  </div>


						
                    </div>
                </div>
            </div>
        </div>
    </section>

  




    <section class="whatWeDo">
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
                            <img src="{{Request::root()}}/public/images/whatWeDo1.jpg" alt="style-A-home">
                            <div class="heading">
                                Living Room
                            </div>
                        </li>
                        <li>
                            <img src="{{Request::root()}}/public/images/whatWeDo2.jpg" alt="style-A-home">
                            <div class="heading">
                                Dining Rooms
                            </div>
                        </li>
                        <li>
                            <img src="{{Request::root()}}/public/images/whatWeDo3.jpg" alt="style-A-home">
                            <div class="heading">
                                Bedrooms
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="simplerTalks">
        <div class="simpler_banner">
            <div class="container">
                <div class="row">
                    <h2>Even Simpler Than You Think</h2>
                    <ul>
                        <li>
                            <div class="talks_cont">
                                <img src="{{Request::root()}}/public/images/simpler_icon1.png" alt="style-A-home">
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
                                <img src="{{Request::root()}}/public/images/simpler_icon2.png" alt="style-A-home">
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
                                <img src="{{Request::root()}}/public/images/simpler_icon3.png" alt="style-A-home">
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
    </section>

    <section class="my_style">
        <div class="container">
            <div class="style_cont">
                <div class="row">
                    <div class="img_style">
                        <img src="{{Request::root()}}/public/images/mystyle.jpg" alt="style-A-home">
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
            </div>
            <div class="session_cont mt-5 pt-4">
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="box">
                            <div class="liveSession">
                                <label class="mb-0">$19</label>
                            </div>
                            <h3>Consult me </h3>
                            <p>20 Minute Consulation Call with </p>
                            <p>Are you not sure if your space needs a change or do you just need an expert opinion? Just have a call with one of our brilliant designers to get you started</p>
                           
                            <button class="mt-3 brown_btn d-block">Get Started</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
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
                    </div>
                </div>
            </div>
      

	  </div>
    </section>

    <section class="testimonial">
        <div class="testimonial_img">
            <div class="container">
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                        <div class="carousel-inner">
                            @if(count($testimonials)>0)
                            @php
                            $k=0;
                            @endphp
                            @foreach($testimonials as $testimonial)
                            <?php
                            if($k==0){
                                $aa="active";
                            }
                            else{
                                $aa = "";
                            }
                            ?>
                            <div class="carousel-item {{$aa}}">
                                <div class="testimonialBox">
                                    <h3>{{$testimonial->title}}</h3>
                                    <label>{{$testimonial->position}}</label>
                                    @if($testimonial->star)
                                    <ul>
                                        
                                        @for ($i = 1; $i <= $testimonial->star; $i++)
                                        <li><i class="fas fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    @endif
                                    {!!$testimonial->description!!}
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
					 <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon1.png" alt=""></a></li>
					  <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon2.png" alt=""></a></li>
					   <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon3.png" alt=""></a></li>
					    <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon4.png" alt=""></a></li>
						 <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon5.png" alt=""></a></li>
						  <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon6.png" alt=""></a></li>
					       <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon7.png" alt=""></a></li>
					        <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon8.png" alt=""></a></li>
					</ul>
				   
				   </div>
                </div>
            </div>
        </div>
    </section>-->
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
	
(function($) {
    $("#preferred_bedroom_form").submit(function(e){
		e.preventDefault();
		
		//$("#btn").text('Please wait...');
		//$("#btn").prop('disabled', true);
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#preferred_bedroom_form").serialize(),
			  success: function(response){
				//$("#btn").text('Submit');
				//$("#btn").prop('disabled', false);
				 if(response.status=='NOK')
				 {
					$("#err_preferred_bedroom").html(response.errors.preferred_bedroom?response.errors.preferred_bedroom:'');
					
					return;
				 }
				 else if(response.status=='OK'){
					 $("#err_preferred_bedroom").html('');
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
    $("#diningroom_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#diningroom_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_diningroom").html(response.errors.diningroom?response.errors.diningroom:'');
					return;
				 }
				 else if(response.status=='OK'){
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
    $("#coffee_table_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#coffee_table_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_coffee_table").html(response.errors.coffee_table?response.errors.coffee_table:'');
					return;
				 }
				 else if(response.status=='OK'){
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
    $("#home_feel_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#home_feel_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_home_feel").html(response.errors.home_feel?response.errors.home_feel:'');
					return;
				 }
				 else if(response.status=='OK'){
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
    $("#home_area_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#home_area_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_home_area").html(response.errors.home_area?response.errors.home_area:'');
					return;
				 }
				 else if(response.status=='OK'){
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
    $("#start_project_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#start_project_form").serialize(),
			  success: function(response){
				 if(response.status=='OK')
				 {
					window.location = response.url;
				 }
			  }
			});
		 
	});
  })(jQuery);
</script>
@endsection
