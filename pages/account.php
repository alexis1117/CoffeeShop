<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/3/2014
 * Time: 9:20 PM
 */
include $_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php";
include $_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Order.php";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Item.php";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Extra.php";
include $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Other.php";

$other = new Other();
$other->__create();

$cur_usr = new Usr();
$usr_email = $cur_usr->getUsrEmail();

$order = new Order($usr_email);
$array_orders = $order->getOrder();

$n_order = count($array_orders);

$div_orders = "<div id ='aside_body'>";

$order_items = "<div id='section_body'>";

$array_orders = array_reverse($array_orders, true);


foreach ($array_orders as $order_id => $order) {

    date_default_timezone_set('America/Los_Angeles');
    $time = strtotime($order[0]['order_date']);
    $date = date("M d, y g:i a", $time);

    $type = $order[0]['order_type'];
    $order_icon = "";

    if ($type == "Delivery")
        $order_icon = "../images/delivery_icon.png";

    else
        $order_icon = "../images/pickup_icon.png";


    $div_orders .= "
                    <div id='order_link'>
                        <div class='div_clicked' hidden='hidden'></div>
                        <div class='div_link'>
                            <img src=$order_icon style='width: 20px; height: 20px'>
                            <label id='order_id' data-type=" . $type . " data-order_id=" . $order_id . " style='font-weight: bold'>Order: #" . $order_id . "</label>
                            <label>Date: " . $date . "</label>
                            <button id='btn_reorder'>Re-Order</button>
                        </div>
                    </div>";

    $order_items .= "<table class='table order_items' data-order_id='$order_id' hidden='hidden'>
                        <thead>
                        <tr >
                            <th > Item Name </th >
                            <th > Size</th >
                            <th > Unit Price </th >
                            <th > Qty</th >
                        </tr >
                        </thead>";

    foreach ($order as $item) {

        $id = $item['item_id'];
        $sz_id = $item['sz_id'];
        $qty = $item['qty'];
        $array_extra_id = $item['extra'];
        $type = $item['order_type'];
        $subtotal = $item['subtotal'];

        $obj_item = new Item();
        $obj_item->__createBy($id, $sz_id);

        $title = $obj_item->getTitle();
        $sz_title = $obj_item->getSizeTitle();
        $img = $obj_item->getImg();
        $price = $obj_item->getPrice();

        $div_extra = "<div id='div_extra'>";


        if ($array_extra_id[0] != "")

            foreach ($array_extra_id as $extra_id) {


                $obj_extra = new Extra();
                $obj_extra->__createBy($extra_id);

                $ext_title = $obj_extra->getTitle();
                $ext_price = $obj_extra->getPrice();

                $div_extra .= "<label>" . $ext_title . ": $" . $ext_price . "</label>";
            }

        $div_extra .= '</div>';


        $order_items .= "<tr>
                            <td>
                                <img src='$img' width='50px' height='50px'/>
                                <label id='title'>$title</label>
                                <label class='subtotal' hidden='hidden'>$subtotal</label>
                                $div_extra
                            </td>
                            <td>$sz_title</td>
                            <td>$$price</td>
                            <td>$qty</td>
                        </tr>";
    }

    $order_items .= "</table>";
}
$order_items .= "</div>";
$div_orders .= "</div>";

?>
<html>
<head>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
<script type="text/javascript" src="/javascripts/account.js"></script>

<style>

body {
    background-color: #C6A76D;
}

div#the_body {
    width: 100%;
    display: flex;
    flex: 1;

    padding: 20px;
}

#account {
    display: flex;
    flex: 1;
    flex-direction: column;

    margin: 5px;
    padding: 30px;

    border: 1px solid #ffffff;

    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
}

#header {
    display: flex;
    flex: 1;
    flex-direction: row;
    white-space: nowrap;

    border-bottom: 1px solid black;

    margin: 20px;
    padding-bottom: 20px;
}

#logo {
    flex: 3;
}

#logo img {
    float: left;
    width: 50px;
    height: 50px;
}

#logo label {
    float: left;
    margin-top: 30px;
    font-weight: bold;
    font-family: Trebuchet, serif;
    white-space: nowrap;
    color: #000000;
}

#side_menu {
    flex: 1;
}

