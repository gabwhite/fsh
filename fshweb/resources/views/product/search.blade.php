@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection


@section('sectionheader')

<section class='clearfix container-wrap main-title search-header'>
    <div class='container'><h1 class="page-title">{{trans('ui.search_label_header')}}</h1>

        <div id="divCategoryDropdowns" class="row">
            <div class="col-xs-12 text-center">
                <select id="ddlbCategory" class="search-dropdown"><option value="">Select Category</option></select>
                <select id="ddlbSubCategory" class="search-dropdown"><option value="">Select Sub Category</option></select>
                <select id="ddlbProductType" class="search-dropdown"><option value="">Select Product Type</option></select>
                <a id="hlDropdownSearch" href="#"><button class="btn-primary">Search</button></a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-12">

            <div class="row">

                <div class="col-xs-12 col-md-4 sidebar-section">
                    <div class="col-xs-12 col-md-11">
                        
                        <h2 class="item-subhead">{{trans('ui.search_label_categories')}}</h2>

                        <div id="jstree_demo_div"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-8">
                    
                    <div class="container">
                        
                        <div class="col-xs-12 sort-menu">
                            <h2 class="sort-title">Sort by:</h2>
                            <select name="sortby" id="sortby" class="drop-sm">
                                <option value="name">Product Name</option>
                                <option value="brand">Brand</option>
                                <option value="pack">Pack</option>
                                <option value="uom">Units</option>
                                <option value="vendors">Vendors</option>
                            </select>

                            <select name="viewall" id="viewall" class="drop-sm">
                                <option value="10">View 10</option>
                                <option value="25">View 25</option>
                                <option value="50">View 50</option>
                                <option value="100">View 100</option>
                            </select>

                            <a id="hlSort" href="#"><button class="btn btn-sm">Sort Results</button></a>
                        </div>

                    </div>

                    <div id="rootResultContainer" class="col-xs-12 well">

                            <div class="row keyword-search">
                                <div class="colxs-12 col-sm-8">
                                    <input type="text" name="tbSearchQuery" id="tbSearchQuery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <a href="#" id="hlSearchButton"><button class="btn">{{trans('ui.button_search')}}</button></a>
                                </div>
                            </div>

                        <div id="product_list">
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{url('js/vendor/jstree/jstree.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/vendor/sprintf/sprintf.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.search.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            fsh.search.init("{{url('ajax/getfoodcategories/')}}",
                            "{{url('ajax/getproducts')}}",
                            "{{url('product/detail')}}",
                            "{{\Session::get('searchquery')}}",
                            "{{url('img/spinner.gif')}}"
                            );
        });

    </script>

@endsection