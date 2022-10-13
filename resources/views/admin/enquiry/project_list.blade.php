@extends('layouts.designer') 


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Project List')}}</strong> 
		</div>
		<div class="card-body">
		<ul class="project_listing">
		    @if(count($projects)>0)
		    @foreach($projects as $project)
		    <li>
              <div class="project_details">
               <h4>{{$project->title}}</h4>
               <span>{{$project->first_name}} {{$project->last_name}}</span>  
              </div>
              @if($project->room_picture)
              <?php
              $x = explode (",", $project->room_picture);
              ?>
              <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt="Project"></div>
             @endif
             <a class="view_project" href="{{route('admin.designer.project.update',['project_id'=>$project->id])}}">Project Update</a>
             <a class="view_project" href="{{route('admin.designer.project.view',['project_id'=>$project->id])}}">Project View</a>
             <a class="view_project" href="{{route('admin.designer.customer.chat',['model'=>$project->id])}}">Chat</a>
              </li>
              @endforeach
              @endif
 
 </ul>	

	</div>
	</div>

</div>


@endsection 