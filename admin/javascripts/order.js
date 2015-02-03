/**
 * Created by Tuya on 1/24/2015.
 */

$(function () {

    $('.datepicker').datepicker();

    $('#form_filter').find('input:checkbox').change(function () {

        var $select = $(this).parents('.checkbox').find('select');

        if ($(this).is(':checked'))
            $select.prop('disabled', false);
        else
            $select.prop('disabled', true);

    });

    $('#order_iframe').ready(function () {

        $('#order_iframe').load(function () {

            var content = $(this).contents();

            $(this).height(content.height());

        })
    });

    $('form').submit(function (event) {

        event.preventDefault();

        $.ajax({
            url: "/admin/backend/action_display_order.php",
            type: "post",
            data: $(this).serialize(),
            processData: false,

            beforeSend: function () {
                $.fancybox.showLoading();
            },

            success: function (data) {
                $('#order_iframe').contents().find('html').html(data);
            },

            complete: function () {
                $.fancybox.hideLoading();
            }
        });

    });

});

function update_szframe_order(new_height) {

    var $iframe = $('#order_iframe');

    if ($iframe.contents().height() < new_height) {
        $iframe.height(new_height);

    }

    window.parent.update_szframe_admin($iframe.contents().height);
}
