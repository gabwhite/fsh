@extends('layouts.master')

@section('title', trans('ui.navigation_profile'))

@section('css')

@endsection

@section('sectionheader')
    {{trans('ui.navigation_profile')}}
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        <form id="form1" name="form1" method="post" action="{{url('profile/edit')}}">

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_email')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="email" placeholder="" class="form-control" value="{{Auth::user()->email}}" maxlength="100"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_password')}}
                </div>
                <div class="col-md-9">
                    <input type="password" name="password" placeholder="" class="form-control" maxlength="25"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_confirmpassword')}}
                </div>
                <div class="col-md-9">
                    <input type="password" name="confirmpassword" placeholder="" class="form-control" maxlength="25"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_firstname')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="firstname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->firstname : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_lastname')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="lastname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->lastname : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.user_label_bio')}}
                </div>
                <div class="col-md-9">
                    <textarea name="bio" class="form-control" placeholder="" cols="80" rows="3">{{isset($profile) ? $profile->bio : ''}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="{{trans('ui.button_update')}}" class="btn btn-primary btn-lg"/>
                    <a href="{{url('/profile')}}" class="btn btn-lg">{{trans('ui.button_cancel')}}</a>
                </div>
            </div>

            {!! csrf_field() !!}
        </form>

    </div>

</div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    email: { required: true, email: true, maxlength: 100 },
                    password: { maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 }
                }
            });

        });
    </script>
@endsection