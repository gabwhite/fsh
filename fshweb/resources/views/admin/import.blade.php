@extends('layouts.admin')

@section('title', 'Import User Products')

@section('sidebar')
    @parent

    <p>This is appended to the admin master sidebar.</p>
@endsection

@section('content')
    <p>This is my admin body content.</p>

    <form id="form1" name="form1" method="post" action="{{url('admin/import')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <input type="file" name="importfile"/>
        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="includesheaders" id="includesheaders" checked="checked"/>First row is header row
            </label>
        </div>

        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="addasactive" id="addasactive"/>Add new entries as active
            </label>
        </div>

        <br/>

        <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
    </form>


@endsection