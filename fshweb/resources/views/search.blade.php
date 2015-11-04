@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <link rel="stylesheet" href="{{url('/js/vendor/jstree/themes/default/style.min.css')}}">
@endsection

@section('sidebar')
    @parent

    <div id="jstree_demo_div"></div>

@endsection

@section('content')
    <p>Search</p>
@endsection

@section('scripts')
    <script src="{{url('js/vendor/jstree/jstree.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            $("#jstree_demo_div").jstree({
                "core" :
                {
                    "multiple" : false,
                    "animation" : 0,
                    "data" :
                    {
                        "url": function(node)
                        {
                            //console.log(node);
                            if(node.id === "#")
                            {
                                return "{{url('ajax/getfoodcategories/TREEJSON/')}}";
                            }
                            else
                            {
                                return "{{url('ajax/getfoodcategories/TREEJSON/')}}" + "/" + node.id;
                            }
                        },
                        "data": function(node)
                        {
                            console.log(node);
                        }
                    }
                }
            });

            $("#jstree_demo_div").off("changed.jstree").on("changed.jstree", function(e, data)
            {
                console.log(data);
            });

        });

    </script>

@endsection