/**
 * Created by Tuya on 1/26/2015.
 */
$(function () {

    $('#update').click(function () {

        var $trs = $('.table').find('tr:not(:first)');

        var data = [];

        $trs.each(function () {

            var temp = {};
            temp['order_id'] = $(this).find('td').eq(0).text();

            var td_type = $(this).find('td').eq(5).attr('id');

            if (td_type == "is_select")
                temp['order_status'] = $.trim($(this).find('select :selected').val());
            else
                temp['order_status'] = $.trim($(this).find('td').eq(5).text());

            data.push(temp);

        });

        $.ajax({
            url: "/admin/backend/action_update_status.php",
            type: "post",
            data: "data=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (msg) {

                window.top.update_norder(msg);

                location.replace("/admin/backend/action_display_order.php?new");

            },
            complete: function () {
                $.fancybox.hideLoading();
            }
        });
    });

    $('.detail').click(function () {

        var order_id = $(this).parents('tr').find('td').eq(0).text();

        $.fancybox({
            'href': '/admin/pages/detail.php?order_id=' + order_id,
            'scrolling': 'no',
            'titleShow': false,
            'titlePosition': 'none',
            'closeClick': false,
            'openSpeed': 'fast',
            'type': 'iframe',
            'padding': 0,
            'preload': true,
            'autoSize': false,
            'minHeight': '400',
            'helpers': {
                overlay: {
                    'closeClick': false
                }
            },

            beforeLoad: function () {

                var window_name = window['name'];

                if (window_name === "order_iframe") {

                    window.parent.update_szframe_order(500);
                }

                else if (window_name === "admin_iframe") {

                    window.parent.update_szframe_admin(500);
                }
            }
        });

    });

});