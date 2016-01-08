@extends('layouts.master')

@section('title', trans('ui.navigation_register'))

@section('sectionheader')
<section class='clearfix container-wrap main-title register-header'>
    <div class='container'>
        <h1 class="page-title"> {{trans('ui.navigation_register')}}</h1>
    </div>
</section>
   
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="row well">
            <h2 class="subhead">Create Your Account</h2>
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <form id="form1" name="form1" method="POST" action="{{url('/auth/register')}}">
                    {!! csrf_field() !!}

                    <div>
                        <label for="name">{{trans('ui.user_label_name')}}</label>
                        <input type="text" name="name" maxlength="25" value="{{ old('name') }}" class="form-control">
                    </div>

                    <div>
                        <label for="email">{{trans('ui.user_label_email')}}</label>
                        <input type="email" name="email" maxlength="100" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div>
                        <label for="password">{{trans('ui.user_label_password')}}</label>
                        <input type="password" id="password" name="password" maxlength="25" class="form-control">
                    </div>

                    <div>
                        <label for="password_confirmation">{{trans('ui.user_label_confirmpassword')}}</label>
                        <input type="password" name="password_confirmation" maxlength="25" class="form-control">
                    </div>

                    <div class="text-center">
                        <button type="submit" class=" btn-primary">{{trans('ui.button_register')}}</button>
                    </div>
                </form>
            </div>
        </div> <!-- end row/well -->
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
                    name: { required: true, maxlength: 25 },
                    email: { required: true, email: true, maxlength: 100 },
                    password: { required: true, maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 }
                }
            });

        });
    </script>
@endsection