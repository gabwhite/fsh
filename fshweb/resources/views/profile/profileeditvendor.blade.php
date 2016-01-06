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

        <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('profile/editvendor')}}">



            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_company')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="company_name" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->company_name : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_country')}}
                </div>
                <div class="col-md-9">
                    <select id="country" name="country" class="form-control">
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_state_province')}}
                </div>
                <div class="col-md-9">
                    <select id="state_province" name="state_province" class="form-control">
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_address1')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="address1" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->address1 : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_address2')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="address2" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->address2 : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_city')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="city" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->city : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_zip_postal')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control" value="{{isset($profile) ? $profile->zip_postal : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_name')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_name" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_name : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_title')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_title" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_title : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_phone')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_phone" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_phone : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_url')}}
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact_url" placeholder="" maxlength="200" class="form-control" value="{{isset($profile) ? $profile->contact_url : ''}}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_intro_text')}}
                </div>
                <div class="col-md-9">
                    <textarea name="intro_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($profile) ? $profile->intro_text : ''}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_about_text')}}
                </div>
                <div class="col-md-9">
                    <textarea name="about_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($profile) ? $profile->about_text : ''}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_logo_image')}}
                </div>
                <div class="col-md-9">
                    <input type="file" name="logo_image_path"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_background_image')}}
                </div>
                <div class="col-md-9">
                    <input type="file" name="background_image_path"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Update" class="btn btn-primary btn-lg"/>
                    <a href="{{url('/profile/')}}">{{trans('ui.button_cancel')}}</a>
                </div>
            </div>

            {!! csrf_field() !!}
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

            var $country = $("#country");

            fsh.common.doAjax("{{url('ajax/getcountries')}}", {}, "GET", true,
                    function(data)
                    {
                        var html = "<option value=''></option>";
                        $.each(data, function(idx, val)
                        {
                            //console.log(val);
                            if(val.id == "{{isset($profile) ? $profile->country : ''}}")
                            {
                                html += "<option value='" + val.id + "' selected='selected'>" + val.name + "</option>";
                            }
                            else
                            {
                                html += "<option value='" + val.id + "'>" + val.name + "</option>";
                            }

                        });
                        $country.html(html);
                        $country.trigger("change");
                    },
                    function(jqXhr, textStatus, errorThrown)
                    {

                    }
            );

            $country.on("change", function(e)
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
                                    if(val.id == "{{isset($profile) ? $profile->state_province : ''}}")
                                    {
                                        html += "<option value='" + val.id + "' selected='selected'>" + val.name + "</option>";
                                    }
                                    else
                                    {
                                        html += "<option value='" + val.id + "'>" + val.name + "</option>";
                                    }

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