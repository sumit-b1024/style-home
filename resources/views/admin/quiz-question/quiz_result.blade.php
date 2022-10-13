@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">Quiz Result</strong>
		</div>
		<div class="card-body card-block">
			<form action="{{route('admin.quiz.result.update.post')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="company" class=" form-control-label">{{__('Question')}}</label>
					<input type="text" value="{{old('question',optional(@$quiz_result)->question)}}" name="question" placeholder="Enter Question" class="form-control">
					<span class="help-block is-invalid">{{$errors->first('question')}}</span>
				</div>
				<div class="form-group">
				<label for="company" class=" form-control-label">{{__('Image')}}</label>
				<input type="file" name="image" class="form-control">
				@if(!empty($quiz_result->image))
				<img width="120px" src="{{$quiz_result->getQuizResultImage()}}"/>
				@endif
				<span class="help-block is-invalid error">{{$errors->first('image')}}</span>
				</div>
				<div class=" form-group">
					<label for="textarea-input" class=" form-control-label">{{__('Description')}}</label>
					<div><textarea name="description" id="default1" rows="9"   class="form-control">{{old('description',optional(@$quiz_result)->description)}}</textarea></div>
					<span class="help-block is-invalid">{{$errors->first('description')}}</span>
				</div>
				<input class="btn btn-primary" type="submit" />

			</form>
			@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection
		</div>
	</div>
</div>

@endsection 
@section("additional_scripts")

 @include("includes/ckeditor")
@endsection
