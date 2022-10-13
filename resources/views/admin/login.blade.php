<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Style-Home - Login</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{Request::root()}}/public/images/footerLogo.jpg">
    <link rel="shortcut icon" href="{{Request::root()}}/public/images/footerLogo.jpg">

    <link rel="stylesheet" href="{{asset('public/backend/css/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/pe-icon-7-stroke.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="{{route('frontend.home')}}"><img class="align-content" src="{{Request::root()}}/public/images/footerLogo.jpg" alt=""></a>
                </div>
                <?php 
             
                ?>
                @if(session()->has('error'))
                <div class="alert alert-danger">
  				<strong>Error!</strong>  {!! session('error') !!}
				</div>
				@endif
                <div class="login-form">
                    <form action="{{route('admin.login.post')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input name="email" type="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                              <span    class="help-block error"> {{$errors->first('email')}}</span>  
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                              <span    class="help-block error"> {{$errors->first('password')}}</span>  
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                       
                      
                    </form>
                </div>
            </div>
        </div>
    </div>

    

</body>
</html>
