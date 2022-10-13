<?php
use App\Models\MetaTag;
?>
@extends('layouts.admin')


@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">Meta Tags</strong> <a
				class="float-right btn btn-warning"
				href="{{route('admin.metaTag.add')}}"><i class="fa fa-plus"></i> </a>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Meta Title</th>
						<th scope="col">Type</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$model->id}}</th>
						<td class="align-middle">{{$model->meta_title}}</td>
						<td class="align-middle">{{$model->getPageType() }}</td>
						<td class="align-middle"><a
							href="{{route('admin.metaTag.update',['model'=>$model->id])}}"
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
