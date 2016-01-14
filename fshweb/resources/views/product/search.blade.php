@extends('layouts.master')

@section('title', 'Page Title')


@section('sectionheader')

<section class='clearfix container-wrap main-title search-header'>
    <div class='container'><h1 class="page-title">{{trans('ui.search_label_header')}}</h1>

        <div id="divCategoryDropdowns">
            <select id="ddlbCategory"><option value="">Select Category</option></select>
            <select id="ddlbSubCategory"><option value="">Select Sub Category</option></select>
            <select id="ddlbProductType"><option value="">Select Product Type</option></select>
        </div>

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

        <div class="col-xs-12 col-md-12">

            <div class="row">

                <div class="col-xs-12 col-md-3">
                    <h2 class="item-subhead">{{trans('ui.search_label_categories')}}</h2>

                    <div id="jstree_demo_div"></div>
                </div>

                <div class="col-xs-12 col-md-9">

                    <form>

                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="tbSearchQuery" id="tbSearchQuery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <a href="#" id="hlSearchButton" class="btn btn-primary">{{trans('ui.button_search')}}</a>
                            </div>
                        </div>

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
                                        <a href="{{url('/product/detail', $r->id)}}">{{$r->name}}</a>
                                    </td>
                                    <td>{{$r->brand}}</td>
                                </tr>
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
    <script type="text/javascript">

        var $resultTable = $("#product_list");
        var $categoryDdlb = $("#ddlbCategory");
        var $subCategoryDdlb = $("#ddlbSubCategory");
        var $productTypeDdlb = $("#ddlbProductType");

        var foodCategoryUrl = "{{url('ajax/getfoodcategories/')}}";

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
                                return foodCategoryUrl + "/TREEJSON";
                            }
                            else
                            {
                                return foodCategoryUrl + "/TREEJSON/" + node.id;
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

            $("#tbSearchQuery").on("keydown", performSearch);
            $("#hlSearchButton").on("click", performSearch);

            populateSearchDropdown(1);

            $categoryDdlb.on("change", populateSearchDropdown);
            $subCategoryDdlb.on("change", populateSearchDropdown);
            $productTypeDdlb.on("change", populateSearchDropdown);

        });

        function performSearch(e)
        {
            if(e.which === 13 || e.target.id === "hlSearchButton")
            {
                var qry = "{{url('ajax/productsearch')}}" + "/" + $("#tbSearchQuery").val();
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
                        tableRows += "<tr><td colspan='3'>{{trans('ui.search_label_no_results')}}</td></tr>";
                    }

                    $resultTable.html(tableRows);
``
                });

                e.preventDefault();
            }
        }

        function populateSearchDropdown(dropdownType)
        {
            var parentId;
            var dropdownToPopulate;
            if(dropdownType === 1)
            {
                dropdownToPopulate = $categoryDdlb;
            }
            else if(dropdownType === 2)
            {
                dropdownToPopulate = $subCategoryDdlb;
            }
            else if(dropdownType === 3)
            {
                dropdownToPopulate = $productTypeDdlb;
            }

            var qry = foodCategoryUrl + "/JSON";
            if(parentId !== undefined && parentId !== null) { qry += "/" + parentId; }

            $.getJSON(qry, function(jsonresult)
            {
                console.log(jsonresult);
                var options = "<option value=''>Select Category</option>";
                $.each(jsonresult, function(idx, val)
                {
                    options += "<option value='" + val.id + "'>" + val.name + "</option>";
                });

                dropdownToPopulate.html(options);

            });

        }

        function getFoodCategories(parentId)
        {

        }

    </script>

@endsection