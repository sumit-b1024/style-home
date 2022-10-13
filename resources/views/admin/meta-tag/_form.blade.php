<?php 
use App\Models\Banner;
?>
<form method="post" action="{{$path}}" enctype="multipart/form-data">
    @csrf

    <div class=" form-group">
        <label for="select" class=" form-control-label">{{__('Select')}}</label>

        <select name="page_id" id="select" class="form-control">
            <option value="">{{__('Please select')}}</option>

            @foreach(Banner::getTypes() as $key=>$type)
            <option value="{{$key}}" {{(old('page_id',optional(@$model)->page_id)=="$key")?'selected':''}}>{{$type}}</option>

            @endforeach
        </select>
        <span class="help-block is-invalid">{{$errors->first('page_id')}}</span>

    </div>
	<div class="form-group">
	<label for="company" class=" form-control-label">{{__('Meta Title')}}</label>
	<input type="text" value="{{old('title',optional(@$model)->meta_title)}}" name="meta_title" placeholder="Enter Meta Title" class="form-control">
	<span class="help-block is-invalid">{{$errors->first('meta_title')}}</span>
	</div>
	<div class="form-group">
	<label for="company" class=" form-control-label">{{__('Meta Tag')}}</label>
	<input type="text" value="{{old('title',optional(@$model)->meta_tags)}}" name="meta_tags" placeholder="Enter Meta Tag" class="form-control">
	<span class="help-block is-invalid">{{$errors->first('meta_tags')}}</span>
	</div>
	<div class="form-group">
	<label for="company" class=" form-control-label">{{__('Meta Description')}}</label>
	<textarea   name="meta_description"   class="form-control">{{old('short_desc',optional(@$model)->meta_description)}}</textarea>
	<span class="help-block is-invalid">{{$errors->first('meta_description')}}</span>
	</div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection
