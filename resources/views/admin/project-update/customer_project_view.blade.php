@extends('layouts.admin')
@section('content')
<style>.card-title{	text-decoration: underline;}</style><style>* {  box-sizing: border-box;}body {  font-family: Arial, Helvetica, sans-serif;}/* Float four columns side by side */.column {  float: left;  width: 25%;  padding: 0 10px;}/* Remove extra left and right margins, due to padding */.row {margin: 0 -5px;}/* Clear floats after the columns */.row:after {  content: "";  display: table;  clear: both;}/* Responsive columns */@media screen and (max-width: 600px) {  .column {    width: 100%;    display: block;    margin-bottom: 20px;  }}/* Style the counter cards */.card {  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);  padding: 16px;  text-align: center;  background-color: #fff;}#img{  display: block;  margin-left: auto;  margin-right: auto;  box-shadow: inherit;   border: 1px solid #ddd;  border-radius: 4px;  padding: 5px;  width: 150px;}</style>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function() {
    var $lightbox = $('#lightbox');
$('[data-target="#lightbox"]').on('click', function(event) {var $img = $(this).find('img'),             src = $img.attr('src'),            alt = $img.attr('alt'),            css = {                'maxWidth': $(window).width() - 100,                'maxHeight': $(window).height() - 100            };            $lightbox.find('.close').addClass('');        $lightbox.find('img').attr('src', src);        $lightbox.find('img').attr('alt', alt);        $lightbox.find('img').css(css);    });        $lightbox.on('shown.bs.modal', function (e) {        var $img = $lightbox.find('img');                    $lightbox.find('.modal-dialog').css({'width': $img.width()});        $lightbox.find('.close').removeClass('');
    
});
});
</script>
<script>
$(document).ready(function() {
    var $lightbox1 = $('#lightbox1');
$('[data-target="#lightbox1"]').on('click', function(event) {var $img = $(this).find('img'),             src = $img.attr('src'),            alt = $img.attr('alt'),            css = {                'maxWidth': $(window).width() - 100,                'maxHeight': $(window).height() - 100            };            $lightbox1.find('.close').addClass('');        $lightbox1.find('img').attr('src', src);        $lightbox1.find('img').attr('alt', alt);        $lightbox1.find('img').css(css);    });        $lightbox1.on('shown.bs.modal', function (e) {        var $img = $lightbox1.find('img');                    $lightbox1.find('.modal-dialog').css({'width': $img.width()});        $lightbox1.find('.close').removeClass('');
    
});
});
</script>

