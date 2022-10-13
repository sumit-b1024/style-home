@extends('layouts.frontend')@section('content')
<!--<section class="banner_inner">
<div class="bannerParallax_inner privacy">
 </div>
</section>-->
<?php
use App\Models\SubscriptionAddon;
use App\Models\QuizAnswer;
?>
<section class="designer_cont project_main tittle_no_banner">
<!--Modal-->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog interior_box">
    <form action="{{route('frontend.preferred.bedroom')}}"  method="post" id="preferred_bedroom_form" novalidate="novalidate">
		@csrf
	<input type="hidden" name="subscription" id="subscription">
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
		  {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p> --}}
		  <a class="next1 bt_score">Take the Quiz</a>
        </div>

        </div>


		@if(count($quiz_questions)>0)
		@php
		$i=2;
		@endphp
		@foreach($quiz_questions as $quiz_question)
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{$quiz_question->title}}</h4>
        </div>

		<div class="modal-body">
		<input name="questions[]"  type="hidden" value="{{$quiz_question->id}}" class="colorinput-input" required>
		  <div class="style_list">
		    <ul>
	        <?php
	        $quiz_answers = QuizAnswer::where('status',1)->where('question_id',$quiz_question->id)->get();
	        ?>
	        @if(count($quiz_answers)>0)
	        @foreach($quiz_answers as $quiz_answer)
			  <li>
			    <label class="checkcontainer">

					<input name="answers_{{$i}}[]" id="preferred_bedroom_{{$i}}" type="radio" value="{{$quiz_answer->id}}" class="colorinput-input" required>
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
			<span class="text-danger" role="alert" id="err_preferred_bedroom_{{$i}}"></span>
		  </div>
		  <?php
		  $user=auth()->user();
		  if(!empty($user) ){
			  if($user->role_id==2){
				  if((count($quiz_questions)+1)==$i){
					 ?>
					 <button type="submit" class="next bt_score1" style="display:block;width: 10%;">Next</button>
					<?php
				  }
				  else{
					  ?>
					<a class="next{{$i}} bt_score1" style="display:block;width: 10%;">Next</a>
					  <?php
				  }
			  }
			  else{
				  ?>
				  <a class="next{{$i}} bt_score1" style="display:block;width: 10%;">Next</a>
				  <?php
			  }
		  }
		  else{
			  ?>
			  <a class="next{{$i}} bt_score1" style="display:block;width: 10%;">Next</a>
			  <?php
		  }
		  ?>
            <!--<a class="next{{$i}} bt_score1" style="display:block;width: 10%;">Next</a>-->

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

		  <div class="style_list customer_info_form">
			   <div class="form-group">
			<label for="company" class=" form-control-label">{{__('Name')}}</label>
			<input type="text" value="{{old('name',optional(@$model)->name)}}" name="name" id="name" placeholder="Enter Name" class="form-control">
			<span class="text-danger" role="alert" id="err_name"></span>
		</div>
			<div class="form-group">
			<label for="company" class=" form-control-label">{{__('Email')}}</label>
			<input type="text" value="{{old('email',optional(@$model)->email)}}" id="email" name="email" placeholder="Enter Email" class="form-control">
			<span class="text-danger" role="alert" id="err_email"></span>
		</div>
		  </div>


            <button  type="submit" style="display:block;width: 10%;" class="submit_bt bt_score1">Submit</button>

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

		  <div class="style_list customer_info_form">
			   <div class="form-group">
			<label for="company" class=" form-control-label">{{__('Name')}}</label>
			<input type="text" value="{{old('name',optional(@$model)->name)}}" name="name" id="name" placeholder="Enter Name" class="form-control">
			<span class="text-danger" role="alert" id="err_name"></span>
		</div>
			<div class="form-group">
			<label for="company" class=" form-control-label">{{__('Email')}}</label>
			<input type="text" value="{{old('email',optional(@$model)->email)}}" id="email" name="email" placeholder="Enter Email" class="form-control">
			<span class="text-danger" role="alert" id="err_email"></span>
		</div>
		  </div>


            <button  type="submit" style="display:block;width: 10%;" class="submit_bt bt_score1">Submit</button>

		<a class="pre bt_score1">Previous</a>
		</div>

		 </div>
		 <!--Email -->
			<?php
			}
			?>
		</form>
		<div class="card calulator-card first">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title"> What's your interior design style? <span id="answer_category" style="color:#56e454"></span></h4>
		</div>
		<div class="modal-body">
		<div class="interior_img">
		<img src="{{asset('/public/img/inerior_banner1.jpg')}}">
		</div>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

		<div class="style_social_link">
		 <h3>Share Your Results</h3>
		  <span><a href="#"><i class="fab fa-facebook"></i></a></span>
		  <span><a href="#"><i class="fab fa-twitter"></i></a></span>
		  <span><a href="#"><i class="fab fa-instagram"></i></a></span>
		</div>
		<a href="{{route('frontend.detail.form')}}" class="start_project">Are you ready to find a designer and start this project?</a>
		<!--<form action="{{route('frontend.start.project')}}"  method="post" id="start_project_form" novalidate="novalidate">
		@csrf
		<button type="submit" class="start_project">Are you ready to find a designer and start this project?</a>
		</form>-->
		</div>
		</div>


      </div>

    </div>
  </div>
<!--Modal-->

</section>
{!!@optional($section1)->html!!}
<!--<section class="simplerTalks">
    <br/>
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
    </section>-->
    <!--<div class="flashBannerCont"><div class="container"><div class="row"><div class="flashBanner">
        <h2>Learn more about our Design packages</h2><button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>
        </div></div></div></div>-->
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
		if(ans_<?php echo $k; ?>) {

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
		}
		else{
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
    $("#preferred_bedroom_form").submit(function(e){
		e.preventDefault();
		var name = $("#name").val();
		var email = $("#email").val();

		//$("#btn").text('Please wait...');
		//$("#btn").prop('disabled', true);
		var url=$(this).attr("action");
		//alert(url);
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#preferred_bedroom_form").serialize(),
			  success: function(response){
			  //alert(response);
			  //alert(response.status);
				//$("#btn").text('Submit');
				//$("#btn").prop('disabled', false);
				 if(response.status=='NOK')
				 {
					$("#err_email").html(response.errors.email?response.errors.email:'');
					$("#err_name").html(response.errors.name?response.errors.name:'');
					return;
				 }
				 else if(response.status=='NOK1')
				 {
				     $("#err_name").html('');
					$("#err_email").html(response.msg?response.msg:'The email has already been taken.');
					return;
				 }
				 else if(response.status=='OK'){
					 //alert('submit');
					 $("#answer_category").text(response.category);
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
        function test(data,data1){
            var addon_amount = data;
            var amount_id = data1;
            var amount = $("#main_amount"+amount_id).val();
            //alert(amount);
            //if($('input[name=thename]').is(":checked")){
            if ($('input:checkbox[name="addons'+data1+'"]').prop("checked")) {

             //alert('checked');
             var total = (parseInt(addon_amount)+parseInt(amount));
             $("#amount_"+amount_id).text("$"+total);
             $("#main_amount"+amount_id).val(total);
            }
            else{
                //alert('Unchecked');
            var total = (parseInt(amount)-parseInt(addon_amount));
             $("#amount_"+amount_id).text("$"+total);
             $("#main_amount"+amount_id).val(total);
            }
        }
        </script>


        <script>
function test2(data){
	var susbcription_id = data;
	$("#subscription").val(susbcription_id);
}
</script>
    @endsection
