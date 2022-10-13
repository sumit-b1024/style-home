@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Coupon')}}</strong>
        <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.coupon.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Coupon Code')}}</th>
						<th scope="col">{{__('Percentage')}}</th>
						<th scope="col">{{__('Created At')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>

						<td class="align-middle">{{$model->coupon_code}}</td>
						<td class="align-middle">{{$model->percentage}}</td>
						<td class="align-middle">{{$model->created_at}}</td>

					<td class="align-middle"><a href="{{route('admin.coupon.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.coupon.delete',['model'=>$model])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $models->links() }}

</div>


@endsection
