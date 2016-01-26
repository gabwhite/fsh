@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $u)
            <tr>
                <td><a href="{{url('admin/userview', $u->id)}}">{{$u->name}}</a></td>
                <td>{{$u->email}}</td>
                <td>{{(count($u->roles) > 0) ? $u->roles->first()->name : ''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection