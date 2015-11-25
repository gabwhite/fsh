@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    EDIT VENDOR PROFILE
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


            <div class="row">
                <div class="col-md-3">
                    Company
                </div>
                <div class="col-md-9">
                    <input type="text" name="company" placeholder="Company" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->company : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Country
                </div>
                <div class="col-md-9">
                    <select name="country" class="form-control">
                        <option value="1">Canada</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    State / Province
                </div>
                <div class="col-md-9">
                    <select name="state_province" class="form-control">
                        <option value="1">NS</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    City
                </div>
                <div class="col-md-9">
                    <input type="text" name="city" placeholder="City" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->city : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Zip / Postal
                </div>
                <div class="col-md-9">
                    <input type="text" name="zip_postal" placeholder="Zip / Postal" maxlength="50" class="form-control" value="{{isset($profile) ? $profile->zip_postal : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Contact Name
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_name" placeholder="Contact Name" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_name : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Contact Phone
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_phone" placeholder="Contact Phone" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_phone : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Logo Image
                </div>
                <div class="col-md-9">
                    <input type="file" name="logo_image_path"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    About your company
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
                    password: { maxlength: 25, minlength: 6 },
                    password_confirmation: { equalTo: "#password", maxlength: 25, minlength: 6 },
                    company: { required: true, maxlength: 200 },
                    country: { required: true },
                    state_province: { required: true },
                    city: { required: true, maxlength: 200 },
                    zip_postal: { required: true, maxlength: 50 },
                    contact_name: { required: true, maxlength: 200 },
                    contact_phone: { maxlength: 200 },
                    bio: { maxlength: 2000 }
                }
            });

        });
    </script>
@endsection