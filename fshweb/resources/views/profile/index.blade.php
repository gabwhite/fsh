@extends('layouts.master')

@section('title', trans('ui.navigation_profile'))

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
            <h1 class="page-title">
                {{$user->name}}
            </h1>
        </div>
    </div>
</section>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 col-md-4">
        <div class="col-xs-12 col-md-11">
            
            <h2 class="item-subhead">Contact</h2>

            <div class="col-xs-12 well">
                <label for="email">Email</label>
                <p>{{$user->email}}</p>
            </div>

        </div>
    </div>

    <div class="col-xs-12 col-md-8">
        <div class="row">
            <div class="col-xs-12">
                
                <h2 class="item-subhead">About Us</h2>

                <div class="col-xs-12 well">
                    <p>{{$user->bio}}</p>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                
                <h2 class="item-subhead">Our Brands</h2>

                <div class="col-xs-12 well">
                    <div class="flexslider">
                      <ul class="slides">
                        <li style="background: url(../public/img/slider/campbells-brand-logo.png); background-repeat: no-repeat; background-position: center center;">
                          
                        </li>

                        <li style="background: url(../public/img/slider/pepperidgefarm-logo.png); background-repeat: no-repeat; background-position: center center;">
                        </li>

                        <li style="background: url(../public/img/slider/ROLAND-LOGO-BANNER-SIZE.png); background-repeat: no-repeat; background-position: center center;">
                        </li>
                        <li style="background: url(../public/img/slider/ROLAND-LOGO-BANNER-SIZE.png); background-repeat: no-repeat; background-position: center center;">
                    
                        </li>
                        <!-- items mirrored twice, total of 12 -->
                      </ul>
                    </div>
                       
                </div>
            </div>
        </div>


        <p class="bg-info">
            <a href="{{url('profile/edit')}}">{{trans('ui.navigation_link_editprofile')}}</a>
        </p>

        <p class="bg-info">
            <a href="{{url('profile/avatar')}}">{{trans('ui.navigation_link_changeavatar')}}</a>
        </p>

        @if($user->hasRole('vendor'))

            @if(isset($vendorId))
            <p class="bg-info">
                <a href="{{url('vendor/detail', $vendorId)}}">{{trans('ui.navigation_link_viewvendor')}}</a>
            </p>
            @endif

            @if($vendorOwner)
            <p class="bg-info">
                <a href="{{url('vendor/edit')}}">{{trans('ui.navigation_link_editvendor')}}</a>
            </p>
            @endif

            <p class="bg-info">
                <a href="{{url('product/vendor')}}">{{trans('ui.navigation_link_myproducts')}}</a>&nbsp;(<a href="{{url('product/edit')}}">{{trans('ui.navigation_link_addnewproduct')}}</a>)
            </p>
        @endif

        @if($user->hasRole('admin'))
            <p class="bg-danger">
            You have <a href="{{url('/admin')}}">administrative</a> access
            </p>
        @endif

    </div>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 225,
            itemMargin: 10
        });
    });
</script>

@endsection