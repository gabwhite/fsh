<!DOCTYPE html>
<html>

<head>

    <title>App Name - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/normalize.css')}}">
    <link rel="stylesheet" href="{{url('/css/foundation.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/fsh.css')}}">

    <script src="{{url('js/vendor/modernizr.js')}}"></script>

    @yield('css')

</head>

<body>

<div class="row">
    <div class="small-2 large-3 columns">
        <h1><a href="{{url('/')}}"><img src="{{url('/img/horizontallogoFoodServiceHound.png')}}"/></a></h1>
    </div>

    <div class="small-10 small-text-right large-9 columns">
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
    <div class="small-12 small-text-center large-12 columns">

        <nav class="top-bar" data-topbar role="navigation">
            <section class="top-bar-section">
                <ul>

                    <li class="has-dropdown">
                        <a href="#">Right Button Dropdown</a>
                        <ul class="dropdown">
                            <li><a href="#">First link in dropdown</a></li>
                            <li class="active"><a href="#">Active link in dropdown</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="#">Right Button Dropdown</a>
                        <ul class="dropdown">
                            <li><a href="#">First link in dropdown</a></li>
                            <li class="active"><a href="#">Active link in dropdown</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
        </nav>

    </div>
</div>


<div class="row">
    <div class="small-12 small-text-center large-12 columns">
        <section class="main-title">
            <h1 class="page-title">@yield('sectionheader')</h1>
        </section>
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
<script src="{{url('js/vendor/fastclick.js')}}"></script>

<script src="{{url('js/foundation.min.js')}}"></script>
<script>
    $(document).foundation();
</script>

@yield('scripts')

</body>

</html>