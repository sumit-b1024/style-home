<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link href="{{ Request::root() }}/public/images/footerLogo.jpg" rel="icon">
    <link href="{{ Request::root() }}/public/images/footerLogo.jpg}" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/290940a338.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/all.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Style-Home</title>
    <style>
        .line1 {
            border-right: #fff solid 1px !important;
        }
    </style>
    <script>
        $(document).ready(function() {

            /*$(".next").click(function() {
                $('.pre').show();
                $showing = $('.first.visible').first();
                $next = $showing.next();
                $showing.removeClass("visible").hide();
                $next.addClass("visible").show();
                if (!$next.next().length) {
                    $(this).hide();
                }
            });*/
            $(".next1").click(function() {
                //Show previous button
                $('.pre').show();

                //Find the element that's currently showing
                $showing = $('.first.visible').first();

                //Find the next element
                $next = $showing.next();

                //Change which div is showing
                $showing.removeClass("visible").hide();
                $next.addClass("visible").show();

                //If there's no more elements, hide the NEXT button
                if (!$next.next().length) {
                    $(this).hide();
                }
            });

            $(".next01").click(function() {
                //Show previous button
                $('.pre').show();

                //Find the element that's currently showing
                $showing = $('.first.visible').first();

                //Find the next element
                $next = $showing.next();

                //Change which div is showing
                $showing.removeClass("visible").hide();
                $next.addClass("visible").show();

                //If there's no more elements, hide the NEXT button
                if (!$next.next().length) {
                    $(this).hide();
                }
            });

            $(".pre").click(function() {
                $('.next').show();

                $showing = $('.first.visible').first();
                $next = $showing.prev();
                $showing.removeClass("visible").hide();
                $next.addClass("visible").show();

                if (!$next.prev().length) {
                    $(this).hide();
                }
            });

        });
    </script>

</head>

