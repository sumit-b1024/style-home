@if (count($errors) > 0)
    <ul id="login-validation-errors" class="validation-errors">
        @foreach ($errors->all() as $error)
            <li style="color:red;" class="validation-error-item">{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form method="post" action="{{ $path }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="project_id" class=" form-control-label">{{ __('Select Project') }}</label>
        {{-- <input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Payment Request Title" > --}}
        <select name="project_id" id="project_id" class="form-control">
            <option selected disabled>Select Project</option>
            @foreach ($project_details as $project)
                <option value="{{$project->id}}" @if (isset($model->project_detail_id) && $model->project_detail_id == $project->id) {{'selected'}} @endif >{{$project->title}}</option>
            @endforeach
        </select>
        <span class="help-block is-invalid">{{ $errors->first('project_id') }}</span>
    </div>
    <div class="form-group">
        <label for="company" class=" form-control-label">{{ __('Request Title') }}</label>
        <input type="text" value="{{ old('title', optional(@$model)->title) }}" name="title"
            placeholder="Enter Payment Request Title" class="form-control">
        <span class="help-block is-invalid">{{ $errors->first('title') }}</span>
    </div>
    <div class=" form-group">
        <label for="textarea-input" class=" form-control-label">{{ __('Message') }}</label>
        <div>
            <textarea name="message" id="default1" rows="9" class="form-control">{{ old('message', optional(@$model)->message) }}</textarea>
        </div>

        <span class="help-block is-invalid">{{ $errors->first('message') }}</span>

    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
    </div>

</form>
@section('additional_scripts')
    @include('includes/ckeditor_new')
@endsection
