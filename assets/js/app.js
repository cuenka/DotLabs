/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function () {
    function ajaxCall(event) {
        var $domResult = $('.api__result');
        var $object = $(event.target);
        var endpoint = $object.data('endpoint');
        var method = $object.data('method');
        var body = (typeof $object.attr('data-body') === "undefined") ? "" : $object.attr('data-body');

        if (typeof method === "undefined" ||
            typeof endpoint === "undefined") {
            alert("Attributes missing, please make sure that data-endpoint and data-method are not empty")
            return 0;
        }
        console.log("Body:" + body)

        $.ajax({
            url: endpoint,
            method: method,
            data: body,
            contentType: "application/json"
        }).done(function (data, statusText, xhr) {
            $domResult.find('.api__result__status').html('<b>Status:</b> ' + xhr.status);
            $domResult.find('.api__result__data').html('');
            var responseData = JSON.stringify(data)
            $domResult.find('.api__result__data').html("<pre>" + responseData + "</pre>");
        }).fail(function (xhr, status, errorThrown) {
            $domResult.find('.api__result__status').html('<b>Status:</b> ' + xhr.status);
            $domResult.find('.api__result__data').html('');
            var responseData = xhr.responseText;
            $domResult.find('.api__result__data').html("<pre>" + responseData + "</pre>");
        });

    }

    $(".howsy-ajax-call").on("click", {}, ajaxCall);

    function updateCta(event) {
        var body = '{"' + $("select#field option:checked").val() + '":"' + $('input#term').val() + '"}';
        $('.howsy-ajax-call').attr('data-body', body);
    }

    $("#field").on("change", {}, updateCta);
    $("#term").on("keyup", {}, updateCta);

});

