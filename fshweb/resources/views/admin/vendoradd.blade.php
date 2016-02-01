@extends('layouts.admin')

@section('title', 'Add Vendor')


@section('content')

    <form id="form1" name="form1" method="post" action="{{url('admin/addvendor')}}">
        {!! csrf_field() !!}
        <table class="table">
            <tbody>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" maxlength="25" class="form-control"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" maxlength="100" class="form-control"/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" id="password" name="password" maxlength="25" class="form-control" /></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="password_confirmation" maxlength="25" class="form-control" /></td>
            </tr>
            <tr>
                <td>Company</td>
                <td><input type="text" name="company_name" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><select id="country_id" name="country_id" class="form-control"></select></td>
            </tr>
            <tr>
                <td>State / Province</td>
                <td>
                    <select id="state_province_id" name="state_province_id" class="form-control">
                        <option value=""></option>
                        <option value="">{{trans('ui.vendor_label_choose_country')}}</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Address 1</td>
                <td><input type="text" name="address1" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Address 2</td>
                <td><input type="text" name="address2" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="city" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Zip / Postal</td>
                <td><input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control"/></td>
            </tr>
            <tr>
                <td>Contact Name</td>
                <td><input type="text" name="contact_name" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Contact Title</td>
                <td><input type="text" name="contact_title" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Contact Phone</td>
                <td><input type="text" name="contact_phone" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Contact Email</td>
                <td><input type="text" name="contact_email" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Contact Url</td>
                <td><input type="text" name="contact_url" placeholder="" maxlength="200" class="form-control"/></td>
            </tr>
            <tr>
                <td>Intro Text</td>
                <td><textarea name="intro_text" class="form-control" placeholder="" cols="80" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>About Text</td>
                <td><textarea name="about_text" class="form-control" placeholder="" cols="80" rows="3"></textarea></td>
            </tr>
            </tbody>
        </table>
        <input type="submit" name="save" class="btn btn-primary" value="Add"/>

    </form>

@endsection

@section('scripts')
    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {

            fsh.common.doAjax("{{url('ajax/getcountries')}}", {}, "GET", true, {},
                    function(data)
                    {
                        var html = "<option value=''></option>";
                        $.each(data, function(idx, val)
                        {
                            //console.log(val);
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $("#country_id").html(html);
                    },
                    function(jqXhr, textStatus, errorThrown)
                    {

                    }
            );

            $("#country_id").on("change", function(e)
            {
                if($(this).val() === "")
                {
                    $("#state_province option[value != '']").remove();
                }
                else
                {
                    fsh.common.doAjax("{{url('ajax/getstateprovincesforcountry')}}/" + $(this).val(), {}, "GET", true, {},
                            function(data)
                            {
                                //console.log(data);
                                var html = "<option value=''></option>";
                                $.each(data, function(idx, val)
                                {
                                    //console.log(val);
                                    html += "<option value='" + val.id + "'>" + val.name + "</option>";
                                });
                                $("#state_province_id").html(html);
                            },
                            function(jqXhr, textStatus, errorThrown)
                            {

                            }
                    );

                }

                e.preventDefault();
            });


            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    name: { required: true, maxlength: 25, remote: "{{url('ajax/checkusername')}}" },
                    email: { required: true, email: true, maxlength: 100, remote: "{{url('ajax/checkemail')}}" },
                    password: { required: true, maxlength: 25, minlength: 6 },
                    password_confirmation: { equalTo: "#password", maxlength: 25, minlength: 6 },
                    company_name: { required: true, maxlength: 200 },
                    country_id: { required: true },
                    state_province_id: { required: true },
                    address1: { maxlength: 200 },
                    address2: { maxlength: 200 },
                    city: { maxlength: 200 },
                    zip_postal: { maxlength: 50 },
                    contact_name: { maxlength: 200 },
                    contact_title: { maxlength: 200 },
                    contact_phone: { maxlength: 200 },
                    contact_email: { email: true, maxlength: 200 },
                    contact_url: { maxlength: 200 },
                    intro_text: { maxlength: 2000 },
                    about_text: { maxlength: 2000 }
                },
                messages:
                {
                    name: { remote: "Name is in use, please choose another" },
                    email: { remote: "Email is in use, please choose another" }
                }
            });

        });
    </script>
@endsection