@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{url('js/vendor/fineuploader/fine-uploader.min.css')}}"/>
@endsection

@section('sectionheader')
    EDIT AVATAR
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="{{url('profile/edit')}}">

                <div class="row">

                    <div class="col-md-2">
                        @if(isset($profile) && isset($profile->logo_image_path))
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $profile->logo_image_path)}}" width="200" height="200"/>
                        @else
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="No avatar" width="200" height="200"/>
                        @endif
                    </div>

                    <div class="col-md-7">
                        @if(isset($profile) && isset($profile->logo_image_path))
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="#" id="hlRemoveAvatar">Delete current avatar</a>
                        @endif
                        <a href="#">Choose new avatar</a>
                        <input type="file" name="logo_image_path"/>
                    </div>

                </div>

                <input type="hidden" id="current_logo_image_path" name="current_logo_image_path" value="{{isset($profile) ? 1 : 0}}"/>

                {!! csrf_field() !!}
            </form>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/fineuploader/fine-uploader.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {

            var uploader = new qq.FineUploaderBasic({/* options go here .... */});

            $("#hlRemoveAvatar").on("click", function(e)
            {
                if(confirm("Remove current avatar?"))
                {
                    $("#current_logo_image_path").val("0");
                    $("#divCurrentAvatar").remove();
                }
                e.preventDefault();
            });

        });
    </script>
@endsection