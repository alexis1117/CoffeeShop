<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/24/2014
 * Time: 2:04 AM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php");

$tr_cat = "";

$obj_cat = new Category();
$cats = $obj_cat->getAll();

foreach ($cats as $cat) {

    $tr_cat .= '
                    <tr>
                        <td>' . $cat['id'] . '</td>
                        <td><img src="' . UPLOAD_DIR . $cat['cat_img'] . '" class="img_upload"></td>
                        <td contenteditable="true" class="cat_title">' . $cat['cat_title'] . '</td>
                        <td class="remove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </td>
                    </tr>';

}
?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/categories.js"></script>
    <script type="text/javascript" src="/admin/javascripts/file_upload.js"></script>

    <style>

        body {
            background-color: lightgoldenrodyellow !important;
        }

        th, tr > td:nth-child(1), tr > td:nth-child(4) {
            width: 10%;
            text-align: center;
        }

        tr > td:nth-child(3) {
            text-align: left;
            padding-left: 20px;
        }

        .img_upload {
            width: 100px;
            height: 40px;
        }

        table {
            background-color: #ffffff;
            font-size: 12px;
        }

        .glyphicon-remove {
            color: darkred;
            cursor: pointer;
        }

        .glyphicon-remove:hover {
            color: #ff0000;
        }

    </style>
</head>
<body>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/help_msg.php"); ?>

<div>
    <p></p>
    <table class="table table-hover" id="table_cat">
        <thead>
        <tr style="background-color: #337ab7; color: #ffffff">
            <th>#</th>
            <th>Image</th>
            <th>Category</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <!-- This is our clonable table line -->
        <tr class="cloneable" hidden="hidden">
            <td></td>
            <td class="upload"><img src="/images/add-img-icon.png" class="img_upload"></td>
            <td contenteditable="true" class="cat_title"></td>
            <td>
                <span class="glyphicon glyphicon-remove"></span>
            </td>
        </tr>
        <?php echo $tr_cat ?>
        </tbody>
    </table>
    <button id="add" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> Add New
    </button>
    <button id="save" class="btn btn-primary" style="float: right">
        <span class="glyphicon glyphicon-floppy-save"></span> Save Changes
    </button>
</div>
</body>
</html>
