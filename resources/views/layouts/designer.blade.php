<!doctype html><html class="no-js" lang=""><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}} - @if(View::hasSection('title'))        @yield('title') @else {{__('Admin')}} @endif</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{Request::root()}}/public/images/footerLogo.jpg" rel="icon">
	<link href="{{Request::root()}}/public/images/footerLogo.jpg}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{asset('public/backend/css/normalize.min.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.min.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/themify-icons.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/pe-icon-7-stroke.min.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/flag-icon.min.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/cs-skin-elastic.css')}}">    <link rel="stylesheet" href="{{asset('public/backend/css/style.css')}}">    <link href="{{asset('public/backend/css/chartist.min.css')}}" rel="stylesheet">    <link href="{{asset('public/backend/css/jqvmap.min.css')}}" rel="stylesheet">    <link href="{{asset('public/backend/css/weather-icons.css')}}" rel="stylesheet" />    <link href="{{asset('public/backend/css/fullcalendar.min.css')}}" rel="stylesheet" /></head>

<body>    <!-- Left Panel -->    
<?php
use App\Models\ProjectDetail;
use App\Models\Message;
?>
<aside id="left-panel" class="left-panel">       
 <nav class="navbar navbar-expand-sm navbar-default">           
 <div id="main-menu" class="main-menu collapse navbar-collapse">                
 <ul class="nav navbar-nav">                    
 <li class="active"><a href="{{route('admin.designer.dashboard')}}"><i class="menu-icon fa fa-laptop"></i>{{__('Dashboard')}} </a></li>                    
 <li class="menu-title">{{__('Main')}}</li>										 
 <li class="menu-item-has-children dropdown"><a href="{{route('admin.designer.dashboard')}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user menu-icon" aria-hidden="true"></i>{{__('Bio')}}</a>
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.bio')}}">{{__('view')}}</a></li>                            

 </ul>                    
 </li>										 
 <li class="menu-item-has-children dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-window-restore menu-icon" aria-hidden="true"></i>{{__('Projects')}}</a>  
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.project.list')}}">{{__('Listing')}}</a></li>                            

 </ul>  
</li>
<!--<li class="menu-item-has-children dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-window-restore menu-icon" aria-hidden="true"></i>{{__('Customer')}}</a>  
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.customer')}}">{{__('Listing')}}</a></li> 
 </ul>  
</li>-->
<li  class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-file-text-o menu-icon" aria-hidden="true"></i>{{__('T&Cs with designer')}}</a>
<ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.term.condition')}}">{{__('view')}}</a></li>                            

 </ul>
</li>
										
 <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user menu-icon" aria-hidden="true"></i>{{__('Profile')}}</a>
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.profile')}}">{{__('update')}}</a></li>                            

 </ul>
 </li>	
  <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user menu-icon" aria-hidden="true"></i>{{__('Faq')}}</a>
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.faq')}}">{{__('view')}}</a></li>                            

 </ul>
 </li>
 <li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user menu-icon" aria-hidden="true"></i>{{__('Payment')}}</a>
 <ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('designer.payment.request')}}">{{__('Payment Request')}}</a></li>                            

 </ul>
 </li>
