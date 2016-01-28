@extends('layouts.admin')

@section('title', 'Cache Control')


@section('content')

    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-alert"></span>&nbsp;
        Manipulating caches can have serious performance consequences if you don't know what you're doing.
        <b>Use extreme caution!</b>
    </div>

    <form id="form1" name="form1" method="post" action="{{url('admin/cache')}}">

        <div class="row">

            <div class="col-md-10">
                <input type="text" name="cachekey" id="cachekey" class="form-control" placeholder="Key Name"/>
            </div>

            <div class="col-md-2">
                <input type="submit" id="btnSubmit" class="btn btn-danger" value="Clear Cache Entry"/>
            </div>

        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <a href="#" id="hlFlush" class="btn btn-danger">Flush Cache</a>
            </div>
        </div>

        <input type="hidden" name="action" id="action" value="key"/>
        {!! csrf_field() !!}
    </form>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function()
        {
            $("#btnSubmit").on("click", function(e)
            {
                e.preventDefault();
                if($("#cachekey").val() !== "" && confirm("Remove cache entry for this key?"))
                {
                    $("#form1").submit();
                }
            });

            $("#hlFlush").on("click", function(e)
            {
                e.preventDefault();
                if(confirm("Flush all cache entries?"))
                {
                    if(confirm("This will completely clear all caches for the site! Are you absolutely sure?"))
                    {
                        $("#action").val("flush");
                        $("#form1").submit();
                    }
                }
            });
        });

    </script>

@endsection