<body>
    <!-- ======= Top Bar ======= -->

    <header>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg w-100">
                    <a class="navbar-brand" href="{{ route('frontend.home') }}">
                        <img src="{{ Request::root() }}/public/images/logo.png" alt="style-A-home">
                    </a>


                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse top_right" id="navbarSupportedContent">

                        <?php
                        use App\Models\HeaderMenu;
                        use App\Models\FooterMenu;
                        use App\Models\ProjectDetail;
                        use App\Models\Message;

                        $headermenus = HeaderMenu::where('status', 1)
                            ->where('parent_id', 0)
                            ->get();
                        $i = 1;
                        ?>
                        <ul class="top_menu">
                            @if (count($headermenus) > 0)
                                @foreach ($headermenus as $headermenu)
                                    @php
                                        $headersubmenus = HeaderMenu::where('status', 1)
                                            ->where('parent_id', $headermenu->id)
                                            ->get();
                                    @endphp
                                    @if (count($headersubmenus) > 0)
                                        @php
                                            $aaa = 'drop_down';
                                            $bb = "<span class='down_arrow'><i class='fas fa-chevron-down'></i></span>";
                                        @endphp
                                        <?php

                                        ?>
                                    @else
                                        @php
                                            $aaa = '';
                                            $bb = '';
                                        @endphp
                                    @endif
                                    @if (count($headermenus) == $i)
                                        <?php
                                        $xx = 'line1';
                                        ?>
                                    @else
                                        <?php
                                        $xx = '';
                                        ?>
                                    @endif
                                    @if ($headermenu->id == 3)
                                        <li class="nav-item active"><a class="{{ $aaa }} {{ $xx }}"
                                                href="{{ asset('/#pricing') }}">{{ $headermenu->menu_name }} </a></li>
                                    @elseif($headermenu->id == 2)
                                        <li class="nav-item "><a class="{{ $aaa }} {{ $xx }}"
                                                style="cursor: pointer;" data-toggle="modal"
                                                data-target="#myModal">{{ $headermenu->menu_name }}</a></li>
                                    @elseif($headermenu->id == 1)
                                        <li class="nav-item active"><a class="{{ $aaa }} {{ $xx }}"
                                                href="{{ asset('/#pricing') }}">{{ $headermenu->menu_name }} </a>
                                        </li>
                                    @else
                                        <li class="nav-item"><a class="{{ $aaa }} {{ $xx }}"
                                                href="{{ route("frontend.{$headermenu->menu_slug}") }}">{{ $headermenu->menu_name }}
                                                <?php echo $bb; ?></a></li>
                                    @endif

                                    @if (count($headersubmenus) > 0)
                                        <ul class="sub_menu">
                                            @foreach ($headersubmenus as $headersubmenu)
                                                <li><a
                                                        href="{{ route("frontend.{$headermenu->menu_slug}") }}">{{ $headersubmenu->menu_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <?php
                                    $i++;
                                    ?>
                                @endforeach
                            @endif

                        </ul>
                        @auth('web')
                            @inject('detailed_form', 'App\Models\DetailForm')
                            @inject('project_form', 'App\Models\ProjectDetail')
                            @php
                                $detailed_form = $detailed_form->where('user_id', Auth::guard('web')->id())->select(['id'])->orderBy('id','DESC')->first();
                                if(isset($detailed_form)){
                                    $project_form = $project_form->where('user_id', Auth::guard('web')->id())->where('detail_form_id',$detailed_form->id)->select(['id'])->orderBy('id','DESC')->first();
                                }
                            @endphp
                            @if(!isset($project_form))
                        <div class="dropdown for-pro_detail">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="pro_detail"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i> <span
                                    class="count bg-primary">1</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="pro_detail">

                                <p class="red">You have 1 notification</p>
                                {{-- @foreach ($chats as $chat) --}}
                                    <a class="dropdown-item media"
                                        href="{{ route('frontend.project.detail') }}">
                                        <span class="photo media-left"><img alt="avatar"
                                                src="{{ asset('public/backend/images/admin_avatar.jpg') }}"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Go to Project Details form</span>
                                        </div>
                                    </a>
                                {{-- @endforeach --}}

                            </div>

                        </div>
                        @endif
                        @endauth
                        {{-- @if (sizeof((array) $addcarts) > 0 && is_array($addcarts)) {{sizeof((array)$addcarts)}} @endif --}}
                        @auth('web')
                            @inject('addcarts', 'App\Models\AddToCart')
                            @php
                                $addcarts = $addcarts
                                    ->where('user_id', Auth::guard('web')->id())
                                    ->select(['id', 'product_id', 'user_id'])
                                    ->with([
                                        'products' => function ($q) {
                                            $q->select('id', 'title');
                                        },
                                    ])
                                    ->get();
                            @endphp
                            <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="added-cart"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='fas fa-shopping-cart'></i> <span class="count bg-primary">
                                        @if (sizeof((array) $addcarts) > 0)
                                            {{ $addcarts->count() }}
                                        @endif
                                    </span>
                                </button>
                                @if (sizeof($addcarts) > 0)
                                    <div class="dropdown-menu" aria-labelledby="added-cart">

                                        <p class="red">You added @if (sizeof((array) $addcarts) > 0)
                                                {{ $addcarts->count() }}
                                            @endif items</p>
                                        @foreach ($addcarts as $cart)
                                            <a class="dropdown-item media"
                                                href="{{ route('frontend.product.product_details', $cart->product_id) }}">
                                                <span class="photo media-left"></span>
                                                <div class="message media-body">
                                                    <span
                                                        class="name float-left text-truncate">{{ $cart->products->title }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                        <a href="{{ route('frontend.product.checkout') }}"
                                            class="btn btn-primary btn-sm text-center mt-2">Checkout</a>
                                    </div>
                                @endif
                            </div>
                        @endauth
                        <?php
						$user=auth()->user();
						if(!empty($user) ){
						if($user->role_id==2){
						$project_detail = ProjectDetail::where('user_id', $user->id)->where('status', 1)->first();
						if(!empty($project_detail)){
					    $currentUserId = $user->id;
						$id=0;
						$chats2=Message::select('project_details.title', 'messages.*')->where('messages.id','>',$id)->where('messages.view_status',0)->where('messages.to_id',$currentUserId)->join('project_details', 'project_details.id', 'messages.project_id')->orderBy("messages.id","ASC");
						$chats2=$chats2->get();

						$chats=Message::select('project_details.title', 'messages.*')->where('messages.id','>',$id)->where('messages.view_status',0)->where('messages.to_id',$currentUserId)->join('project_details', 'project_details.id', 'messages.project_id')->orderBy("messages.id","ASC")->groupBy('messages.project_id');
						$chats=$chats->get();

					    ?>
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i> <span
                                    class="count bg-primary">{{ count($chats2) }}</span>
                            </button>
                            <?php
							    if(count($chats)>0){
							    ?>
                            <div class="dropdown-menu" aria-labelledby="message">

                                <p class="red">You have {{ count($chats2) }} message</p>
                                @foreach ($chats as $chat)
                                    <a class="dropdown-item media"
                                        href="{{ route('frontend.designer.chat', ['model' => $chat->project_id]) }}">
                                        <span class="photo media-left"><img alt="avatar"
                                                src="{{ asset('public/backend/images/admin_avatar.jpg') }}"></span>
                                        <div class="message media-body">
                                            <span class="name float-left">{{ $chat->title }}</span>
                                            <!--<p>{{ $chat->message }}</p>-->
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <?php
						}
						?>
                        </div>

                        <a href="{{ route('frontend.project') }}"
                            class="btn btn-outline-success my-2 my-sm-0 login_btn">My Projects</a>
                        <?php
						}
						?>
                        <a href="{{ route('admin.customer.logout') }}"
                            class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Logout</a>
                        <?php
						}
						else{
						?>
                        <ul class="my-2 my-lg-0 account_bt">
                            <a href="{{ route('frontend.login') }}"
                                class="btn btn-outline-success my-2 my-sm-0 login_btn">Login</a>
                            <a href="{{ route('frontend.signup') }}"
                                class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Sign Up</a>
                        </ul>
                        <?php
						}
						}
						else{
						?>
                        <ul class="my-2 my-lg-0 account_bt">
                            <a href="{{ route('frontend.login') }}"
                                class="btn btn-outline-success my-2 my-sm-0 login_btn">Login</a>
                            <a href="{{ route('frontend.signup') }}"
                                class="btn btn-outline-success my-2 my-sm-0 signUp_btn">Sign Up</a>
                        </ul>
                        <?php
						}
						?>

                    </div>

                </nav>
            </div>
        </div>
    </header>
    <div id="entry-content">
        @yield('content')
    </div>
    <!-- ======= Footer ======= -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 footer_fst">
                    <img src="{{ Request::root() }}/public/images/footerLogo.png" alt="style-A-home">
                    <!---<p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    </p>-->
                    <ul class="social">
                        <li><a target="_blank" href="{{ $setting->facebook_page_link }}"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        {{-- <li><a target="_blank" href="{{$setting->twitter_page_link}}"><i class="fab fa-twitter"></i></a></li> --}}
                        <li><a target="_blank" href="{{ $setting->instagram_page_link }}"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li><a target="_blank" href="{{ $setting->pinterest_page_link }}"><i
                                    class="fab fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <ul class="company">
                        <label>Company</label>
                        <li><a href="{{ route('frontend.contact') }}">Contact us </a></li>

                        <li><a href="{{ route('frontend.faq') }}">FAQ </a></li>
                        <li><a href="{{ route('frontend.career') }}">Careers </a></li>
                        <?php
                        $footer_menus = FooterMenu::where('status', 1)
                            ->where('parent_id', 0)
                            ->get();
                        ?>
                        @if (count($footer_menus))
                            @foreach ($footer_menus as $footer_menu)
                                <li><a href="{{ route('frontend.footer.menu', ['slug' => $footer_menu->menu_slug]) }}">{{ $footer_menu->menu_name }}
                                    </a></li>
                            @endforeach
                        @endif
                        <!--
                        <li><a href="{{ route('frontend.career') }}">Careers </a></li>-->
                        <!--<li><a href="{{ route('frontend.design.career') }}">Design Careers </a></li>
                        <li><a href="{{ route('frontend.our.book') }}">Our Book </a></li>-->
                    </ul>
                </div>

                <!-- <div class="col-lg-2 col-md-6 col-sm-4">
                    <ul class="company">


                        <label>Explore</label>
                        <li><a href="{{ route('frontend.financing') }}">Financing </a></li>
                        <li><a href="{{ route('frontend.stories') }}">Stories </a></li>
                        <li><a href="{{ route('frontend.gift.card') }}">Gift Cards </a></li>
                        <li><a href="{{ route('frontend.refer.earn') }}">Refer & Earn </a></li>
                        <li><a href="{{ route('frontend.help.center') }}">Help Center </a></li>
                        <li><a href="{{ route('frontend.current.promotion') }}">Current Promotions </a></li>
                        <li><a href="{{ route('frontend.review') }}">Reviews </a></li>

                    </ul></div>-->

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <ul class="company">
                        <label>Contact us</label>
                        <li><a href="tel:{{ $setting->contact_number }}">call: {{ $setting->contact_number }} </a>
                        </li>
                        <!--<li><a href="#">email </a></li>-->
                        <li><a href="mailto:{{ $setting->contact_email }}">email: {{ $setting->contact_email }} </a>
                        </li>
                        <li><a href="#">Address: {{ $setting->office_address }} </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="footerEnd">
        <div class="container">
            <div class="row">
                <p>© 2021 , All Rights Reserved.</p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $needle='chat';
    if(strpos($actual_link, $needle ) == false){
    ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <?php
    }
    ?>
</body>

</html>
