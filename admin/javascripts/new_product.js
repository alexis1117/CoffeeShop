/**
 * Created by Tuya on 1/28/2015.
 */

$(function () {


    function show_success_msg() {

        var alert_success = $('.alert-success');
        var alert_error = $('.alert-error');

        if (typeof alert_success.attr("hidden") !== 'undefined')
            alert_success.removeAttr("hidden");

        if (typeof alert_error.attr("hidden") === 'undefined')
            alert_error.attr("hidden", "hidden");

    }

    function show_error_msg() {

        var alert_success = $('.alert-success');
        var alert_error = $('.alert-error');

        if (typeof alert_error.attr("hidden") !== 'undefined')
            alert_error.removeAttr("hidden");

        if (typeof alert_success.attr("hidden") === 'undefined')
            alert_success.attr("hidden", "hidden");

    }

    var isValid = true;

    function validate() {

        if ($.trim($('#item_title').val()).length === 0) {
            isValid = false;
            return false;
        }

        var count = 0;

        $('.item_sz').each(function () {
            if (!isNaN(parseFloat($.trim($(this).val())))) {
                count++;
            }
        });

        if (count == 0) {
            isValid = false;
            return false;
        }

        if ($('li').length == 0) {
            isValid = false;
            return false;
        }
    }

    $('#new_item').submit(function (event) {

        event.preventDefault();

        validate();

        if (isValid) {

            var data = {};

            data['cat_id'] = $('#cat_id').attr('data-cat_id');
            data['item_title'] = $.trim($('#item_title').val());

            var sz_price = [];

            $('.item_sz').each(function () {

                var temp_sz = {};

                if (!isNaN(parseFloat($.trim($(this).val())))) {
                    temp_sz['sz_id'] = $(this).attr('data-sz_id');
                    temp_sz['price'] = $.trim($(this).val());
                }

                sz_price.push(temp_sz);
            });

            data['sz_price'] = JSON.stringify(sz_price);
            data['item_desc'] = $('#item_desc').val();

            var images = "";

            $('ul').find('li').each(function () {

                images += $(this).text() + ",";
            });

            data['item_img'] = images;

            $.ajax({
                url: "/admin/backend/action_add_item.php",
                type: "post",
                data: "data=" + JSON.stringify(data),
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                beforeSend: function () {
                    $.fancybox.showLoading();
                },

                success: function (msg) {

                    if (msg === "") {

                        $('form')[0].reset();

                        $('li').each(function () {
                            $(this).detach();
                        });

                        show_success_msg();
                    }

                    else
                        show_success_msg();

                },

                complete: function () {

                    $.fancybox.hideLoading();
                }
            });
        }
        else {
            show_error_msg();
            isValid = true;
        }
    });


});