/**
 * Created by Tuya on 1/26/2015.
 */
$(function () {

    var submitted = false;

    $('form').validate({
        rules: {
            old_pass: {
                required: true,
                minlength: 10
            },
            new_pass: {
                required: true,
                minlength: 10
            },
            confirm_pass: {
                required: true,
                minlength: 10,
                equalTo: "#new_pass"
            }
        },

        showErrors: function (errorMap, errorList) {
            if (submitted) {
                var summary = "";

                $.each(errorMap, function (key, value) {

                    var name = $('#' + key).parent().find('label').text();
                    summary += "<li><span style='font-size: 12px'><strong>" + name + ': ' + "</strong>" + value + "</span></li>";
                });

                $('.alert-success').attr("hidden", "hidden");

                var $alert_error = $('.alert-error');

                $alert_error.find('ul').html(summary);
                $alert_error.removeAttr("hidden");

                window.parent.update_szframe_admin(200);

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

            $.ajax({

                url: "/admin/backend/action_update_admin.php",
                type: "POST",
                data: $(this).serialize(),
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (data) {

                    if (data === "ERROR_CREDENTIAL") {

                        $('.alert-success').attr("hidden", "hidden");

                        var $alert_error = $('.alert-error');

                        $alert_error.removeAttr("hidden");
                        $alert_error.find('ul').html("<li>Please check if your password is correct. Please note that passwords are case sensitive.</li>");

                        window.parent.update_szframe_admin(200);

                    }
                    else {

                        $('.alert-error').attr("hidden", "hidden");
                        $('.alert-success').removeAttr("hidden");

                        window.parent.update_szframe_admin(200);

                    }
                    $('form')[0].reset();
                },
                error: function () {
                    alert("error");
                }
            });
        }

    });
});