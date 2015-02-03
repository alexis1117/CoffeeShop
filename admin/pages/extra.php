<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 11:26 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Extra.php");

$tr_extra = "";

$obj_extra = new Extra();
$extras = $obj_extra->getAll();

foreach ($extras as $extra) {

    $tr_extra .= '
                    <tr>
                        <td>' . $extra['id'] . '</td>
                        <td contenteditable="true">' . $extra['ext_title'] . '</td>
                        <td contenteditable="true">' . $extra['ext_price'] . '</td>
                        <td class="remove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </td>
                    </tr>';
}
?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/extra.js"></script>

    <style>

        body {
            background-color: lightgoldenrodyellow !important;
        }

        table {
            font-size: 12px;
            background-color: #ffffff;
        }

        th, tr > td:nth-child(1), tr > td:nth-child(3), tr > td:nth-child(4) {
            width: 15%;
            text-align: center;
        }

        tr > td:nth-child(2) {
            text-align: left;
            padding-left: 20px;
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

    <table class="table table-hover" id="table_extra">
        <thead>
        <tr style="background-color: #337ab7; color: #ffffff">
            <th>#</th>
            <th>Extra Item</th>
            <th>Price ($)</th>
            <th></th>
        </tr>
        </thead>

        <!-- This is our clonable table line -->
        <tr class="cloneable" hidden="hidden">
            <td></td>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td>
                <span class="glyphicon glyphicon-remove"></span>
            </td>
        </tr>
        <?php echo $tr_extra ?>
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

