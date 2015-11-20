@extends('layouts.master')

@section('title', 'Register')

@section('sectionheader')
    REGISTER
@endsection

@section('content')

<form method="POST" action="{{url('/auth/register')}}" data-abide>
    {!! csrf_field() !!}

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>

@endsection

@section('scripts')
    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
@endsection