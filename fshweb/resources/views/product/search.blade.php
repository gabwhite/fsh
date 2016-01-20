@extends('layouts.master')

@section('title', 'Page Title')

@section('css')
    <style type="text/css">
        .loadProgress
        {
            background: rgba(0,0,0,.5) url('{{url('img/spinner.gif')}}') no-repeat;
            z-index:999;
        }
    </style>
@endsection


@section('sectionheader')

<section class='clearfix container-wrap main-title search-header'>
    <div class='container'><h1 class="page-title">{{trans('ui.search_label_header')}}</h1>

        <div id="divCategoryDropdowns" class="row">
            <div class="col-xs-12 text-center">
                <select id="ddlbCategory" class="search-dropdown"><option value="">Select Category</option></select>
                <select id="ddlbSubCategory" class="search-dropdown"><option value="">Select Sub Category</option></select>
                <select id="ddlbProductType" class="search-dropdown"><option value="">Select Product Type</option></select>
                <a id="hlDropdownSearch" href="#"><button class="btn btn-sm">Go</button></a>
            </div>
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

                <div class="col-xs-12 col-md-4">
                    <div class="col-xs-12 col-md-11">
                        
                        <h2 class="item-subhead">{{trans('ui.search_label_categories')}}</h2>

                        <div id="jstree_demo_div"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-8">
                    <div class="col-xs-12 sort-menu">
                        <h2 class="sort-title">Sort by:</h2>
                        <select name="sortby" id="sortby" class="drop-sm">
                            <option value="name">Product Name</option>
                            <option value="brand">Brand</option>
                            <option value="pack">Pack</option>
                            <option value="units">Units</option>
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
                    <div id="rootResultContainer" class="col-xs-12 well">
                        <form>

                            <div class="row keyword-search">
                                <div class="col-xs-8">
                                    <input type="text" name="tbSearchQuery" id="tbSearchQuery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                                </div>
                                <div class="col-xs-4">
                                    <a href="#" id="hlSearchButton"><button class="btn">{{trans('ui.button_search')}}</button></a>
                                </div>
                            </div>

                        </form>

                        <div id="product_list">
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                               <nav class="text-center">
                                 <ul class="pagination">
                                    <p>Page</p>
                                   <li>
                                     <a href="#" aria-label="Previous">
                                       <span aria-hidden="true">&laquo;</span>
                                     </a>
                                   </li>
                                   <li><a href="#">1</a></li>
                                   <li><a href="#">2</a></li>
                                   <li><a href="#">3</a></li>
                                   <li><a href="#">4</a></li>
                                   <li><a href="#">5</a></li>
                                   <li>
                                     <a href="#" aria-label="Next">
                                       <span aria-hidden="true">&raquo;</span>
                                     </a>
                                   </li>
                                 </ul>
                               </nav> 
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{url('js/vendor/jstree/jstree.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.search.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            fsh.search.init("{{url('ajax/getfoodcategories/')}}",
                            "{{url('ajax/getproducts')}}",
                            "{{url('ajax/productsearch')}}",
                            "{{url('product/detail')}}",
                            "{{url('img/spinner.gif')}}"
                            );
        });

    </script>

@endsection