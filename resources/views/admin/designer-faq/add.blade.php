@extends('layouts.admin')
@section('content')

	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Designer Faq')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					@include('admin.designer-faq._form',['path'=>route('admin.faq.designer.add.post')]) 
							
					</div>
				</div>
			</div>
	</div>
 @endsection