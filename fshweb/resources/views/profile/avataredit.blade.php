@extends('layouts.master')

@section('title', trans('ui.navigation_editavatar'))

@section('css')
    <link type="text/css" rel="stylesheet" href="{{url('css/cropper.min.css')}}"/>
    <style type="text/css">
        #divCropArea { width: 400px; height: 400px;  }
    </style>
@endsection

@section('sectionheader')
    {{trans('ui.navigation_editavatar')}}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('profile/avatar')}}">

                <div class="row">

                    <div class="col-md-2">
                        @if(isset($profile) && isset($profile->avatar_image_path) && !isset($isCropMode))
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $profile->avatar_image_path)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
                        @else
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
                        @endif
                    </div>

                    <div class="col-md-7">
                        @if(isset($profile) && isset($profile->avatar_image_path))
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="#" id="hlRemoveAvatar">{{trans('ui.navigation_link_deleteavatar')}}</a><br/>
                        @endif
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<a href="#" id="hlNewAvatar">{{trans('ui.navigation_link_changeavatar')}}</a>
                            <input type="file" id="avatar_image_path" name="avatar_image_path" style="opacity: 0; height: 0px; width: 0px;"/>
                    </div>

                </div>

                @if(isset($isCropMode))
                <div class="row">

                    <div class="col-md-offset-2" id="divCropArea">
                        <img id="uncroppedImage" src="{{url(config('app.avatar_storage') . '/' . $profile->avatar_image_path)}}"/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-offset-2">
                        <a href="#" id="hlCropAvatar" class="btn btn-primary btn-lg">Crop</a>
                        <a href="#" id="hlCancelCropAvatar" class="btn btn-lg">{{trans('ui.button_cancel')}}</a>
                    </div>
                </div>

                @endif

                @if(!isset($isCropMode))
                <div class="row">
                    <div class="col-md-offset-2">
                        <input type="submit" id="btnUpdate" value="{{trans('ui.button_update')}}" class="btn btn-primary btn-lg"/>
                        <a href="{{url('/profile/')}}" class="btn btn-lg">{{trans('ui.button_cancel')}}</a>
                    </div>
                </div>
                @endif

                <input type="hidden" id="current_avatar_image_path" name="current_avatar_image_path" value="{{isset($profile) ? 1 : 0}}"/>
                <input type="hidden" id="action" name="action" value="UPDATE"/>
                <input type="hidden" id="cropdata" name="cropdata" value=""/>

                {!! csrf_field() !!}
            </form>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/cropper/cropper.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {

            $("#uncroppedImage").cropper({

                rotatable: false,
                scalable: false,
                zoomable: false,
                crop: function(e)
                {
                    //console.log(e.x);
                    //console.log(e.y);
                    //console.log(e.width);
                    //console.log(e.height);
                    //console.log(e.rotate);
                    //console.log(e.scaleX);
                    //console.log(e.scaleY);

                    var cropData = e.width + ";" + e.height + ";" + e.x + ";" + e.y + ";" + e.rotate + ";" + e.scaleX + ";" + e.scaleY;
                    console.log(cropData);
                    $("#cropdata").val(cropData);

                }
            });

            $("#btnUpdate").on("click", function(e)
            {
                $("#action").val("UPDATE");
                $("#form1").submit();
            });

            $("#hlCropAvatar").on("click", function(e)
            {
                $("#action").val("CROP");
                $("#form1").submit();
            });

            $("#hlCancelCropAvatar").on("click", function(e)
            {
                $("#action").val("DELETE");
                $("#form1").submit();
            });

            $("#hlNewAvatar").on("click", function(e)
            {
                $("#avatar_image_path").click();
                e.preventDefault();
            });

            $("#hlRemoveAvatar").on("click", function(e)
            {
                if(confirm("Remove current avatar?"))
                {
                    //$("#current_avatar_image_path").val("0");
                    $("#action").val("DELETE");
                    $("#form1").submit();
                }
                e.preventDefault();
            });

        });
    </script>
@endsection