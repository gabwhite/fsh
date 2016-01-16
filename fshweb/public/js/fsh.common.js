var fsh = fsh || {};

fsh.common = (function ($, document)
{

    "use strict";

    var isProduction = true;

    var setDebug = function(enabled)
    {
        isProduction = !enabled;
    };

    var doAjax = function (url, data, method, isAsync, successFunction, errorFunction)
    {
        $.ajax({
            type: method,
            url: url,
            data: data,
            async: isAsync,
            //contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: successFunction,
            error: errorFunction
        });
    };

    var p = function (message, level)
    {
        if (!isProduction)
        {
            if (typeof (console) !== "undefined")
            {
                switch (level)
                {
                    case "info":
                        console.info(message);
                        break;
                    case "warn":
                        console.warn(message);
                        break;
                    case "debug":
                        console.debug(message);
                        break;
                    case "error":
                        console.error(message);
                        break;
                    default:
                        console.log(message);
                        break;
                }
            }
        }
    };

    var getCountries = function(url, elem, selected)
    {
        doAjax(url, {}, "GET", true,
            function(data)
            {
                var html = "<option value=''></option>";
                $.each(data, function(idx, val)
                {
                    //console.log(val);
                    if(val.id == selected)
                    {
                        html += "<option value='" + val.id + "' selected='selected'>" + val.name + "</option>";
                    }
                    else
                    {
                        html += "<option value='" + val.id + "'>" + val.name + "</option>";
                    }

                });
                elem.html(html);
                elem.trigger("change");
            },
            function(jqXhr, textStatus, errorThrown)
            {

            }
        );
    };

    var getStateProvincesForCountry = function(url, elem, selected)
    {
        doAjax(url, {}, "GET", true,
            function(data)
            {
                //console.log(data);
                var html = "<option value=''></option>";
                $.each(data, function(idx, val)
                {
                    //console.log(val);
                    if(val.id == selected)
                    {
                        html += "<option value='" + val.id + "' selected='selected'>" + val.name + "</option>";
                    }
                    else
                    {
                        html += "<option value='" + val.id + "'>" + val.name + "</option>";
                    }

                });
                elem.html(html);
            },
            function(jqXhr, textStatus, errorThrown)
            {

            }
        );
    };


    var globalInitialization = function()
    {
        // Set event handler for global search button
        var searchButton = $("#frmNavigationSearch").find("a");
        searchButton.on("click", function(e)
        {
            e.preventDefault();
            $("#frmNavigationSearch").submit();
        });
    };

    var pub =
    {
        p: p,
        setDebug: setDebug,
        doAjax: doAjax,
        globalInitialization: globalInitialization,
        getCountries: getCountries,
        getStateProvincesForCountry: getStateProvincesForCountry
    };

    return pub;


}(jQuery, document));

$(document).ready(function() { fsh.common.globalInitialization();});
