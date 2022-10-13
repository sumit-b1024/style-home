@extends('layouts.admin')


@section('content')
<?php
use App\User;
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Applied Designer')}}</strong> 
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Job Name')}}</th>
						<th scope="col">{{__('First Name')}}</th>
						<th scope="col">{{__('Last Name')}}</th>
        				 <th scope="col">{{__('Email')}}</th>
						 <th scope="col">{{__('Phone Number')}}</th>
        				 	 <th scope="col">{{__('Status')}}</th>
        				 	 <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($applied_designers as $applied_designer)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$applied_designer->job_title}}</td>
						<td class="align-middle">{{$applied_designer->first_name}}</td>
						<td class="align-middle">{{$applied_designer->last_name}}</td>
						<td class="align-middle">{{$applied_designer->email}}</td>
						<td class="align-middle">{{$applied_designer->phone_number}}</td>
						<?php
					           $designer=User::where("status",1)->where("job_id",$applied_designer->job_id)->where("apply_id",$applied_designer->id)->where("email",$applied_designer->email)->first();
							   if(empty($designer)){
					           ?>
						<td class="align-middle"><span class="text-warning">Unhire</span></td>
						<?php
							   }
							   else{
								   ?>
								   <td class="align-middle"><span class="text-success">Hired</span></td>
								   <?php
							   }
							   ?>
						<td class="align-middle"><a href="{{route('admin.view.applied.designer',['model'=>$applied_designer->id])}}" class="btn btn-success"><i class="fa fa-eye"></i> view</a></td>	 
					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $applied_designers->links() }}

</div>


@endsection 