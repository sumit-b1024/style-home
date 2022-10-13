@extends('layouts.frontend')@section('content')
<section class="designer_cont project_main"><h4>Signup</h4>
<div class="container">
    <div class="row"><div class="col-sm-12 login_page sign_up_page">
        <div class="img_style"><img src="{{asset('/public/img/login_page_img.jpg')}}" alt="style-A-home"></div>
        @if(session()->has('success'))<span class="success-msg" style="color: green;">{!!session('success')!!}</span>
        @endif
        <div class="login_form_details"><h3>Sign Up for Style a Home</h3>
        <form action="{{route('frontend.register.post')}}"  method="post">
		@csrf
        <p class="form-group">
            <input type="text" class="input-text form-control" name="first_name" id="name" value="{{old('first_name')}}" placeholder="First Name">
            <span class="help-block is-invalid" style="color:red;">{{$errors->first('first_name')}}</span>
        </p>
        <p class="form-group">
            <input type="text" class="input-text form-control" name="last_name" id="name" value="{{old('last_name')}}" placeholder="Last Name">
            
        </p>
        <p class="form-group"><input type="text" class="input-text form-control" name="email" id="email" value="{{old('email')}}" placeholder="Email">
        <span class="help-block is-invalid" style="color:red;">{{$errors->first('email')}}</span>
        </p>
        <p class="form-group"><input class="input-text form-control" type="password" name="password" id="password" placeholder="Password">
        <span class="help-block is-invalid" style="color:red;">{{$errors->first('password')}}</span></p>
        <p class="form-group"><input class="input-text form-control" type="password" name="password_confirmation" id="password" placeholder="Confirm Password">
        <span class="help-block is-invalid" style="color:red;">{{$errors->first('password_confirmation')}}</span>
        </p>
        
            <input type="submit" class="btn-block read_more" name="signup" value="Sign Up to Get Started"><p class="sign_up_txt">Already have an account? <a href="{{route('frontend.login')}}">Sign In</a></p></form>
            </div>
            </div>
            </div>
            </div>
            @extends('layouts.modal')
            </section>    
            @endsection
