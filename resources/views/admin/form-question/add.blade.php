@extends('layouts.admin')
@section('content')

	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Form Question')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					 @include('admin.form-question._form',['path'=>route('admin.form.question.add.post')]) 
							
					</div>
				</div>
			</div>
	</div>
 @endsection