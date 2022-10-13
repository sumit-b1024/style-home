<?php
use App\Models\Banner;
?>
@extends('layouts.admin')


@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">Banner</strong> <a
				class="float-right btn btn-warning"
				href="{{route('admin.banner.add')}}"><i class="fa fa-plus"></i> </a>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Type</th>
						<th scope="col">Image</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$model->id}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{{$model->getType()}}</td>
						<td class="align-middle"><img width="80px" src="{{asset("
							public/uploads/banner/{$model->path}")}}"/></td>
						<td class="align-middle"><a
							href="{{route('admin.banner.update',['model'=>$model->id])}}"
							class="btn btn-primary btn-sm">Edit</a></td>
					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $models->links() }}

</div>
@endsection
