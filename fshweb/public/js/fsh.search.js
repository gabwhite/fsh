/**
 * Created by Breen on 14/01/2016.
 */
var fsh = fsh || {};

fsh.search = (function ($, document)
{
    var _categoryUrl, _productUrl, _detailUrl, _progressImage;

    var $categoryTree = $("#jstree_demo_div");
    var $resultTable = $("#product_list");

    var $categoryDdlb = $("#ddlbCategory");
    var $subCategoryDdlb = $("#ddlbSubCategory");
    var $productTypeDdlb = $("#ddlbProductType");

    var $searchQueryTb = $("#tbSearchQuery");
    var $searchButton = $("#hlSearchButton");

    var $sortBy = $("#sortby");
    var $pageSize = $("#viewall");

    var currentQuery = "";
    var currentSearchType = "";
    var productSearchQueryStringFormat = "?type=%s&sort=%s&pageSize=%s";

    var init = function(categoryUrl, productUrl, detailUrl, progressImage)
    {
        _categoryUrl = categoryUrl;
        _productUrl = productUrl;
        _detailUrl = detailUrl;
        _progressImage = progressImage;

        getProducts(productUrl + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val()));

        initTree();

        initCategoryDropdowns();

        $searchQueryTb.on("keydown", doSearch);
        $searchButton.on("click", doSearch);

        $(document).on('click', '.pagination a', function (e)
        {
            e.preventDefault();
            getProducts($(this).attr('href'));
        });

        $("#hlDropdownSearch").on("click", function(e)
        {
            var categoryId = "";
            if($productTypeDdlb.val() !== "") { categoryId = $productTypeDdlb.val(); }
            else if($subCategoryDdlb.val() !== "") { categoryId = $subCategoryDdlb.val(); }
            else if($categoryDdlb.val() !== "") { categoryId = $categoryDdlb.val(); }

            if(categoryId !== "") { getProducts(productUrl + "/" + categoryId + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val())); }

            e.preventDefault();
        });

        $("#hlSort").on("click", function(e)
        {
            e.preventDefault();
            resortResults();
        });

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
            getProducts(_productUrl + "/" + data.node.id + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val()));
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
        if(e.type === "click") { e.preventDefault(); }

        if((e.which === 13 || e.type === "click") && $searchQueryTb.val() !== "")
        {
            getProducts(_productUrl + "/" + $searchQueryTb.val() + sprintf(productSearchQueryStringFormat, "ft", $sortBy.val(), $pageSize.val()));
        }
    };

    var getProducts = function(url)
    {
        applyResultLoader();
        $.getJSON(url, function(jsonresult)
        {
            //console.log(jsonresult);
            currentQuery = jsonresult.query;
            currentSearchType = jsonresult.type;
            $resultTable.html(jsonresult.view);

            removeResultLoader();
        });
    };

    var resortResults = function()
    {
        if($sortBy.val() === "vendors")
        {
            alert("TODO vendors sorting");
        }
        else
        {
            var url = _productUrl + (currentQuery ? "/" + currentQuery : "") + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val());
            //console.log(url);
            getProducts(url);
        }
    };

    var applyResultLoader = function()
    {
        $("#rootResultContainer").addClass("loadProgress");
    };

    var removeResultLoader = function()
    {
        $("#rootResultContainer").removeClass("loadProgress");
    };


    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));