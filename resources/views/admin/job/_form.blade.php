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
        <label for="company" class=" form-control-label">{{__('Name')}}</label>
        <input type="text" value="{{old('name',optional(@$model)->name)}}" name="name" placeholder="Enter Name" class="form-control">
        <span class="help-block is-invalid">{{$errors->first('name')}}</span>
    </div>

    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Category')}}</label>
        <select class="form-control" name="job_category">
            <option value="">---{{__('Select')}}---</option>
            @foreach(Job::getCategories() as $key=>$type)
                 <option value="{{$key}}" {{(old('job_category',optional(@$model)->job_category)==$key)?'selected':''}}>{{$type}}</option>
            @endforeach
        </select>
        
        <span class="help-block is-invalid">{{$errors->first('job_category')}}</span>
    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Location')}}</label>
        <input type="text" value="{{old('location',optional(@$model)->location)}}" name="location"   class="form-control">
        <span class="help-block is-invalid">{{$errors->first('location')}}</span>
    </div>
    
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Image')}}</label>
        <input type="file"  name="image"   class="form-control">
        @if(!empty($model->image))
    <img width="120px" src="{{$model->getJobImage()}}"/>
        @endif
        <span class="help-block is-invalid">{{$errors->first('image')}}</span>
    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{__('Job Description')}}</label>
        <textarea  id="desc" name="description"   class="form-control">{{old('description',optional(@$model)->description)}}</textarea>
       
        <span class="help-block is-invalid">{{$errors->first('description')}}</span>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>

</form>
@section("additional_scripts")

@include('includes.ckeditor',['ckFieldName'=>'education_desc']) 
@include('includes.ckeditor',['ckFieldName'=>'desc'])
@include('includes.ckeditor',['ckFieldName'=>'company_overview'])

@include('includes.ckeditor',['ckFieldName'=>'required_knowledge_desc'])

@endsection