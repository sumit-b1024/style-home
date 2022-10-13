@extends('layouts.admin')
@section('content')
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Quiz Question')}}</strong><small> {{__('Form')}}</small><div class="pull-right"><a class="btn btn-warning" href="{{route('admin.quiz.question')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
					<div class="card-body card-block">
					 @include('admin.quiz-question._form',['path'=>route('admin.quiz.question.update.post',['model'=>$model])]) 		
					</div>
				</div>
			</div>
	</div>
 @endsection