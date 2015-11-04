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

    <table id="product_list">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

@endsection

@section('scripts')
    <script src="{{url('js/vendor/jstree/jstree.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            var $resultTable = $("#product_list");

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
                var qry = "{{url('ajax/getuserproducts')}}" + "/" + data.node.id;
                $.getJSON(qry, function(jsonresult)
                {
                    //console.log(jsonresult);
                    var tableRows = "";
                    $.each(jsonresult, function(idx, val)
                    {
                        console.log(val);
                        tableRows += "<tr><td>" + val.name + "</td><td>" + val.brand + "</td><td></td></tr>";
                    });

                    $resultTable.html(tableRows);
                });

            });

        });

    </script>

@endsection