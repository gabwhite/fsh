@extends('layouts.master')

@section('title', trans('ui.navigation_profile'))

@section('css')

@endsection

@section('sectionheader')
    {{trans('ui.navigation_profile')}}
@endsection

@section('content')

<div class="row">

    <div class="col-md-3">
        @if(isset($avatarFilename))
            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
        @else
            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
        @endif

    </div>

    <div class="col-md-9">

        {{$user->name}} ({{$user->email}})
        <br/><br/>

        <p class="bg-info">
            <a href="{{url('profile/edit')}}">{{trans('ui.navigation_link_editprofile')}}</a>
        </p>

        <p class="bg-info">
            <a href="{{url('profile/avatar')}}">{{trans('ui.navigation_link_changeavatar')}}</a>
        </p>

        @if($user->hasRole('vendor'))

            @if(isset($vendorId))
            <p class="bg-info">
                <a href="{{url('vendor', $vendorId)}}">{{trans('ui.navigation_link_viewvendor')}}</a>
            </p>
            @endif

            @if($vendorOwner)
            <p class="bg-info">
                <a href="{{url('profile/editvendor')}}">{{trans('ui.navigation_link_editvendor')}}</a>
            </p>
            @endif

            <p class="bg-info">
                <a href="{{url('profile/products')}}">{{trans('ui.navigation_link_myproducts')}}</a>&nbsp;(<a href="{{url('profile/product')}}">{{trans('ui.navigation_link_addnewproduct')}}</a>)
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


@endsection