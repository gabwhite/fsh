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

                <form name="homesearch" method="post" action="{{url('fulltextsearch')}}">

                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" name="searchquery" id="searchquery" placeholder="{{trans('ui.search_placeholder')}}" class="form-control"/>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary" value="{{trans('ui.button_search')}}"/>
                        </div>
                    </div>

                    {!! csrf_field() !!}
                </form>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')


@endsection