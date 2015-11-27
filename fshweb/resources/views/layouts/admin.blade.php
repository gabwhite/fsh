<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Admin - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')

</head>

<body>

<div class="row">
    <div class="col-md-12">
        <h1><a href="{{url('/admin')}}">Administration</a></h1>
    </div>
</div>

<div class="row">

    <div class="col-md-2">
        @section('sidebar')
            <ul>
                <li><a href="{{url('admin/users')}}">Users</a></li>
                <li><a href="{{url('admin/roles')}}">Roles</a></li>
                <li><a href="{{url('admin/permissions')}}">Permissions</a></li>
                <li><a href="{{url('admin/import')}}">Product Import</a></li>
                <li><a href="{{url('admin/searchindexes')}}">Search Indexes</a></li>
                <li><a href="{{url('/')}}" target="_blank">Public Site</a></li>
                <li><a href="{{url('/auth/logout')}}">Logout</a></li>
            </ul>

        @show
    </div>

    <div class="col-md-10">
        @yield('content')
    </div>
</div>


<script src="{{url('js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{url('js/vendor/bootstrap/bootstrap.min.js')}}"></script>

@yield('scripts')

</body>

</html>