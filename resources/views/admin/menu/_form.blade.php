<style>
.required:after{
	content: "*";
    color: red;
}
</style>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
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
        <label for="company" class=" form-control-label required">{{__('Footer Menu Name')}}</label>
        <input type="text" value="{{old('menu_name',optional(@$model)->menu_name)}}" name="menu_name" placeholder="Enter Menu Name" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('menu_name')}}</span>
    </div>

	@if(@$model->id)
	<div class="form-group">
        <label for="company" class=" form-control-label">{{__('Footer Menu Status')}}</label>
        <select class="form-control" name="status">
			<option value="">---{{__('Select Status')}}---</option>
			<option value="1" {{(old('status',optional(@$model)->status)=='1')?'selected':''}}>Active</option>
			<option value="0" {{(old('status',optional(@$model)->status)=='0')?'selected':''}}>Inactive</option>		
		</select>
        <span class="help-block is-invalid">{{$errors->first('status')}}</span>
    </div>
	@endif
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 
@include('includes.ckeditor',['ckFieldName'=>'desc'])
    
@endsection