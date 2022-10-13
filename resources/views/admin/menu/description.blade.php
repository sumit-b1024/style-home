@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header"><strong class="card-title">{{__('Footer Menu Description')}} </strong><div class="pull-right"><a class="btn btn-warning" href="{{route('admin.footer.menu')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
		<div class="card-body card-block">
			<form action="{{route('admin.footer.menu.description.post',['menu_id'=>$model])}}" method="post">
				@csrf
				<input type="hidden" name="menu_id" value="{{$model}}">
				<textarea name="html" id="default">{{optional($description)->html}}</textarea>
				<span class="help-block is-invalid">{{$errors->first('html')}}</span>
				<input class="btn btn-primary" type="submit" />
			</form>
		</div>
	</div>
</div>

@endsection 
@section("additional_scripts")

 @include("includes/ckeditor")
@endsection
