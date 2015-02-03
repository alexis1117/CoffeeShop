/**
 * Created by Tuya on 1/30/2015.
 */
$(function () {

    var submitted = false;

    $('form').validate({
        rules: {
            usr_name: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            usr_street: {
                required: true
            },
            usr_apt: {
                required: true
            },
            usr_zip: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 5
            },
            usr_phone: {
                required: true,
                phoneUS: true
            }
        },
        showErrors: function (errorMap, errorList) {

            if (submitted) {

                var summary = "";

                $.each(errorMap, function (key, value) {

                    var name = $('#' + key).parent().find('span').text();
                    summary += "<li><span style='font-size: 12px'>" + "<strong>" + name + "</strong>" + ' ' + value + "</span></li>";
                });

                $('.alert-success').attr("hidden", "hidden");

                var $alert_error = $('.alert-error');
                $alert_error.find('ul').html(summary);
                $alert_error.removeAttr("hidden");

                window.parent.update_szframe_main();

                submitted = false;
            }
        },
        invalidHandler: function (form, validator) {

            submitted = true;
            $('.alert-error').attr("hidden", "hidden");
        }

    });

    $('#form_settings').submit(function (event) {

        event.preventDefault();

        if ($(this).valid()) {

            var data = {};
            data['usr_email'] = $.trim($('#usr_email').val());
            data['usr_name'] = $.trim($('#usr_name').val());
            data['usr_phone'] = $.trim($('#usr_phone').val());
            data['usr_address'] = $.trim($('#usr_street').val()) + "_" +
            $.trim($('#usr_apt').val()) + "_" +
            $.trim($('#usr_zip').val());

            if ($('#email_list').is(':checked'))
                data['email_list'] = 1;
            else
                data['email_list'] = 0;

            $.ajax({

                url: "/backend/action_update_usr.php",
                type: "post",
                data: "data=" + JSON.stringify(data),
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                beforeSend: function () {
                    $.fancybox.showLoading();
                },

                success: function (msg) {

                    if (msg == "") {

                        $('.alert-error').attr("hidden", "hidden");
                        $('.alert-success').removeAttr("hidden");

                        window.parent.update_szframe_main();
                    }
                },

                complete: function () {
                    $.fancybox.hideLoading();
                }
            });
        }
    });

    $('a').click(function (event) {

        event.preventDefault();

        $.fancybox({

            'href': '/pages/password.php',
            'scrolling': 'no',
            'closeClick': false,
            'openSpeed': 'fast',
            'type': 'iframe',
            'padding': 0,
            'preload': true,
            'autoDimensions': true,
            'fitToView': false,
            'autoSize': false,
            'maxWidth': 400,
            'height': 400,
            'helpers': {
                overlay: {
                    'closeClick': false
                }
            },

            beforeClose: function () {

            }
        });

    });
});

function update_szframe_fancy() {

    var $iframe = $('.fancybox-iframe');
    $iframe.height($iframe.contents().height());
}