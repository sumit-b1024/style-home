@extends('layouts.designer')
@section('content')
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Payment Request')}}</strong><small> {{__('Form')}}</small></div>
					<div class="card-body card-block">
					@include('admin.payment-request._form',['path'=>route('designer.payment.request.add.post')])

					</div>
				</div>
			</div>
	</div>
 @endsection
