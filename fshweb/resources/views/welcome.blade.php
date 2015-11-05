@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>

    <form name="homesearch" method="post" action="{{url('fulltextsearch')}}">
    {!! csrf_field() !!}
    <input type="text" name="searchquery" id="searchquery"/>
    <input type="submit" class="button" value="Search"/>
    </form>
@endsection
