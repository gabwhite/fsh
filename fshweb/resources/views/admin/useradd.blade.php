@extends('layouts.admin')

@section('title', 'Add User')


@section('content')

    <form id="form1" name="form1" method="post" action="{{url('admin/adduser')}}">
        {!! csrf_field() !!}
        <table class="table">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" maxlength="25" class="form-control"/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" maxlength="100" class="form-control"/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="password" name="password" maxlength="25" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="password_confirmation" maxlength="25" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                    <select name="role" id="role" class="form-control">
                        <option value="">No Role</option>
                    @foreach ($roles as $r)
                        <option value="{{$r->id}}">{{$r->name}}</option>
                    @endforeach
                    </select>
                    </td>
                </tr>

            </tbody>
        </table>
        <input type="submit" name="save" class="btn btn-primary" value="Add"/>

    </form>

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
                    password_confirmation: { equalTo: "#password", maxlength: 25 },
                    role: { required: true }
                }
            });

        });
    </script>
@endsection