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
        <label for="company" class=" form-control-label">{{__('Question')}}</label>
        <input type="text" value="{{old('question',optional(@$model)->question)}}" name="question" placeholder="Enter Question" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('question')}}</span>
    </div>
	<div class=" form-group">
        <label for="textarea-input" class=" form-control-label">{{__('Answer')}}</label>
        <div><textarea name="answer" id="default1" rows="9"   class="form-control">{{old('answer',optional(@$model)->answer)}}</textarea></div>

        <span class="help-block is-invalid">{{$errors->first('answer')}}</span>

    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection