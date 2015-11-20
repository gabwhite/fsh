@extends('layouts.master')

@section('title', 'Login')

@section('sectionheader')
    LOGIN
@endsection

@section('content')

<form method="POST" action="{{url('/auth/login')}}">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="checkbox">
        <label>
        <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>

@endsection