@extends('layouts.admin')

@section('title', 'Manage Roles')

@section('sidebar')
    @parent

@endsection

@section('content')
    <p>This is my admin body content.</p>

    <form id="form1" name="form1" method="post" action="{{url('admin/permissions')}}">
        {!! csrf_field() !!}
        <table id="permissions">
            <thead>
            <tr>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $p)
                <tr>
                    <td>{{$p->name}}</td>
                    <td>{{$p->display_name}}</td>
                    <td>{{$p->description}}</td>
                    <td><a href="{{url('admin/permissions',[$p->id])}}">Edit</a></td>
                    <td><a href="#" data-id="{{$p->id}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <input type="text" name="permissionname" id="permissionname" placeholder="Name" value="{{$permission->name or ''}}"/>
        <input type="text" name="permissiondisplay" id="permissiondisplay" placeholder="Display Name" value="{{$permission->display_name or ''}}"/>
        <input type="text" name="permissiondesc" id="permissiondesc" placeholder="Descrption" value="{{$permission->description or ''}}"/>
        <input type="button" name="add" id="add" value="Add/Update" class="button"/>

        <input type="hidden" name="permissionid" id="permissionid" value="{{$permission->id or ''}}"/>
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

            var currentPerms = $("#permissions tbody tr");
            $.each(currentPerms, function(idx, val)
            {
                var alinks = $(val).find("a");

                alinks.last().bind("click", function(e)
                {
                    e.preventDefault();
                    $("#action").val("DELETE");
                    $("#permissionid").val(alinks.last().data("id"));
                    $("#form1").submit();
                });
            })
        });
    </script>

@endsection