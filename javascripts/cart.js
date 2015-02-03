/**
 * Created by Tuya on 1/30/2015.
 */
$(function () {

    $('#checkout').click(function () {

        var data = [];

        var $cart_items = $('#cart').find('tr:not(:first)');


        $cart_items.each(function () {
            var item = {};

            item['item_id'] = $(this).find('.caption').attr('data-item_id');
            item['size_id'] = $(this).find('#size').attr('data-size_id');
            item['qty'] = $(this).find('#qty').text();

            var $p_extra = $(this).find('#div_extra').find('label');
            var array_extra = [];

            $p_extra.each(function () {
                array_extra.push($(this).attr('data-id'));
            });

            item['extra'] = array_extra;
            item['subtotal'] = $(this).find('#item_subtotal').text().substr(1);
            item['type'] = $('input[name="order_type"]:checked').val();
            data.push(item);
        });

        $.ajax({
            url: "/backend/action_add_order.php",
            type: "post",
            data: "cart=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (msg) {
                if (msg === "") {
                    alert("Successfully checked out!");
                    n_cart = 0;
                    $('#usr_cart').text("My Cart");
                    $('#cart').remove();
                    $('#div_total').remove();
                    var $p = $('<p/>').attr('id', 'empty').text("Your basket is currently empty.");
                    $('.cart_content').append($p);
                }

                if (msg === "ERROR_NOLOGIN") {
                    //show fancybox in login
                }
                else {
                    alert(msg);
                }
            },
            error: function (error) {
                alert(error);
            }
        });

    });

    $('.glyphicon-remove').click(function () {

        var $p_td = $(this).parent('td');
        var $p_tr = $p_td.parent('tr');
        var $parent_table = $(this).parents('table');

        var $p_extra = $p_tr.find('#div_extra').find('label');
        var array_extra = [];


        var data = {};

        data['item_id'] = $p_tr.find('.caption').attr('data-item_id');
        data['size_id'] = $p_tr.find('#size').attr('data-size_id');

        $p_extra.each(function () {
            array_extra.push($(this).attr('data-id'));
        });

        data['extra'] = array_extra;

        $.ajax({
            url: "/backend/action_remove_cart.php",
            type: "post",
            data: "cart=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function (data) {
                $p_tr.remove();
                n_cart = parseInt(data);

                if ($parent_table.find('tr').length === 1) {

                    var $p = $('<p/>').attr('id', 'empty').text("Your basket is currently empty.");

                    $parent_table.parent('div').append($p);
                    $parent_table.remove();
                    $('#div_total').remove();
                }

                if (n_cart > 0) {
                    $('#usr_cart').text("My Cart" + "(" + n_cart + ")");
                    calc_total();
                }

                else
                    $('#usr_cart').text("My Cart");
            },
            error: function () {
                alert("error");
            }
        });
    });

});