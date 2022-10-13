@extends('layouts.designer')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Payment Request')}}</strong> 
        <div class="pull-right"><a class="btn btn-warning" href="{{route('designer.payment.request.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body project_update">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Payment Request Title')}}</th>
						<th scope="col">{{__('Payment Request Status')}}</th>
						<th scope="col">{{__('Posted On')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{{$model->request_status}}</td>
						<td class="align-middle">{{$model->created_at}}</td>
					<td class="align-middle">
					    @if($model->request_status=='Pending')
					    <a href="{{route('designer.payment.request.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
					    @endif
					</td>
					</tr>
					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $models->links() }}

</div>


@endsection 