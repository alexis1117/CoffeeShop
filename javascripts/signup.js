/**
 * Created by Tuya on 1/30/2015.
 */

$(function () {

    var submitted = false;

    $('form').validate({

        rules: {
            usr_name: {
                required: true
            },
            usr_email: {
                required: true
            },
            usr_pass: {
                required: true,
                minlength: 8
            },
            confirm_pass: {
                required: true,
                minlength: 8,
                equalTo: "#usr_pass"
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

    $("#form_signup").submit(function (event) {

        event.preventDefault();

        if ($(this).valid()) {

            var new_usr = {};

            new_usr['usr_name'] = $.trim($(this).find('#usr_name').val());
            new_usr['usr_email'] = $.trim($(this).find('#usr_email').val());
            new_usr['usr_pass'] = $.trim($(this).find('#usr_pass').val());
            new_usr['usr_address'] = $.trim($(this).find('#usr_street').val()) + '_' + $.trim($(this).find('#usr_apt').val()) + '_' + $.trim($(this).find('#usr_zip').val());
            new_usr['usr_phone'] = $.trim($(this).find('#usr_phone').val());

            if ($(this).find('#email_list').is(':checked'))
                new_usr['email_list'] = 1;
            else
                new_usr['email_list'] = 0;


            $.ajax({
                url: "/backend/action_signup.php",
                type: "post",
                data: "new_usr=" + JSON.stringify(new_usr),
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                beforeSend: function () {
                    $.fancybox.showLoading();
                },

                success: function (msg) {

                    if (msg === "") {

                        window.parent.location.reload(true);
                    }
                    else {
                        if (msg === "ERROR_DUPLICATE") {

                            $('.alert-error').removeAttr("hidden");
                            $('.alert-error').find('ul').html("<li>Email address is already registered.</li>");
                        }
                        else {
                            $('.alert-error').removeAttr("hidden");
                            $('.alert-error').find('ul').html("<li>A problem has been occurred while submitting your data. Please check your data.</li>");
                        }

                        window.parent.update_szframe_main();
                    }
                },

                complete: function () {
                    $.fancybox.hideLoading();
                }
            });
        }
    });


});