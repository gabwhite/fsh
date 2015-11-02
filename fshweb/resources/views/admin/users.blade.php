@extends('layouts.admin')

@section('title', 'Manage Users')

@section('sidebar')
    @parent

    <p>This is appended to the admin master sidebar.</p>
@endsection

@section('content')
    <p>This is my admin body content.</p>

    <table>
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
                <td>{{$u->roles}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection