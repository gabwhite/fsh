@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <link rel="stylesheet" href="{{url('/js/vendor/jstree/themes/default/style.min.css')}}">
@endsection

@section('sectionheader')
<section class='clearfix container-wrap main-title search-header'>
    <div class='container'><h1 class="page-title">Find What You're Looking For.</h1>
        
        <!-- BREADCRUMBS, NOT SURE IF THEY'RE NEEDED?  -->

        <!-- <div class='breadcrumb-extra'>
            <div class="kleo_framework breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
                <span typeof="v:Breadcrumb">
                    <a rel="v:url" property="v:title" href="http://www.foodservicehound.com" title="FoodserviceHound.com" >Home</a>
                </span>
                <span class="sep"> </span>
                <span class="active">Find What You're Looking For</span>
            </div>
        </div> -->
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <div class="col-md-3">
                    <div id="jstree_demo_div"></div>
                </div>

                <div class="col-md-9">

                    <form method="post" action="{{url('product/search')}}">

                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="searchquery" id="searchquery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <a href="#" id="hlSearch" class="btn btn-primary">{{trans('ui.button_search')}}</a>
                            </div>
                        </div>

                        {!! csrf_field() !!}
                    </form>
                    <table id="product_list" width="100%" class="table">
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


        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{url('js/vendor/jstree/jstree.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.common.js')}}"></script>
    <script type="text/javascript">

        var $resultTable = $("#product_list");

        $(document).ready(function()
        {

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
                            //console.log(node);
                        }
                    }
                }
            });

            $("#jstree_demo_div").off("changed.jstree").on("changed.jstree", function(e, data)
            {
                //console.log(data);
                var qry = "{{url('ajax/getproducts')}}" + "/" + data.node.id;
                $.getJSON(qry, function(jsonresult)
                {
                    console.log(jsonresult);
                    var tableRows = "";
                    $.each(jsonresult, function(idx, val)
                    {
                        console.log(val);
                        tableRows += "<tr><td><a href='{{url('product/detail')}}/" + val.id + "'>" + val.name + "</a></td><td>" + val.brand + "</td><td></td></tr>";
                    });

                    $resultTable.html(tableRows);
                });

            });


            $("#searchquery").on("keydown", performSearch);
            $("#hlSearch").on("click", performSearch);

        });

        function performSearch(e)
        {
            if(e.which === 13 || e.target.id === "hlSearch")
            {
                var qry = "{{url('ajax/productsearch')}}" + "/" + $("#searchquery").val();
                $.getJSON(qry, function(jsonresult)
                {
                    var tableRows = "";
                    $.each(jsonresult, function(idx, val)
                    {
                        //console.log(val);
                        tableRows += "<tr><td><a href='{{url('product/detail')}}/" + val.id + "'>" + val.name + "</a></td><td>" + val.brand + "</td><td></td></tr>";
                    });

                    if(jsonresult.length === 0)
                    {
                        tableRows += "<tr><td colspan='3'>No Results Found</td></tr>";
                    }

                    $resultTable.html(tableRows);

                });

                e.preventDefault();
            }
        }

    </script>

@endsection