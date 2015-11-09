@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <link rel="stylesheet" href="{{url('/js/vendor/jstree/themes/default/style.min.css')}}">
@endsection

@section('sidebar')
    @parent



@endsection

@section('content')

    <div class="row">

        <div class="small-2 large-3 columns">
            <div id="jstree_demo_div"></div>
        </div>

        <div class="small-10 large-9 columns">

            <form method="post" action="{{url('fulltextsearch')}}">
                <input type="text" name="searchquery" id="searchquery" placeholder="Search" value="{{$query or ''}}"/>
                {!! csrf_field() !!}
            </form>
            <table id="product_list" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($searchresults))
                    @foreach($searchresults as $r)
                        <tr>
                            <td>
                                <a href="{{url('/productdetail', $r['document']->getFieldValue('id'))}}">{{$r['document']->getFieldValue('name')}}</a>
                                ({{round($r['score'] * 100)}}%)
                            </td>
                            <td>{{$r['document']->getFieldValue('brand')}}</td></tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>


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
                    "themes" : { "stripes" : false },
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
                        tableRows += "<tr><td><a href='{{url('productdetail')}}/" + val.id + "'>" + val.name + "</a></td><td>" + val.brand + "</td><td></td></tr>";
                    });

                    $resultTable.html(tableRows);
                });

            });

        });

    </script>

@endsection