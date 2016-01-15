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
            
            <h1 class="item-title">
                {{$user->name}}
            </h1>

            <div class="btn-row">
                <button class="btn-sm"><a href="{{url('profile/edit')}}">{{trans('ui.navigation_link_editprofile')}}</a></button>
            </div>

            @if($user->hasRole('vendor'))

                @if(isset($vendorId))
                <button class="btn-sm">
                    <a href="{{url('vendor/detail', $vendorId)}}">{{trans('ui.navigation_link_viewvendor')}}</a>
                </button>
               
                @endif

                @if($vendorOwner)
                <button class="btn-sm">
                    
                    <a href="{{url('vendor/edit')}}">{{trans('ui.navigation_link_editvendor')}}</a>
                </button>
                @endif

                
                
            @endif

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
                
                <h2 class="item-subhead">Bio</h2>

                <div class="col-xs-12 well">
                    <p>{{$bio}}</p>
                </div>

            </div>
        </div>
        
        @if($user->hasRole('vendor'))
            @if($vendorOwner)
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="item-subhead">My Products</h2>
                    <div class="col-xs-12 well">
                        
                        <p>Edit existing products or upload new products.</p>
                        
                        <button class="btn-primary">
                            <a href="{{url('product/vendor')}}">{{trans('ui.navigation_link_myproducts')}}</a>
                        </button>

                        <button class="btn-primary">
                            <a href="{{url('product/edit')}}">{{trans('ui.navigation_link_addnewproduct')}}</a>
                        </button>
                    </div>
                </div>
            </div>   
            @endif
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


@endsection