@extends('layouts.frontend')
@section('content')
    <section class="designer_cont project_main">
        <h4>Login </h4>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 login_page">
                    <div class="img_style"><img src="{{asset('/public/img/login_page_img.jpg')}}"
                            alt="style-A-home"></div>
                    <div class="login_form_details">
                        @if (session()->has('success'))
                            <span class="success-msg" style="color: green;">{!! session('success') !!}</span>
                        @endif
                        @if (session()->has('error'))
                            <span class="danger-msg" style="color: red;">{!! session('error') !!}</span>
                        @endif
                        <h3>Reset Password</h3>
                        <form action="{{ route('frontend.reset.password.post') }}" method="post">
                            @csrf
                            <p class="form-group form-row form-row-wide"> <label for="username">Username or email address
                                    <span class="required">*</span></label>
                                <input type="text" class="input-text form-control" name="username" id="username"
                                    value="">
                                <span class="help-block is-invalid"
                                    style="color:red;">{{ $errors->first('username') }}</span>
                                @if (Session::has('emailError'))
                                    <span class="help-block is-invalid" style="color:red;">
                                        {{ Session::get('emailError') }}
                                    </span>
                                @endif
                            </p>

                            <input type="submit" class="btn-block read_more" name="login" value="Submit">
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @extends('layouts.modal')
    </section>
@endsection
