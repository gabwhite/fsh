<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Admin - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/fshadmin.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fsh-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/admin')}}">FSH Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="fsh-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/users')}}">View</a></li>
                        <li><a href="{{url('admin/adduser')}}">Add New User</a></li>
                        <li><a href="{{url('admin/addvendor')}}">Add New Vendor</a></li>
                    </ul>
                </li>
                <li><a href="{{url('admin/roles')}}">Roles</a></li>
                <li><a href="{{url('admin/permissions')}}">Permissions</a></li>
                <li><a href="{{url('admin/import')}}">Product Import</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/categories')}}">View</a></li>
                        <li><a href="{{url('admin/category/add')}}">Add</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">System <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/cache')}}">Cache Control</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('/')}}" target="_blank">Public Site</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">

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

            @yield('content')
        </div>
    </div>
</div>

<script src="{{url('js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{url('js/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('js/fsh.common.js')}}"></script>
@yield('scripts')

</body>

</html>