@extends('layouts.master')

@section('title', 'Register')

@section('sectionheader')
    REGISTER
@endsection

@section('content')

<form method="POST" action="{{url('/auth/register')}}" data-abide>
    {!! csrf_field() !!}

    <div>
        <label>Name
            <input type="text" name="name" value="{{ old('name') }}" required>
        </label>
        <small class="error">An name is required.</small>
    </div>

    <div>
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" required pattern="email">
        </label>
        <small class="error">An email address is required.</small>
    </div>

    <div>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <small class="error">Password is required.</small>
    </div>

    <div>
        <label>Confirm Password
            <input type="password" name="password_confirmation" required data-equalto="password">
        </label>
        <small class="error">The password did not match</small>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>

@endsection