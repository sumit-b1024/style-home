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
<h4>Pricing</h4>
<div class="container">
<div class="row">
<div class="session_cont mt-5 pt-4 pricing_area">
<div class="row">
@if(count($subscriptions)>0)
@php
$i=1;
@endphp
@foreach($subscriptions as $subscription)
<div class="col-lg-4 col-xs-12">
 <div class="box">
 <div class="price_box">
 <div class="liveSession">
<label class="mb-0" id="amount_{{$i}}">${{$subscription->fee_amount}}</label>                            <input type="hidden" name="amount" value="{{$subscription->fee_amount}}" id="main_amount{{$i}}">
 </div><h3>{{$subscription->title}} </h3>
 <p>20 Minute Consulation Call with </p>
 <span class="size">Size : {{$subscription->size}}</span>
 {!!@optional($subscription)->facilities!!}
<!-- <button class="mt-3 brown_btn d-block">Get Started</button>-->
<button class="mt-3 brown_btn d-block" type="button" data-toggle="modal" data-target="#myModal" onclick="test2('{{$subscription->id}}')">Get Started</button>
<button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo{{$i}}">Addons</button>
  <div id="demo{{$i}}" class="collapse">
<form class="profile price_list">
@php
 $subscriptions1 = SubscriptionAddon::where('status',1)->where('subscription_id',$subscription->id)->get();
@endphp
@if(count($subscriptions1)>0)
@foreach($subscriptions1 as $subscription1)
 <div class="form-check">
  <input class="form-check-input" name="addons{{$i}}" type="checkbox"  onclick="test('{{$subscription1->price}}','{{$i}}')" value="{{$subscription1->id}}" id="">
  <label class="form-check-label" for=""> {{$subscription1->title}} (${{$subscription1->price}})</label>
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

 <!--<div class="col-lg-4 col-xs-12">
 <div class="box">


 <div class="price_box">
 <div class="liveSession">
 <label class="mb-0">$350</label>
 </div>
 <h3>Decorate me</h3>
 <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
 <span class="size">Size : Per room</span>



<button class="mt-3 brown_btn d-block">Get Started</button>

<button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo">Addons</button>
  <div id="demo" class="collapse">
  <form class="profile price_list">
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

</form>

 <p>Do you have the main furniture pieces and just need help decorating your space? Then Decorate me is for you!</p>

  </div>


 </div>
 </div>					</div>

 <div class="col-lg-4 col-xs-12">
 <div class="box">
 <div class="price_box">
 <div class="liveSession">
 <label class="mb-0">$500</label>
 </div>
 <h3>Furnish me</h3>
 <p>3 Moodboard opitions to choose from Design concept (with unlimited revisions until you are satisfied) Shopping list</p>
 <span class="size">Size : Per room</span>

 <button class="mt-3 brown_btn d-block">Get Started</button>

<button type="button" class="addons_bt" data-toggle="collapse" data-target="#demo1">Addons</button>
  <div id="demo1" class="collapse">
  <form class="profile price_list">
 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="">
  <label class="form-check-label" for="">Initial site visit (+50 / visit)</label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="">
  <label class="form-check-label" for="">2D layout  (+50 / room)</label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="">
  <label class="form-check-label" for="">3D Model (+100 / room)</label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="">
  <label class="form-check-label" for="">Procurement (100/ room, +50 for additional</label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="">
  <label class="form-check-label" for="">Onsite supervision for 1 day (+200/ day)</label>
</div>

</form>
 <p>Do you need to furnish and decorate a room from scratch? Furnish me will help you design your room and elevate it to the next level!</p>
  </div>

 </div>
 </div>
 </div>	-->

 </div>
</div>
</div></div></section>
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
