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
    <div class="container">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="col-xs-12 well">
            <h2 class="subhead">Create Your Account</h2>
            <p class="text-center">Are you a product vendor?</p>
            <p class="text-center"> See our <a title="{{trans('ui.navigation_vendorreg')}}" href="{{url('auth/vendorregister')}}">{{trans('ui.navigation_vendorreg')}}</a> to sign up</p>
            <div class="col-xs-12 col-md-10 col-md-offset-1">
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

                    <div>
                        <label for="user_type_id">{{trans('ui.user_label_usertype')}}</label>
                        <select name="user_type_id" class="form-control">
                            <option value="">Please Select a Role</option>
                            @foreach ($userTypes as $ut)
                                <option value="{{$ut->id}}">{{$ut->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-primary">{{trans('ui.button_register')}}</button>
                    </div>

                </form>
            </div>
        </div> <!-- end row/well -->
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
                    name: { required: true, maxlength: 25, remote: "{{url('ajax/checkusername')}}" },
                    email: { required: true, email: true, maxlength: 100, remote: "{{url('ajax/checkemail')}}" },
                    password: { required: true, maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 }
                },
                messages:
                {
                    name:
                    {
                        remote: "Name is in use, please choose another"
                    },
                    email:
                    {
                        remote: "Email is in use, please choose another"
                    }
                }
            });

        });
    </script>
@endsection