@extends('layouts.admin_new')


@section('content')
<style>
.card-title{
	text-decoration: underline;
}
</style>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #fff;
}
#img{
  display: block;
  margin-left: auto;
  margin-right: auto;
  box-shadow: inherit;
 
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}
</style>
<?php
use App\User;
use App\Models\ApplyForm;
?>
 <div class="animated fadeIn">


                <div class="row">
                   

                    </div><!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>{{__('Applied Designer Detail')}}</strong><div class="pull-right"><a class="btn btn-warning" href="{{route('admin.applied.designer')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
							 <div class="col-lg-12">&nbsp;</div>
                            <div class="card">

							<div class="card-body">
							  <h4 class="card-title">{{$applied_designer->first_name}} {{$applied_designer->last_name}}</h4>
							  <p class="card-text"><b>Email:</b> {{@$applied_designer->email}}</p>
							  <p class="card-text"><b>Phone:</b> {{@$applied_designer->phone_number}}</p>
							  <p class="card-text"><b>Gender:</b> {{@$applied_designer->getGender()}}</p>
							  <p class="card-text"><b>Job:</b> {{@$applied_designer->job_title}}</p>
							  @if(($applied_designer->form_questions) && ($applied_designer->form_answers))
								<?php
								$form_questions = $applied_designer->form_questions;
								$form_questions1 = explode(",",$form_questions);
								$form_answers = $applied_designer->form_answers;
								$form_answers1 = json_decode($form_answers);
								for($i=0;$i<count($form_questions1);$i++){
									@$question = ApplyForm::where(['id'=>$form_questions1[$i]])->first();
								?>
							  <p class="card-text"><b>{{@$question->label}}:</b> {{@$form_answers1[$i]}}</p>
							    <?php
								}
								?>
							  @endif
							 <!-- <p class="card-text"><b>LinkedIn:</b> {{@$applied_designer->linkedin_profile}}</p>
							  <p class="card-text"><b>Sponsorship:</b> {{@$applied_designer->sponsorship}}</p>
							  <p class="card-text"><b>Relocation:</b> {{@$applied_designer->relocation}}</p>
							  <p class="card-text"><b>Career Opportunity:</b> {{@$applied_designer->career_opportunity}}</p>
							  
							  <p class="card-text"><b>Hispanic Ethnicity:</b> {{@$applied_designer->hispanic_ethnicity}}</p>
							  <p class="card-text"><b>Veteran Status:</b> {{@$applied_designer->veteran_status}}</p>
							  <p class="card-text"><b>Disability Status:</b> {{@$applied_designer->getDisabilityStatu()}}</p>-->
							  @if($applied_designer->cv)
							  <p class="card-text"><b>CV:</b> <a target="_blank" href="{{asset("public/uploads/cv/{$applied_designer->cv}")}}" style="background: #2cd4d9;" class ="browse_bt"><span>View CV</span></a></p>
							  @endif
							  @if($applied_designer->cover_letter)
							  <p class="card-text"><b>Cover Letter:</b> <a target="_blank" href="{{asset("public/uploads/cover_letter/{$applied_designer->cover_letter}")}}" style="background: #2cd4d9;" class ="browse_bt"><span>View Cover Letter</span></a></p>
							  @endif
							  @if($applied_designer->profile_image)
							  <p class="card-text"><img class="card-img-top" id="img" src="{{asset("public/uploads/{$applied_designer->profile_image}")}}" alt="User Profile"></p>
							      
							  
							  @endif
							  <?php
					           $designer=User::where("status",1)->where("job_id",$applied_designer->job_id)->where("apply_id",$applied_designer->id)->where("email",$applied_designer->email)->first();
							   if(empty($designer)){
					           ?>
							  <form method="post" action="{{route('admin.designer.registration')}}" enctype="multipart/form-data">
									@csrf
								<input type="hidden" class="form-control" name="apply_id" value="{{$applied_designer->id}}" autofocus>
								<input type="hidden" name="job_id" value="{{$applied_designer->job_id}}">

								<button type="submit" class="btn btn-primary stretched-link text-center">Hire Now</button>
								</form>
								<?php
							   }
							   else{
								   ?>
								   <button type="button" class="btn btn-primary stretched-link text-center">Hired</button>
								   <?php
							   }
							   ?>
							</div>
							</div>
						</div>
					</div>
                        
                        
                    </div>
                    
                    </div>
 @endsection