@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Header Menus')}}</strong> 
        </div>
		<div class="card-body">
		
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						
						<th scope="col">{{__('Menu Name')}}</th>
						<th scope="col">{{__('Created On')}}</th>
						
						<th scope="col">{{__('Status')}}</th>

                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($headermenus as $model)
					<tr>
						<th class="align-middle" scope="row">{{ $loop->iteration }}</th>
						<td class="align-middle">{{$model->menu_name}}</td>
						<td class="align-middle">{{$model->created_at}}</td>
						
					    <td class="align-middle">
						@if($model->status==1)<span class="text-success">Active</span>
						@else<span class="text-danger">Inactive</span>
						@endif
						
						</td>
    					<td class="align-middle">
    					@if($model->status==1)
    						<a href="{{route('admin.header.menu.inactive',['model'=>$model])}}" class="btn btn-warning">Inactive</a>
    						@else
    						<a href="{{route('admin.header.menu.active',['model'=>$model])}}" class="btn btn-success">Active</a>
    						@endif
    						 <!--<a href="" onclick="return confirm('Are You Sure to Delete');" class="btn btn-danger"><i class="fa fa-trash"></i></a>-->
    					</td>

					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	

</div>


@endsection 