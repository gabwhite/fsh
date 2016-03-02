var fsh = fsh || {};

fsh.productedit = (function ($, document)
{
    var _categoryUrl;
    var _categoryId = null, _subCategoryId = null, _productTypeId = null;
    var $categoryDdlb = $("#ddlbCategory");
    var $subCategoryDdlb = $("#ddlbSubCategory");
    var $productTypeDdlb = $("#ddlbProductType");

    var categoriesDefault = { id: "", name: "Select Category", parent_id: null };
    var subCategoriesDefault = { id: "", name: "Select Sub Category", parent_id: null };
    var productTypesDefault = { id: "", name: "Select Product Type", parent_id: null };

    var categoryDdlbVue;

    var init = function(categoryUrl, productCategories)
    {
        _categoryUrl = categoryUrl;


        categoryDdlbVue = new Vue({
            el: "#divCategoryDropdowns",
            data: {
                categories: [ categoriesDefault ],
                subCategories: [ subCategoriesDefault ],
                productTypes: [ productTypesDefault ],
                selectedCategoryId: _categoryId,
                selectedSubCategoryId: _subCategoryId,
                selectedProductTypeId: _productTypeId
            },
            methods: {
                selectCatChange: function(event)
                {
                    //this.selectedCategoryId = $(event.target).val();
                    console.log($(event.target).val());
                },
                selectSubCatChange: function(event)
                {
                    //this.selectedSubCategoryId = $(event.target).val();
                    console.log($(event.target).val());
                },
                selectProductChange: function(event)
                {
                    //this.selectedProductTypeId = $(event.target).val();
                    console.log($(event.target).val());
                }
            }
        });

        for(var i = 0; i < productCategories.length; i++)
        {
            var id = productCategories[i].id;
            var pId = productCategories[i].parent_id;

            if(pId === null) { categoryDdlbVue.selectedCategoryId = id; }
            else if(pId === categoryDdlbVue.selectedCategoryId) { categoryDdlbVue.selectedSubCategoryId = id; }
            else if(pId === categoryDdlbVue.selectedSubCategoryId) { categoryDdlbVue.selectedProductTypeId = id; }
        }

        initCategoryDropdowns();

        getCategoriesForId(_categoryUrl + "/JSON", function(data)
        {
            data.splice(0, 0, categoriesDefault);
            categoryDdlbVue.categories = data;
        });

        getCategoriesForId(_categoryUrl + "/JSON/" + categoryDdlbVue.selectedCategoryId, function(data)
        {
            data.splice(0, 0, subCategoriesDefault);
            categoryDdlbVue.subCategories = data;
        });

        getCategoriesForId(_categoryUrl + "/JSON/" + categoryDdlbVue.selectedSubCategoryId, function(data)
        {
            data.splice(0, 0, productTypesDefault);
            categoryDdlbVue.productTypes = data;
        });

    };

    var initCategoryDropdowns = function()
    {
        $categoryDdlb.on("change", function(e)
        {
            categoryDdlbVue.selectedCategoryId = $categoryDdlb.val();
            getCategories();
        });

        $subCategoryDdlb.on("change", function(e)
        {
            categoryDdlbVue.selectedSubCategoryId = $subCategoryDdlb.val();

            if($subCategoryDdlb.val() !== "")
            {
                getProductTypes();
            }
            else
            {
                categoryDdlbVue.selectedProductTypeId = "";
                categoryDdlbVue.productTypes = [productTypesDefault];
            }
        });

        $productTypeDdlb.on("change", function(e) { categoryDdlbVue.selectedProductTypeId = $productTypeDdlb.val(); })
    };

    var getCategories = function()
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

        getCategoryJson(qry, placeHolder, fillSelf);
    };

    var getProductTypes = function()
    {
        var qry = _categoryUrl + "/JSON/" + $subCategoryDdlb.val();
        $.getJSON(qry, function(jsonresult)
        {
            //console.log(jsonresult);
            jsonresult.splice(0, 0, productTypesDefault);
            categoryDdlbVue.productTypes = jsonresult;
        });
    };

    var getCategoryJson = function(qry, placeHolder, fillSelf)
    {
        $.getJSON(qry, function(jsonresult)
        {
            //console.log(jsonresult);
            jsonresult.splice(0, 0, placeHolder);
            if(fillSelf)
            {
                categoryDdlbVue.categories = jsonresult;
                categoryDdlbVue.subCategories = [subCategoriesDefault];
                categoryDdlbVue.productTypes = [productTypesDefault];

                categoryDdlbVue.selectedSubCategoryId = "";
                categoryDdlbVue.selectedProductTypeId = "";
            }
            else { categoryDdlbVue.subCategories = jsonresult;  }
        });
    };

    var getCategoriesForId = function(qry, func)
    {
        $.getJSON(qry, func);
    };

    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));