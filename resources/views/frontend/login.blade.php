@extends('layouts.frontend')
@section('content')    <section class="designer_cont project_main">
        <h4>Login </h4>
        <div class="container">
            <div class="row"><div class="col-sm-12 login_page">
                <div class="img_style"><img src="{{asset('/public/img/login_page_img.jpg')}}" alt="style-A-home"></div>
                <div class="login_form_details">
                    @if(session()->has('success'))<span class="success-msg" style="color: green;">{!!session('success')!!}</span>
                    @endif
                    @if(session()->has('error'))<span class="danger-msg" style="color: red;">{!!session('error')!!}</span>
                    @endif
                    <h3>Login</h3>
                    <form action="{{route('frontend.login.post')}}" method="post">
		            @csrf
                        <p class="form-group form-row form-row-wide">		<label for="username">Username or email address <span class="required">*</span></label>
                        <input type="text" class="input-text form-control" name="username" id="username" value="">
                        <span class="help-block is-invalid" style="color:red;">{{$errors->first('username')}}</span>
                        @if(Session::has('emailError'))
                        <span class="help-block is-invalid" style="color:red;">
                		{{Session::get('emailError')}}
                		</span>
                		@endif
                        </p>
                        <p class="form-group form-row form-row-wide">		<label for="password">Password <span class="required">*</span></label>
                        <input class="input-text form-control" type="password" name="password" id="password">
                        <span class="help-block is-invalid" style="color:red;">{{$errors->first('password')}}</span>
                        @if(Session::has('passwordError'))
                        <span class="help-block is-invalid" style="color:red;">
                		{{Session::get('passwordError')}}
                		</span>
                		@endif
                        </p>
                        <div class="form-group clearfix">
                            <span for="rememberme" class="inline pull-left"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me </span><span class="lost_password pull-right">
                                <a href="{{route('frontend.reset.password')}}">Forgot your password?</a>
                                </span></div><input type="submit" class="btn-block read_more" name="login" value="Login"><p class="sign_up_txt">Don't have an account? <a href="{{route('frontend.signup')}}">Join Now</a></p>
                                </form>
                                </div>
                                </div>

            </div>
        </div>
        @extends('layouts.modal')
    </section>


@endsection
