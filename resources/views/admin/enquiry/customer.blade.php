@extends('layouts.designer')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Customers')}}</strong>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Project')}}</th>
				        <th scope="col">{{__('Designer')}}</th>
        				 <!--<th scope="col">{{__('Email')}}</th>-->
        				 	 <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
				    @if(count($customers)>0)
					@foreach($customers as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle"><div class="backend_img"><img src="{{asset('/public/uploads/download (5).jpg')}}" alt="Project"></div></td>
				  <td class="align-middle">{{$model->first_name}}</td>

				 <td class="align-middle"><a href="{{route('admin.designer.customer.chat',['model'=>$model->id])}}" class="btn btn-primary"><i class="fa fa-commenting"></i> chat</a></td>
					</tr>


					@endforeach
                    @endif
				</tbody>
			</table>

		</div>
	</div>


</div>


@endsection
