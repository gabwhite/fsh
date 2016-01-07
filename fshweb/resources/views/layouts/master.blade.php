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

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{url('/css/kleo/fontello-ie7.min.css')}}">
    <![endif]-->

    <!-- <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}"> -->
    <!-- <link rel="stylesheet" id="kleo-app-css"  href="{{url('/css/kleo/app.css?ver=3.0.4')}}" type="text/css" media="all" /> -->
    <link rel="stylesheet" id="magnific-popup-css"  href="{{url('/js/vendor/magnific-popup/magnific.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="tp-josefin-css"  href="http://fonts.googleapis.com/css?family=Josefin+Slab%3A400%2C100%2C600%2C700%2C300%7CJosefin+Sans%3A400%2C300%2C100%2C600%2C700&#038;ver=4.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="tp-josefinsans-css"  href="http://fonts.googleapis.com/css?family=Josefin+Sans%3A400%2C300%2C100%2C600%2C700&#038;ver=4.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-fonts-css"  href="{{url('/css/kleo/fontello.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-google-fonts-css"  href="//fonts.googleapis.com/css?family=Josefin+Sans%3A700%2C300%2C400%7CRoboto+Condensed%3A300%7COpen+Sans%3A400&#038;subset=latin&#038;ver=4.3.1" type="text/css" media="all" />
    <!-- <link rel="stylesheet" id="kleo-colors-css"  href="{{url('/css/kleo/dynamic.css?ver=3.0.4')}}" type="text/css" media="all" /> -->
   <!--  <link rel="stylesheet" id="kleo-style-css"  href="{{url('/css/kleo/style-child.css?ver=3.0.4')}}" type="text/css" media="all" /> -->
    <link rel="stylesheet" href="{{url('/css/app.css')}}">

    <script src="{{url('js/kleo/init.js')}}"></script>
    <script src="{{url('js/kleo/modernizr.custom.46504.js')}}"></script>
    
    <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>


    @yield('css')

</head>

<body class="kleo-navbar-fixed navbar-resize">

<div class="kleo-page">

    <div id="header" class="header-color">

        <div class="navbar" role="navigation">

            <div class="kleo-main-header header-normal">

                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        <div class="kleo-mobile-switch">

                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>

                        <div class="kleo-mobile-icons">


                        </div>

                        <strong class="logo">
                            <a href="{{url('/')}}">
                                <img id="logo_img" title="FoodserviceHound.com" src="{{url('/img/horizontallogoFoodServiceHound.png')}}" alt="FoodserviceHound.com">
                            </a>
                        </strong>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse nav-collapse">

                        <ul id="menu-primary-menu" class="nav navbar-nav">
                            <li id="menu-item-662" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-662"><a title="{{trans('ui.navigation_productsearch')}}" href="{{url('/search')}}">{{trans('ui.navigation_productsearch')}}</a></li>
                            <li id="menu-item-4594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4594"><a title="{{trans('ui.navigation_industryforums')}}" href="{{url('industryforums')}}">{{trans('ui.navigation_industryforums')}}</a></li>
                            <li id="menu-item-224" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-224"><a title="{{trans('ui.navigation_tools')}}" href="{{url('toolsresources')}}">{{trans('ui.navigation_tools')}}</a></li>

                            @if (Auth::check())
                                <li id="menu-item-722" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-722"><a title="{{trans('ui.navigation_profile')}}" href="{{url('profile/')}}">{{trans('ui.navigation_profile')}}</a></li>
                                <li id="menu-item-723" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-723"><a title="{{trans('ui.navigation_logout')}}" href="{{url('auth/logout')}}">{{trans('ui.navigation_logout')}}</a></li>
                            @else
                                <li id="menu-item-721" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-721"><a title="{{trans('ui.navigation_vendorreg')}}" href="{{url('auth/vendorregister')}}">{{trans('ui.navigation_vendorreg')}}</a></li>
                                <li id="menu-item-720" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-720"><a title="{{trans('ui.navigation_login')}}" href="{{url('auth/login')}}">{{trans('ui.navigation_login')}}</a></li>
                            @endif

                        </ul>
                    </div>

                </div><!--end container-->
            </div>

        </div>

    </div><!--end header-->

    <div id="main">

        <section class='container-wrap main-title alternate-color  main-center-title border-bottom'>
            <div class='container'><h1 class="page-title">@yield('sectionheader')</h1>
                <div class='breadcrumb-extra'>
                    <div class="kleo_framework breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
                        <span typeof="v:Breadcrumb">
                            <a rel="v:url" property="v:title" href="http://www.foodservicehound.com" title="FoodserviceHound.com" >Home</a>
                        </span>
                        <span class="sep"> </span>
                        <span class="active">@yield('sectionheader')</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="container-wrap main-color">
            <div id="main-container" class="container">
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
            <div class="template-page tpl-no col-xs-12 col-sm-12">
                <div class="wrap-content">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="gap-10"></div>
                        </div><!--end widget-->

                        <div class="col-sm-12">
                            <p id="footer" style="text-align: center;">©2015 foodservicehound.com | <a href="{{url('contact')}}">{{trans('ui.navigation_contactus')}}</a></p>
                        </div>

                        <div class="col-sm-12">
                            <div class="gap-10"></div>
                        </div><!--end widget-->

                    </div><!--end row-->

                </div><!--end wrap-content-->
            </div><!--end template-page-->
        </div><!--end container-->
    </div><!--end footer-->

</div><!-- end kleo page -->


<script src="{{url('js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{url('js/vendor/bootstrap/bootstrap.min.js')}}"></script>



@yield('scripts')

</body>

</html>