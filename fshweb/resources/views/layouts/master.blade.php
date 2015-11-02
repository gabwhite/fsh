<!DOCTYPE html>
<html>

<head>

    <title>App Name - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/normalize.css')}}">
    <link rel="stylesheet" href="{{url('/css/foundation.min.css')}}">

    <script src="{{url('js/vendor/modernizr.js')}}"></script>
</head>

<body>

<div class="row">
    <div class="small-12 large-12 columns">
        <h1>Master Page</h1>

        @if (Auth::check())
            <a href="">My Profile</a>
            |
            <a href="{{url('auth/logout')}}">Logout</a>
        @else
            <a href="{{url('auth/login')}}">Login</a>
            |
            <a href="{{url('auth/register')}}">Register</a>
        @endif

    </div>
</div>

<div class="row">

    <div class="small-2 large-3 columns">
        @section('sidebar')
            This is the master sidebar.
        @show
    </div>

    <div class="small-10 large-9 columns">
        @yield('content')
    </div>
</div>


<script src="{{url('js/vendor/jquery.js')}}"></script>
<script src="{{url('js/foundation.min.js')}}"></script>
<script>
    $(document).foundation();
</script>

</body>

</html>