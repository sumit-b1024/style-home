@extends('layouts.designer')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Project List')}}</strong>
		</div>
		<div class="card-body">
		<ul class="project_listing"><li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>
  </div>
  <div class="proj_img"><img src="{{asset('/public/img/home8.jpg')}}" alt=""></div>

  </li>

   <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>
  </div>
  <div class="proj_img"><img src="{{asset('/public/img/home8.jpg')}}" alt=""></div>

  </li>

    <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>
  </div>
  <div class="proj_img"><img src="{{asset('/public/img/home8.jpg')}}" alt=""></div>

  </li>

    <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>
  </div>
  <div class="proj_img"><img src="{{asset('/public/img/home8.jpg')}}" alt=""></div>

  </li>

    <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>
  </div>
  <div class="proj_img"><img src="{{asset('/public/img/home8.jpg')}}" alt=""></div>

  </li>
 </ul>

		</div>
	</div>


</div>


@endsection
