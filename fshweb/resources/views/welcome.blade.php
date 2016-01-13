@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('js/vendor/vegas/vegas.min.css')}}"/>
@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">


        <div class="row">

            <div class="col-md-12">

                <h1>HOME PAGE CONTENT</h1>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')


@endsection