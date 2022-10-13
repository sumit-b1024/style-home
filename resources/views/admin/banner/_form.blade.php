<?php 
use App\Models\Banner;
?>
<form method="post" action="{{$path}}" enctype="multipart/form-data">
    @csrf


    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Title')}}</label>
        <input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Title" class="form-control">
        <span class="help-block is-invalid text-danger">{{$errors->first('title')}}</span>
    </div>


    <div class=" form-group">
        <label for="select" class=" form-control-label">{{__('Select')}}</label>

        <select name="type_id" id="select" class="form-control">
            <option value="">{{__('Please select')}}</option>

            @foreach(Banner::getTypes() as $key=>$type)
            <option value="{{$key}}" {{(old('type_id',optional(@$model)->type_id)=="$key")?'selected':''}}>{{$type}}</option>

            @endforeach
        </select>
        <span class="help-block is-invalid text-danger">{{$errors->first('type_id')}}</span>

    </div>



    <div class=" form-group">
        <label for="textarea-input" class=" form-control-label">{{__('Description')}}</label>
        <div><textarea name="description" id="default1" rows="9"   class="form-control">{{old('description',optional(@$model)->description)}}</textarea></div>

        <span class="help-block is-invalid text-danger">{{$errors->first('description')}}</span>

    </div>

    <div class="row form-group">
        @isset($model)
        <img src="{{asset("public/uploads/banner/{$model->path}")}}" width="150px" />
        @endisset
        @if(@$model->type_id==0)
        <label for="file-input" class=" form-control-label">Banner Image (<span class="help-block is-invalid text-danger">Image Size :width:1920px and height:500px;</span>)</label>
        @elseif(@$model->type_id==14)
        <label for="file-input" class=" form-control-label">Banner Image (<span class="help-block is-invalid text-danger">Image Size :width:1920px and height:463px;</span>)</label>
        @else
        <label for="file-input" class=" form-control-label">Banner Image (<span class="help-block is-invalid text-danger">Image Size :width:1920px and height:500px;</span>)</label>
        @endif
        <input name="banner_image" type="file" id="file-input" name="file-input" class="form-control-file">

            <span class="help-block is-invalid text-danger">{{$errors->first('banner_image')}}</span>

        
    </div>

    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection
