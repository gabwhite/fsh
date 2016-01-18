@extends('layouts.master')

@section('title', trans('ui.navigation_profile'))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap profile-head'>
    <div class="container">
        <div class="col-xs-12 col-md-4">
          @if(isset($avatarFilename))
              <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
          @else
              <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
          @endif      
        </div>

        <div class="col-xs-12 col-md-8">  

            <h1 class="item-title">{{trans('ui.navigation_link_editprofile')}}</h1>
            
            <a href="{{url('profile/avatar')}}"><button class="btn-primary">{{trans('ui.navigation_link_changeavatar')}}</button></a>
            
        </div>
    </div>
</section>
            

@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 col-md-8 col-md-offset-4">
        <div class="col-xs-12 well">
            
            <form id="form1" name="form1" method="post" action="{{url('profile/edit')}}">

                <div class="detail-row">
                    <label for="email">{{trans('ui.user_label_email')}}</label>
                    <input type="text" name="email" placeholder="" class="form-control" value="{{Auth::user()->email}}" maxlength="100"/>  
                </div>

                <div class="detail-row">
                    <label for="password">{{trans('ui.user_label_password')}}</label>

                    <input type="password" name="password" placeholder="" class="form-control" maxlength="25"/>
                </div>
                    
                
                <div class="detail-row">
                    <label for="confirm password">{{trans('ui.user_label_confirmpassword')}}</label>    
                    
                    <input type="password" name="confirmpassword" placeholder="" class="form-control" maxlength="25"/>
                </div>
            
                <div class="detail-row">
                    <label for="firstname">{{trans('ui.user_label_firstname')}}</label>
                        
                    <input type="text" name="firstname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->firstname : ''}}"/>
                </div>
                
                <div class="detail-row">
                    <label for="lastname">{{trans('ui.user_label_lastname')}}</label>
                    
                    <input type="text" name="lastname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->lastname : ''}}"/>
                </div>

                <div class="detail-row">
                    <label for="bio">{{trans('ui.user_label_bio')}}</label>
                    
                    <textarea name="bio" class="form-control" placeholder="" cols="80" rows="5">{{isset($profile) ? $profile->bio : ''}}</textarea>
                </div>


            </form>
        </div>
        <div class="row btn-row">
            <div class="col-xs-12">
                <input type="submit" value="{{trans('ui.button_update')}}" class="btn-primary"/>
                <a href="{{url('/profile')}}"><button class="btn">{{trans('ui.button_cancel')}}</button</a>
            </div>
        </div>

        {!! csrf_field() !!}
    </div>

</div>

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    email: { required: true, email: true, maxlength: 100 },
                    password: { maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 }
                }
            });

        });
    </script>
@endsection