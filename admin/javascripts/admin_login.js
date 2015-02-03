/**
 * Created by Tuya on 1/23/2015.
 */

$(function () {

    $('form[name=admin_form]').validate({
        Rules: {
            admin_id: {
                required: true
            },
            admin_pass: {
                required: true
            }
        }
    });

    $('form[name=admin_form]').submit(function (event) {
        event.preventDefault();

        if ($(this).valid()) {

            var admin_id = $.trim($(this).find('#admin_id').val());
            var admin_pass = $.trim($(this).find('#admin_pass').val());


            $.ajax({
                url: "/admin/backend/action_admin_login.php",
                type: "post",
                data: "admin_id=" + admin_id + "&admin_pass=" + admin_pass,
                processData: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (data) {

                    $('form[name=admin_form]')[0].reset();

                    if (data == "") {
                        window.location.replace("/admin/index.php");
                    }
                    else if (data === "ERROR_BLOCK") {
                        $('.alert').removeAttr("hidden").find('small')
                            .text("Login blocked after 3 failed login attempts. Please contact the system administrator.");
                    }
                    else if (data === "ERROR_CREDENTIAL") {
                        $('.alert').removeAttr("hidden").find('small')
                            .text("Please check the login credentials and submit your details again. Please note that password is case   sensitive.");
                    }
                    else {
                        alert(data);
                    }
                },
                error: function (error) {
                    alert(error);
                }
            });
        }


    });
});