@extends('layouts.master')

@section('title', trans('ui.navigation_editavatar'))

@section('css')

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
                        @if(isset($profile) && isset($profile->logo_image_path))
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $profile->logo_image_path)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
                        @else
                            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
                        @endif
                    </div>

                    <div class="col-md-7">
                        @if(isset($profile) && isset($profile->logo_image_path))
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="#" id="hlRemoveAvatar">{{trans('ui.navigation_link_deleteavatar')}}</a><br/>
                        @endif
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<a href="#" id="hlNewAvatar">{{trans('ui.navigation_link_changeavatar')}}</a>
                            <input type="file" id="logo_image_path" name="logo_image_path" style="opacity: 0; height: 0px; width: 0px;"/>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-offset-2">
                        <input type="submit" value="{{trans('ui.button_update')}}" class="btn btn-primary btn-lg"/>
                        <a href="{{url('/profile/')}}" class="btn btn-lg">{{trans('ui.button_cancel')}}</a>
                    </div>
                </div>

                <input type="hidden" id="current_logo_image_path" name="current_logo_image_path" value="{{isset($profile) ? 1 : 0}}"/>

                {!! csrf_field() !!}
            </form>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function()
        {

            $("#hlNewAvatar").on("click", function(e)
            {
                $("#logo_image_path").click();
                e.preventDefault();
            });

            $("#hlRemoveAvatar").on("click", function(e)
            {
                if(confirm("Remove current avatar?"))
                {
                    $("#current_logo_image_path").val("0");
                    $("#form1").submit();
                }
                e.preventDefault();
            });

        });
    </script>
@endsection