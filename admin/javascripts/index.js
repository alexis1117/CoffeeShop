$(function () {

    $('.panel-heading a').click(function () {

        $('.panel-heading').find('span').each(function () {
            $(this).removeClass('glyphicon-triangle-bottom');
            $(this).addClass('glyphicon-play');
        });

        var $span = $(this).find('span');

        $span.removeClass('glyphicon-play');
        $span.addClass('glyphicon-triangle-bottom');

    });

    $('.nav-stacked li').click(function () {

        $('.section_heading label').text($(this).text());

    });

    $('#admin_iframe').ready(function () {

        $('#admin_iframe').load(function () {

            var content = $(this).contents();

            $(this).height(content.height());

            content.find('#add').click(function () {

                var $table = $(this).parents().find('table');

                var $clone = $table.find('tr.cloneable').clone(true).removeClass('cloneable').removeAttr('hidden');

                $clone.find('.glyphicon-remove').click(function () {

                    $('#admin_iframe')[0].contentWindow.remove_item($(this));
                });

                $clone.find('.img_upload').click(function () {

                    var id = $clone.find('td').eq(0).text();
                    var tbl_name = $clone.parents('table').attr('id');
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

                                        alert(default_img);
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

                var last_id = 0;

                if ($table.find('tr').length > 2)
                    last_id = parseInt($table.find('tr:last').find('td').eq(0).text());


                $clone.find('td').eq(0).text(last_id + 1);
                $table.append($clone);

                $('#admin_iframe').height(content.height());

            });
        });
    });

});


function update_szframe_admin(new_height) {

    var $iframe = $('#admin_iframe');

    if (new_height > $iframe.contents().height()) {

        $iframe.height(new_height);
    }

    else {
        $iframe.height($iframe.contents().height());
    }
}

function update_norder(n_order) {

    var array = $.parseJSON(n_order);

    $('.n_neworder').text(array['n_neworder']);
    $('.n_pastorder').text(array['n_pastorder']);
}

function show_success_msg() {

    var $iframe = $('#admin_iframe');

    if (typeof $iframe.contents().find('.alert-success').attr("hidden") !== 'undefined') {

        $iframe.contents().find('.alert-success').removeAttr("hidden");
        $iframe.height($iframe.contents().height() + 100);
    }
    if (typeof $iframe.contents().find('.alert-error').attr("hidden") === 'undefined') {

        $iframe.contents().find('.alert-error').attr("hidden", "hidden");
        $iframe.height($iframe.contents().height() - 100);
    }
}

function show_error_msg() {

    var $iframe = $('iframe');

    if (typeof $iframe.contents().find('.alert-error').attr("hidden") !== 'undefined') {

        $iframe.contents().find('.alert-error').removeAttr("hidden");
        $iframe.height($iframe.contents().height() + 100);
    }

    if (typeof $iframe.contents().find('.alert-success').attr("hidden") === 'undefined') {

        $iframe.contents().find('.alert-success').attr("hidden", "hidden");
        $iframe.height($iframe.contents().height() - 100);
    }
}