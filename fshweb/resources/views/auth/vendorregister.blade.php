@extends('layouts.master')

@section('title', trans('ui.navigation_vendorreg'))

@section('sectionheader')
<section class='clearfix container-wrap main-title register-header'>
    <div class='container'>
        <h1 class="page-title"> {{trans('ui.navigation_vendorreg')}}</h1>
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12 well">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <h2 class="subhead">Create a Vendor Account</h2>
                    <form id="form1" name="form1" method="POST" action="{{url('/auth/vendorregister')}}">
                        {!! csrf_field() !!}

                        <div>
                            <label for="name">{{trans('ui.vendor_label_name')}}</label>
                            <input type="text" name="name" maxlength="25" placeholder="" class="form-control">
                        </div>

                        <div>
                            <label for="email">{{trans('ui.vendor_label_email')}}</label>
                            <input type="email" name="email" maxlength="100" placeholder="" class="form-control">
                        </div>

                        <div>
                            <label for="password">{{trans('ui.vendor_label_password')}}</label>
                            <input type="password" id="password" name="password" placeholder="" maxlength="25" class="form-control">
                        </div>

                        <div>
                            <label for="password_confirmation">{{trans('ui.vendor_label_confirm_password')}}</label>
                            <input type="password" name="password_confirmation" placeholder="" maxlength="25" class="form-control">
                        </div>

                        <div>
                            <label for="company">{{trans('ui.vendor_label_company')}}</label>
                            <input type="text" name="company_name" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="country_id">{{trans('ui.vendor_label_country')}}</label>
                            <select id="country_id" name="country_id" class="form-control">
                            </select>
                        </div>

                        <div>
                            <label for="state_province_id">{{trans('ui.vendor_label_state_province')}}</label>
                            <select id="state_province_id" name="state_province_id" class="form-control">
                                <option value=""></option>
                                <option value="">{{trans('ui.vendor_label_choose_country')}}</option>
                            </select>
                        </div>

                        <div>
                            <label for="address1">{{trans('ui.vendor_label_address1')}}</label>
                            <input type="text" name="address1" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="address2">{{trans('ui.vendor_label_address2')}}</label>
                            <input type="text" name="address2" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="city">{{trans('ui.vendor_label_city')}}</label>
                            <input type="text" name="city" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="zip_postal">{{trans('ui.vendor_label_zip_postal')}}</label>
                            <input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control"/>
                        </div>

                        <div>
                            <label for="contact_name">{{trans('ui.vendor_label_contact_name')}}</label>
                            <input type="text" name="contact_name" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="contact_name">{{trans('ui.vendor_label_contact_title')}}</label>
                            <input type="text" name="contact_title" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="contact_phone">{{trans('ui.vendor_label_contact_phone')}}</label>
                            <input type="text" name="contact_phone" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="contact_url">{{trans('ui.vendor_label_contact_url')}}</label>
                            <input type="text" name="contact_url" placeholder="" maxlength="200" class="form-control"/>
                        </div>

                        <div>
                            <label for="intro_text">{{trans('ui.vendor_label_intro_text')}}</label>
                            <textarea name="intro_text" class="form-control" placeholder="" cols="80" rows="3"></textarea>
                        </div>

                        <div>
                            <label for="about_text">{{trans('ui.vendor_label_about_text')}}</label>
                            <textarea name="about_text" class="form-control" placeholder="" cols="80" rows="3"></textarea>
                        </div>

                        <div>
                            <label for="logo_image_path">{{trans('ui.vendor_label_logo_image')}}</label>
                            <input type="file" name="logo_image_path"/>
                        </div>

                        <div>
                            <label for="logo_image_path">{{trans('ui.vendor_label_background_image')}}</label>
                            <input type="file" name="background_image_path"/>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-primary">{{trans('ui.button_register')}}</button>
                        </div>
                    </div>    
                </form>
            </div> <!-- end of well -->
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {

            fsh.common.doAjax("{{url('ajax/getcountries')}}", {}, "GET", true,
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
                    fsh.common.doAjax("{{url('ajax/getstateprovincesforcountry')}}/" + $(this).val(), {}, "GET", true,
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
                    name: { required: true, maxlength: 25 },
                    email: { required: true, email: true, maxlength: 100 },
                    password: { required: true, maxlength: 25, minlength: 6 },
                    password_confirmation: { equalTo: "#password", maxlength: 25, minlength: 6 },
                    company_name: { required: true, maxlength: 200 },
                    country: { required: true },
                    state_province: { required: true },
                    address1: { required: true, maxlength: 200 },
                    address2: { required: true, maxlength: 200 },
                    city: { required: true, maxlength: 200 },
                    zip_postal: { required: true, maxlength: 50 },
                    contact_name: { required: true, maxlength: 200 },
                    contact_title: { maxlength: 200 },
                    contact_phone: { maxlength: 200 },
                    contact_url: { maxlength: 200 },
                    intro_text: { maxlength: 2000 },
                    about_text: { maxlength: 2000 }
                }
            });

        });
    </script>
@endsection