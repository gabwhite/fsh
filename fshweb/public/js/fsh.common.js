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
        globalInitialization: globalInitialization
    };

    return pub;


}(jQuery, document));

$(document).ready(function() { fsh.common.globalInitialization();});
