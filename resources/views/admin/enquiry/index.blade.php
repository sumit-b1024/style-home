@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Enquiries')}}</strong> 
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Name')}}</th>
				 
        				 <th scope="col">{{__('Email')}}</th>
						 <!--<th scope="col">{{__('Phone Number')}}</th>-->
        				 <th scope="col">{{__('Subject')}}</th>
        				 	 <th scope="col">{{__('Message')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$model->id}}</th>
						<td class="align-middle">{{$model->name}}</td>
				  
				  
				  <td class="align-middle">{{$model->email}}</td>
				  <!--<td class="align-middle">{{$model->phone_number}}</td>-->
				  <td class="align-middle">{{$model->subject}}</td>
				 <td class="align-middle">{{$model->message}}</td>	 
					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $models->links() }}

</div>


@endsection 