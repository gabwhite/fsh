<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>App Name - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="{{url('/css/fsh.css')}}">

    @yield('css')

</head>

<body>

<div class="container">

    <div class="row">

        <div class="col-md-2">
            <div><a href="{{url('/')}}"><img src="{{url('/img/horizontallogoFoodServiceHound.png')}}" class="img-responsive"/></a></div>
        </div>

        <div class="col-md-10">
            <a href="{{url('/search')}}">Products Search</a>
            |
            <a href="{{url('industryforums')}}">Industry Forums</a>
            |
            <a href="{{url('toolsresources')}}">Tools &amp; Resources</a>
            |
            @if (Auth::check())
                <a href="{{url('profile/')}}">My Profile</a>
                |
                <a href="{{url('auth/logout')}}">Logout</a>
            @else
                <a href="#">Vendor Registration</a>
                |
                <a href="{{url('auth/login')}}">Login</a>
                |
                <a href="{{url('auth/register')}}">Register</a>
            @endif

        </div>

    </div>


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