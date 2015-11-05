<!DOCTYPE html>
<html>

<head>
    <title>Admin - @yield('title')</title>

    <link rel="stylesheet" href="{{url('/css/normalize.css')}}">
    <link rel="stylesheet" href="{{url('/css/foundation.min.css')}}">

    <script src="{{url('js/vendor/modernizr.js')}}"></script>

    @yield('css')

</head>

<body>

<div class="row">
    <div class="small-12 large-12 columns">
        <h1>Admininistration</h1>
    </div>
</div>

<div class="row">

    <div class="small-2 large-3 columns">
        @section('sidebar')
            <ul>
                <li><a href="{{url('admin/users')}}">Users</a></li>
                <li><a href="{{url('admin/roles')}}">Roles</a></li>
                <li><a href="{{url('admin/permissions')}}">Permissions</a></li>
                <li><a href="{{url('admin/import')}}">Product Import</a></li>
                <li><a href="{{url('admin/lucenesearch')}}">Lucene Search</a></li>
                <li><a href="{{url('/')}}" target="_blank">Public Site</a></li>
            </ul>


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

@yield('scripts')

</body>

</html>