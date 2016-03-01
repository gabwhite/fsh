var fsh = fsh || {};

fsh.productedit = (function ($, document)
{
    var _categoryUrl, _categoryId, _subCategoryId, _productTypeId;
    var $categoryDdlb = $("#ddlbCategory");
    var $subCategoryDdlb = $("#ddlbSubCategory");
    var $productTypeDdlb = $("#ddlbProductType");

    var categoriesDefault = { id: "", name: "Select Category", parent_id: null };
    var subCategoriesDefault = { id: "", name: "Select Sub Category", parent_id: null };
    var productTypesDefault = { id: "", name: "Select Product Type", parent_id: null };

    var categoryDdlbVue = new Vue({
        el: "#divCategoryDropdowns",
        data: {
            categories: [ categoriesDefault ],
            subCategories: [ subCategoriesDefault ],
            productTypes: [ productTypesDefault ]
        }
    });

    var init = function(categoryUrl, productCategories)
    {
        _categoryUrl = categoryUrl;

        for(var i = 0; i < productCategories.length; i++)
        {
            var id = productCategories[i].id;
            var pId = productCategories[i].parent_id;

            if(pId === null) { _categoryId = id; }
            else if(pId === _categoryId) { _subCategoryId = id; }
            else if(pId === _subCategoryId) { _productTypeId = id; }
        }

        console.log(_categoryId); console.log(_subCategoryId); console.log(_productTypeId);

        initCategoryDropdowns();

        $categoryDdlb.trigger("change");

        $categoryDdlb.val(_categoryId);
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

    var pub =
    {
        init: init
    };

    return pub;

}(jQuery, document));