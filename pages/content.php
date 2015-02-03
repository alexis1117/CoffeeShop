<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/24/2014
 * Time: 8:04 AM
 */
$cat_id = "";
$ROWs = "";
$checklist = "";

include_once $_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php";
include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Extra.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Item.php");


if (isset($_GET['categoryID'])) {

    $cat_id = $_GET['categoryID'];

    $obj_extra = new Extra();
    $result_ext = $obj_extra->getAll();

    $checklist = '<table id="table_checklist" hidden="hidden">';

    $l = 0;
    while ($l < $result_ext->num_rows) {

        $checklist .= '<tr>';

        for ($m = 0; $m < 3 && $l < $result_ext->num_rows; $m++) {

            $result_ext->data_seek($l);
            $extra = $result_ext->fetch_assoc();

            $checklist .= '<td>';
            $checklist .= '<div class="ext_price" hidden="hidden"><span>$' . $extra['ext_price'] . '</span></div>';
            $checklist .= '<span class="checklist">';
            $checklist .= '<input type="checkbox" id="' . $extra['id'] . '" name="extra_list[]" value="' . $extra['ext_title'] . '"/>';
            $checklist .= $extra['ext_title'] . '</span>';
            $checklist .= '</td>';

            $l++;
        }

        $checklist .= '</tr>';
    }

    $checklist .= '</table >';

    $obj_sz = new Size();
    $array_sz = $obj_sz->getAll_Array();

    $obj_item = new Item();
    $items = $obj_item->getByCatId($cat_id);

    $i = 0;

    while ($i < $items->num_rows) {

        $COLs = "";

        for ($j = 0; $j < 4; $j++) {

            if ($i < $items->num_rows) {

                $items->data_seek($i);
                $item = $items->fetch_assoc();

                $id = $item['id'];
                $def_sz_id = $item['sz_id'];
                $def_price = $item['item_price'];
                $img = UPLOAD_DIR . explode(',', $item['item_img'])[0];

                $result_sub_item = $obj_item->getByItemId($id);

                $sz_drop = '<select id="item_size" hidden="hidden">';
                $sz_drop .= '<option selected="selected" disabled="disabled" id="-1">Select Size</option>';

                for ($k = 0; $k < $result_sub_item->num_rows; $k++) {

                    $result_sub_item->data_seek($k);
                    $sub_item = $result_sub_item->fetch_assoc();

                    $sz_id = $sub_item['sz_id'];
                    $sz_title = $array_sz[$sz_id];
                    $price = $sub_item['item_price'];

                    $sz_drop .= "<option id=$sz_id value=$price>$sz_title</option>";

                    $i++;
                }
                $sz_drop .= '</select>';

                $COLs .= '<div class="col">
                        <div class="image-wrapper">
                            <img id="item_img" src="' . $img . '" data-item_id="' . $id . '"/>
                            <button class="btn_detail" data-sz_id="' . $def_sz_id . '" data-def_price="' . $def_price . '">view</button>
                        </div>
                        <div class="title-wrapper">
                            <p id="item_title">' . $item['item_title'] . '</p>
                            <label id="item_desc" hidden="hidden">' . $item['item_desc'] . '</label>' . $sz_drop . '
                        </div>
                    </div>';

            } else {
                $COLs .= '<div class="col"></div>';
            }

        }

        $ROWs .= '<div class="container_row">' . $COLs . '</div>';

    }
}

?>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="/stylesheets/content.css">

    <style>
        .container_row {
            display: flex;
            flex: 1;
            flex-direction: row;
            padding: 20px;
        }

        .col {
            flex: 3;
        }

        .title-wrapper {
            display: flex;
            flex: 1;
            justify-content: center;
            height: 50px;
        }

        div p {
            font-family: MS, serif;
            color: #5F310F;
            font-size: 15px;
            font-weight: bold;
        }

        .image-wrapper img {
            display: flex;
            flex: 1;

            max-width: 120px;
            max-height: 150px;
            border: 1px solid #5F310F;

            border-radius: 20px;
            box-shadow: 0px 0px 20px 5px rgba(95, 49, 15, 0.94);

        }

        .image-wrapper {
            position: relative;
            display: flex;
            flex: 1;
            justify-content: center;
            height: 150px;

        }

        .btn_detail {
            position: absolute;
            left: 35%;
            top: 93%;

            width: 50px;

            border-radius: 5px;

            background-color: #5F310F;
            border: 1px solid #5F310F;

            color: #C6A76D;

            cursor: pointer;
        }

        :focus {
            outline: none !important;
        }

    </style>
</head>
<body>

<?php echo $ROWs ?>

<?php echo $checklist ?>

</body>
</html>