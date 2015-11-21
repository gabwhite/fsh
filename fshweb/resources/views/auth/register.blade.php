@extends('layouts.master')

@section('title', 'Register')

@section('sectionheader')
    REGISTER
@endsection

@section('content')

    <div class="col-md-12">

        <form id="form1" name="form1" method="POST" action="{{url('/auth/register')}}">
            {!! csrf_field() !!}

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" maxlength="25" value="{{ old('name') }}" class="form-control">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" maxlength="100" value="{{ old('email') }}" class="form-control">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" maxlength="25" class="form-control">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" maxlength="25" class="form-control">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>

    </div>


@endsection

@section('scripts')
    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    name: { required: true, maxlength: 25 },
                    email: { required: true, email: true, maxlength: 100 },
                    password: { required: true, maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 }
                }
            });

        });
    </script>
@endsection