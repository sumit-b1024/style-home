@extends('layouts.admin')
@section('content')
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Quiz Category')}}</strong><small> {{__('Form')}}</small><div class="pull-right"><a class="btn btn-warning" href="{{route('admin.quiz.category')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
					<div class="card-body card-block">
					 @include('admin.quiz-category._form',['path'=>route('admin.quiz.category.update.post',['model'=>$model])]) 		
					</div>
				</div>
			</div>
	</div>
 @endsection