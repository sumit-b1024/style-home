@extends('layouts.admin')
@section('content')

	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Apply Job Form')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					@include('admin.apply-form._form',['path'=>route('admin.apply.job.form.add.post')]) 
							
					</div>
				</div>
			</div>
	</div>
 @endsection