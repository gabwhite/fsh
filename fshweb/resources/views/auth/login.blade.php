@extends('layouts.master')

@section('title', trans('ui.navigation_login'))


@section('sectionheader')
<section class='clearfix container-wrap main-title login-header'>
    <div class='container'><h1 class="page-title">{{trans('ui.navigation_login')}}</h1>
        
        <!-- BREADCRUMBS, NOT SURE IF THEY'RE NEEDED?  -->

        <!-- <div class='breadcrumb-extra'>
            <div class="kleo_framework breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
                <span typeof="v:Breadcrumb">
                    <a rel="v:url" property="v:title" href="http://www.foodservicehound.com" title="FoodserviceHound.com" >Home</a>
                </span>
                <span class="sep"> </span>
                <span class="active">Find What You're Looking For</span>
            </div>
        </div> -->
    </div>
</section>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="well">
            <h2 class="subhead">Sign In to Your Account</h2>
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
        </div>
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