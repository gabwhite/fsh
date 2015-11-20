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
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{url('/css/kleo/fontello-ie7.min.css')}}">
    <![endif]-->

    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" id="kleo-app-css"  href="{{url('/css/kleo/app.min.css?ver=3.0.4')}}" type="text/css" media="all" />
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

    </style>
    <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>


    @yield('css')

</head>

<body class="kleo-navbar-fixed">

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
                            <a href="http://www.foodservicehound.com">


                                <img id="logo_img" title="FoodserviceHound.com" src="http://www.foodservicehound.com/wp-content/uploads/2015/09/horizontallogoFoodServiceHound.png" alt="FoodserviceHound.com">


                            </a>
                        </strong>
                    </div>


                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse nav-collapse">

                        <ul id="menu-primary-menu" class="nav navbar-nav">
                            <li id="menu-item-662" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-662"><a title="Products Search" href="{{url('/search')}}">Products Search</a></li>
                            <li id="menu-item-4594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4594"><a title="Industry Forums" href="{{url('industryforums')}}">Industry Forums</a></li>
                            <li id="menu-item-224" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-224"><a title="Tools &amp; Resources" href="{{url('toolsresources')}}">Tools &#038; Resources</a></li>
                            <li id="menu-item-721" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-716 current_page_item menu-item-721 active"><a title="Vendor Registration" href="#">Vendor Registration</a></li>
                            <li id="menu-item-720" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-720"><a title="Login/Register" href="http://www.foodservicehound.com/login-2/">Login/Register</a></li>
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

</div>

<div class="container">

    <div class="row">

        <div class="col-md-12">
            <section class="main-title">
                <h1 class="page-title">@yield('sectionheader')</h1>
            </section>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
        @yield('content')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <small>&copy; 2015 foodservicehound.com</small>
        </div>
    </div>

</div>



<script src="{{url('js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{url('js/vendor/bootstrap/bootstrap.min.js')}}"></script>



@yield('scripts')

</body>

</html>