@extends('layouts.master')

@section('title', trans('ui.navigation_editavatar'))

@section('css')
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
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $profile->avatar_image_path)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
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
                            <p>Delete your existing avatar?</p>
                        
                            <div class="delete-avatar">
                                <img src="../../public/img/icons/trash.svg" alt="">
                                <a href="#" id="hlRemoveAvatar" class="delete-avatar">{{trans('ui.navigation_link_deleteavatar')}}</a>
                            </div>
                         </div>
                    @endif

                    <div class="bg-info col-xs-12">
                        <p>Select a new avatar for your profile.</p>
                        <div class="change-avatar">
                            <img src="../../public/img/icons/user.svg">
                            <a href="#" id="hlNewAvatar">{{trans('ui.navigation_link_changeavatar')}}</a>
                        </div>
                    
                        <input type="file" id="avatar_image_path" name="avatar_image_path" style="opacity: 0; height: 0px; width: 0px;"/>
                    </div>
                    
                    <div class="row">
                        @if(isset($isCropMode))

                        <div class="col-xs-12" id="divCropArea">
                            <img id="uncroppedImage" src="{{url(config('app.avatar_storage') . '/' . $profile->avatar_image_path)}}"/>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="btn-row">
                            <a href="#" id="hlCropAvatar" class="btn-primary">Crop</a>
                            <a href="#" id="hlCancelCropAvatar" class="btn">{{trans('ui.button_cancel')}}</a>
                        </div>
                    </div>

                    @endif

                    @if(!isset($isCropMode))
                    <div class="col-xs-12">
                        <div class="btn-row">
                            <input type="submit" id="btnUpdate" value="{{trans('ui.button_update')}}" class="btn-primary"/>
                            <a href="{{url('/profile/')}}" class="btn">{{trans('ui.button_cancel')}}</a>
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
                movable: false,
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