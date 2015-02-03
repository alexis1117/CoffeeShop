/**
 * Created by Tuya on 1/23/2015.
 */

$(function () {
    $('#save').click(function (e) {

        e.preventDefault();

        var $rows = $('table').find('tr:not(:first)');

        var data = [];

        $rows.each(function () {
            var extra = {};
            var $td = $(this).find('td');

            if ($.trim($td.eq(1).text()) !== "") {
                extra['id'] = $.trim($td.eq(0).text());
                extra['title'] = $.trim($td.eq(1).text());
                extra['price'] = parseFloat($td.eq(2).text());

                data.push(extra);
            }
        });

        $.ajax({

            url: "/admin/backend/action_update_extra.php",
            type: "post",
            data: "data=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

            beforeSend: function () {

                $.fancybox.showLoading();
            },

            success: function (msg) {

                if (msg == "") {

                    var $rows = $('table').find('tr:not(:first)');
                    $rows.each(function () {

                        if ($(this).attr('class') !== "cloneable" && $.trim($(this).find('td').eq(1).text()) === "")
                            $(this).detach();
                    });

                    window.parent.show_success_msg();
                }
                else {

                    window.parent.show_error_msg();
                }

            },

            complete: function () {

                $.fancybox.hideLoading();
            }
        });
    });


    $('.glyphicon-remove').click(function () {

    });
});

function remove_item($element) {

    var $tr = $element.parents('tr');
    var id = $.trim($tr.find('td').eq(0).text());

    $.ajax({

        url: "/admin/backend/action_remove_extra.php",
        type: "post",
        data: "id=" + id,
        processData: false,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

        beforeSend: function () {
            $.fancybox.showLoading();
        },

        success: function (msg) {

            if (msg == "") {

                window.parent.show_success_msg();
                $tr.detach();
            }
            else {

                window.parent.show_error_msg();
            }
        },

        complete: function () {

            $.fancybox.hideLoading();
        }
    });
}