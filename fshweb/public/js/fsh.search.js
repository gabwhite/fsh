/**
 * Created by Breen on 14/01/2016.
 */
var fsh = fsh || {};

fsh.search = (function ($, document)
{
    var _categoryUrl, _productUrl, _detailUrl, _progressImage, _productImagePath;

    var $categoryTree = $("#jstree_demo_div");
    var $resultTable = $("#product_list");

    var $categoryDdlb = $("#ddlbCategory");
    var $subCategoryDdlb = $("#ddlbSubCategory");
    var $productTypeDdlb = $("#ddlbProductType");

    var $searchQueryTb = $("#tbSearchQuery");
    var $searchButton = $("#hlSearchButton");
    var $rootResultContainer = $("#rootResultContainer");

    var $sortBy = $("#sortby");
    var $pageSize = $("#viewall");

    var currentQuery = "";
    var currentSearchType = "";
    var productSearchQueryStringFormat = "?type=%s&sort=%s&pageSize=%s";

    var searchVue;
    var categoryDdlbVue;

    var categoriesDefault = { id: "", name: "Select Category", parent_id: null };
    var subCategoriesDefault = { id: "", name: "Select Sub Category", parent_id: null };
    var productTypesDefault = { id: "", name: "Select Product Type", parent_id: null };

    var resultsObject = {};

    var init = function(categoryUrl, productUrl, detailUrl, existingQuery, progressImage, productImagePath)
    {
        _categoryUrl = categoryUrl;
        _productUrl = productUrl;
        _detailUrl = detailUrl;
        _progressImage = progressImage;
        _productImagePath = productImagePath;

        searchVue = new Vue({
            el: "#searchview",
            data: {
                results: resultsObject
            },
            methods:
            {
                getProductImage: function (img)
                {
                    //console.log(img);
                    if(img === "")
                    {
                        return sprintf("url('%s')", noProductImage);
                    }

                    return sprintf("url('%s/%s')", productImagePath, img);


                }
            }
        });

        categoryDdlbVue = new Vue({
            el: "#divCategoryDropdowns",
            data: {
                categories: [ categoriesDefault ],
                subCategories: [ subCategoriesDefault ],
                productTypes: [ productTypesDefault ]
            }
        });

        if(existingQuery !== "")
        {
            getProducts(_productUrl + "/" + existingQuery + sprintf(productSearchQueryStringFormat, "ft", $sortBy.val(), $pageSize.val()));
            $searchQueryTb.val(existingQuery);
        }
        else
        {
            getProducts(productUrl + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val()));
        }

        initTree();

        initCategoryDropdowns();
        $categoryDdlb.trigger("change");

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

            if(categoryId !== "") { getProducts(productUrl + "/" + categoryId + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val())); }

            e.preventDefault();
        });

        $("#hlSort").on("click", function(e)
        {
            e.preventDefault();
            resortResults();
        });

        $("#hlToggleSearchTips").on("click", function(e)
        {
            e.preventDefault();
            $("#divSearchTips").slideToggle();
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
            getProducts(_productUrl + "/" + data.node.id + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val()));
        });
    };

    var initCategoryDropdowns = function()
    {
        $categoryDdlb.on("change", function(e)
        {
            var placeHolder = categoriesDefault;
            var fillSelf = true;

            var qry = _categoryUrl + "/JSON";
            if($categoryDdlb.val() !== "")
            {
                fillSelf = false;
                qry += "/" + $categoryDdlb.val();
                placeHolder = subCategoriesDefault;
            }

            $.getJSON(qry, function(jsonresult)
            {
                //console.log(jsonresult);
                jsonresult.splice(0, 0, placeHolder);
                if(fillSelf)
                {
                    categoryDdlbVue.categories = jsonresult;
                    categoryDdlbVue.subCategories = [subCategoriesDefault];
                    categoryDdlbVue.productTypes = [productTypesDefault];
                }
                else { categoryDdlbVue.subCategories = jsonresult; }
            });
        });

        $subCategoryDdlb.on("change", function(e)
        {
            if($subCategoryDdlb.val() !== "")
            {
                var qry = _categoryUrl + "/JSON/" + $subCategoryDdlb.val();
                $.getJSON(qry, function(jsonresult)
                {
                    //console.log(jsonresult);
                    jsonresult.splice(0, 0, productTypesDefault);
                    categoryDdlbVue.productTypes = jsonresult;
                });
            }
            else
            {
                categoryDdlbVue.productTypes = [productTypesDefault];
            }
        });
    };

    var doSearch = function(e)
    {
        if(e.type === "click") { e.preventDefault(); }

        if((e.which === 13 || e.type === "click") && $searchQueryTb.val() !== "")
        {
            getProducts(_productUrl + "/" + $searchQueryTb.val() + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val()));
        }
    };

    var getProducts = function(url)
    {
        console.log("Retrieving url:[" + url + "]");

        $rootResultContainer.addClass("loadProgress");
        $.getJSON(url, function(jsonresult)
        {
            console.log(jsonresult);

            currentQuery = jsonresult.query;
            currentSearchType = jsonresult.type;

            if($.isEmptyObject(resultsObject)) { searchVue.$set("results", jsonresult); }
            else { resultsObject = jsonresult; }

            $rootResultContainer.removeClass("loadProgress");
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
            var url = _productUrl + (currentQuery ? "/" + currentQuery : "") + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val());
            getProducts(url);
        }
    };

    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));