<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/29/2015
 * Time: 2:21 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Item.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php");

if (isset($_GET)) {

    $cat_id = $_GET['cat_id'];

    $obj_sz = new Size();
    $array_sz = $obj_sz->getAll_Array();

    $obj_item = new Item();
    $items = $obj_item->getByCatId($cat_id);

    $tds = "";

    $j = 0;

    while ($j < $items->num_rows) {

        $items->data_seek($j);
        $item = $items->fetch_assoc();

        $id = $item['id'];
        $title = $item['item_title'];
        $img = UPLOAD_DIR . explode(',', $item['item_img'])[0];
        $desc = $item['item_desc'];

        $result_sub_item = $obj_item->getByItemId($id);

        $array_sz_price = [];

        foreach ($result_sub_item as $sub_item) {

            $array_sz_price[$sub_item['sz_id']] = $sub_item['item_price'];
            $j++;
        }

        $size_table = "";

        foreach ($array_sz as $sz_id => $sz_title) {
            $size_table .= '<tr>
                            <td>
                                <label id="' . $sz_id . '">' . $sz_title . '</label>
                            </td>';

            if (array_key_exists($sz_id, $array_sz_price))

                $size_table .= '<td contenteditable="true">' . $array_sz_price[$sz_id] . '</td>';
            else

                $size_table .= '<td contenteditable="true"></td>';

            $size_table .= '</tr>';
        }


        $tds .= '
                    <tr>
                        <td>' . $id . '</td>
                        <td class="upload"><img src="' . $img . '" class="img_upload"></td>
                        <td contenteditable="true">' . $title . '</td>
                        <td class="size"><table class="tbl_size">' . $size_table . '</table></td>
                        <td contenteditable="true">' . $desc . '</td>
                        <td class="remove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </td>
                    </tr>';


    }
}
?>
<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/display_table.js"></script>
    <script type="text/javascript" src="/admin/javascripts/file_upload.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/stylesheets/display_table.css">

    <style>

        .add {
            float: right !important;
            padding: 10px !important;
            margin-bottom: 5px !important;
        }

    </style>

</head>
<body>
<div style="padding: 20px 5px; background-color: #ffffff">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/help_msg.php"); ?>

    <form>
        <div id="<?php echo $cat_id ?>" class="table-editable">
            <table class="table table-hover" id="table_item">
                <button class="btn btn-primary add">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>

                <thead>
                <tr style="background-color: #337AB7; color: white">
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Size | Price ($)</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                </thead>
                <?php echo $tds ?>
            </table>
            <button type="button" class="btn btn-primary save" style="float:right">
                <span class="glyphicon glyphicon-floppy-save"></span> Save Changes
            </button>
        </div>
    </form>
</div>
</body>
</html>