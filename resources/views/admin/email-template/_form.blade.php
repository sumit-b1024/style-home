<?php 
use App\Models\EmailTemplate;
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
        <label for="company" class=" form-control-label">{{__('Salutation')}}</label>
        <input type="text" value="{{old('salutation',optional(@$model)->salutation)}}" name="salutation" placeholder="Enter Salutation" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('salutation')}}</span>
    </div>
	<div class=" form-group">
        <label for="company" class=" form-control-label">{{__('Type')}}</label>
        <select class="form-control" name="type" onchange="test(this)">
            <option value="">---{{__('Select')}}---</option>
            @foreach(EmailTemplate::getEmailTypes() as $key=>$type)
                 <option value="{{$key}}" {{(old('type',optional(@$model)->type)==$key)?'selected':''}}>{{$type}}</option>
            @endforeach
        </select>
        <span class="help-block is-invalid">{{$errors->first('type')}}</span>
    </div>
	<div class=" form-group">
        <label for="textarea-input" class=" form-control-label">{{__('Message')}}</label>
        <div><textarea name="message" id="default1" rows="9"   class="form-control">{{old('message',optional(@$model)->message)}}</textarea></div>
        <span class="help-block is-invalid">{{$errors->first('message')}}</span>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
	
@section("additional_scripts")

 @include("includes/ckeditor_new")


@endsection