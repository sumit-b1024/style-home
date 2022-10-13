@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Customer Users')}}</strong> 
        </div>
		<div class="card-body">
		<!--<form method="GET" action="#" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form><br/><br/><br/>-->
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<!--<th scope="col">{{__('Profile Image')}}</th>-->
						<th scope="col">{{__('First Name')}}</th>
						<th scope="col">{{__('Last Name')}}</th>
						<th scope="col">{{__('Email')}}</th>
						<th scope="col">{{__('Status')}}</th>

                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{ $loop->iteration }}</th>
						<td class="align-middle">{{$model->first_name}}</td>
						<td class="align-middle">{{$model->last_name}}</td>
						<td class="align-middle">{{$model->email}}</td>
					    <td class="align-middle">
						@if($model->status==1)<span class="text-success">Active</span>
						@else<span class="text-danger">Inactive</span>
						@endif
						
						</td>
    					<td class="align-middle">
    					@if($model->status==1)
    						<a href="{{route('admin.user.inactive',['model'=>$model])}}" class="btn btn-primary">Inactive</a>
    						@else
    						<a href="{{route('admin.user.active',['model'=>$model])}}" class="btn btn-primary">Active</a>
    						@endif
    						 <!--<a href="" onclick="return confirm('Are You Sure to Delete');" class="btn btn-danger"><i class="fa fa-trash"></i></a>-->
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