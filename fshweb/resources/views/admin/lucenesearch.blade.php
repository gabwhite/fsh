@extends('layouts.admin')

@section('title', 'Manage Fulltext Search')

@section('sidebar')
    @parent

@endsection

@section('content')
Manage Search Indexes

<form id="frmManageIndex" method="post" action="{{url('admin/managesearchindex')}}">
<table width="100%" id="currentindexes" class="table">
    <thead>
        <tr>
            <th>Index Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($indexes as $i)
        <tr>
            <td>{{substr($i, strpos($i, '/') + 1)}}</td>
            <td><a href="#" class="idxrebuild" data-indexname="{{substr($i, strpos($i, '/') + 1)}}">Rebuild</a></td>
            <td><a href="#" class="idxoptimize" data-indexname="{{substr($i, strpos($i, '/') + 1)}}">Optimize</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! csrf_field() !!}
<input type="hidden" name="indexname" id="indexname"/>
<input type="hidden" name="indexaction" id="indexaction"/>
</form>

<hr/>

<form name="frmCreateIndex" method="post" action="{{url('admin/createsearchindex')}}">
<input type="text" name="newindex" class="form-control"/>
<input type="submit" class="btn btn-primary" value="Create Index"/>
{!! csrf_field() !!}
</form>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#currentindexes").find("a.idxrebuild").off("click").on("click", function(e)
            {
                e.preventDefault();
                $("#indexaction").val("REBUILD");
                $("#indexname").val($(this).data("indexname"));
                $("#frmManageIndex").submit();
            });

            $("#currentindexes").find("a.idxoptimize").off("click").on("click", function(e)
            {
                e.preventDefault();
                $("#indexaction").val("OPTIMIZE");
                $("#indexname").val($(this).data("indexname"));
                $("#frmManageIndex").submit();
            });

        });
    </script>

@endsection