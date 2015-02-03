/**
 * Created by Tuya on 1/30/2015.
 */
$(function () {

    $('.div_link').click(function () {

        var order_id = $(this).find('#order_id').attr('data-order_id');
        var type = $(this).find('#order_id').attr('data-type');
        $('#account').find('#order_title').text(type + ": #" + order_id);

        $('.div_clicked').each(function () {
            $(this).attr({
                'hidden': 'hidden'
            });
        });

        $(this).parent().find('.div_clicked').removeAttr('hidden');

        var $order_items = $('.order_items');

        $order_items.each(function () {

            if ($(this).attr('data-order_id') == order_id) {

                $(".current").remove();

                var $clone = $(this).clone(true).removeAttr("hidden").addClass("current");
                $('#account').find('#section_body').append($clone);
                window.parent.calc_total_2($clone);
            }
        });
    });


});