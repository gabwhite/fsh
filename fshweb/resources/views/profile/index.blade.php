@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    PROFILE
@endsection

@section('content')

<div class="row">

    <div class="col-md-3">
        @if(isset($avatarFilename))
            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="Current avatar" width="200" height="200"/>
        @else
            <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="No avatar" width="200" height="200"/>
        @endif

    </div>

    <div class="col-md-9">

        Currently logged in as: {{$user->name}} ({{$user->email}})
        <br/><br/>

        @if(isEmailInUse('breen.young@gmail.com', 1))
            cxcxcxc
        @endif

        <p class="bg-info">
            <a href="{{url('profile/edit')}}">Edit my profile</a>
        </p>

        <p class="bg-info">
            <a href="{{url('profile/avatar')}}">Change Avatar</a>
        </p>

        @if($user->hasRole('vendor'))
            <p class="bg-info">
                <a href="{{url('profile/products')}}">My Products</a>
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