<!DOCTYPE html>
<html>

<head>

    <title>App Name - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/normalize.css')}}">
    <link rel="stylesheet" href="{{url('/css/foundation.min.css')}}">

    <script src="{{url('js/vendor/modernizr.js')}}"></script>

    @yield('css')

</head>

<body>

<div class="row">
    <div class="small-12 large-12 columns">
        <h1><a href="{{url('/')}}"><img src="{{url('/img/horizontallogoFoodServiceHound.png')}}"/></a></h1>
    </div>
</div>

<div class="row">
    <div class="small-12 small-text-right large-12 columns">
        <a href="{{url('/search')}}">Products Search</a>
        |
        <a href="#">Industry Forums</a>
        |
        <a href="#">Tools &amp; Resources</a>
        |
        @if (Auth::check())
            <a href="{{url('profile/')}}">My Profile</a>
            |
            <a href="{{url('auth/logout')}}">Logout</a>
        @else
            <a href="">Vendor Registration</a>

            <a href="{{url('auth/login')}}">Login</a>
            |
            <a href="{{url('auth/register')}}">Register</a>
        @endif

    </div>
</div>

<div class="row">

    <div class="small-12 large-12 columns">
        @yield('content')
    </div>
</div>

<div class="row">
    <div class="small-12 small-text-center large-12 columns">
        <small>&copy; 2015 foodservicehound.com</small>
    </div>
</div>


<script src="{{url('js/vendor/jquery.js')}}"></script>
<script src="{{url('js/foundation.min.js')}}"></script>
<script>
    $(document).foundation();
</script>

@yield('scripts')

</body>

</html>