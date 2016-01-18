@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
<link type="text/css" rel="stylesheet" href="{{url('css/dropzone/dropzone.min.css')}}"/>
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

            <button class="btn-primary pull-right" data-toggle="modal" data-target="#headerModal">{{trans('ui.vendor_label_edit_header')}}</button>
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

                                <label for="state_province_id">{{trans('ui.vendor_label_state_province')}}</label>
                                <select id="state_province_id" name="state_province_id" class="form-control">
                                    <option value=""></option>
                                    <option value="">{{trans('ui.vendor_label_choose_country')}}</option>
                                </select>
                                
                                <label for="country_id">{{trans('ui.vendor_label_country')}}</label>
                                 <select id="country_id" name="country_id" class="form-control"></select>
                                
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
                                    <div id="brandUploader" class="dropzone"></div>

                                    <div id="currentbrands">
                                    @foreach($vendor->brands as $b)
                                
                                        <div class="divBrand" style="background: url('{{url(config('app.vendor_storage'))}}/{{$b->logo_image_path}}') no-repeat; background-size:100px; background-position: center center;">
                                        
                                            <a href="#" class="deletebrand" data-brandid="{{$b->id}}" data-imagename="{{$b->logo_image_path}}"><span><img src="../../public/img/icons/trash.svg" alt=""></span>{{trans('ui.button_delete')}}</a>
                                        </div>
                                                
                                       
                                        @endforeach
                                            <p id="nobrands" style="display:none;">{{trans('ui.vendor_label_no_brands')}}</p>
                                    </div>
                                    
                                    
                                <a href="#"><button class="btn-primary">{{trans('ui.vendor_label_add_brand')}}</button></a>
                                    </div>
                                <div class="col-xs-12">
                                    
                                    <div class="row btn-row">
                                        <input type="submit" value="{{trans('ui.button_update')}}" class="btn-primary"/>
                                        <a href="{{url('/profile/')}}"><button class="btn">{{trans('ui.button_cancel')}}</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="headerModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <div class="modal-header">
                            <h4 class="modal-title">{{trans('ui.vendor_label_edit_profile_header')}}</h4>
                          </div>
                      
                          <div class="modal-body">
                            <label for="company name">{{trans('ui.vendor_label_company')}}</label>
                            <input type="text" name="company_name" placeholder="{{trans('ui.vendor_label_company')}}" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->company_name : ''}}"/>

                            <div class="logo-zone clearfix">
                                <label for="logo">{{trans('ui.vendor_label_logo_image')}}</label>
                                
                                <div class="vendor-logo"></div>
                                
                                <div class="logo-upload">
                                    <input type="file" name="logo_image_path"/>
                                </div>
                            </div>

                            <div class="logo-zone clearfix">
                                <label for="background_image">{{trans('ui.vendor_label_background_image')}}</label>
                                <p>{{trans('messages.vendor_background_image_notice')}}</p>
                                <div class="vendor-background"></div>
                                
                                <div class="logo-upload">
                                    <input type="file" name="background_image_path"/>
                                </div>
                            </div>
                          </div>
                      
                          <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">{{trans('ui.button_close')}}</button>
                            <button type="button" class="btn-primary">{{trans('ui.button_save')}}</button>
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

    <script type="text/javascript" src="{{url('js/vendor/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.common.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            var $brandContainer = $("#currentbrands");
            var $noBrands = $("#nobrands");
            var vid = "{{\Session::get(config('app.session_key_vendor'))}}";

            if($brandContainer.find(".divBrand").length === 0) { $noBrands.show(); }

            $("#currentbrands").on("click", ".deletebrand", function(e)
            {
                e.preventDefault();
                if(confirm("Delete Brand?"))
                {
                    var parentElem = $(this).parent();

                    var headers = {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "BID": $(this).data("brandid"),
                        "VID": vid,
                        "FNAME": $(this).data("imagename")
                    };

                    fsh.common.doAjax("{{url('/vendor/edit/deletebrand')}}", {}, "POST", true, headers,
                            function (data)
                            {
                                parentElem.remove();
                                if($brandContainer.find(".divBrand").length === 0) { $noBrands.show(); }
                            },
                            function (jqXhr, textStatus, errorThrown)
                            {
                                alert("Error deleting file");
                            }
                    );
                }
            });

            Dropzone.options.brandUploader =
            {
                url: "{{url('/vendor/edit/addbrand')}}",
                paramName: "brand_image_path",
                uploadMultiple: false,
                addRemoveLinks: false,
                previewsContainer: null,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "VID": vid},
                init: function()
                {
                    //console.log("Dropzone init'ed");
                    this.on("success", function(e, response)
                    {
                        $noBrands.hide();

                        var imgSrc = "{{url('img/vendors/')}}/" + response.filename;
                        $brandContainer.append("<div class='divBrand'><img src='" + imgSrc + "'/><br/><a href='#' class='deletebrand' data-brandid='" + response.id + "' data-imagename='" + response.filename + "'>Delete</a></div>");
                        this.removeAllFiles();
                        //console.log(response);
                    });
                }
            };

            var $country = $("#country_id");
            var $stateProvince = $("#state_province_id");

            fsh.common.getCountries("{{url('ajax/getcountries')}}", $country, "{{isset($vendor) ? $vendor->country_id : ''}}");

            $country.on("change", function(e)
            {
                if($(this).val() === "")
                {
                    $("#state_province_id option[value != '']").remove();
                    $stateProvince.html("<option value=\"\"></option><option value=\"\">{{trans('ui.vendor_label_choose_country')}}</option>");
                }
                else
                {
                    fsh.common.getStateProvincesForCountry("{{url('ajax/getstateprovincesforcountry')}}/" + $(this).val(),
                                                            $stateProvince,
                                                            "{{isset($vendor) ? $vendor->state_province_id : ''}}");
                }

                e.preventDefault();
            });


            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    company_name: { required: true, maxlength: 200 },
                    country_id: { required: true },
                    state_province_id: { required: true },
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