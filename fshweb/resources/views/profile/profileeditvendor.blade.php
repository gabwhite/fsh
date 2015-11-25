@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    EDIT PROFILE VV
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        <form id="form1" name="form1" method="post" action="{{url('profile/edit')}}">

            <div class="row">
                <div class="col-md-3">
                    Email
                </div>
                <div class="col-md-9">
                    <input type="text" name="email" placeholder="Email" class="form-control" value="{{Auth::user()->email}}" maxlength="100"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Password
                </div>
                <div class="col-md-9">
                    <input type="password" name="password" placeholder="Password" class="form-control" maxlength="25"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Confirm Password
                </div>
                <div class="col-md-9">
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control" maxlength="25"/>
                </div>
            </div>

            @if(isset(Auth::user()->userProfile) && isset(Auth::user()->userProfile->vendor_id))
            <div class="row">
                <div class="col-md-3">
                    Vendor
                </div>
                <div class="col-md-9">
                    You're a member of {{Auth::user()->userProfile->vendor_id}}
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    First Name
                </div>
                <div class="col-md-9">
                    <input type="text" name="firstname" placeholder="First Name" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->firstname : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Last Name
                </div>
                <div class="col-md-9">
                    <input type="text" name="lastname" placeholder="Last Name" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->lastname : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Bio
                </div>
                <div class="col-md-9">
                    <textarea name="bio" class="form-control" placeholder="Bio" cols="80" rows="3">{{isset($profile) ? $profile->bio : ''}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Update" class="btn btn-primary btn-lg"/>
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