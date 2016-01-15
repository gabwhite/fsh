@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap main-title'>
    <div class="container ">
        <div class="col-xs-12 vendor-profile">

            @if(isset($avatarFilename))
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
            @else
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
            @endif
           
                    
            <div class="col-md-8 col-md-offset-2">
                <h1 class="page-title"> {{isset($vendor) ? $vendor->company_name : ''}}</h1>
            </div>

            <button class="btn-primary pull-right" data-toggle="modal" data-target="#headerModal">Edit Header</button>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12">

            <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('vendor/edit')}}">
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        
                        <div class="col-xs-12 col-md-11">
                                
                            <h2 class="item-subhead">Contact</h2>

                            <div class="col-xs-12 well">
                                

                                <label for="address">{{trans('ui.vendor_label_address1')}}</label>
                                <input type="text" name="address1" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->address1 : ''}}"/>

                                <label for="address2">{{trans('ui.vendor_label_address2')}}</label>
                                <input type="text" name="address2" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->address2 : ''}}"/>
                                
                                <label for="city">{{trans('ui.vendor_label_city')}}</label>
                                <input type="text" name="city" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->city : ''}}"/>

                                <label for="state/province">{{trans('ui.vendor_label_state_province')}}</label>
                                <select id="state_province" name="state_province" class="form-control"></select>
                                
                                <label for="country">{{trans('ui.vendor_label_country')}}</label>
                                 <select id="country" name="country" class="form-control"></select>
                                
                                <label for="zip_postal">{{trans('ui.vendor_label_zip_postal')}}</label>

                                <input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control" value="{{isset($vendor) ? $vendor->zip_postal : ''}}"/>

                                <label for="contact_name">{{trans('ui.vendor_label_contact_name')}}</label>

                                <input type="text" name="contact_name" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->contact_name : ''}}"/>

                                <label for="contact_title">{{trans('ui.vendor_label_contact_title')}}</label>
                                <input type="text" name="contact_title" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->contact_title : ''}}"/>

                                <label for="contact_phone">{{trans('ui.vendor_label_contact_phone')}}</label>
                                <input type="text" name="contact_phone" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->contact_phone : ''}}"/>

                                <label for="contact_url">{{trans('ui.vendor_label_contact_url')}}</label>
                                <input type="text" name="contact_url" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->contact_url : ''}}"/>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-xs-12 col-md-8">
                        <h2 class="item-subhead">{{trans('ui.vendor_label_about_text')}}</h2>

                        <div class="col-xs-12 well">
                            
                            <label for="Intro Text">{{trans('ui.vendor_label_intro_text')}}</label>

                            <textarea name="intro_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($vendor) ? $vendor->intro_text : ''}}</textarea>
                            

                            <label for="about_text">{{trans('ui.vendor_label_about_text')}}</label>
                        
                            <textarea name="about_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($vendor) ? $vendor->about_text : ''}}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="item-subhead">{{trans('ui.vendor_label_brands')}}</h2>
                                
                                <div class="col-xs-12 well">
                                    @forelse($vendor->brands as $b)
                                    {{$b->name}} <a href="#" class="deletebrand">Delete</a><br/>
                                    @empty
                                       <p>No Brands Defined</p> 
                                    @endforelse
                                    
                                    <a href="#"><button class="btn-primary">Add Brand</button></a>
                                </div>

                                <input type="submit" value="Update" class="btn-primary"/>
                                <a href="{{url('/profile/')}}"><button class="btn">{{trans('ui.button_cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="headerModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Profile Header</h4>
                          </div>
                      
                          <div class="modal-body">
                            <label for="company name">{{trans('ui.vendor_label_company')}}</label>
                            <input type="text" name="company_name" placeholder="Company Name" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->company_name : ''}}"/>

                            <div class="logo-zone clearfix">
                                <label for="logo">{{trans('ui.vendor_label_logo_image')}}</label>
                                
                                <div class="vendor-logo"></div>
                                
                                <div class="logo-upload">
                                    <input type="file" name="logo_image_path"/>
                                </div>
                            </div>

                            <div class="logo-zone clearfix">
                                <label for="background_image">{{trans('ui.vendor_label_background_image')}}</label>
                                <p>For best results, crop your photo to 930px x 275px</p>
                                <div class="vendor-background"></div>
                                
                                <div class="logo-upload">
                                    <input type="file" name="background_image_path"/>
                                </div>
                            </div>
                          </div>
                      
                          <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn-primary">Save changes</button>
                          </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                

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

            var $country = $("#country");

            fsh.common.doAjax("{{url('ajax/getcountries')}}", {}, "GET", true,
                    function(data)
                    {
                        var html = "<option value=''></option>";
                        $.each(data, function(idx, val)
                        {
                            //console.log(val);
                            if(val.id == "{{isset($vendor) ? $vendor->country : ''}}")
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
                                    if(val.id == "{{isset($vendor) ? $vendor->state_province : ''}}")
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