@extends('layouts.master')

@section('title', 'Login')

@section('sectionheader')
    LOGIN
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        <form id="form1" name="form1" method="POST" action="{{url('/auth/login')}}">
            {!! csrf_field() !!}

            <div>
                Email
                <input type="email" name="email" maxlength="100" value="{{ old('email') }}" class="form-control">
            </div>

            <div>
                Password
                <input type="password" name="password" id="password" maxlength="25" class="form-control">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <a href="{{url('/auth/register')}}">Register</a>
        |
        <a href="#">Lost Password</a>

    </div>

</div>

@endsection

@section('scripts')
    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    email: { required: true, email: true, maxlength: 100 },
                    password: { required: true, maxlength: 25 }
                }
            });

        });
    </script>
@endsection