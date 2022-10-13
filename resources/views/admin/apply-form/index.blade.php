@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Apply Job Form')}}</strong> 
        <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.apply.job.form.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Label')}}</th>
						<th scope="col">{{__('Posted On')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->label}}</td>
						<td class="align-middle">{{$model->created_at}}</td>
					<td class="align-middle"><a href="{{route('admin.apply.job.form.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.apply.job.form.delete',['model'=>$model])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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