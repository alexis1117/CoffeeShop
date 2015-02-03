<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 11:26 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Settings.php");

$obj_settings = new Settings();
$obj_settings->__create();

$del_fee = $obj_settings->getDelFee();
$tax = $obj_settings->getTax();
$min_order = $obj_settings->getMinOrder();

?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/admin/javascripts/settings.js"></script>

    <style>

        body {
            background-color: lightgoldenrodyellow !important;
        }

        table {
            background-color: #ffffff;
            font-size: 12px;
        }

        th, tr > td {
            text-align: center;
        }

    </style>
</head>
<body>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/help_msg.php"); ?>

<div class>

    <table class="table table-hover" id="table_other">
        <tr style="background-color: #337ab7; color: #ffffff">
            <th>Delivery Fee($)</th>
            <th>Tax(%)</th>
            <th>Free Delivery if (order($) >)</th>
        </tr>
        <tr>
            <td contenteditable='true'><?php echo $del_fee; ?></td>
            <td contenteditable='true'><?php echo $tax; ?></td>
            <td contenteditable='true'><?php echo $min_order; ?></td>
        </tr>
    </table>

    <button type="button" id="save" class="btn btn-primary" style="float: right">
        <span class="glyphicon glyphicon-floppy-save"></span> Save Changes
    </button>

</div>

</body>
</html>

