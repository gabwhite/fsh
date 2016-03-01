<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Food Service Hound - @yield('title')</title>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="{{url('/img/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{url('/img/appleicon.png')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

 
    <link rel="stylesheet" id="magnific-popup-css"  href="{{url('/js/vendor/magnific-popup/magnific.css?ver=3.0.4')}}" type="text/css" media="all" />
   
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:600,300,700,300italic,700italic|Josefin+Sans:400,700,700italic,400italic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{url('/js/vendor/jstree/themes/default/style.min.css')}}">

    <!-- <link rel="stylesheet" href="{{url('/css/flexslider.css')}}"> -->
   
    <link rel="stylesheet" href="{{url('/css/app.css')}}">

    <script src="{{url('js/kleo/init.js')}}"></script>
    <script src="{{url('js/kleo/modernizr.custom.46504.js')}}"></script>
    

    <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>

    @yield('css')

</head>

<body>

    <div id="header" class="row" style="margin-right: 0;">

        <nav class="navbar navbar-default" role="navigation">

            <div class="container clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="col-xs-5 col-md-3">
                    <div class="navbar-header">

                        <a href="{{url('/')}}" class="navbar-brand"> 
                            <img id="logo_img" title="FoodserviceHound.com" src="{{url('/img/horizontallogoFoodServiceHound.png')}}" alt="FoodserviceHound.com">
                        </a>
                    </div>
                </div>
            

                <div class="col-xs-7 col-md-4 pull-right">    

                    <!-- Collect the nav links, forms, and other content for toggling -->

                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                        

                            
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    @if(\Session::has(config('app.session_key_avatar')))
                                        <img class="menu-img" src="{{url(config('app.avatar_storage') . '/' . \Session::get(config('app.session_key_avatar')))}}" title="{{trans('ui.user_label_currentavatar')}}"/>
                                    @else
                                        <img class="menu-img" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" />
                                    @endif

                                    <span class="username">{{Auth::user()->name}}</span>
                                    <img class="drop-arrow" src="{{url('/img/icons/chevron-down.svg')}}" alt="drop-down">

                                </a>

                                <ul class="dropdown-menu pull-right">
                                    
                                    <li class="menu-item">
                                        <a class="product-search" title="{{trans('ui.navigation_productsearch')}}" href="{{url('/product/search')}}">{{trans('ui.navigation_productsearch')}}</a>
                                    </li>
                                    
                                    <li class="menu-item">
                                        <a class="user" title="{{trans('ui.navigation_profile')}}" href="{{url('profile/')}}">{{trans('ui.navigation_profile')}}</a>
                                    </li>

                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-723">
                                        <a class="logout" title="{{trans('ui.navigation_logout')}}" href="{{url('auth/logout')}}">{{trans('ui.navigation_logout')}}</a>
                                    </li>
                                </ul>
                            </li> <!-- end of dropdown menu -->
                            
                        @else

                            <!-- <li class="menu-item">
                                <a title="{{trans('ui.navigation_vendorreg')}}" href="{{url('auth/vendorregister')}}">{{trans('ui.navigation_vendorreg')}}</a>
                            </li> -->

                            <li class="menu-item pull-right sign-in">
                                <a title="{{trans('ui.navigation_login')}}" href="{{url('auth/login')}}">{{trans('ui.navigation_login')}}</a>
                            </li>

                            <li class="menu-item pull-right">
                                <a title="{{trans('ui.navigation_vendorreg')}}" href="{{url('auth/register')}}"><button class=" btn-primary">{{trans('ui.navigation_userreg')}}</button></a>
                            </li>
                        
                            <!-- Hidden menu item -->
                            <li class="hide menu-item">
                                <a title="{{trans('ui.navigation_industryforums')}}" href="{{url('industryforums')}}">{{trans('ui.navigation_industryforums')}}</a>
                            </li>
                            <!-- hidden menu item -->
                            <li class="hide menu-item">
                                <a title="{{trans('ui.navigation_tools')}}" href="{{url('toolsresources')}}">{{trans('ui.navigation_tools')}}</a>
                            </li>
                    @endif
                    </ul>
                </div>
                
                <div class="col-xs-12 col-md-5">
                    
                    <form class="navbar-form pull-right" id="frmNavigationSearch" method="post" action="{{url('product/navsearch')}}">
                        <div class="form-group">
                            <input type="text" name="searchquery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                            <a href="#" class="search"><img src="{{url('img/icons/search.svg')}}" alt=""></a>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div><!--end container-->

        </nav>

    </div><!--end header-->

    <div id="main">
        @yield('sectionheader')

        <section class="container-wrap">
            <div id="main-container" class="container">

                <!-- START BOOTSTRAP ALERT AREA -->
                @if(session('successMessage'))
                    <div class="row">
                        <div class="col-xs-12 ">
                            <p class="bg-success">{{session('successMessage')}}</p>
                        </div>
                    </div>
                @endif

                @if($errors && count($errors) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <p class="bg-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                            </p>
                        </div>
                    </div>
                @endif
                <!-- END BOOTSTRAP ALERT AREA -->

                <!-- START MAIN PAGE CONTENT -->
                @yield('content')
                <!-- END MAIN PAGE CONTENT -->
            </div><!--end .container-->
        </section>

    </div><!-- #main -->

    <!-- start footer -->
    <div id="socket" class="socket-color">
        <div class="container">
            <div class="row">
                    <div class="col-xs-12">
                        
                        <div class="col-xs-6">
                            <p class="footer">&#169; 2016 Food Service Hound</p>
                        </div>

                        <div class="col-xs-6 pull-right">
                            <a class="contact" href="{{url('contact')}}">{{trans('ui.navigation_contactus')}}</a>
                        </div>
                    </div><!--end row-->
            </div><!--end template-page-->
        </div><!--end container-->
    </div><!--end footer-->


<script src="{{url('js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{url('js/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('js/fsh.common.js')}}"></script>
<script src="{{url('js/vendor/flexslider/jquery.flexslider-min.js')}}"></script>


@yield('scripts')

@if (App::environment('prod'))
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-74247025-1', 'auto');
    ga('send', 'pageview');

</script>
@endif

</body>

</html>