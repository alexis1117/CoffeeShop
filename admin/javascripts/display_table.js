/**
 * Created by Tuya on 1/29/2015.
 */


$(function () {

    $('.save').click(function (event) {

        event.preventDefault();

        var $parent_div = $(this).parent('div');
        var cat_id = $parent_div.attr('id');
        var $rows = $parent_div.find('#table_item').find('tr:not(:first):not(table.tbl_size tr)');

        var data = [];

        $rows.each(function () {
            var $tds = $(this).find('td:not(table.tbl_size td)');
            var temp = {};

            temp['id'] = $.trim($tds.eq(0).text());
            temp['item_title'] = $.trim($tds.eq(2).text());
            temp['item_desc'] = $.trim($tds.eq(4).text());

            var array_sz_price = [];

            $tds.eq(3).find('table').find('tr').each(function () {
                var sz_price = {};

                if ($.trim($(this).find('td').eq(1).text()) !== "") {
                    sz_price['sz_id'] = $(this).find('td').eq(0).find('label').attr('id');
                    sz_price['price'] = parseFloat($(this).find('td').eq(1).text());
                    array_sz_price.push(sz_price);
                }
            });

            temp['sz_price'] = JSON.stringify(array_sz_price);
            temp['cat_id'] = cat_id;
            data.push(temp);
        });

        $.ajax({

            url: "/admin/backend/action_update_item.php",
            type: "post",
            data: "data=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

            beforeSend: function () {

                $.fancybox.showLoading();
            },
            success: function (msg) {

                if (msg === "") {

                    window.parent.show_success_msg_tbl();
                }
                else {

                    window.parent.show_error_msg_tbl();
                }
            },

            complete: function () {

                $.fancybox.hideLoading();
            }
        });
    });

    $('.glyphicon-remove').click(function () {

        var $tr = $(this).parents('tr');
        var id = $.trim($tr.find('td').eq(0).text());

        $.ajax({

            url: "/admin/backend/action_remove_item.php",
            type: "post",
            data: "id=" + id,
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

            beforeSend: function () {

                $.fancybox.showLoading();
            },

            success: function (msg) {

                if (msg == "") {

                    window.parent.show_success_msg_tbl();
                    $tr.detach();
                }
                else {

                    window.parent.show_error_msg_tbl();
                }
            },

            complete: function () {

                $.fancybox.hideLoading();
            }
        });
    });

    $('.add').click(function (event) {

        event.preventDefault();

        var cat_id = $(this).parent('div').attr('id');

        $.fancybox({
            'href': '/admin/pages/new_product.php?cat_id=' + cat_id,
            'scrolling': 'no',
            'titleShow': false,
            'titlePosition': 'none',
            'closeClick': false,
            'openSpeed': 'fast',
            'type': 'iframe',
            'padding': 0,
            'preload': true,
            'fitToView': true,
            'height': '550',
            'autoSize': false,
            'helpers': {
                overlay: {
                    'closeClick': false
                }
            },
            beforeLoad: function () {

                $.fancybox.showLoading();
                window.parent.update_szframe_table(600);
            },

            beforeClose: function () {
                location.reload();
            },

            afterClose: function () { //I search StackOverflow, add this function to reload parent page, it will appear the flash data message notification which I write on controller "add_user"
                //parent.location.reload();
            }
        });

    });

});