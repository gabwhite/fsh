@extends('layouts.master')

@section('title', trans('ui.navigation_login'))

@section('sectionheader')
    {{trans('ui.navigation_login')}}
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        <form id="form1" name="form1" method="POST" action="{{url('/auth/login')}}">
            {!! csrf_field() !!}

            <div>
                {{trans('ui.login_label_email')}}
                <input type="email" name="email" maxlength="100" value="{{ old('email') }}" class="form-control">
            </div>

            <div>
                {{trans('ui.login_label_password')}}
                <input type="password" name="password" id="password" maxlength="25" class="form-control">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> {{trans('ui.login_label_remember')}}
                </label>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">{{trans('ui.button_login')}}</button>
            </div>
        </form>
        <a href="{{url('/auth/register')}}">{{trans('ui.navigation_register')}}</a>
        |
        <a href="{{url('/password/email')}}">{{trans('ui.navigation_forgotpassword')}}</a>

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