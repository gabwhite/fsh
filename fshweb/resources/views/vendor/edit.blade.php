@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
<link type="text/css" rel="stylesheet" href="{{url('css/dropzone/dropzone.min.css')}}"/>
@endsection

@section('sectionheader')
<section class='clearfix container-wrap main-title'>
    <div class="container">
        <div id="bgImage" class="col-xs-12 vendor-profile" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),  url('{{ ($vendor->background_image_path) ? url(config('app.vendor_storage') . '/' . $vendor->background_image_path) : '' }}') no-repeat; background-size: cover; background-position: center center;">

            @if($vendor->logo_image_path)
                <div class="vendor-profile-img" id="imgCurrentAvatar" style="background: url({{url(config('app.vendor_storage') . '/' . $vendor->logo_image_path)}}) #fff no-repeat; background-size: 80%; background-position: center center;"></div>
               
            @else
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
            @endif
           
                    
            <div class="col-md-8 col-md-offset-2">
                <h1 id="h1CompanyName" class="page-title"> {{isset($vendor) ? $vendor->company_name : ''}}</h1>
            </div>

            <button class="btn-primary pull-right edit-header" data-toggle="modal" data-target="#headerModal">{{trans('ui.vendor_label_edit_header')}}</button>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12">

            <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('vendor/edit')}}">
                <div class="row">
                    <div class="col-xs-12 col-md-4 drop-padding">
                        
                        <div class="col-xs-12 col-md-11 drop-padding">
                                
                            <h2 class="item-subhead">Contact</h2>

                            <div class="col-xs-12 well">
                                

                                <label for="address">{{trans('ui.vendor_label_address1')}}</label>
                                <input type="text" name="address1" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->address1 : ''}}"/>

                                <label for="address2">{{trans('ui.vendor_label_address2')}}</label>
                                <input type="text" name="address2" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->address2 : ''}}"/>
                                
                                <label for="city">{{trans('ui.vendor_label_city')}}</label>
                                <input type="text" name="city" placeholder="" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->city : ''}}"/>
                                
                                <label for="country_id">{{trans('ui.vendor_label_country')}}</label>
                                 <select id="country_id" name="country_id" class="form-control"></select>

                                <label for="state_province_id">{{trans('ui.vendor_label_state_province')}}</label>
                                <select id="state_province_id" name="state_province_id" class="form-control">
                                    <option value=""></option>
                                    <option value="">{{trans('ui.vendor_label_choose_country')}}</option>
                                </select>
                            
                                
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
                
                    <div class="col-xs-12 col-md-8 drop-padding">
                        <h2 class="item-subhead">{{trans('ui.vendor_label_about_text')}}</h2>

                        <div class="col-xs-12 well">
                            
                            <label for="Intro Text">{{trans('ui.vendor_label_intro_text')}}</label>

                            <textarea name="intro_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($vendor) ? $vendor->intro_text : ''}}</textarea>
                            

                            <label for="about_text">{{trans('ui.vendor_label_about_text')}}</label>
                        
                            <textarea name="about_text" class="form-control" placeholder="" cols="80" rows="3">{{isset($vendor) ? $vendor->about_text : ''}}</textarea>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 drop-padding">
                                <h2 class="item-subhead">{{trans('ui.vendor_label_brands')}}</h2>
                                
                                <div class="col-xs-12 well">
                                    <div id="brandUploader" class="dropzone"></div>

                                    <div id="currentbrands">
                                    @foreach($vendor->brands as $b)
                                
                                        <div class="divBrand" style="background: url('{{url(config('app.vendor_storage'))}}/{{$b->logo_image_path}}') no-repeat; background-size:100px; background-position: center center;">
                                        
                                            <a href="#" class="deletebrand" data-brandid="{{$b->id}}" data-imagename="{{$b->logo_image_path}}"><span><img src="{{url('/img/icons/trash.svg')}}" alt=""></span>{{trans('ui.button_delete')}}</a>
                                        </div>
                                                
                                       
                                        @endforeach
                                            <p id="nobrands" style="display:none;">{{trans('ui.vendor_label_no_brands')}}</p>
                                    </div>
                                    
                                </div>
                                <div class="col-xs-12 drop-padding">
                                    
                                    <div class="row btn-row pull-right">
                                        <a href="{{url('/profile/')}}"><button type="button" class="btn">{{trans('ui.button_cancel')}}</button></a>
                                        <input type="submit" value="{{trans('ui.button_update')}}" class="btn-primary"/>
                                        
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
                            <input type="text" id="company_name" name="company_name" placeholder="{{trans('ui.vendor_label_company')}}" maxlength="200" class="form-control" value="{{isset($vendor) ? $vendor->company_name : ''}}"/>

                            <div class="logo-zone clearfix">
                                <label for="logo">{{trans('ui.vendor_label_logo_image')}}</label>
                                
                                    @if($vendor->logo_image_path)
                                    <div class="vendor-logo" id="logoImageModal" style="background: url({{url('img/vendors', $vendor->logo_image_path)}}) no-repeat; background-size: contain; background-position: center;">
                                       
                                    </div>
                                    @else
                                    <div id="logoImageModal" class="vendor-logo" style="background: url({{url(config('app.avatar_none'))}}) no-repeat; background-size: contain; background-position: center;"></div>
                                    @endif
                                
                                <div id="logoUploader" class="logo-upload dropzone">
                                </div>
                            </div>

                            <div class="logo-zone clearfix">
                                <label for="background_image">{{trans('ui.vendor_label_background_image')}}</label>
                                <p>{{trans('messages.vendor_background_image_notice')}}</p>
                                
                                @if($vendor->background_image_path)
                                    <div id="backgroundImageModal" class="vendor-background" style="background: url('{{url('img/vendors', $vendor->background_image_path)}}') no-repeat; background-size: cover; background-position: center;"></div>
                                    @endif
                                <div id="backgroundUploader" class="logo-upload dropzone"></div>
                            </div>
                          </div>
                      
                          <div class="modal-footer btn-row drop-padding">
                            <button type="button" class="btn" data-dismiss="modal">{{trans('ui.button_close')}}</button>
                            <a href="#" id="hlSaveHeader"><button type="button" class="btn-primary">{{trans('ui.button_save')}}</button></a>
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
            var $logoImage = $("#imgCurrentAvatar");
            var $logoImageModal = $("#logoImage");
            var $bgImage = $("#bgImage");
            var $bgImageModal = $("#backgroundImageModal");
            var $companyNameHeader = $("#h1CompanyName");
            var $companyNameTextbox = $("#company_name");

            var $noBrands = $("#nobrands");
            var vid = "{{\Session::get(config('app.session_key_vendor'))}}";
            var csrf = "{{ csrf_token() }}";

            if($brandContainer.find(".divBrand").length === 0) { $noBrands.show(); }

            $brandContainer.on("click", ".deletebrand", function(e)
            {
                e.preventDefault();
                if(confirm("Delete Brand?"))
                {
                    var parentElem = $(this).parent();

                    var headers = {
                        "X-CSRF-TOKEN": csrf,
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
                headers: { "X-CSRF-TOKEN": csrf, "VID": vid},
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

                    this.on("error", function(e, errorMessage, xhr)
                    {
                        console.log(errorMessage);
                    });
                }
            };

            Dropzone.options.logoUploader =
            {
                url: "{{url('/vendor/edit/addasset')}}",
                paramName: "logo_image_path",
                uploadMultiple: false,
                addRemoveLinks: false,
                previewsContainer: null,
                headers: { "X-CSRF-TOKEN": csrf, "VID": vid},
                init: function()
                {
                    //console.log("Dropzone init'ed");
                    this.on("success", function(e, response)
                    {
                        $logoImage.attr("src", "{{url('img/vendors/')}}/" + response.filename);
                        $logoImageModal.attr("src", "{{url('img/vendors/')}}/" + response.filename);
                        this.removeAllFiles();
                    });

                    this.on("error", function(e, response, xhr)
                    {
                        this.removeAllFiles();
                        alert("Error: " + response.message);
                        //console.log(response);
                    });
                }
            };

            Dropzone.options.backgroundUploader =
            {
                url: "{{url('/vendor/edit/addasset')}}",
                paramName: "background_image_path",
                uploadMultiple: false,
                addRemoveLinks: false,
                previewsContainer: null,
                headers: { "X-CSRF-TOKEN": csrf, "VID": vid},
                init: function()
                {
                    //console.log("Dropzone init'ed");
                    this.on("success", function(e, response)
                    {
                        $bgImage.attr("src", "{{url('img/vendors/')}}/" + response.filename);
                        $bgImageModal.attr("src", "{{url('img/vendors/')}}/" + response.filename);
                        this.removeAllFiles();
                    });

                    this.on("error", function(e, response, xhr)
                    {
                        this.removeAllFiles();
                        alert("Error: " + response.message);
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

            $("#hlSaveHeader").on("click", function(e)
            {
                e.preventDefault();

                var headers = { "X-CSRF-TOKEN": csrf };

                fsh.common.doAjax("{{url('/vendor/edit/variableupdate')}}", { "VID": vid, "company_name": $companyNameTextbox.val()}, "POST", true, headers,
                    function(result)
                    {
                        $companyNameHeader.html($companyNameTextbox.val());
                        $("#headerModal").modal("hide");
                    },
                    function()
                    {
                        alert("Error updating header info");
                    });

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