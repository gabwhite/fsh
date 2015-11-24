@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    PROFILE
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        Currently logged in user: {{Auth::user()->name}} ({{Auth::user()->email}})
        <br/><br/>

        @if(isEmailInUse('breen.young@gmail.com', 1))
            cxcxcxc
        @endif

        <a href="{{url('profile/edit')}}">Edit my profile</a>
        <br/><br/>

        @if(Auth::user()->hasRole('admin'))
            You have <a href="{{url('/admin')}}">administrative</a> access
        @endif

        <hr/>
        More Coming Soon

    </div>

</div>

@endsection

@section('scripts')


@endsection