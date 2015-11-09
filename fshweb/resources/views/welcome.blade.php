@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>


    <form name="homesearch" method="post" action="{{url('fulltextsearch')}}">

    <div class="row">
        <div class="small-10 large-9 columns inline">
            <input type="text" name="searchquery" id="searchquery"/>
        </div>
        <div class="small-2 large-3 columns inline">
            <input type="submit" class="button tiny" value="Search"/>
        </div>
    </div>

    {!! csrf_field() !!}
    </form>


@endsection