#side_menu a {
    padding-left: 10px;
    font-family: Arial, serif;
    font-size: 12px;
    font-weight: bold;
}

a {
    /*
        color: black;
    */
    white-space: nowrap;
}

#side_menu a:hover {
    /*color: #ffffff;*/
}

#body {
    display: flex;
    flex: 1;
}

aside {
    display: flex;
    flex: 1;
    flex-direction: column;
    padding: 10px;

}

section {
    flex: 2;
    padding: 10px;
    flex-direction: column;
}

#aside_header, #section_header {
    background-color: #CAB286;
    text-align: center;

    font-family: Trebuchet, serif;
    font-size: 13px;
    font-weight: bold;

    padding: 5px;
    margin-bottom: 5px;

    border-top: 1px solid #5F310F;
    border-bottom: 1px solid #5F310F;
}

#aside_body, #section_body {
    font-family: Arial, serif;
    font-size: 12px;
}

#order_link {
    display: flex;
    flex: 1;
    flex-direction: row;
    background-color: #CAB286;
    float: left;

    margin-bottom: 5px;

    border-top: 1px solid #ffffff;
    border-bottom: 1px solid #ffffff;
}

#order_link label {
    float: left;
    margin: 5px;
    height: 20px;

}

#order_link:hover {
    background-color: #d3d3d3;
    cursor: pointer;

}

#order_link button {
    background-color: #5F310F;
    float: right;
    font-size: 12px;
    color: #C6A76D;

    padding: 5px;

    border: 1px solid #ffffff;

    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;

    cursor: pointer;

}

#order_link label:hover {
    cursor: pointer;
}

.div_clicked {
    flex: 1;
    background-color: #5F310F;
}

.div_link {
    flex: 15;
    padding: 10px;
    margin-right: 5px;
}

#div_extra {
    display: flex;
    flex: 1;
    float: right;
    flex-direction: column;
    font-size: 10px;
    color: #5F310F;

}

table {
    background-color: #CAB286;
    font-family: Tahoma, serif;
    font-size: 12px;
}

table th, table td {
    border-color: #5f310f !important;
}

#title {
    float: left;
    font-weight: bold;
    margin-left: 10px;
}

img {
    float: left;
}

#calc {
    width: 50%;
    background-color: #CAB286;
    float: right;

    font: 12px Arial;
    font-weight: 400;

    margin-bottom: 10px;

    border-top: 1px solid #5F310F;
    border-bottom: 1px solid #5F310F;
}

#calc tr td {
    padding: 5px;
}

#calc tr td:nth-child(odd) {
    text-align: right;
}

#calc tr td:nth-child(even) {
    text-align: right;
}

</style>

</head>
<body>
<div id="the_body">
    <div id="account">
        <div id="header">
            <div id="logo">
                <img src="../images/user_account.png"/>
                <label id="name"
                       data-usr_email="<?php echo $cur_usr->getUsrEmail() ?>">Welcome, <?php echo $cur_usr->getUsrName() ?></label>
            </div>
            <div id="side_menu">
                <a href="/pages/account.php" target="_self">Past Orders</a>
                <a href="/pages/settings.php" target="_self">Settings</a>
            </div>

        </div>
        <div id="body">

            <aside>
                <div id="aside_header">
                    <label><?php echo $n_order ?> Past Orders</label>
                </div>
                <?php echo $div_orders ?>
            </aside>
            <section>
                <div id="section_header">
                    <label id="order_title">Order: #</label>
                </div>
                <?php echo $order_items ?>
                <div id="div_calc" hidden="hidden">
                    <table id="calc">
                        <tr>
                            <td><label>Subtotal:</label></td>
                            <td><label id="subtotal"></label></td>
                        </tr>
                        <tr>
                            <td><label>Tax</label></td>
                            <td>
                                <label id="tax" data-tax="<?php echo $other->getTax() ?>"></label>
                                <label id="min_order" hidden="hidden"><?php echo $other->getMinOrder() ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Delivery:</label></td>
                            <td><label id="delivery" data-del="<?php echo $other->getDeliveryFee() ?>"></label></td>
                        </tr>
                        <tr>
                            <td><label style="font-weight: bold">Total:</label></td>
                            <td><label id="total" style="font-weight: bold"></label></td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>
    </div>


</div>

</body>
</html>
