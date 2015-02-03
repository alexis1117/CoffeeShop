/**
 * Created by Tuya on 1/28/2015.
 */

$(function () {

    $(('.img_upload')).click(function () {

        var id = $(this).parents('tr').find('td').eq(0).text();
        var tbl_name = $(this).parents('table').attr('id');
        var $img = $(this);

        var dir = "";
        var temp_array = $(this).attr('src').split('/');

        for (var i = 0; i < temp_array.length - 1; i++) {
            dir += temp_array[i] + '/';
        }

        $.fancybox({

            'href': '/admin/pages/file_upload.php',
            'scrolling': 'no',
            'titleShow': false,
            'titlePosition': 'none',
            'closeClick': false,
            'openSpeed': 'fast',
            'type': 'iframe',
            'padding': 0,
            'preload': true,
            'autoSize': false,
            'width': '400',
            'height': '200',
            'helpers': {
                overlay: {
                    'closeClick': false
                }
            },
            beforeClose: function () {

                var $iframe = $('.fancybox-iframe');

                var $lis = $iframe.contents().find('ul').find('li');

                if ($lis.length > 0) {

                    var images = "";
                    var default_img = dir + $iframe.contents().find('li').eq(0).text();

                    $lis.each(function () {
                        images += $(this).text() + ",";
                    });

                    var URL = "";
                    if (tbl_name === "table_cat")
                        URL = "/admin/backend/action_update_cat_img.php";

                    if (tbl_name === "table_item")
                        URL = "/admin/backend/action_update_item_img.php";

                    $.ajax({

                        url: URL,
                        type: "post",
                        data: "id=" + id + "&images=" + images,
                        processData: false,
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',

                        beforeSend: function () {

                            $.fancybox.showLoading();
                        },

                        success: function () {

                            $img.attr('src', default_img);
                        },

                        complete: function () {

                            $.fancybox.hideLoading();
                        }
                    });
                }
            }
        });

    });

    $('#fileupload').fileupload({
        add: function (e, data) {
            data.submit();
        },
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {

                var li = "<li>" + file.name + " <span class='glyphicon glyphicon-remove'></span></li>";
                $('ul').append(li);


                $('.glyphicon-remove').click(function () {

                    $(this).parent().detach();
                });
            });

        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.bar').css(
                'width',
                progress + '%'
            );
        }
    });
});