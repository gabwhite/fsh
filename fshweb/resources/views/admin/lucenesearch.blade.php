@extends('layouts.admin')

@section('title', 'Manage Fulltext Search')

@section('sidebar')
    @parent

@endsection

@section('content')
Manage Indexes

<table>
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>
<hr/>

<form name="frmCreateIndex" method="post" action="{{url('admin/createluceneindex')}}">
<input type="text" name="newindex"/>
<input type="submit" value="Create Index"/>
{!! csrf_field() !!}
</form>

@endsection