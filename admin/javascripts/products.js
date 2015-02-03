/**
 * Created by Tuya on 1/24/2015.
 */
$(function () {

    $(window).load(function () {

        $('.nav-tabs li:first-child').addClass('active');


        window.parent.update_szframe_admin($('#tbl_frame').contents().height());

    });

    $('#tbl_iframe').load(function () {

        $.fancybox.hideLoading();

        $(this).height($(this).contents().height());

        window.parent.update_szframe_admin($(this).contents().height());
    });


    $('.nav-tabs li').click(function (event) {

        event.preventDefault();

        $.fancybox.showLoading();

        var $lis = $('.nav-tabs').find('li');

        $lis.each(function () {
            $(this).removeClass('active');
        });

        $(this).addClass('active');

        var cat_id = $(this).find('a').attr('data-cat_id');

        var $iframe = $('#tbl_iframe');
        $iframe.attr('src', "/admin/backend/action_display_table.php?cat_id=" + cat_id);

        $iframe.contents().find('.alert-success').attr("hidden", "hidden");
        $iframe.contents().find('.alert-error').attr("hidden", "hidden");
    });

});


function show_success_msg_tbl() {

    var $iframe = $('#tbl_iframe');

    if (typeof $iframe.contents().find('.alert-success').attr("hidden") !== 'undefined') {

        $iframe.contents().find('.alert-success').removeAttr("hidden");
        $iframe.height($iframe.contents().height() + 100);

        window.parent.update_szframe_admin($iframe.contents().height);

    }
    if (typeof $iframe.contents().find('.alert-error').attr("hidden") === 'undefined') {

        $iframe.contents().find('.alert-error').attr("hidden", "hidden");
        $iframe.height($iframe.contents().height() - 100);

        window.parent.update_szframe_admin($iframe.contents().height);

    }
}

function show_error_msg_tbl() {

    var $iframe = $('#tbl_iframe');

    if (typeof $iframe.contents().find('.alert-error').attr("hidden") !== 'undefined') {

        $iframe.contents().find('.alert-error').removeAttr("hidden");
        $iframe.height($iframe.contents().height() + 100);

        window.parent.update_szframe_admin($iframe.contents().height());
    }

    if (typeof $iframe.contents().find('.alert-success').attr("hidden") === 'undefined') {

        $iframe.contents().find('.alert-success').attr("hidden", "hidden");
        $iframe.height($iframe.contents().height() - 100);

        window.parent.update_szframe_admin($iframe.contents().height());
    }
}
function update_szframe_table(new_height) {

    var $iframe = $('#tbl_iframe');

    if ($iframe.contents().height() < new_height) {
        $iframe.height(new_height);

    }
    window.parent.update_szframe_admin($iframe.contents().height());
}