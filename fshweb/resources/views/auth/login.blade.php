@extends('layouts.master')

@section('title', trans('ui.navigation_login'))


@section('sectionheader')
<section class='clearfix container-wrap main-title login-header'>
    <div class='container'>
        <h1 class="page-title">{{trans('ui.navigation_login')}}</h1>
    </div>
</section>
@endsection

@section('content')

<div class="row">
    <div class="container">
        
    
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="well col-xs-12">
                <h2 class="subhead">Sign In to Your Account</h2>
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="form1" name="form1" method="POST" action="{{url('/auth/login')}}">
                    {!! csrf_field() !!}

                        <div>
                            <label for="email">{{trans('ui.login_label_email')}}</label>
                            <input type="email" name="email" maxlength="100" value="{{ old('email') }}" class="form-control">
                        </div>

                        <div>
                            <label for="password">{{trans('ui.login_label_password')}}</label>
                            <input type="password" name="password" id="password" maxlength="25" class="form-control">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> {{trans('ui.login_label_remember')}}
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-primary">{{trans('ui.button_login')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center login-links">
                 <a href="{{url('/auth/register')}}">{{trans('ui.navigation_register')}}</a>
                |
                <a href="{{url('/password/email')}}">{{trans('ui.navigation_forgotpassword')}}</a>
            </div>
        </div>
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