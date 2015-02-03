/**
 * Created by Tuya on 12/24/2014.
 */

function show_link_signin() {

    $('#link_account').hide();
    $('#link_signin').show();
    $('#usr_exists').text("false");
    //$('#iframe_body').attr('src', '')
}

function show_link_account() {

    $('#link_account').show();
    $('#link_signin').hide();
    $('#usr_exists').text("true");
    $('#iframe_body').attr('src', "/pages/account.php");
}

$(function () {

    $(window).load(function () {

        var usr_exists = $('#usr_exists').text();

        if (usr_exists === "true")
            show_link_account();

        else
            show_link_signin();
    });


    var n_cart = 0;

    $('.nav-stacked li').click(function () {
        $.fancybox.showLoading();

        $('.container_title').find('img').attr('src', $(this).attr('data-img'));
        var $lis = $('.nav-stacked').find('li');

        $lis.each(function () {
            $(this).removeClass('active');
        });

        $(this).addClass('active');

    });

    $('.navbar-right li').click(function () {

        var img_src = $(this).attr('data-img');

        if (typeof img_src !== 'undefined' && img_src !== false) {
            $.fancybox.open(this.href, {type: "iframe"});
            $.fancybox.showLoading();
            $('.container_title img').attr('src', img_src);
        }

    });

    $('#usr_signout').click(function (event) {

        event.preventDefault();

        $.ajax({

            url: "/backend/action_signout.php",
            type: "post",
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (msg) {

                if (msg === "") {

                    show_link_signin();
                }

                else {
                    alert(msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("error=" + XMLHttpRequest + " error2=" + textStatus + " error3=" + errorThrown);
                console.log({"error": XMLHttpRequest, "error2": textStatus, "error3": errorThrown});
            },

            complete: function () {
                $.fancybox.hideLoading();
            }
        });
    });

    $('#iframe_body').ready(function () {

        $('#iframe_body').load(function () {


            var content = $(this).contents();

            $(this).height(content.height());

            if (content.find('#cart').find('tr').length > 1) {
                calc_total();
            }


            content.find('#link_signup').click(function (event) {
                event.preventDefault();

                window.frames['iframe_body'].location.replace('/pages/signup.php');
                $('.container_title').find('img').attr('src', $(this).attr('data-img'));
            });

            content.find('.btn_detail').click(function () {

                var $parent_td = $(this).parents('div[class=col]');
                var $checklist = content.find('#table_checklist').clone(true).removeAttr("hidden");

                var _dialog;

                var $mydiv = $('<div>').load('/pages/content_detail_temp.php', function () {

                    $(this).find('#detail_title').text($parent_td.find('#item_title').text());
                    $(this).find('#detail_price').text("$" + $parent_td.find('.btn_detail').attr('data-def_price'));
                    $(this).find('#detail_price').attr('data-size_id', $parent_td.find('.btn_detail').attr('data-sz_id'));
                    $(this).find('#detail_img').attr('src', $parent_td.find('#item_img').attr('src'));
                    $(this).find('#detail_extra').append($checklist);
                    $(this).find('#detail_desc').text($parent_td.find('#item_desc').text());
                    $(this).find('#add_to_cart').attr('data-item_id', $parent_td.find('#item_img').attr('data-item_id'));
                    $(this).find('#detail_size').append($parent_td.find('#item_size').clone(true).removeAttr("hidden")).bind({
                            change: function () {
                                var id = $(this).find(':selected').attr('id');
                                var value = $(this).find(':selected').attr('value');

                                $mydiv.find('#detail_price').attr('data-size_id', id);
                                $mydiv.find('#detail_price').text('$' + value);

                            }
                        }
                    );

                    $(this).find('#dec_qty').on('click', function () {

                        if (parseInt($mydiv.find('#item_qty').val()) > 1)
                            $mydiv.find('#item_qty').val(parseInt($mydiv.find('#item_qty').val()) - 1);

                        return false;
                    });

                    $(this).find('#inc_qty').on('click', function () {

                        $mydiv.find('input#item_qty').val(parseInt($mydiv.find('input#item_qty').val()) + 1);

                        return false;
                    });

                    $(this).find('.checklist').hover(
                        function () {
                            $(this).parent().find('.ext_price').removeAttr('hidden');
                        },
                        function () {
                            $(this).parent().find('.ext_price').attr({
                                hidden: 'hidden'
                            });

                        }
                    );

                    $(this).find('#add_to_cart').on('click', function () {
                        var data = {};

                        data['item_id'] = $(this).attr('data-item_id');
                        data['size_id'] = $mydiv.find('#detail_price').attr('data-size_id');
                        data['price'] = $mydiv.find('#detail_price').text();
                        data['qty'] = $mydiv.find('#item_qty').val();


                        var array_extra = [];
                        ($mydiv.find('#table_checklist').find('input[type=checkbox]:checked')).each(function () {
                            array_extra.push($(this).attr('id'));
                        });
                        data['extra'] = array_extra;

                        $.ajax({
                            url: "/backend/action_add_cart.php",
                            type: "post",
                            data: "cart=" + JSON.stringify(data),
                            processData: false,
                            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                            success: function (data) {
                                n_cart = parseInt(data);
                                $('#usr_cart').text("My Cart (" + n_cart + ")");
                            },
                            error: function () {
                                alert("error");
                            }
                        });

                        return false;
                    });

                    $(this).find('#btn_close').click(function () {
                        _dialog.dialog("close");
                    });

                });

                _dialog = $mydiv.dialog({
                    width: 600,
                    height: 430,
                    resizable: false,
                    hide: "puff",
                    show: "slide",
                    modal: true,

                    open: function () {
                    },

                    close: function () {
                        $(this).dialog("close");
                        $(this).remove();
                        if (n_cart > 0)
                            $('#usr_cart').text("My Cart" + "(" + n_cart + ")");
                    }

                });

            });


            content.find('.change_qty').click(function () {

                var qty;
                var $p_td = $(this).parent('td');
                var $p_tr = $p_td.parent('tr');
                var $p_extra = $p_tr.find('#div_extra').find('label');

                var data = {};
                var array_extra = [];

                if ($(this).attr('id') === "inc_qty") {

                    qty = parseInt($p_td.find('#qty').text());
                    $p_td.find('#qty').text(qty + 1);
                }

                else if ($(this).attr('id') === "dec_qty") {

                    qty = parseInt($p_td.find('#qty').text());

                    if (qty > 1)
                        $p_td.find('#qty').text(qty - 1);
                }

                data['item_id'] = $p_tr.find('.caption').attr('data-item_id');
                data['size_id'] = $p_tr.find('#size').attr('data-size_id');
                data['price'] = $p_tr.find('#price').text();
                data['qty'] = $p_td.find('#qty').text();

                $p_extra.each(function () {
                    array_extra.push($(this).attr('data-id'));
                });

                data['extra'] = array_extra;

                $.ajax({
                    url: "/backend/action_update_cart.php",
                    type: "post",
                    data: "cart=" + JSON.stringify(data),
                    processData: false,
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function () {
                        calc_total();
                    },
                    error: function () {
                        alert("error");
                    }
                });

            });

            function calc_total() {
                var item_subtotal = 0, subtotal = 0;
                var qty = 0, price = 0;

                var delivery_fee = parseFloat(content.find('#delivery').attr('data-del'));
                var min_order = parseFloat(content.find('#min_order').text().substring(1));
                var tax = parseFloat(content.find('#tax').attr('data-tax'));

                var $cart_items = content.find('#cart').find('tr:not(:first)');

                $cart_items.each(function () {

                    var $p_extra = $(this).find('#div_extra').find('label');
                    var total_extra = 0;
                    $p_extra.each(function () {
                        total_extra += parseFloat($(this).attr('data-price'));
                    });

                    qty = parseInt($(this).find('#qty').text());
                    price = parseFloat($(this).find('#price').text().substring(1));

                    item_subtotal = Math.round((qty * price + total_extra ) * 100) / 100;
                    $(this).find('#item_subtotal').text("$" + item_subtotal);
                    subtotal += item_subtotal;
                });

                if (min_order > 0 && subtotal > min_order)
                    delivery_fee = 0;


                content.find('#subtotal').text("$" + Math.round(subtotal * 100) / 100);
                content.find('#tax').text("$" + Math.round(subtotal * tax) / 100);
                content.find('#delivery').text("$" + delivery_fee);
                content.find('#total').text("$" + Math.round((subtotal + subtotal * tax * 0.01 + delivery_fee) * 100) / 100);

                return Math.round((subtotal + subtotal * tax * 0.01 + delivery_fee) * 100) / 100;
            }

            $.fancybox.hideLoading();

        });
    });
})
;

function update_szframe_main() {

    var $iframe = $('#iframe_body');

    $iframe.height($iframe.contents().height());
}

function calc_total_2($table) {

    var iframe = $('#iframe_body');

    iframe.contents().find('#div_calc').removeAttr('hidden');

    var $subtotals = $table.find('.subtotal');
    var subtotal = 0;

    var del_fee = parseFloat(iframe.contents().find('#delivery').attr('data-del'));
    var tax = parseFloat(iframe.contents().find('#tax').attr('data-tax'));
    var min_order = parseFloat(iframe.contents().find('#min_order').text());

    $subtotals.each(function () {
        subtotal += parseFloat($(this).text());
    });

    if (subtotal > min_order)
        del_fee = 0;

    iframe.contents().find('#subtotal').text("$" + Math.round(subtotal * 100) / 100);
    iframe.contents().find('#tax').text("$" + Math.round(subtotal * tax) / 100);
    iframe.contents().find('#delivery').text("$" + del_fee);
    iframe.contents().find('#total').text("$" + Math.round((subtotal + subtotal * tax * 0.01 + del_fee) * 100) / 100);

    $('#iframe_body').height(iframe.contents().height());
    $('#frame_body').width(iframe.contents().width());
}

