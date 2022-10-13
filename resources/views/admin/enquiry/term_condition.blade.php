@extends('layouts.designer') 


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Term Condition')}}</strong> 
		</div>
		<div class="card-body">
			 {!!@optional($section2)->html!!}

		</div>
	</div>
	

</div>


@endsection 