/**
 * Created by Breen on 14/01/2016.
 */
var fsh = fsh || {};

fsh.search = (function ($, document)
{
    var _categoryUrl, _productUrl, _searchUrl, _detailUrl;

    var $categoryTree = $("#jstree_demo_div");
    var $resultTable = $("#product_list");

    var $categoryDdlb = $("#ddlbCategory");
    var $subCategoryDdlb = $("#ddlbSubCategory");
    var $productTypeDdlb = $("#ddlbProductType");

    var $searchQueryTb = $("#tbSearchQuery");


    var init = function(categoryUrl, productUrl, searchUrl, detailUrl)
    {
        _categoryUrl = categoryUrl;
        _productUrl = productUrl;
        _searchUrl = searchUrl;
        _detailUrl = detailUrl;

        initTree();

        initCategoryDropdowns();

        $searchQueryTb.on("keydown", doSearch);
        $searchQueryTb.on("click", doSearch);
    };

    var initTree = function()
    {
        $categoryTree.jstree({
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
                            return _categoryUrl + "/TREEJSON";
                        }
                        else
                        {
                            return _categoryUrl + "/TREEJSON/" + node.id;
                        }
                    },
                    "data": function(node)
                    {
                        //console.log(node);
                    }
                }
            }
        });

        $categoryTree.off("changed.jstree").on("changed.jstree", function(e, data)
        {
            //console.log(data);
            var qry = _productUrl + "/" + data.node.id;
            $.getJSON(qry, function(jsonresult)
            {
                //console.log(jsonresult);
                var tableRows = "";
                $.each(jsonresult, function(idx, val)
                {
                    //console.log(val);
                    tableRows += "<div class='col-xs-12 search-row'><a href='" + _detailUrl + "/" + val.id + "'>" + val.name + "</a><span class='brand'>" + val.brand + "</span></div>";
                });

                $resultTable.html(tableRows);
            });
        });
    };

    var initCategoryDropdowns = function()
    {
        $categoryDdlb.on("change", function(e)
        {
            var placeHolder = "Select Category";
            var fillSelf = true;
            var qry = _categoryUrl + "/JSON";
            if($categoryDdlb.val() !== "")
            {
                fillSelf = false;
                qry += "/" + $categoryDdlb.val();
                placeHolder = "Select Sub Category";
            }

            $.getJSON(qry, function(jsonresult)
            {
                //console.log(jsonresult);
                var options = "<option value=''>" + placeHolder + "</option>";
                $.each(jsonresult, function(idx, val)
                {
                    options += "<option value='" + val.id + "'>" + val.name + "</option>";
                });

                if(fillSelf) { $categoryDdlb.html(options); }
                else { $subCategoryDdlb.html(options); }
            });
        });

        $subCategoryDdlb.on("change", function(e)
        {
            var placeHolder = "Select Product Type";
            var qry = _categoryUrl + "/JSON/" + $subCategoryDdlb.val();
            if($subCategoryDdlb.val() !== "")
            {
            }

            $.getJSON(qry, function(jsonresult)
            {
                //console.log(jsonresult);
                var options = "<option value=''>" + placeHolder + "</option>";
                $.each(jsonresult, function(idx, val)
                {
                    options += "<option value='" + val.id + "'>" + val.name + "</option>";
                });

                $productTypeDdlb.html(options);
            });
        });

        $categoryDdlb.trigger("change");
    };

    var doSearch = function(e)
    {
        if(e.which === 13 || e.target.id === "hlSearchButton")
        {
            var qry = _searchUrl + "/" + $searchQueryTb.val();
            $.getJSON(qry, function(jsonresult)
            {
                var tableRows = "";
                $.each(jsonresult, function(idx, val)
                {
                    //console.log(val);
                    tableRows += "<tr><td><a href='" + _detailUrl + "/" + val.id + "'>" + val.name + "</a></td><td>" + val.brand + "</td><td></td></tr>";
                });

                if(jsonresult.length === 0)
                {
                    tableRows += "<tr><td colspan='3'>{{trans('ui.search_label_no_results')}}</td></tr>";
                }

                $resultTable.html(tableRows);
            });

            e.preventDefault();
        }
    };


    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));