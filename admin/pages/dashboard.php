<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 9:34 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Order.php");


$obj_order = new Order();
$total_orders = $obj_order->getAll()->num_rows;

$obj_usr = new Usr();
$total_users = $obj_usr->getAll()->num_rows;

?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>

    <style>

        .bs-example {
            padding: 20px;
            text-align: center;

        }

        body {
            background-color: lightgoldenrodyellow !important;
            display: flex;
            flex: 3;
            flex-direction: row;
        }

    </style>
</head>
<body>

<div class="row" style="width: 100%">
    <div class="col-sm-4">
        <div class="bs-example">
            <div class="alert alert-warning">
                <strong><span class=" glyphicon glyphicon-cutlery"></span> Total Orders</strong>

                <p><?php echo $total_orders ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="bs-example">
            <div class="alert alert-warning">
                <strong><span class="glyphicon glyphicon-user"></span> Total Customers</strong>

                <p><?php echo $total_users ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="bs-example">
            <div class="alert alert-warning">
                <strong><span class="glyphicon glyphicon-comment"></span> Total Enquiries</strong>

                <p>12</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>