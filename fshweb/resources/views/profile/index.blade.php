@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    PROFILE
@endsection

@section('content')

    Currently logged in user: {{Auth::user()->name}} ({{Auth::user()->email}})
    <br/><br/>

    @if(Auth::user()->hasRole('admin'))
        You have <a href="{{url('/admin')}}">administrative</a> access
    @endif

    <hr/>
    More Coming Soon

@endsection

@section('scripts')


@endsection