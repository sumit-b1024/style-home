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
        <label for="company" class=" form-control-label">{{__('Subscription Amount')}}</label>
        <input type="text" value="{{old('fee_amount',optional(@$model)->fee_amount)}}" name="fee_amount" placeholder="Enter Fee Amount" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('fee_amount')}}</span>
    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Size')}}</label>
        <input type="text" value="{{old('size',optional(@$model)->size)}}" name="size" placeholder="Enter Size" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('size')}}</span>
    </div>
	<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Subscription Facilities')}}</label>
        <textarea   name="facilities" id="default1" class="form-control">{{old('facilities',optional(@$model)->facilities)}}</textarea>
       
        <span class="help-block is-invalid">{{$errors->first('facilities')}}</span>
    </div>
	
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection