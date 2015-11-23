@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    PROFILE
@endsection

@section('content')

    <div class="col-md-12">

        Currently logged in user: {{Auth::user()->name}} ({{Auth::user()->email}})
        <br/><br/>

        <a href="{{url('profile/edit')}}">Edit my profile</a>
        <br/><br/>

        @if(Auth::user()->hasRole('admin'))
            You have <a href="{{url('/admin')}}">administrative</a> access
        @endif

        <hr/>
        More Coming Soon

    </div>

@endsection

@section('scripts')


@endsection