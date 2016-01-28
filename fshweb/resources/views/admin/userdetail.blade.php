@extends('layouts.admin')

@section('title', 'Edit User')


@section('content')

    <form id="form1" name="form1" method="post" action="{{url('admin/edituser')}}">
        {!! csrf_field() !!}
        <table class="table">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                </tr>
                <tr>
                    <td>Change Password</td>
                    <td><input type="password" id="password" name="password" maxlength="25" class="form-control"/></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" id="password_confirmation" name="password_confirmation" maxlength="25" class="form-control"/></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                    <select name="role" id="role" class="form-control">
                        <option value="">No Role</option>
                    @foreach ($roles as $r)


                        @if (count($user->roles) > 0 && $user->roles->first()->id == $r->id)
                            <option value="{{$r->id}}" selected="selected">{{$r->name}}</option>
                        @else
                            <option value="{{$r->id}}">{{$r->name}}</option>
                        @endif

                    @endforeach
                    </select>
                    </td>
                </tr>

            </tbody>
        </table>
        <input type="hidden" name="userid" value="{{$user->id}}"/>
        <input type="submit" name="save" class="btn btn-primary" value="Update"/>

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
                    password: { required: false, maxlength: 25 },
                    password_confirmation: { equalTo: "#password", maxlength: 25 },
                    role: { required: true }
                }
            });

        });
    </script>
@endsection