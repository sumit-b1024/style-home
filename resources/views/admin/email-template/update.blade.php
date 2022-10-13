@extends('layouts.admin')
@section('content')
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Email Template')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					 @include('admin.email-template._form',['path'=>route('admin.email.template.update.post',['model'=>$model])]) 	
					</div>
				</div>
			</div>
	</div>
 @endsection