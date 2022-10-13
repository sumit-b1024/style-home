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
        <label for="coupon_code" class=" form-control-label">{{__('Coupon Code')}}</label>

        <input type="text" value="{{old('coupon_code',optional(@$model)->coupon_code)}}" name="coupon_code" placeholder="Enter Coupon Code" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('coupon_code')}}</span>

    </div>
	<div class="form-group">
        <label for="percentage" class=" form-control-label">{{__('Percentage')}}</label>

        <input type="number" value="{{old('percentage',optional(@$model)->percentage)}}" name="percentage" placeholder="Enter Percentage" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('percentage')}}</span>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
