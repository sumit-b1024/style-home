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
                    <h3>Reset New Password</h3>
                    <form action="{{route('frontend.reset.password.new.post')}}" method="post">
		            @csrf
		            <input type="hidden" name="user_id" value="{{$userId}}">
                        <p class="form-group form-row form-row-wide">		<label for="username">New Password <span class="required">*</span></label>
                        <input type="password" class="input-text form-control" name="password" id="password" value="">
                        <span class="help-block is-invalid" style="color:red;">{{$errors->first('password')}}</span>
                        
                        </p>
                        <p class="form-group form-row form-row-wide">		<label for="username">Password Confirmation <span class="required">*</span></label>
                        <input type="password" class="input-text form-control" name="password_confirmation" id="password_confirmation" value="">
                        <span class="help-block is-invalid" style="color:red;">{{$errors->first('password_confirmation')}}</span>
                        
                        </p>
                        <input type="submit" class="btn-block read_more" name="login" value="Reset">
                                </form>
                                </div>
                                </div>
                
            </div>
        </div>
    </section>

    
@endsection
