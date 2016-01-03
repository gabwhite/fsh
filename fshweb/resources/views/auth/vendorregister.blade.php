@extends('layouts.master')

@section('title', trans('ui.navigation_vendorreg'))

@section('sectionheader')
    {{trans('ui.navigation_vendorreg')}}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

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
                    <label for="password_confirmation">{{trans('ui.vendor_label_confirmpassword')}}</label>
                    <input type="password" name="password_confirmation" placeholder="" maxlength="25" class="form-control">
                </div>

                <div>
                    <label for="company">{{trans('ui.vendor_label_company')}}</label>
                    <input type="text" name="company" placeholder="" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="country">{{trans('ui.vendor_label_country')}}</label>
                    <select id="country" name="country" class="form-control">
                    </select>
                </div>

                <div>
                    <label for="state_province">{{trans('ui.vendor_label_stateprovince')}}</label>
                    <select id="state_province" name="state_province" class="form-control">
                    </select>
                </div>

                <div>
                    <label for="city">{{trans('ui.vendor_label_city')}}</label>
                    <input type="text" name="city" placeholder="" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="zip_postal">{{trans('ui.vendor_label_zippostal')}}</label>
                    <input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control"/>
                </div>

                <div>
                    <label for="contact_name">{{trans('ui.vendor_label_contactname')}}</label>
                    <input type="text" name="contact_name" placeholder="" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="contact_name">{{trans('ui.vendor_label_contacttitle')}}</label>
                    <input type="text" name="contact_title" placeholder="" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="contact_phone">{{trans('ui.vendor_label_contactphone')}}</label>
                    <input type="text" name="contact_phone" placeholder="" maxlength="200" class="form-control"/>
                </div>

                <div>
                    <label for="logo_image_path">{{trans('ui.vendor_label_logoimage')}}</label>
                    <input type="file" name="logo_image_path"/>
                </div>

                <div>
                    <label for="bio">{{trans('ui.vendor_label_bio')}}</label>
                    <textarea name="bio" class="form-control" placeholder="" cols="80" rows="3"></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">{{trans('ui.button_register')}}</button>
                </div>
            </form>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.common.js')}}"></script>
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
                    $("#country").html(html);
                },
                function(jqXhr, textStatus, errorThrown)
                {

                }
            );

            $("#country").on("change", function(e)
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
                            $("#state_province").html(html);
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
                    company: { required: true, maxlength: 200 },
                    country: { required: true },
                    state_province: { required: true },
                    city: { required: true, maxlength: 200 },
                    zip_postal: { required: true, maxlength: 50 },
                    contact_name: { required: true, maxlength: 200 },
                    contact_title: { maxlength: 200 },
                    contact_phone: { maxlength: 200 },
                    bio: { maxlength: 2000 }
                }
            });

        });
    </script>
@endsection