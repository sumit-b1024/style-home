@extends('layouts.admin')
@section('content')
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Job')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					 @include('admin.job._form',['path'=>route('admin.job.update.post',['model'=>$model])]) 		
					</div>
				</div>
			</div>
	</div>
 @endsection