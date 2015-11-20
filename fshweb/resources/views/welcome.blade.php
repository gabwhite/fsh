@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non erat sit amet erat rutrum laoreet in nec nisl. Nam ut elit vel diam rhoncus auctor sit amet nec neque. Nullam mollis ullamcorper turpis, nec sollicitudin nibh imperdiet a. Etiam vel metus lectus. Praesent gravida dignissim porttitor. Sed finibus velit sit amet nisi pretium, eget mattis magna hendrerit. Aliquam erat volutpat. Curabitur volutpat quam ullamcorper ipsum pharetra convallis. Sed sit amet egestas risus. Morbi massa sem, dictum id varius in, porta eget quam. Aliquam egestas consequat magna, et feugiat dolor iaculis in. Ut at eros luctus, lobortis nunc sit amet, egestas orci. Mauris bibendum ex arcu, vel fermentum ante porta laoreet.
            </p>
        </div>
    </div>

    <form name="homesearch" method="post" action="{{url('fulltextsearch')}}">

    <div class="row">
        <div class="col-md-10">
            <input type="text" name="searchquery" id="searchquery" class="form-control"/>
        </div>
        <div class="col-md-2">
            <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
    </div>

    {!! csrf_field() !!}
    </form>


@endsection
