<?php
use App\Models\Banner;
?>
@extends('layouts.admin')


@section('content')


<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Section')}} {{$section_index}}</strong>
		</div>
		<div class="card-body card-block">
			<form
				action="{{route('admin.homepage.section.post',['section_index'=>$section_index])}}"
				method="post">
				@csrf
				<textarea name="html" id="default">{{optional($page)->html}}</textarea>

				<input class="btn btn-primary" type="submit" />

			</form>
		</div>

	</div>


</div>

@endsection 
@section("additional_scripts")

 @include("includes/ckeditor")
@endsection
