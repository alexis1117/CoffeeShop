/**
 * Created by Tuya on 1/30/2015.
 */

$(function () {

    var submitted = false;

    $('form').validate({

        rules: {
            usr_email: {
                required: true,
                email: true
            },
            usr_pass: {
                required: true,
                minlength: 8
            }

        },
        showErrors: function (errorMap, errorList) {

            if (submitted) {

                var summary = "";

                $.each(errorMap, function (key, value) {

                    var name = $('#' + key).parent().find('span').text();
                    summary += "<li><span style='font-size: 12px'>" + "<strong>" + name + "</strong>" + ' ' + value + "</span></li>";
                });

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

    $('#form_signin').submit(function (event) {

        event.preventDefault();

        if ($(this).valid()) {

            var usr_email = $.trim($('#usr_email').val());
            var usr_pass = $.trim($('#usr_pass').val());

            $.ajax({

                url: "/backend/action_signin.php",
                type: "post",
                data: "usr_email=" + usr_email + "&usr_pass=" + usr_pass,
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                beforeSend: function () {
                    $.fancybox.showLoading();
                },

                success: function (msg) {

                    if (msg === "") {

                        $('#form_signin')[0].reset();
                        window.parent.show_link_account();
                    }
                    else {

                        var $alert_error = $('.alert-error');
                        $alert_error.removeAttr("hidden");

                        if (msg === "ERROR_BLOCK")
                            $alert_error.find('ul').html("<li>Login blocked after 5 failed login attempts.</li>");

                        if (msg === "ERROR_CREDENTIAL")
                            $alert_error.find('ul').html("<li>Please check your email address and password are correct and submit your details again.</li>" +
                            "<li>Please note that passwords are case sensitive.</li>");

                        window.parent.update_szframe_main();
                    }
                },
                error: function () {
                    alert("error");
                },

                complete: function () {
                    $.fancybox.hideLoading();
                }
            });
        }
    });

});