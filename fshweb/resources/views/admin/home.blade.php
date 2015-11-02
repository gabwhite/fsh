@extends('layouts.admin')

@section('title', 'Admin H ome')

@section('sidebar')
    @parent

    <p>This is appended to the admin master sidebar.</p>
@endsection

@section('content')
    <p>This is my admin body content.</p>




@endsection