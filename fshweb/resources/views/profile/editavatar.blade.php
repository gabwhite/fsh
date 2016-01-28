@extends('layouts.master')

@section('title', trans('ui.navigation_editavatar'))

@section('css')
    <link type="text/css" rel="stylesheet" href="{{url('css/dropzone/dropzone.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{url('css/cropper.min.css')}}"/>
    <style type="text/css">
        #divCropArea { width: 400px; height: 400px;  }
    </style>
@endsection

@section('sectionheader')
<section class='clearfix container-wrap profile-head'>
    <div class="container">
        <div class="col-xs-12 col-md-4">
            @if(isset($profile) && isset($profile->avatar_image_path) && !isset($isCropMode))
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $profile->avatar_image_path)}}?{{\Carbon\Carbon::now()->timestamp}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
            @else
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
            @endif
        </div>
        <div class="col-xs-12 col-md-8">
            <h1 class="item-title">{{trans('ui.navigation_editavatar')}}</h1>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-8 col-md-offset-4">
            <div class="col-xs-12 well">
            
                <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('profile/avatar')}}">
                        
                    @if(isset($profile) && isset($profile->avatar_image_path))
                        <div class="col-xs-12 bg-info">
                            <p>{{trans('messages.profile_delete_avatar')}}</p>
                        
                            <div class="delete-avatar">
                                <img src="{{url('/img/icons/trash.svg')}}" alt="">
                                <a href="#" id="hlRemoveAvatar" class="delete-avatar">{{trans('ui.navigation_link_deleteavatar')}}</a>
                            </div>
                         </div>
                    @endif

                    <div id="divCropArea" style="display:none">

                        <div class="row">
                            <div class="col-xs-12">
                                <img id="uncroppedImage" src=""/>
                                <a href="#" id="hlCropAvatar"><button class="btn-primary">Crop</button></a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="btn-row">

                            </div>
                        </div>
                    </div>

                    <div class="bg-info col-xs-12">
                        <p>{{trans('messages.profile_select_avatar')}}</p>
                        <div id="avatarUploader" class="dropzone"></div>
                    </div>

                    <input type="hidden" id="current_avatar_image_path" name="current_avatar_image_path" value="{{isset($profile) ? 1 : 0}}"/>
                    <input type="hidden" id="action" name="action" value="UPDATE"/>
                    <input type="hidden" id="cropdata" name="cropdata" value=""/>

                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/dropzone/dropzone.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/vendor/cropper/cropper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.search.js')}}"></script>
    <script type="text/javascript">

        var csrf = "{{ csrf_token() }}";

        $(document).ready(function()
        {
            var $uncroppedImage = $("#uncroppedImage");
            var $cropArea = $("#divCropArea");
            var $currentAvatar = $("#imgCurrentAvatar");
            var $noAvatarImage = "{{url(config('app.avatar_none'))}}";

            $("#uncroppedImage").cropper({

                rotatable: false,
                scalable: false,
                zoomable: false,
                movable: false,
                viewMode: 0,
                aspectRatio: 1 / 1,
                crop: function(e)
                {
                    //console.log(e.x);
                    //console.log(e.y);
                    //console.log(e.width);
                    //console.log(e.height);
                    //console.log(e.rotate);
                    //console.log(e.scaleX);
                    //console.log(e.scaleY);

                    //var cropData = e.width + ";" + e.height + ";" + e.x + ";" + e.y + ";" + e.rotate + ";" + e.scaleX + ";" + e.scaleY;
                    //console.log(cropData);
                    //$("#cropdata").val(cropData);
                }
            });

            Dropzone.options.avatarUploader =
            {
                url: "{{url('/profile/avatar')}}",
                paramName: "avatar_image_path",
                uploadMultiple: false,
                addRemoveLinks: false,
                previewsContainer: null,
                headers: { "X-CSRF-TOKEN": csrf, "ACTION": "UPDATE"},
                init: function()
                {
                    //console.log("Dropzone init'ed");
                    this.on("success", function(e, response)
                    {
                        $cropArea.show();
                        var imgSrc = "{{url('img/avatars/')}}/" + response.filename + "?" + (Math.floor(Date.now() / 1000));
                        console.log(imgSrc);
                        //$uncroppedImage.attr("src", imgSrc);
                        this.removeAllFiles();
                        //console.log(response);

                        $("#uncroppedImage").cropper("replace", imgSrc);

                    });
                }
            };

            $("#hlCropAvatar").on("click", function(e)
            {
                e.preventDefault();

                var objCropData = $("#uncroppedImage").cropper("getData", true)
                var cropData = objCropData.width + ";" + objCropData.height + ";" + objCropData.x + ";" + objCropData.y;

                //var headers = { "X-CSRF-TOKEN": csrf, "ACTION": "CROP", "cropdata": $("#cropdata").val() };
                var headers = { "X-CSRF-TOKEN": csrf, "ACTION": "CROP", "cropdata": cropData };

                fsh.common.doAjax("{{url('/profile/avatar')}}", {}, "POST", true, headers,
                    function(result)
                    {
                        $cropArea.hide();
                        var imgSrc = "{{url('img/avatars/')}}/" + result.filename;
                        $currentAvatar.attr("src", imgSrc);
                    },
                    function()
                    {
                        alert("{{trans('messages.profile_error_crop_avatar')}}");
                    }
                );
            });

            $("#hlRemoveAvatar").on("click", function(e)
            {
                e.preventDefault();

                if(confirm("{{trans('messages.profile_delete_avatar')}}"))
                {
                    deleteAvatar();
                }
            });

            $("#hlCancelCropAvatar").on("click", function(e)
            {
                e.preventDefault();
                deleteAvatar();
            });

        });


        function deleteAvatar()
        {
            var headers = { "X-CSRF-TOKEN": csrf, "ACTION": "DELETE" };
            fsh.common.doAjax("{{url('/profile/avatar')}}", {}, "POST", true, headers,
                function(result)
                {
                    alert("deleted");
                    $currentAvatar.attr("src", $noAvatarImage);
                },
                function()
                {
                    alert("{{trans('messages.profile_error_delete_avatar')}}}");
                }
            );
        }
    </script>
@endsection