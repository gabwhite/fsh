@extends('layouts.master')

@section('title', trans('ui.navigation_profile'))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap profile-head'>
    <div class="container">
        <div class="col-xs-12 col-md-4 drop-padding">
            @if(isset($avatarFilename))
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
            @else
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
            @endif
        </div>

        <div class="col-xs-12 col-md-8 drop-padding">  
            
            <h1 class="edit-profile">
                {{$user->name}}
            </h1>

            <div class="btn-row">
                <a href="{{url('profile/edit')}}"><button class="btn-sm">{{trans('ui.navigation_link_editprofile')}}</button></a>
                <a href="{{url('profile/favorites')}}"><button class="btn-sm">Favorite Products</button></a>

                @if($user->hasRole('vendor'))

                    @if(isset($vendorId))
                        <a href="{{url('vendor/detail', $vendorId)}}"><button class="btn-sm">{{trans('ui.navigation_link_viewvendor')}}</button></a>
                    
                    @endif

                    @if($vendorOwner)
                    <a href="{{url('vendor/edit')}}"><button class="btn-sm">{{trans('ui.navigation_link_editvendor')}}</button></a>
                    
                    @endif

                @endif
            </div>

        </div>
    </div>
</section>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 col-md-4 drop-padding">
        <div class="col-xs-12 col-md-11">
            
            <h2 class="item-subhead">{{trans('ui.user_label_contact')}}</h2>

            <div class="col-xs-12 well">
                <label for="email">{{trans('ui.user_label_email')}}</label>
                <p>{{$user->email}}</p>
            </div>

        </div>
    </div>

    <div class="col-xs-12 col-md-8 drop-padding">
        <div class="col-xs-12">
            
            <h2 class="item-subhead">{{trans('ui.user_label_bio')}}</h2>

            <div class="col-xs-12 well">
                <p>{{$bio or trans('messages.profile_no_bio')}}</p>
            </div>

        </div>
        
        @if($user->hasRole('vendor'))
            @if($vendorOwner)
            
            <div class="col-xs-12 ">
                
                <h2 class="item-subhead">{{trans('ui.vendor_label_my_products')}}</h2>
                <div class="col-xs-12 well">
                    
                    <p>{{trans('ui.vendor_label_my_products_instruction')}}</p>
                    
                    <div class="row btn-row">
                        <div class="col-xs-12 drop-padding">
                            
                            <a href="{{url('product/vendor')}}"><button class="btn-primary">{{trans('ui.navigation_link_myproducts')}}</button></a>
                            

                            <a href="{{url('product/edit')}}"><button class="btn-primary">{{trans('ui.navigation_link_addnewproduct')}}</button></a>

                        </div>
                    </div>
                   
                </div>
            </div>
              
            @endif
        @endif

        @if($user->hasRole('admin'))
            <div class="col-xs-12">
                <div class="bg-danger">
                    <p>You have <a href="{{url('/admin')}}">administrative</a> access</p>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection

@section('scripts')


@endsection