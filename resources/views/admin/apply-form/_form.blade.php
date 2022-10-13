<?php 
use App\Models\ApplyForm;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<style>
#option{
display:none;
}
</style>

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
        <label for="company" class=" form-control-label">{{__('Label')}}</label>
        <input type="text" value="{{old('label',optional(@$model)->label)}}" name="label" placeholder="Enter Label" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('label')}}</span>
    </div>
	<div class=" form-group">
        <label for="company" class=" form-control-label">{{__('Type')}}</label>
        <select class="form-control" name="type" onchange="test(this)">
            <option value="">---{{__('Select')}}---</option>
            @foreach(ApplyForm::getInputTypes() as $key=>$type)
                 <option value="{{$key}}" {{(old('type',optional(@$model)->type)==$key)?'selected':''}}>{{$type}}</option>
            @endforeach
        </select>

        <span class="help-block is-invalid">{{$errors->first('type')}}</span>

    </div>
	@if(@$model->type==1)
	@php
	$aa = "option";
	@endphp
	@elseif(@$model->id=="")
		@php
		$aa = "option";
	
	@endphp
	@else
		@php
		
	$aa = "";
	@endphp
		@endif
	<div class="form-actions form-group" id="{{$aa}}">
	<div class="input-group control-group increment" >
	
	  
	  <input type="text" name="options[]" class="form-control" placeholder="Options">
	 
	  <div class="input-group-btn"> 
		<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
	  </div>
	  
	</div>
	<div class="clone hide">
	  <div class="control-group input-group" style="margin-top:10px">
	  
	  <input type="text" name="options[]" class="form-control" placeholder="Options">
	 
		
		<div class="input-group-btn"> 
		  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
		</div>
		
	  </div>
	</div>
	</div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
	@if(@$model->id)
	@foreach($options as $option)
	<div class=" block_img"><p>{{$option->option_value}}</p>
	
	<a class="clos cancel-rule1" href="{{route('admin.apply.job.form.delete.option',['model'=>$option->id])}}" >
	<span class="icon_close"><i class="fa fa-times-circle" aria-hidden="true"></i></span></a>
	</div>
	@endforeach
	@endif
@section("additional_scripts")

 @include("includes/ckeditor_new")

<script type="text/javascript">
		$(document).ready(function() {
		  $(".btn-success").click(function(){ 
			  var html = $(".clone").html();
			  $(".increment").after(html);
		  });
		  $("body").on("click",".btn-danger",function(){ 
			  $(this).parents(".control-group").remove();
		  });
		});
		</script>
		<script>
		function test(data){
			var type = data.value;
			if(type==2){
				 $("#option").show();
			}
			else{
				 $("#option").hide();
			}
		}
		</script>
@endsection