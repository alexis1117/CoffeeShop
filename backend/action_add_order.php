<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/7/2015
 * Time: 11:09 AM
 */

include "./classes/Usr.php";
include "./classes/Order.php";

if (isset($_POST['cart'])) {

    $cur_usr = new Usr();

    if ($cur_usr->getUsrEmail() == "") {
        echo "ERROR_NOLOGIN";
    } else {
        $new_order = new Order();
        $new_order->__add();
    }


    //$cart_items = json_decode($_POST['data'], true);


}