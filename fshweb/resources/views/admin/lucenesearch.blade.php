@extends('layouts.admin')

@section('title', 'Manage Fulltext Search')

@section('sidebar')
    @parent

@endsection

@section('content')
Manage Indexes

<form method="post" action="">
<table width="100%" id="currentindexes">
    <thead>
        <tr>
            <th>Index Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($indexes as $i)
        <tr>
            <td>{{$i}}</td>
            <td><a href="#">Rebuild</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! csrf_field() !!}
</form>

<hr/>

<form name="frmCreateIndex" method="post" action="{{url('admin/createluceneindex')}}">
<input type="text" name="newindex"/>
<input type="submit" value="Create Index"/>
{!! csrf_field() !!}
</form>

@endsection