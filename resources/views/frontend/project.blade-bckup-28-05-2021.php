@extends('layouts.frontend')
@section('content')
<?php 
use App\Models\QuizAnswer;
?>
<section class="banner_inner">
<div class="bannerParallax_inner"></div>
</section>
<section class="designer_cont project_main">
<button class="create_button btn btn-secondary brown_btn mt-5 mb-3 mx-auto d-block pl-5 pr-5 pt-3 pb-3" data-toggle="modal" data-target="#myModal">Create New Project</button>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
@endif
	<h4>Recent Project </h4>
	<div class="container">
	<div class="row">
	<div class="tabs_cont">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation"><a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all"  role="tab" aria-controls="pills-all" aria-selected="true">All</a></li>
	<li class="nav-item" role="presentation"><a class="nav-link" id="pills-living-tab" data-toggle="pill" href="#pills-living" role="tab" aria-controls="pills-living" aria-selected="false">Under Progress</a></li>
	<li class="nav-item" role="presentation"><a class="nav-link" id="pills-kitchen-tab" data-toggle="pill" href="#pills-kitchen" role="tab" aria-controls="pills-kitchen" aria-selected="false">Completed </a></li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	    <div class="tab-pane fade show active" id="pills-all" role="tabpanel"  aria-labelledby="pills-all-tab">
	        <ul class="project_listing">
    @if(count($projects)>0)
    @foreach($projects as $project)
	  <li>
      <div class="project_details">
       <h4>{{$project->title}}</h4>
       <span>{{$project->first_name}} {{$project->last_name}}</span>  
      </div>
      @if($project->room_picture)
      <?php
      $x = explode (",", $project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      <a class="view_project" href="{{route('frontend.designer.chat',['model'=>$project->userId])}}">chat</a>
      </li>
      @endforeach
      @endif
     
 </ul>
                       
</div>                        

<div class="tab-pane fade" id="pills-living" role="tabpanel" aria-labelledby="pills-living-tab">                            
 <ul class="project_listing">
@if(count($projects)>0)
    @foreach($projects as $project)
	  <li>
      <div class="project_details">
       <h4>{{$project->title}}</h4>
       <span>{{$project->first_name}} {{$project->last_name}}</span>  
      </div>
      @if($project->room_picture)
      <?php
      $x = explode (",", $project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      <a class="view_project" href="{{route('frontend.designer.chat',['model'=>$project->userId])}}">chat</a>
      </li>
      @endforeach
      @endif
 
 </ul>
                                 
</div>                        

<div class="tab-pane fade" id="pills-kitchen" role="tabpanel"                            aria-labelledby="pills-kitchen-tab">                           
  <ul class="project_listing">
  @if(count($complete_projects)>0)
    @foreach($complete_projects as $complete_project)
	  <li>
      <div class="project_details">
       <h4>{{$complete_project->title}}</h4>
       <span>{{$complete_project->first_name}} {{$project->last_name}}</span>  
      </div>
      @if($complete_project->room_picture)
      <?php
      $x = explode (",", $complete_project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      <a class="view_project" href="{{route('frontend.designer.chat',['model'=>$complete_project->userId])}}">chat</a>
      </li>
      @endforeach
      @endif


 </ul>     
 </div>                        
 </div> 
 
       

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




 </section>    
 
 
 
 
 <div class="flashBannerCont">        <div class="container">            <div class="row">                <div class="flashBanner">                    <h2>                        Learn more about our Design packages                    </h2>                    <button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>                </div>            </div>        </div>    </div>	
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