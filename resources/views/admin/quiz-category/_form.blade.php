<form method="post" action="{{$path}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Title')}}</label>
        <input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Title" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('title')}}</span>
    </div>
    <div class="form-group">
	<label for="company" class=" form-control-label">{{__('Image')}}</label>
	<input type="file" name="image" class="form-control">
	@if(!empty($model->image))
	<img width="120px" src="{{$model->getQuizCategoryImage()}}"/>
	@endif
	<span class="help-block is-invalid error">{{$errors->first('image')}}</span>
	</div>
	<div class=" form-group">
		<label for="textarea-input" class=" form-control-label">{{__('Description')}}</label>
		<div><textarea name="description" id="default1" rows="9"   class="form-control">{{old('description',optional(@$model)->description)}}</textarea></div>
		<span class="help-block is-invalid">{{$errors->first('description')}}</span>
	</div>
    
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection