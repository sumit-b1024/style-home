<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}} - @if(View::hasSection('title'))
        @yield('title') @else {{__('Admin')}} @endif</title>
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
    <link href="{{asset('public/backend/css/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/jqvmap.min.css')}}" rel="stylesheet">

    <link href="{{asset('public/backend/css/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('public/backend/css/fullcalendar.min.css')}}" rel="stylesheet" />


</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('admin.dashboard')}}"><i class="menu-icon fa fa-laptop"></i>{{__('Dashboard')}} </a></li>
                    <li class="menu-title">{{__('CMS PAGES')}}</li>
                    <!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Homepage')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.homepage.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.homepage.section',['section_index'=>2])}}">{{__('Section')}} 2</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.homepage.section',['section_index'=>3])}}">{{__('Section')}} 3</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.homepage.section',['section_index'=>4])}}">{{__('Section')}} 4</a></li>
                        </ul>
                    </li>
                    <!--<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('How It Works')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.how.it.work.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>-->
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Terms Conditions')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-id-badge"></i><a href="{{route('admin.terms.conditions.section',['section_index'=>2])}}">{{__('Designer')}}</a></li>

                        </ul>
                    </li>
                    <!--<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Career')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.career.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Privacy Policy')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.privacyPolicy.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Terms Conditions')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.terms.conditions.section',['section_index'=>1])}}">{{__('Customer')}} </a></li>
							<li><i class="fa fa-id-badge"></i><a href="{{route('admin.terms.conditions.section',['section_index'=>2])}}">{{__('Designer')}}</a></li>

                        </ul>
                    </li>-->
                    <!--<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Design Career')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.design.career.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Our Book')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.our.book.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Financing')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.financing.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Stories')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.stories.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Gift Cards')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.gift.card.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Refer & Earn')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.refer.earn.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Help Center')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.help.center.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Current Promotion')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.current.promotion.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Reviews')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.review.section',['section_index'=>1])}}">{{__('Section')}} 1</a></li>

                        </ul>
                    </li>-->
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>{{__('Banners')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('admin.banner')}}">{{__('Manage')}} </a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>{{__('Page Title')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('admin.page.title')}}">{{__('Manage')}} </a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>{{__('Other Information')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('admin.other.otherInformation.post')}}">{{__('Update')}} </a></li>
                        </ul>
                    </li>
                    <li class="menu-title">{{__('Main')}}</li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Users')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.user.customer')}}">{{__('Customer')}}</a></li>
							<li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.user.designer')}}">{{__('Designer')}}</a></li>
							<li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.payment')}}">{{__('Designer Payment')}}</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Applied Designer')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.applied.designer')}}">{{__('View')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Chat communication')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.chat.communication')}}">{{__('View')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Questionnaire')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.quiz.category')}}">{{__('Category')}}</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.quiz.question')}}">{{__('Questions')}}</a></li>
                            <!--<li><i class="fa fa-id-badge"></i><a href="{{route('admin.quiz.result')}}">{{__('Quiz Result')}}</a></li>-->
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>{{__('Form Wizard')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="{{route('admin.form.question')}}">{{__('Questions')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Customer Project')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.customer.project')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Menu Management')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.header.menu')}}">{{__('Header Menu')}}</a></li>
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.footer.menu')}}">{{__('Footer Menu')}}</a></li>

                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Apply Job Form')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.apply.job.form')}}">{{__('manage')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Enquiries')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.enquiry')}}">{{__('View')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>{{__('Faq')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('admin.faq')}}">{{__('Customer')}} </a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('admin.faq.designer')}}">{{__('Designer')}} </a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>{{__('Jobs')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('admin.job')}}">{{__('Listing')}} </a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Email Template')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.email.template')}}">{{__('Manage')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Package Management')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.subscription')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Testimonial')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.testimonial')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Coupon')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.coupon')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Product')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.products')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Additional Filter')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.filters')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>{{__('Customer Survey')}}
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.survey')}}">{{__('Listing')}}</a></li>

                        </ul>
                    </li>
                    <!-- /.menu-title -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('admin.dashboard')}}" style="color: #00c292; font-weight: 800; font-size: 32px;">
                        <img width="60px" src="{{Request::root()}}/public/images/footerLogo.jpg">
                        Admin </a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">


                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="user-avatar rounded-circle" src="{{asset('public/backend/images/admin_avatar.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">

                                <a class="nav-link" href="{{route('admin.logout')}}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            @if(session()->has('success'))

            <div class="alert alert-success" role="alert">{!! session('success')
                !!}</div>
            @endif @if(session()->has('error'))

            <div class="alert alert-danger" role="alert">{!! session('error') !!}
            </div>
            @endif @yield('content')
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->

    <script src="{{asset('public/backend/js/popper.min.js')}}"></script>

    <script src="{{asset('public/backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('public/backend/js/jquery.matchHeight.min.js')}}"></script>

    <script src="{{asset('public/backend/js/main.js')}}"></script>

    <script src="{{asset('public/assets/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">


        CKEDITOR.config.contentsCss = ["{{asset('public/css/post-8.css')}}","{{asset('public/css/style.css')}}" ,"{{asset('public/css/frontend.min.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/post-8.css')}}"];

        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.protectedSource.push(/<i[^>]*><\/i>/g);

        CKEDITOR.dtd.$removeEmpty.i = 0;
        CKEDITOR.config.extraAllowedContent = 'i';

        CKEDITOR.dtd.$removeEmpty['i'] = false;

        CKEDITOR.dtd.$removeEmpty.i = 0;
    </script>
    @yield('additional_scripts')
</body>
</html>
