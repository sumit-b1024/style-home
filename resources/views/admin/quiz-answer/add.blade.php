@extends('layouts.admin')
@section('content')
    <link href="{{ asset('public/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('public/select2/select2.min.css') }}" rel="stylesheet">
    <style>
        .error {
            color: #ff0000;
        }
    </style>

    <div class="animated fadeIn">
        <div class="row"></div>
        <!--/.col-->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('Quiz Question Answer') }}</strong><small> {{ __('Form') }}</small>
                    <div class="pull-right"><a class="btn btn-warning"
                            href="{{ route('admin.quiz.answer', ['question_id' => $question_id]) }}">Back <i
                                class="fa fa-arrow-circle-left"></i></a></div>
                </div>
                <div class="card-body card-block">
                    <form method="post" action="{{ route('admin.quiz.answer.add.post', ['question_id' => $question_id]) }}"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- <div class="form-group">
                            <label for="company" class=" form-control-label">{{ __('Quiz Category') }}</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">---{{ __('Select') }}---</option>
                                @foreach ($quiz_categories as $key => $quiz_category)
                                    <option value="{{ $key }}"
                                        {{ old('category_id', optional(@$model)->category_id) == $key ? 'selected' : '' }}>
                                        {{ $quiz_category }}</option>
                                @endforeach
                            </select>
                            <span class="help-block is-invalid error">{{ $errors->first('category_id') }}</span>
                        </div> --}}
                        <div class="form-group">
                            <label for="category_id" class=" form-control-label">{{ __('Quiz Category') }}</label>
                            <select class="form-control select2" name="category_id[]" id="category_id" multiple>
                                @foreach ($quiz_categories as $key => $quiz_category)
                                    <option value="{{ $key }}"
                                        {{ old('category_id', optional(@$model)->category_id) == $key ? 'selected' : '' }}>
                                        {{ $quiz_category }}</option>
                                @endforeach
                            </select>
                            <span class="help-block is-invalid error">{{ $errors->first('category_id') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company" class=" form-control-label">{{ __('Title') }}</label>
                            <input type="text" value="{{ old('title', optional(@$model)->title) }}" name="title"
                                placeholder="Enter Title" class="form-control">
                            <span class="help-block is-invalid error">{{ $errors->first('title') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="company" class=" form-control-label">{{ __('Answer Image') }}</label>
                            <input type="file" name="image" class="form-control">
                            @if (!empty($model->image))
                                <img width="120px" src="{{ $model->getQuizAnswerImage() }}" />
                            @endif
                            <span class="help-block is-invalid error">{{ $errors->first('image') }}</span>
                        </div>


                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        $('select').select2();
    </script>
@endsection