<li class="menu-item-has-children dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-envelope-o menu-icon" aria-hidden="true"></i>{{__('Designer Support Email')}}</a>
<ul class="sub-menu children dropdown-menu">                            
 <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{route('admin.designer.support.email')}}">{{__('view')}}</a></li>                            

 </ul>
 </li>  
 
 </ul>            
 </div>            <!-- /.navbar-collapse -->        </nav>    
 </aside>    <!-- /#left-panel -->    <!-- Right Panel -->    
 
 <div id="right-panel" class="right-panel">        <!-- Header-->        
 <header id="header" class="header">           
 <div class="top-left">                
 <div class="navbar-header">                    
 <a class="navbar-brand" href="{{route('admin.designer.dashboard')}}" style="color: #00c292; font-weight: 800; font-size: 32px;">                        
 <img width="43px" src="{{Request::root()}}/public/images/logo.png"> Designer</a>                
 </div>            
 </div>           
 <div class="top-right">               
 <div class="header-menu">   
 <div class="header-left">
      <!--chat notify-->
	<?php
	$currentUserId=Auth()->user()->id;
        $id=0;
		$chats2=Message::select('project_details.title', 'messages.*')->where('messages.id','>',$id)->where('messages.view_status',0)->where('messages.to_id',$currentUserId)->join('project_details', 'project_details.id', 'messages.project_id')->orderBy("messages.id","ASC");
		$chats2=$chats2->get();
		
        $chats=Message::select('project_details.title', 'messages.*')->where('messages.id','>',$id)->where('messages.view_status',0)->where('messages.to_id',$currentUserId)->join('project_details', 'project_details.id', 'messages.project_id')->orderBy("messages.id","ASC")->groupBy('messages.project_id');
		$chats=$chats->get();
		
	?>
	<div class="dropdown for-message">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-envelope"></i> <span class="count bg-primary">{{count($chats2)}}</span>
		</button>
		<?php
		    if(count($chats)>0){
		    ?>
		<div class="dropdown-menu" aria-labelledby="message">
		    
			<p class="red">You have {{count($chats2)}} message</p>
			@foreach($chats as $chat)
			<a class="dropdown-item media" href="{{route('admin.designer.customer.chat',['model'=>$chat->project_id])}}"> <span class="photo media-left"><img alt="avatar" src="{{asset('public/backend/images/admin_avatar.jpg')}}"></span>
				<div class="message media-body">
					<span class="name float-left">{{$chat->title}}</span> 
					<!--<p>{{$chat->message}}</p>-->
				</div>
			</a>
			@endforeach
			
		</div>
		<?php
		}
		?>
	</div>
	
 <!--chat notify-->
     <?php
     $user=auth()->user();
        $projects = ProjectDetail::select('detail_forms.project_duration','detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name','users.last_name', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')->join('users', 'users.id', 'project_details.user_id')
            ->where("detail_forms.designer", $user->id)->where("project_details.status",1)->where("project_details.view_status",0)->get();
    if(count($projects)>0){
    
     ?>
     <div class="dropdown for-notification">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"></i> <span class="count bg-danger">{{count($projects)}}</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="notification">
            <p class="red">You have {{count($projects)}} New Project</p>
            @foreach($projects as $project)
            <a class="dropdown-item media" href="{{route('admin.designer.project.view',['project_id'=>$project->id])}}"> <i class="fa fa-check"></i>
                <p>{{$project->title}}</p>
            </a> 
            @endforeach
        </div>
    </div>
    <?php
    }
    ?>
     </div>
 <div class="user-area dropdown float-right">                       
 <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="user-avatar rounded-circle" src="{{asset('public/backend/images/admin_avatar.jpg')}}" alt="User Avatar"></a>						
 <?php $user_id = \Auth::user()->id;?>                        
 <div class="user-menu dropdown-menu">							
 <a class="nav-link" href="{{route('frontend.home')}}"><i class="fa fa- user"></i>{{__('Visit site')}}</a>
 <a class="nav-link" href="{{route('admin.designer.logout')}}"><i class="fa fa-power -off"></i>Logout</a>                        
 </div>                   
 </div>                
 </div>            
 </div>        
 </header>        <!-- /#header -->        <!-- Content -->        
 <div class="content"> @yield('content') </div>        <!-- /.content -->        
 <div class="clearfix"></div>        <!-- Footer -->        
 
 
 
 <footer class="site-footer">            
 <div class="footer-inner bg-white">                
 <div class="row">                    
 <div class="col-sm-12" style="text-align:center;">Copyright &copy; 2020 All rights reserved</div>                    <!--<div class="col-sm-6 text-right">                        Designed by <a href="https://colorlib.com">Colorlib</a>                    </div>-->               
 </div></div>        
 </footer>        <!-- /.site-footer -->    
 
 </div>    <!-- /#right-panel -->    <!-- Scripts -->    <script src="{{asset('public/backend/js/popper.min.js')}}"></script>    <script src="{{asset('public/backend/js/jquery.min.js')}}"></script>    <script src="{{asset('public/backend/js/bootstrap.min.js')}}"></script>    <script src="{{asset('public/backend/js/jquery.matchHeight.min.js')}}"></script>    <script src="{{asset('public/backend/js/main.js')}}"></script>    <script src="{{asset('public/assets/ckeditor/ckeditor.js')}}"></script>    <script type="text/javascript">            CKEDITOR.config.contentsCss = ["{{asset('public/css/post-8.css')}}","{{asset('public/css/style.css')}}" ,"{{asset('public/css/frontend.min.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/global.css')}}","{{asset('public/css/post-8.css')}}"];                CKEDITOR.config.allowedContent = true;        CKEDITOR.config.protectedSource.push(/<i[^>]*><\/i>/g);                CKEDITOR.dtd.$removeEmpty.i = 0;        CKEDITOR.config.extraAllowedContent = 'i';                CKEDITOR.dtd.$removeEmpty['i'] = false;                CKEDITOR.dtd.$removeEmpty.i = 0;    </script>    @yield('additional_scripts')</body></html>