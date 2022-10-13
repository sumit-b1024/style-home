<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Style-Home - Design Login</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ Request::root() }}/public/images/footerLogo.jpg">
    <link rel="shortcut icon" href="{{ Request::root() }}/public/images/footerLogo.jpg">

    <link rel="stylesheet" href="{{ asset('public/backend/css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/pe-icon-7-stroke.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="{{ route('frontend.home') }}"><img class="align-content"
                            src="{{ Request::root() }}/public/images/footerLogo.jpg" alt=""></a>
                </div>
                <?php

                ?>
                @if (Session::has('accountError'))
                    {{ Session::get('accountError') }}
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {!! session('error') !!}
                    </div>
                @endif
                <div class="login-form">
                    @if (session()->has('success'))
                        <span class="success-msg" style="color: green;">{!! session('success') !!}</span>
                    @endif
                    @if (session()->has('error'))
                        <span class="danger-msg" style="color: red;">{!! session('error') !!}</span>
                    @endif
                    <h3>Reset Password</h3>
                    <form action="{{ route('frontend.designer.reset.password.post') }}" method="post">
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
                        <input type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="login"
                            value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
