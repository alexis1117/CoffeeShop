<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/31/2014
 * Time: 6:23 PM
 */
session_start();

include "../admin/backend/classes/Other.php";
include "../admin/backend/classes/Item.php";
include "../admin/backend/classes/Size.php";
include "../admin/backend/classes/Extra.php";


$TR = "";

if (isset($_SESSION['cart'])) {

    $other = new Other();
    $other->__create();


    foreach ($_SESSION['cart'] as $session) {

        $item_id = $session['item_id'];
        $size_id = $session['size_id'];
        $price = $session['price'];
        $qty = $session['qty'];
        $array_extra_id = $session['extra'];

        $item = new Item();
        $item->__createBy($item_id, $size_id);

        $size = new Size();
        $size->__createBy($size_id);

        $div_extra = "<div id='div_extra'>";

        if (count($array_extra_id) > 0) {

            foreach ($array_extra_id as $extra_id) {

                $extra = new Extra();
                $extra->__createBy($extra_id);

                $div_extra .= "<label data-id='" . $extra_id . "' data-price='" . $extra->getPrice() . "'>" . $extra->getTitle() . ": $" . $extra->getPrice() . "</label>";
            }
        }

        $div_extra .= '</div>';

        $TR .= "
                <tr>
                    <td>
                        <img src='" . $item->getImg() . "' width='50px' height='50px' class='cart_img'/>
                        <label class='caption' data-item_id='$item_id'>" . $item->getTitle() . "</label>
                        $div_extra
                    </td>
                    <td>
                        <label id='size' data-size_id='$size_id'>" . $size->getTitle() . "</label>
                    </td>
                    <td>
                        <label id='price'>$price</label>
                    </td>
                    <td>
                        <label id='dec_qty' class='change_qty'>-</label>
                        <label id='qty'>$qty</label>
                        <label id='inc_qty' class='change_qty'>+</label>
                    </td>
                    <td>
                        <label id='item_subtotal'></label>
                    </td>
                    <td>
                        <span class='glyphicon glyphicon-remove'></span>
                    </td>

                </tr>";
    }
}

?>

<html>
<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/config/head.php"); ?>
    <script type="text/javascript" src="/javascripts/cart.js"></script>


    <style>
        body {
            background-color: #C6A76D;
            padding: 20px;
        }

        #empty {
            font-family: Arial, serif;
            font-size: 12px;
            float: left;
            font-family: Tahoma, serif;
        }

        table {
            background-color: #cab286;
            font-size: 12px;
            margin-top: 20px;
        }

        table th, table td {
            border-color: #5f310f !important;
        }

        #div_extra {
            display: flex;
            flex: 1;
            flex-direction: column;
            color: #5F310F;

            font-size: 10px;
            font-family: Arial, serif;
            float: right;
            text-align: right;
        }

        .glyphicon-remove {
            color: darkred;
        }

        .glyphicon-remove:hover {
            color: #ff0000;
            cursor: pointer;
        }

        .caption {
            font-size: 12px;
            font-weight: bold;
            padding: 10px;
            float: left;
        }

        table img {
            width: 50px;
            height: 50px;
            float: left;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        #inc_qty, #dec_qty {
            padding: 1px;
            font-weight: bold;
        }

        #inc_qty, #dec_qty:hover {
            cursor: pointer;
        }

        #div_total {
            min-width: 260px;
            float: right;
        }

        #calc {
            width: 100%;
            background-color: #CAB286;
            font: 12px Arial;

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

        .radio {
            font-family: MS, serif;
            font-size: 15px;
            font-weight: bold;
            height: 20px;
            margin: 5px;

            cursor: pointer;
        }

        :focus {
            outline: none !important;
        }

        .cart_img {
            cursor: pointer;
        }

        .btn, .btn:focus, .btn:active, .btn.active, .open .dropdown-toggle.btn {
            width: 100%;
            padding: 4px;
            font-weight: bold;

            color: #C6A76D;
            background-color: #5F310F;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;

            border: 1px solid #5F310F;
        }

        .btn:hover {
            background-color: saddlebrown;
            border-color: #ffffff;
            color: #C6A76D;
        }

    </style>
</head>
<body>

<?php
if (isset($_COOKIE['n_cart'])) {
    ?>
    <div class="cart_content">
        <table class="table" id="cart">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Size</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php echo $TR ?>
            </tbody>
        </table>
    </div>
    <div id="div_total">
        <table id="calc">
            <tbody>
            <tr>
                <td><label>Subtotal:</label></td>
                <td><label id="subtotal"></label></td>
            </tr>
            <tr>
                <td><label>Tax</label></td>
                <td>
                    <label id="tax" data-tax="<?php echo $other->getTax() ?>"></label>
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
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-6" style="text-align: right">
                <label class="radio">
                    <input type="radio" name="order_type" value="Pick-up" checked>
                    <img src="/images/pickup_icon.png" style="width: 20px; height: 20px">
                    PICKUP
                </label>
            </div>
            <div class="col-sm-6">
                <label class="radio" style="text-align: left">
                    <input type="radio" name="order_type" value="Delivery"/>
                    <img src="/images/delivery_icon.png" style="width: 20px; height: 20px">
                    DELIVERY
                </label>
            </div>
        </div>

        <p style="text-align: center; font-family: Arial, serif; font-size: 12px">
            Free Delivery on order over
            <label id="min_order">$<?php echo $other->getMinOrder() ?></label>
        </p>
        <button id="checkout" class="btn" data-checkout="false">PROCEED TO CHECKOUT</button>
    </div>

<?php
} else {
    echo '<p id="empty">Your basket is currently empty.</p>';
}
?>

</body>
</html>