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

    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" id="kleo-app-css"  href="{{url('/css/kleo/app.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="magnific-popup-css"  href="{{url('/js/vendor/magnific-popup/magnific.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="tp-josefin-css"  href="http://fonts.googleapis.com/css?family=Josefin+Slab%3A400%2C100%2C600%2C700%2C300%7CJosefin+Sans%3A400%2C300%2C100%2C600%2C700&#038;ver=4.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="tp-josefinsans-css"  href="http://fonts.googleapis.com/css?family=Josefin+Sans%3A400%2C300%2C100%2C600%2C700&#038;ver=4.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-fonts-css"  href="{{url('/css/kleo/fontello.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-google-fonts-css"  href="//fonts.googleapis.com/css?family=Josefin+Sans%3A700%2C300%2C400%7CRoboto+Condensed%3A300%7COpen+Sans%3A400&#038;subset=latin&#038;ver=4.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-colors-css"  href="{{url('/css/kleo/dynamic.css?ver=3.0.4')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="kleo-style-css"  href="{{url('/css/kleo/style-child.css?ver=3.0.4')}}" type="text/css" media="all" />


    <script src="{{url('js/kleo/init.js')}}"></script>
    <script src="{{url('js/kleo/modernizr.custom.46504.js')}}"></script>


    <style>
        span.kleo-animate-number.animate-when-almost-visible.number_prepared.start-animation {
            color: #ffffff;
            border: none;
            font-size: 95px;
        }

        table#products-list tr td {
            border-bottom: 1px solid #444;
            padding: 0px 5px!important;
        }

        td.hidden-xs {
            font-size: 13px!important;
        }

        table#products-list tr td a {
            font-weight: bold;
            font-size: 13px!important;
            color: #000!important;
            text-transform: uppercase!important;
        }

        .nutrition-block {
            font-family: 'Helvetica', sans-serif;
            background: #fff;
            font-size: 10px;
            border: 1px solid #000;
            padding: 10px;
        }

        .nutrition {
            margin: 30px!important;
        }

        .nutrition-block h4 {
            color: #000;
            font-family: 'Helvetica', sans-serif!important;
            font-size: 2em!important;
            margin-top: 2px!important;
        }

        .nutrition-block label {
            font-weight: bold;
        }

        .product-details-meta p {
            margin-top: 1px;
        }

        .user-products h4 {
            font-weight: 600;
            font-size: 1.5em;
            font-family: 'Josefin Sans', sans-serif;
            margin: 35px 0 1px 0;
        }

        .vendor-logo {
            margin: 30px;
        }

        .vendor-logo img {
            width: 100% !important;
            height: auto !important;
            border-radius: 50%;
        }


        .product-image img {
            width: inherit!important;
            max-height: 400px;
            margin: 0 auto;
        }

        div#wpcf-field-product-image {
            width: 100%;
            text-align: center;
        }

        h1 {
            border-bottom: none!important;
        }

        .home-page section.container-wrap.main-color {
            background-color: #de5328;
            color: #ffffff!important;
        }

        p#footer {
            font-size: 12px;
        }

        .home-page section.container-wrap.main-color h2 {
            color: #ffffff!important;
        }

        h2 {
            text-transform: uppercase;
        }

        .navbar-nav>li>a {
            text-transform: uppercase;
        }

        .tp-button.orange, .tp-button:hover.orange,
        .purchase.orange, .purchase:hover.orange
        { background-color: #de5328;
            -webkit-box-shadow:  none;
            -moz-box-shadow:   none;
            box-shadow:   none
        }

        .tp-button {
            padding: 6px 13px 5px;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            height: 30px;
            cursor: pointer;
            color: #fff !important;
            text-transform: uppercase;
            text-shadow: none!important;
            font-size: 15px;
            line-height: 45px !important;
            background: none;
            font-family: 'Helvetica Neue', sans-serif;
            font-weight: bold;
            letter-spacing: -1px;
            text-decoration: none;
        }

        #main .alternate-color h1, #main .alternate-color h2, #main .alternate-color h3, #main .alternate-color h4, #main .alternate-color h5, #main .alternate-color h6 {
            text-transform: uppercase;
            margin-top: 10px;
        }

        .main-center-title .breadcrumb-extra {
            display: none;
        }

        .validationError
        {
            color: red;
        }

    </style>
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
                            <li id="menu-item-662" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-662"><a title="Products Search" href="{{url('/search')}}">Products Search</a></li>
                            <li id="menu-item-4594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4594"><a title="Industry Forums" href="{{url('industryforums')}}">Industry Forums</a></li>
                            <li id="menu-item-224" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-224"><a title="Tools &amp; Resources" href="{{url('toolsresources')}}">Tools &#038; Resources</a></li>
                            <li id="menu-item-721" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-721"><a title="Vendor Registration" href="#">Vendor Registration</a></li>

                            @if (Auth::check())
                                <li id="menu-item-722" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-722"><a title="Logout" href="{{url('profile/')}}">Profile</a></li>
                                <li id="menu-item-723" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-723"><a title="Logout" href="{{url('auth/logout')}}">Logout</a></li>
                            @else
                                <li id="menu-item-720" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-720"><a title="Login/Register" href="{{url('auth/login')}}">Login/Register</a></li>
                            @endif

                            <li id="nav-menu-item-search" class="menu-item kleo-search-nav"><a class="search-trigger" href="#"><i class="icon icon-search"></i></a>
                                <div class="kleo-search-wrap searchHidden" id="ajax_search_container">
                                    <form class="form-inline" id="ajax_searchform" action="http://www.foodservicehound.com/" data-context="product">
                                        <input type="hidden" name="post_type" value="product">        <input name="s" class="ajax_s form-control" autocomplete="off" type="text" value="" placeholder="Start typing to search...">
                                        <span class="kleo-ajax-search-loading"><i class="icon-spin6 animate-spin"></i></span>
                                    </form>
                                    <div class="kleo_ajax_results"></div>
                                </div>
                            </li>
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
    <a class="kleo-go-top" href="#"><i class="icon-up-open-big"></i></a>
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
    </div><!--end kleo-quick-contact-wrapper-->

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
                            <p id="footer" style="text-align: center;">©2015 foodservicehound.com </p>
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