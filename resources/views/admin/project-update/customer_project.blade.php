@extends('layouts.admin')
@section('content')

<?php
use App\Models\ProjectUpdate;
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Customer Project')}}</strong>

		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Project Title')}}</th>
						<th scope="col">{{__('Customer Name')}}</th>
						<th scope="col">{{__('Designer Name')}}</th>

						<th scope="col">{{__('Image')}}</th>
						<th scope="col">{{__('Purchase Date')}}</th>
						<th scope="col">{{__('Project Status')}}</th>
						<th scope="col">{{__('Posted On')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($projects as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{{$model->cust_firstname}} {{$model->cust_lastname}}</td>
						<td class="align-middle">{{$model->first_name}} {{$model->last_name}}</td>

						<td class="align-middle">@if($model->room_picture)
						  <?php
						  $x = explode (",", $model->room_picture);
						  ?>
						  <img width="80px" src="{{asset("public/uploads/{$x[0]}")}}"/>
						 @endif</td>
                         <td>{{$model->Designer_date}}</td>
                         <td>
                            @if ($model->status == 0)
                                Completed
                            @else
                                Under Progress
                            @endif
                         </td>
						 <td class="align-middle">{{$model->created_at}}</td>
						<td class="align-middle"><a href="{{route('admin.customer.project.view',['project'=>$model->id])}}" class="btn btn-info">view</a>
						@php
						$project_updates=ProjectUpdate::where('project_id',$model->id)->get();
						@endphp
						@if(count($project_updates)>0)
						<a href="{{route('admin.customer.project.update',['project'=>$model->id])}}" class="btn btn-primary">view updates</a>
						@endif
						</td>
					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $projects->links() }}

</div>


@endsection
