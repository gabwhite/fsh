@extends('layouts.admin')

@section('title', 'Manage Roles')

@section('sidebar')
    @parent

@endsection

@section('content')
    <p>This is my admin body content.</p>

    <form id="form1" name="form1" method="post" action="{{url('admin/roles')}}">
        {!! csrf_field() !!}
        <table id="roles" width="100%">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($roles as $r)
            <tr>
                <td valign="top">{{$r->name}}</td>
                <td>
                    <select name="rolepermissions-{{$r->id}}[]" multiple="multiple" data-id="{{$r->id}}">
                    @foreach ($permissions as $p)

                        @if ($r->perms()->where('id', '=', $p->id)->count() == 1)
                            <option value="{{$p->id}}" selected="selected">{{$p->name}}</option>
                        @else
                            <option value="{{$p->id}}">{{$p->name}}</option>
                        @endif

                    @endforeach
                    </select>
                    <a href="#" data-id="{{$r->id}}">Save</a>
                </td>
                <td valign="top"><a href="#" data-id="{{$r->id}}">Delete</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>


        <input type="text" name="rolename" id="rolename"/>
        <input type="button" name="add" id="add" value="Add Role" class="button"/>

        <input type="hidden" name="roleid" id="roleid" value=""/>
        <input type="hidden" name="action" id="action" value=""/>

    </form>


@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function()
        {
            $(document).off("click", "#add").on("click", "#add", function(e)
            {
                e.preventDefault();
                $("#action").val("ADD");
                $("#form1").submit();
            });

            var currentRoles = $("#roles tbody tr");
            $.each(currentRoles, function(idx, val)
            {
                var alinks = $(val).find("a");

                alinks.first().bind("click", function(e)
                {
                    e.preventDefault();
                    $("#action").val("EDITPERMS");
                    $("#roleid").val(alinks.first().data("id"));
                    $("#form1").submit();
                });


                alinks.last().bind("click", function(e)
                {
                    e.preventDefault();
                    $("#action").val("DELETE");
                    $("#roleid").val(alinks.last().data("id"));
                    $("#form1").submit();
                });
            })
        });
    </script>

@endsection