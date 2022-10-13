<?php
use Illuminate\Support\Facades\DB;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use App\Models\QuizResult;
?>
<?php
$quiz_questions=DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog interior_box">
    <form action="{{route('frontend.preferred.bedroom')}}"  method="post" id="preferred_bedroom_form" novalidate="novalidate">
		@csrf
	<input type="hidden" name="subscription" id="subscription" value="">
		<input type="hidden" name="subscription_ammount" id="subscription_ammount" value="">
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
		<input type="hidden" name="login_type" class="login_type" value="signup">
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
		<p class="sign_up_txt popup_sign">Already have an account? <a class="next01 bt_score">Sign In</a></p>
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
		<input type="hidden" name="login_type" class="login_type" value="signup">
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
		<p class="sign_up_txt popup_sign">Already have an account? <a class="next01 bt_score">Sign In</a></p>
		  </div>


            <button  type="submit" style="display:block;width: 10%;" class="submit_bt bt_score1">Submit</button>

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
			<label for="company" class=" form-control-label">{{__('Username or Email')}}</label>
			<input type="text" value="{{old('username',optional(@$model)->username)}}" name="username" id="username" placeholder="Enter Username" class="form-control">
			<span class="text-danger" role="alert" id="err_username"></span>
		</div>
			<div class="form-group">
			<label for="company" class=" form-control-label">{{__('Password')}}</label>
			<input type="password" value="{{old('password',optional(@$model)->password)}}" id="password" name="password" placeholder="Enter Password" class="form-control">
			<span class="text-danger" role="alert" id="err_password"></span>
		</div>
		<span class="text-danger" role="alert" id="err_account"></span>
		  </div>

            <button  type="submit" style="display:block;width: 10%;"  class="submit_bt bt_score1">Submit</button>

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
		<h4 class="modal-title"> What's your interior design style? <span id="answer_category" style="color:#56e454"></span></h4>
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
				 else if(response.status=='NOK2')
				 {
					 $("#err_account").html('');
					$("#err_username").html(response.errors.username?response.errors.username:'');
					$("#err_password").html(response.errors.password?response.errors.password:'');
					return;
				 }
				 else if(response.status=='NOK3'){
				 $("#err_username").html('');
				 $("#err_password").html('');
				 $("#err_account").html(response.msg?response.msg:'Invalid account, please create an account by Signup');
					return;
				 }
				 else if(response.status=='OK'){
					 //alert('submit');
					 if(response.category_image==""){
						 $("#answer_image").css("display", "none");
					 }
					 else{
						 $("#answer_image").css("display", "block");
					 }
					 $("#answer_category").text(response.category);
					 $("#answer_image").attr("src",response.category_image);
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
		$(".next01").click(function(){
			$(".login_type").val('login');
			});
		$(".pre01").click(function(){
			$(".login_type").val('signup');
			});
		</script>
