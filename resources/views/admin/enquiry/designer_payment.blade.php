@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Designer Payment Request')}}</strong>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Request Title')}}</th>
						<th scope="col">{{__('Request Message')}}</th>

        				<th scope="col">{{__('Customer Name')}}</th>
        				<th scope="col">{{__('Designer Name')}}</th>
        				<th scope="col">{{__('Posted On')}}</th>
        				<th scope="col">{{__('Request Status')}}</th>
        				 	 <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
				    @if(count($payment_requests)>0)
					@foreach($payment_requests as $model)
					<tr>
					<form method="post" action="{{route('admin.designer.payment.request.post',['model'=>$model->id])}}" enctype="multipart/form-data">
										@csrf
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{!!$model->message!!}</td>
						<td class="align-middle">@isset($model->project_details->users->first_name){!!$model->project_details->users->first_name!!} @endisset @isset($model->project_details->users->last_name)
							{!!$model->project_details->users->last_name!!}
						@endisset</td>
						<td class="align-middle">@isset($model->users->first_name)

						{!!$model->users->first_name!!}@endisset @isset($model->users->last_name)
						{!!$model->users->last_name!!}
						@endisset</td>
						<td class="align-middle">{{$model->created_at}}</td>
				  <td class="align-middle">
				  <input type="hidden" name="user_id" value="{{$model->user_id}}">
						<select class="form-control" name="request_status">
							<option value="">---{{__('Select Status')}}---</option>
							<option value="Accept" {{(old('request_status',optional(@$model)->request_status)=='Accept')?'selected':''}}>Accept</option>
							<option value="Pending" {{(old('request_status',optional(@$model)->request_status)=='Pending')?'selected':''}}>Pending</option>
							<option value="Reject" {{(old('request_status',optional(@$model)->request_status)=='Reject')?'selected':''}}>Reject</option>
						</select>
				  </td>


				 <td class="align-middle">
						<button type="submit" class="btn btn-primary">change status</button>


						</td>
						</form>
					</tr>


					@endforeach
                    @endif
				</tbody>
			</table>

		</div>
	</div>


</div>


@endsection