<script>
$(document).ready(function() {
    var $lightbox2 = $('#lightbox2');
$('[data-target="#lightbox2"]').on('click', function(event) {var $img = $(this).find('img'),             src = $img.attr('src'),            alt = $img.attr('alt'),            css = {                'maxWidth': $(window).width() - 100,                'maxHeight': $(window).height() - 100            };            $lightbox2.find('.close').addClass('');        $lightbox2.find('img').attr('src', src);        $lightbox2.find('img').attr('alt', alt);        $lightbox2.find('img').css(css);    });        $lightbox2.on('shown.bs.modal', function (e) {        var $img = $lightbox2.find('img');                    $lightbox2.find('.modal-dialog').css({'width': $img.width()});        $lightbox2.find('.close').removeClass('');
    
});
});
</script>
<?php
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use App\Models\FormAnswer;
use App\Models\SubscriptionAddon;
use App\User;
?>
	<div class="animated fadeIn"><div class="row"></div><!--/.col--><div class="col-lg-12"><nav>
	<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-quiz" role="tab" aria-controls="nav-home" aria-selected="true">Quiz Details</a>
	<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-contact" aria-selected="false">Detail Form</a>
	<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-project" role="tab" aria-controls="nav-profile" aria-selected="false">Project Detail</a>
	</div>
	</nav>
	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-quiz" role="tabpanel" aria-labelledby="nav-home-tab">
    <h4 class="modal-title text-center"> What's your interior design style? <span id="answer_category" style="color:#56e454">{{$project->category_title}}</span></h4><br/>
    @if(($project->questions) && ($project->answers))
    <?php
    $questions = $project->questions;
    $questions1 = explode(",",$questions);
    $answers = $project->answers;
    $answers1 = explode(",",$answers);
    for($i=0;$i<count($questions1);$i++){
        @$question = QuizQuestion::where(['id'=>$questions1[$i]])->first();
        @$answer = QuizAnswer::where(['id'=>$answers1[$i]])->first();
    
    ?>
    <div class="quiz_answer"><h3> {{@$question->title}}</h3>
	<span class="ans_img"><img src="{{@$answer->getQuizAnswerImage()}}"></span><span class="bg-azure">{{@$answer->title}}</span>
	</div>
	<?php
	}
	?>
	@endif
	<!--<div class="quiz_answer"><h3> Which dining room lights you up?</h3><span class="ans_img"><img src="http://learning.neuronsit.in/style-home/public/uploads/answer/light1_1620716306.jpg"></span><span class="bg-azure">Minimalist with a few eye-catching accents!</span>					 </div>
	<div class="quiz_answer"><h3>Pick some accents for your coffee table...</h3><span class="ans_img"><img src="http://learning.neuronsit.in/style-home/public/uploads/answer/coffee_table1_1620716541.jpg"></span><span class="bg-azure">Minimalist with a few eye-catching accents!</span>
	</div>-->
	</div>
	<div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-contact-tab">
	    <div class="detail_form_box">
	        <p><b>Designer?</b> {{@$project->first_name}} {{@$project->last_name}}</p>
	         @if($project->user_id)
	         @php
	        @$user = User::where(['id'=>$project->user_id])->first();
	        @endphp
	        <p><b>Customer?</b> {{@$user->first_name}} {{@$user->last_name}}</p>
	        @endif
	        <p><b>When would you need this project done?</b> {{@$project->project_duration}}</p>
	        <p><b>Where are you located?</b>{{@$project->country_name}}</p>
	        <p><b>{{@$form_questions[0]['title']}}?</b>{{@$project->form_answer}}</p>
	        @if($project->room)
	        @php
	        @$room = FormAnswer::where(['id'=>$project->room])->first();
	        @endphp
	        <p><b>{{@$form_questions[1]['title']}}</b>{{@$room->title}}</p>
	        @endif
	        <p class="full_wid"><b>Subscription Plan</b>{{@$project->subscription_title}} @if(@$project->subscription_amount)({{@$project->subscription_amount}} AED) @endif</p>
			@if(@$project->addons)
			<?php
			$addons2 = [];
			$addons = $project->addons;
			
			$addons1 = explode(",",$addons);
			$subscription_addons = SubscriptionAddon::whereIn('id',$addons1)->get();
			if(count($subscription_addons)>0){
			foreach($subscription_addons as $subscription_addon){
				$addons2[] = $subscription_addon->title;
			}
			}
			$addons3 = implode(",",$addons2);
			?>
			<p class="full_wid"><b>Subscription Addons</b>{{@$addons3}}</p>
			@endif
			
			</div>
	    </div>
	    
	  <div class="tab-pane fade" id="nav-project" role="tabpanel" aria-labelledby="nav-profile-tab">
	 @if($project->room_picture)
	<table class="project_details1"><tr>
    <td width="20%">
	<?php
	$x = explode (",", $project->room_picture);
	?>
	<img class="card-img-top" id="img" src="{{asset("public/uploads/{$x[0]}")}}" alt="Project">
    @endif
    </td>
    <td><table class="details_table">
        <tr><td><b>Project Title:</b></td><td>{{$project->title}} </td></tr>
        <tr><td><b>About Room:</b></td><td>{{$project->about_room}} </td></tr>
        <tr><td><b>Room Dimension:</b></td><td>{{$project->room_dimension}}</td></tr>
        <tr><td><b>Specific Area:</b></td><td>{{$project->specific_area}}</td></tr>
        <tr><td><b>Budget:</b></td><td>{{$project->budget}}</td></tr>
        
        @if($project->room_picture)
        <tr><td><b>Pictures of the Room</b></td><td>
            <div class="details_img">
                <div class="row">
                    <?php
                	$x1 = explode (",", $project->room_picture);
                	for($j=0;$j<count($x1);$j++){
                	?>
                    <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img src="{{asset("public/uploads/{$x1[$j]}")}}" alt="..."></a></div>
                    <?php
                    }
                    ?>
                    <!--<div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img src="http://learning.neuronsit.in/style-home/public/img/gallery3.jpg" alt="..."></a></div>
                    <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img src="http://learning.neuronsit.in/style-home/public/img/gallery2.jpg" alt="..."></a></div>
                    <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img src="http://learning.neuronsit.in/style-home/public/img/gallery1.jpg" alt="..."></a></div>-->
                    </div>
                    <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><div class="modal-dialog"><button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button><div class="modal-content"><div class="modal-body"><img src="" alt="" /></div></div></div></div></div></td></tr>
                    @endif
        <tr><td><b>Iteem Keep in Room:</b></td><td>{{$project->room_item_keep}}</td></tr>
        @if($project->room_item_keep_picture)
        <tr><td><b>Iteem Keep in Room Picture:</b></td><td>
            <div class="details_img">
                <div class="row">
                    <?php
                	$y1 = explode (",", $project->room_item_keep_picture);
                	for($k=0;$k<count($y1);$k++){
                	?>
                    <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox1"><img src="{{asset("public/uploads/{$y1[$k]}")}}" alt="..."></a></div>
                    <?php
                    }
                    ?>
                    </div>
                    <div id="lightbox1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><div class="modal-dialog"><button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button><div class="modal-content"><div class="modal-body"><img src="" alt="" /></div></div></div></div>
                    </div></td></tr>
                    @endif
         <tr><td><b>What is the vision you have for this Room:</b></td><td>{{$project->room_vision}}</td></tr>
         <tr><td><b>Room Vision:</b></td><td>{{$project->room_vision}}</td></tr>
        @if($project->inspiration_image)
        <tr><td><b>Inspiration Image:</b></td><td>
            <div class="details_img">
                <div class="row">
                    <?php
                	$z1 = explode (",", $project->inspiration_image);
                	for($l=0;$l<count($z1);$l++){
                	?>
                    <div class="col-xs-6 col-sm-3"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox2"><img src="{{asset("public/uploads/{$z1[$l]}")}}" alt="..."></a></div>
                    <?php
                    }
                    ?>
                    </div>
                    <div id="lightbox2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><div class="modal-dialog"><button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button><div class="modal-content"><div class="modal-body"><img src="" alt="" /></div></div></div></div>
                    </div></td></tr>
                    @endif
          <tr><td><b>Pinterest Board Link:</b></td><td>{{$project->pinterest_board}}</td></tr>
          <tr><td><b>Color Schemes:</b></td><td>{{$project->color_schemes}}</td></tr>
          <tr><td><b>Specific Item:</b></td><td>{{$project->specific_item}}</td></tr>
          <tr><td><b>Other Consideration:</b></td><td>{{$project->other_consideration}}</td></tr>
        </table></td></tr></table></div>
	                
	                </div>
	                </div>
	                </div>
	                </div> 
	                @endsection