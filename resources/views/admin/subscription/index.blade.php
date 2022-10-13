@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Subscription')}}</strong> 
        <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.subscription.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Title')}}</th>
						<th scope="col">{{__('Subscription Pricing')}}</th>
						<!--<th scope="col">{{__('Image')}}</th>-->

						

                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{{$model->fee_amount}} AED</td>
					<!--<td class="align-middle"><img width="82px;" src="{{$model->getSubscriptionImage()}}"/></td>-->
					
					<td class="align-middle"><a href="{{route('admin.subscription.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="{{route('admin.subscription.delete',['model'=>$model])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a> <a href="{{route('admin.subscription.addons',['subscription_id'=>$model])}}" class="btn btn-info">Addons</a>
					
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