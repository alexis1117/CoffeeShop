<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 11:26 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php");

$tr_size = "";

$obj_sz = new Size();

$sizes = $obj_sz->getAll();

foreach ($sizes as $size) {

    $tr_size .= '
                    <tr>
                        <td>' . $size['id'] . ' </td>
                        <td contenteditable="true">' . $size['sz_title'] . '</td>
                        <td class="remove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </td>
                    </tr>';
}
?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/size.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/stylesheets/size.css">

</head>
<body>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/help_msg.php"); ?>

<div>

    <table class="table table-hover" id="table_size">
        <thead>
        <tr style="background-color: #337ab7; color: #ffffff">
            <th>#</th>
            <th>Size</th>
            <th></th>
        </tr>
        </thead>
        <!-- This is our clonable table line -->
        <tr class="cloneable" hidden="hidden">
            <td></td>
            <td contenteditable="true"></td>
            <td>
                <span class="glyphicon glyphicon-remove"></span>
            </td>
        </tr>
        <?php echo $tr_size ?>
    </table>

    <button id="add" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> Add New
    </button>
    <button type="button" id="save" class="btn btn-primary" style="float: right">
        <span class="glyphicon glyphicon-floppy-save"></span> Save Changes
    </button>

</div>

</body>
</html>

