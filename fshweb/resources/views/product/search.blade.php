@extends('layouts.master')

@section('title', trans('ui.navigation_productsearch'))

@section('css')

@endsection


@section('sectionheader')

<section class='clearfix container-wrap main-title search-header'>
    <div class='container'><h1 class="page-title">{{trans('ui.search_label_header')}}</h1>

        <div id="divCategoryDropdowns" class="row">
            <div class="col-xs-12 text-center">
                <select id="ddlbCategory" class="search-dropdown">
                    <option v-for="c in categories" v-bind:value="c.id">@{{ c.name }}</option>
                </select>
                <select id="ddlbSubCategory" class="search-dropdown">
                    <option v-for="s in subCategories" v-bind:value="s.id">@{{ s.name }}</option>
                </select>
                <select id="ddlbProductType" class="search-dropdown">
                    <option v-for="p in productTypes" v-bind:value="p.id">@{{ p.name }}</option>
                </select>
                <a id="hlDropdownSearch" href="#"><button class="btn-primary">Search</button></a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div id="searchview">

        <div class="row">

            <div class="col-xs-12 col-md-12 drop-padding">

                <div class="row">

                    <div class="col-xs-12 col-md-4 sidebar-section">
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


                        <div id="rootResultContainer" class="col-xs-12 well">

                            <div class="col-xs-12 keyword-search">
                                <div class="col-xs-12 col-sm-8 reset-left">
                                    <input type="text" name="tbSearchQuery" id="tbSearchQuery" autocomplete="off" placeholder="{{trans('ui.search_placeholder')}}" value="{{$query or ''}}" class="form-control"/>
                                    <a class="search-tips" id="hlToggleSearchTips" href="#">Search Tips</a>
                                </div>
                                <div class="col-xs-12 col-sm-4 reset-right">
                                    <a href="#" id="hlSearchButton"><button class="btn">{{trans('ui.button_search')}}</button></a>
                                </div>
                                <div id="divSearchTips" class="row" style="display:none;">
                                    <div class="col-xs-12">
                                        <div class="bg-info">
                                            <p>"+" : Two or more terms or phrases must be in the result.</p>
                                            <p>Example: <span class="italic">+swiss +cheese</span></p>
                                        </div>
                                        <div class="bg-info">
                                            <p>"-" : A term or phrase specified is excluded from the search</p>
                                            <p><span class="italic">milk -coconut</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="product_list">

                                <div v-for="p in results.data" class="col-xs-12 search-row"><!-- START VUE.JS view, outputs one per result -->

                                    <div class="col-xs-3 col-md-2 drop-padding">

                                        <div class="item-thumb" v-bind:style="{ backgroundImage: getProductImage(p.product_image) }" style="background-repeat: no-repeat; background-size: cover; background-position: center center;"></div>

                                        <div class="star-rating">
                                            <img src="{{url('/img/icons/star.svg')}}">
                                        </div>

                                    </div>

                                    <div class="col-xs-9 col-md-10">
                                        <a href="{{url('product/detail')}}/@{{ p.id }}">@{{p.name}}</a>
                                        <p class="brand">@{{p.brand}}</p>
                                    </div>

                                    <div class="col-xs-12 col-md-10 drop-padding">

                                        <p>@{{p.description}}</p>

                                        <div class="col-xs-12 search-details">
                                            <p>Pack: @{{p.pack}}</p>

                                            <p>Size: @{{p.size}} @{{p.uom}}</p>

                                            <p>Product Code: @{{p.mpc}}</p>
                                        </div>

                                        <a class="goto-item" href="{{url('product/detail')}}/@{{ p.id }}">View Product Details</a>
                                    </div>

                                </div><!-- END VUE.JS -->

                                @{{{results.nav}}}

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
    <script type="text/javascript" src="{{url('js/vendor/vuejs/vue.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/vendor/lockr/lockr.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/vendor/sprintf/sprintf.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/fsh.search.js')}}"></script>
    <script type="text/javascript">

        var noProductImage = "{{url('img/no-photo-avail.svg')}}";

        $(document).ready(function()
        {
            fsh.search.init("{{url('ajax/getfoodcategories/')}}",
                            "{{url('ajax/getproducts')}}",
                            "{{url('product/detail')}}",
                            "{{\Session::get('searchquery')}}",
                            "{{url('img/spinner.gif')}}",
                            "{{url(config('app.product_storage'))}}"
                            );
        });

    </script>

@endsection