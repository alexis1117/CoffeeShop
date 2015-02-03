/**
 * Created by Tuya on 1/31/2015.
 */

$(function () {

    var submitted = false;

    $('form').validate({
        rules: {
            old_pass: {
                required: true,
                minlength: 8
            },
            new_pass: {
                required: true,
                minlength: 8
            },
            confirm_pass: {
                required: true,
                minlength: 8,
                equalTo: '#new_pass'
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

                $('.hidden_div').attr("hidden", "hidden");

                window.parent.update_szframe_fancy();

                submitted = false;
            }
        },
        invalidHandler: function (form, validator) {

            submitted = true;
            $('.alert-error').attr("hidden", "hidden");
        }
    });

    $('#form_pwd').submit(function (event) {

        event.preventDefault();


        if ($(this).valid()) {

            var old_pass = $.trim($('#old_pass').val());
            var new_pass = $.trim($('#new_pass').val());

            $.ajax({

                url: "/backend/action_update_pass.php",
                type: "post",
                data: "old_pass=" + old_pass + "&new_pass=" + new_pass,
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                beforeSend: function () {
                    $.fancybox.showLoading();
                },

                success: function (msg) {

                    if (msg === "ERROR_CREDENTIAL") {

                        $('.hidden_div').attr("hidden", "hidden");
                        $('.alert-success').attr("hidden", "hidden");

                        var $alert_error = $('.alert-error');
                        $alert_error.removeAttr("hidden");
                        $alert_error.find('ul').html("<li>Please check if your password is correct. Please note that passwords are case sensitive.</li>");

                        window.parent.update_szframe_fancy();
                    }
                    else {

                        $('.alert-error').attr("hidden", "hidden");
                        $('.hidden_div').attr("hidden", "hidden");

                        $('.alert-success').removeAttr("hidden");

                        window.parent.update_szframe_fancy();
                    }

                    $('form')[0].reset();
                },

                complete: function () {
                    $.fancybox.hideLoading();
                }
            });
        }
    });

});