@extends('layouts.admin')
@section('content')

	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Quiz Question')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					 @include('admin.quiz-question._form',['path'=>route('admin.quiz.question.add.post')]) 
							
					</div>
				</div>
			</div>
	</div>
 @endsection