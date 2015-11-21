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

        <div id="slider" class="col-md-12">

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{url('js/vendor/vegas/vegas.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $("#slider").vegas({
                delay: 20000,
                timer: false,
                overlay: false,
                cover: true,
                slides: [
                    {src: "{{url('img/slider/chef-in-kitchen.jpg')}}"},
                    {src: "{{url('img/slider/Fire-Kitchen.jpg')}}"}
                ]
            });

        });
    </script>
@endsection