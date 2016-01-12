<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>App Name - @yield('title')</title>

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
   
    <link rel="stylesheet" href="{{url('/css/app.css')}}">

    <script src="{{url('js/kleo/init.js')}}"></script>
    <script src="{{url('js/kleo/modernizr.custom.46504.js')}}"></script>

    <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>

    @yield('css')

</head>

<body>

    <div id="header" class="row">

        <nav class="navbar navbar-default col-xs-12" role="navigation">

            <div class="container clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=">col-xs-6 col-md-3">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a href="{{url('/')}}" class="navbar-brand"> 
                            <img id="logo_img" title="FoodserviceHound.com" src="{{url('/img/horizontallogoFoodServiceHound.png')}}" alt="FoodserviceHound.com">
                        </a>
                    </div>
                </div>
                
                <div class="col-xs-6 col-md-9">
                    <div class="col-xs-12 col-md-4">
                        <form class="navbar-form" method="post" action="{{url('product/search')}}">
                            <div class="form-group">
                                <input type="text" name="searchquery" id="searchquery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                                <a href="#" id="hlSearch" class="search"><img src="/public/img/icons/search.svg" alt=""></a>
                            </div>
                                    
                                    
                            {!! csrf_field() !!}
                        </form>
                    </div>    

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="col-xs-12 col-md-8">
                     
                        <div class="collapse navbar-collapse nav-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">
                                <li class="menu-item">
                                    <a title="{{trans('ui.navigation_productsearch')}}" href="{{url('/product/search')}}">{{trans('ui.navigation_productsearch')}}</a>
                                </li>
                                
                                <!-- Hidden menu item -->
                                <li class="hide menu-item">
                                    <a title="{{trans('ui.navigation_industryforums')}}" href="{{url('industryforums')}}">{{trans('ui.navigation_industryforums')}}</a>
                                </li>
                                
                                <!-- hidden menu item -->
                                <li class="hide menu-item">
                                    <a title="{{trans('ui.navigation_tools')}}" href="{{url('toolsresources')}}">{{trans('ui.navigation_tools')}}</a>
                                </li>

                                @if (Auth::check())
                                    <li class="menu-item">
                                        <a title="{{trans('ui.navigation_profile')}}" href="{{url('profile/')}}">{{trans('ui.navigation_profile')}}</a>
                                    </li>

                                    <li id="menu-item-723" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-723">
                                        <a title="{{trans('ui.navigation_logout')}}" href="{{url('auth/logout')}}">{{trans('ui.navigation_logout')}}</a>
                                    </li>
                                @else
                                    <li class="menu-item">
                                        <a title="{{trans('ui.navigation_vendorreg')}}" href="{{url('auth/vendorregister')}}">{{trans('ui.navigation_vendorreg')}}</a>
                                    </li>

                                    <li class="menu-item">
                                        <a title="{{trans('ui.navigation_login')}}" href="{{url('auth/login')}}">{{trans('ui.navigation_login')}}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>

                    </div>
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
                        <div class="col-md-12">
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

    <!--start kleo-quick-contact-wrapper-->
   <!--  <a class="kleo-go-top" href="#"><i class="icon-up-open-big"></i></a>
    <div class="kleo-quick-contact-wrapper">
        <a class="kleo-quick-contact-link" href="#"><i class="icon-mail-alt"></i></a>
        <div id="kleo-quick-contact">
            <h4 class="kleo-qc-title">CONTACT US</h4>
            <p>We're not around right now. But you can send us an email and we'll get back to you, asap.</p>
            <form class="kleo-contact-form" action="#" method="post" novalidate>
                <input type="text" placeholder="Your Name" required id="contact_name" name="contact_name" class="form-control" value="" tabindex="276" />
                <input type="email" required placeholder="Your Email" id="contact_email" name="contact_email" class="form-control" value="" tabindex="277"  />
                <textarea placeholder="Type your message..." required id="contact_content" name="contact_content" class="form-control" tabindex="278"></textarea>
                <input type="hidden" name="action" value="kleo_sendmail">
                <button tabindex="279" class="btn btn-default pull-right" type="submit">Send</button>
                <div class="kleo-contact-loading">Sending <i class="icon-spinner icon-spin icon-large"></i></div>
                <div class="kleo-contact-success">
                </div>
            </form>
            <div class="bottom-arrow"></div>
        </div>
    </div>

     --><!--end kleo-quick-contact-wrapper-->

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



@yield('scripts')

</body>

</html>