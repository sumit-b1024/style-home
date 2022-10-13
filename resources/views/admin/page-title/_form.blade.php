<?php 
use App\Models\PageTitle;
?>
<form method="post" action="{{$path}}" enctype="multipart/form-data">
    @csrf

	<div class=" form-group">
        <label for="select" class=" form-control-label">{{__('Select')}}</label>

        <select name="type" id="select" class="form-control">
            <option value="">{{__('Please select')}}</option>

            @foreach(PageTitle::getTypes() as $key=>$type)
            <option value="{{$key}}" {{(old('type',optional(@$model)->type)=="$key")?'selected':''}}>{{$type}}</option>

            @endforeach
        </select>
        <span class="help-block is-invalid">{{$errors->first('type')}}</span>

    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Title')}}</label>
        <input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Title" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('title')}}</span>
    </div>

    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection
