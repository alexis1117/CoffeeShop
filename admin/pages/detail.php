<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/26/2015
 * Time: 8:46 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Order.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Detail.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Extra.php");
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Item.php");


if (isset($_GET)) {

    $order_id = $_GET['order_id'];

    $obj_order = new Order();
    $obj_order->__createtByOrderId($order_id);

    $order_type = $obj_order->getOrderType();
    $order_status = $obj_order->getOrderStatus();
    $payment = $obj_order->getPaymentType();
    $usr_email = $obj_order->getUsrEmail();

    $obj_usr = new Usr();
    $obj_usr->__createBy($usr_email);

    $usr_name = $obj_usr->getUsrName();
    $usr_phone = $obj_usr->getUsrPhone();

    $usr_address = $obj_usr->getUsrAddress();

    $obj_detail = new Detail();
    $details = $obj_detail->getAllByOrderId($order_id);

    $obj_sz = new Size();
    $obj_extra = new Extra();

    $TRs = "";

    $count = 1;
    $total = 0;

    foreach ($details as $detail) {

        $item_id = $detail['item_id'];
        $sz_id = $detail['sz_id'];

        $obj_item = new Item();
        $obj_item->__createBy($item_id, $sz_id);

        $item_img = $obj_item->getImg();
        $item_title = $obj_item->getTitle();
        $item_price = $obj_item->getPrice();
        $sz_title = $obj_sz->getById($sz_id);


        $TRs .= '<tr>';
        $TRs .= "<td>" . ($count++) . "</td>";
        $TRs .= "<td><img src='" . $item_img . "'/></td>";
        $TRs .= "<td>" . $item_title . "</td>";
        $TRs .= "<td>" . $sz_title . "</td>";
        $TRs .= "<td> $" . $item_price . "</td>";

        $ext_id_array = explode(',', $detail['extra']);

        $extra = "";

        for ($j = 0; $j < count($ext_id_array) && intval($ext_id_array[$j]) > 0; $j++) {

            $extra .= $obj_extra->getTitleById($ext_id_array[$j]);

            if ($j != count($ext_id_array) - 1)
                $extra .= ', ';
        }

        $TRs .= "<td>$extra</td>";
        $TRs .= "<td>" . $detail['qty'] . "</td>";
        $TRs .= "<td> $" . $detail['subtotal'] . "</td>";
        $TRs .= '</tr>';

        $total += floatval($detail['subtotal']);
    }

}
?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <link type="text/css" rel="stylesheet" href="/admin/stylesheets/detail.css"/>

</head>
<body>
<div style="padding: 10px">
    <h4 class="text-primary">Order #:
        <small><?php echo $order_id ?></small>
    </h4>
    <div class="container_status text-primary">
        <label>Type:</label>
        <small> <?php echo $order_type ?></small>
        <label>Status:</label>
        <small> <?php echo $order_status ?></small>
        <label><span class="glyphicon glyphicon-credit-card"></span>Payment: </label>
        <small><?php echo $payment ?></small>
    </div>
    <div class="container_detail text-success">

        <div class="container_usr">
            <label><span class="glyphicon glyphicon-user"> </span> <?php echo $usr_name ?></label>
            <label><span class="glyphicon glyphicon-envelope"> </span> <?php echo $usr_email ?></label>
        </div>
        <div class="container_address">
            <label><span class="glyphicon glyphicon-phone-alt"> </span> <?php echo $usr_phone ?></label>
            <label><span class="glyphicon glyphicon-home"> </span> <?php echo $usr_address ?></label>
        </div>
    </div>
</div>
<div class="container_item">
    <table class="table">
        <thead class="bg-primary">
        <tr>
            <th>#</th>
            <th>Img</th>
            <th>Product</th>
            <th>Size</th>
            <th>Price</th>
            <th>Extra</th>
            <th>Qty</th>
            <th>subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $TRs ?>
        </tbody>
    </table>
    <label style="float: right; padding: 20px">Total: <span>$<?php echo $total ?></span></label>
</div>
</body>
</html>