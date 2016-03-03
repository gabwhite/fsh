/**
 * Created by Breen on 14/01/2016.
 */
var fsh = fsh || {};

fsh.search = (function ($, document)
{
    var _categoryUrl, _productUrl, _detailUrl, _progressImage, _productImagePath;

    var objTree;
    var treeState = [];
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

    var lastSearchQuery = null;
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
                    else if(img.lastIndexOf('http', 0) === 0)
                    {
                        return sprintf("url('%s')", img);
                    }
                    else
                    {
                        return sprintf("url('%s/%s')", productImagePath, img);
                    }
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

        initTree();

        lastSearchQuery = retrieveSearchQuery();
        deleteSearchQuery();

        if(existingQuery !== "")
        {
            getProducts(buildSearchUrl(existingQuery, "ft", $sortBy.val(), $pageSize.val()));
            $searchQueryTb.val(existingQuery);
        }
        else if(lastSearchQuery !== null && lastSearchQuery !== undefined)
        {
            getProducts(buildSearchUrl(lastSearchQuery.query, lastSearchQuery.searchType, lastSearchQuery.sort, lastSearchQuery.pageSize));
            restoreUi(lastSearchQuery);
        }
        else
        {
            getProducts(buildSearchUrl("", "fc", $sortBy.val(), $pageSize.val()));
            //getProducts(productUrl + sprintf(productSearchQueryStringFormat, "fc", $sortBy.val(), $pageSize.val()));
        }


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

            if(categoryId !== "")
            {
                getProducts(buildSearchUrl(categoryId, currentSearchType, $sortBy.val(), $pageSize.val()));
                //getProducts(productUrl + "/" + categoryId + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val()));
            }

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
                },
                "plugins": [ "state" ]
            }
        });

        // Get tree instance
        objTree = $categoryTree.jstree(true);

        $categoryTree.off("loaded.jstree").on("loaded.jstree", function(e, data)
        {
            if(lastSearchQuery !== null && lastSearchQuery !== undefined && lastSearchQuery.searchType === "fc")
            {
                var nodeCount = lastSearchQuery.treeState.length;
                if(lastSearchQuery.treeState && nodeCount > 0)
                {
                    var nodeId = lastSearchQuery.treeState[0];
                    var node = objTree.get_node(nodeId);
                    objTree.open_node(node, function(e, data)
                    {
                        if(nodeCount > 2)
                        {
                            nodeId = lastSearchQuery.treeState[1];
                            node = objTree.get_node(nodeId);
                            objTree.open_node(node, function(e, data)
                            {
                            });
                        }
                    });
                }
            }
        });

        $categoryTree.off("changed.jstree").on("changed.jstree", function(e, data)
        {
            saveTreeState(data.node);
            currentSearchType = "fc";
            $searchQueryTb.val("");
            getProducts(buildSearchUrl(data.node.id, currentSearchType, $sortBy.val(), $pageSize.val()));
            //getProducts(_productUrl + "/" + data.node.id + sprintf(productSearchQueryStringFormat, currentSearchType, $sortBy.val(), $pageSize.val()));
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

        currentSearchType = "ft";

        if((e.which === 13 || e.type === "click") && $searchQueryTb.val() !== "")
        {
            getProducts(buildSearchUrl($searchQueryTb.val(), currentSearchType, $sortBy.val(), $pageSize.val()));
        }
    };

    var getProducts = function(url)
    {
        console.log("Retrieving url:[" + url + "]");

        $rootResultContainer.addClass("loadProgress");
        $.getJSON(url, function(jsonresult)
        {
            //console.log(jsonresult);

            currentQuery = jsonresult.query;
            currentSearchType = jsonresult.type;

            if($.isEmptyObject(resultsObject)) { searchVue.$set("results", jsonresult); }
            else { resultsObject = jsonresult; }

            $rootResultContainer.removeClass("loadProgress");

            storeSearchQuery();
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
            getProducts(buildSearchUrl(currentQuery, "fc", $sortBy.val(), $pageSize.val()));
        }
    };

    var buildSearchUrl = function(query, sType, sort, pageSize)
    {
        var url = _productUrl + (query ? "/" + query : "") + sprintf(productSearchQueryStringFormat, sType, sort, pageSize);

        return url;
    };

    var restoreUi = function(searchQuery)
    {
        $pageSize.val(searchQuery.pageSize);
        $sortBy.val(searchQuery.sort);

        if(searchQuery.searchType === "ft")
        {
            $searchQueryTb.val(searchQuery.query);
        }
        else
        {
            $searchQueryTb.val("");
        }
    };

    var storeSearchQuery = function()
    {
        var obj = { query: currentQuery, searchType: currentSearchType, sort: $sortBy.val(), pageSize: $pageSize.val(), treeState: treeState, saved: new Date().getTime() };

        Lockr.set("lastSearchQuery", obj);
    };

    var retrieveSearchQuery = function()
    {
        return Lockr.get("lastSearchQuery");
    };

    var deleteSearchQuery = function()
    {
        Lockr.rm("lastSearchQuery");
    };

    var saveTreeState = function(nodeChosen)
    {
        treeState = [];

        // Walk up the tree saving node id's
        treeState.unshift(nodeChosen.id);
        var parentNode = objTree.get_parent(nodeChosen);
        //console.log(parentNode);
        while(parentNode !== "#")
        {
            treeState.unshift(parentNode);
            parentNode = objTree.get_parent(parentNode);
        }

        //console.log(treeState);
    };

    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));