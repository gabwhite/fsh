@extends('layouts.master')

@section('title', 'Vendor Registration')

@section('sectionheader')
    VENDOR REGISTRATION
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <form id="form1" name="form1" method="POST" action="{{url('/auth/vendorregister')}}">
                {!! csrf_field() !!}

                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" maxlength="25" placeholder="Name" class="form-control">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="100" placeholder="Email" class="form-control">
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" maxlength="25" class="form-control">
                </div>

                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" maxlength="25" class="form-control">
                </div>

                <div>
                    <label for="company">Company</label>
                    <input type="text" name="company" placeholder="Company" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="country">Country</label>
                    <select name="country" class="form-control">
                        <option value="1">Canada</option>
                    </select>
                </div>

                <div>
                    <label for="state_province">State / Province</label>
                    <select name="state_province" class="form-control">
                        <option value="1">NS</option>
                    </select>
                </div>

                <div>
                    <label for="city">City</label>
                    <input type="text" name="city" placeholder="City" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="zip_postal">Zip / Postal</label>
                    <input type="text" name="zip_postal" placeholder="Zip / Postal" maxlength="50" class="form-control"/>
                </div>

                <div>
                    <label for="contact_name">Contact Name</label>
                    <input type="text" name="contact_name" placeholder="Contact Name" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="contact_phone">Contact Phone</label>
                    <input type="text" name="contact_phone" placeholder="Contact Phone" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="logo_image_path">Logo Image</label>
                    <input type="file" name="logo_image_path"/>
                </div>

                <div>
                    <label for="bio">About your company</label>
                    <textarea name="bio" class="form-control" placeholder="Bio" cols="80" rows="3"></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>

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
                    password: { required: true, maxlength: 25, minlength: 6 },
                    password_confirmation: { equalTo: "#password", maxlength: 25, minlength: 6 },
                    company: { required: true, maxlength: 200 },
                    //country: { required: true },
                    //state_province: { required: true },
                    city: { required: true, maxlength: 200 },
                    zip_postal: { required: true, maxlength: 50 },
                    contact_name: { required: true, maxlength: 200 }
                }
            });

        });
    </script>
@endsection