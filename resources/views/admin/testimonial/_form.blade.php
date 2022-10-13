<?php 
use App\Models\Job;
?>
@if (count($errors) > 0)
<ul id="login-validation-errors" class="validation-errors">
    @foreach ($errors->all() as $error)
    <li style="color:red;" class="validation-error-item">{{ $error }}</li>
    @endforeach
</ul>
@endif
<form method="post" action="{{$path}}" enctype="multipart/form-data">
    @csrf

	
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Title')}}</label>
        
        <input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Title" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('title')}}</span>
        
    </div>
	<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Position')}}</label>
        
        <input type="text" value="{{old('position',optional(@$model)->position)}}" name="position" placeholder="Enter Position" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('position')}}</span>
    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Stars')}}</label>
        <select class="form-control" name="star">
            <option value="">---{{__('Select')}}---</option>
                <option value="1" {{(old('star',optional(@$model)->star)=='1')?'selected':''}}>1 Star</option>
                <option value="2" {{(old('star',optional(@$model)->star)=='2')?'selected':''}}>2 Star</option>
                <option value="3" {{(old('star',optional(@$model)->star)=='3')?'selected':''}}>3 Star</option>
                <option value="4" {{(old('star',optional(@$model)->star)=='4')?'selected':''}}>4 Star</option>
                <option value="5" {{(old('star',optional(@$model)->star)=='5')?'selected':''}}>5 Star</option>
        </select>
        
        <span class="help-block is-invalid">{{$errors->first('star')}}</span>
    </div>
	<!--<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Testimonial Image')}}</label>
        <input type="file"  name="image"   class="form-control">
        @if(!empty($model->image))
    <img width="120px" src="{{$model->getTesttimonialImage()}}"/>
        @endif
        <span class="help-block is-invalid">{{$errors->first('image')}}</span>
    </div>-->
	<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Description')}}</label>
        
        <textarea   name="description" id="default1"  class="form-control">{{old('description',optional(@$model)->description)}}</textarea>
       
        <span class="help-block is-invalid">{{$errors->first('description')}}</span>
        
    </div>
	<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Status')}}</label>
        <select class="form-control" name="status">
            <option value="">---{{__('Select')}}---</option>
                <option value="1" {{(old('status',optional(@$model)->status)=='1')?'selected':''}}>Active</option>
                <option value="0" {{(old('status',optional(@$model)->status)=='0')?'selected':''}}>Inactive</option>
        </select>
        
        <span class="help-block is-invalid">{{$errors->first('star')}}</span>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection