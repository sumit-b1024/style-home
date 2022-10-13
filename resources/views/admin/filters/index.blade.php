@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Additional Filters')}}</strong>
        <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.filters.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Name')}}</th>
						<th scope="col">{{__('Created At')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($filter_groups as $group)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>

						<td class="align-middle">{{$group->name}}</td>
						<td class="align-middle">{{$group->created_at}}</td>

					<td class="align-middle"><a href="{{route('admin.filters.update',['group'=>$group])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.filters.delete',['group'=>$group])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $filter_groups->links() }}

</div>


@endsection
