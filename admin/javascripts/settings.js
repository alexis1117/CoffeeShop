/**
 * Created by Tuya on 1/24/2015.
 */

$(function () {

    $('#save').click(function (e) {

        e.preventDefault();

        var $rows = $('#table_other').find('tr:not(:first-child)');

        var $tds = $rows.find('td');

        var data = {};

        data['del_fee'] = parseFloat($tds.eq(0).text());
        data['tax'] = parseFloat($tds.eq(1).text());
        data['min_order'] = parseFloat($tds.eq(2).text());


        $.ajax({

            url: "/admin/backend/action_update_other.php",
            type: "post",
            data: "data=" + JSON.stringify(data),
            processData: false,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

            beforeSend: function () {

                $.fancybox.showLoading();
            },

            success: function (msg) {

                if (msg == "") {

                    window.parent.show_success_msg();
                }
                else {

                    window.parent.show_error_msg();
                }
            },

            complete: function () {

                $.fancybox.hideLoading();
            }
        });

    });

});