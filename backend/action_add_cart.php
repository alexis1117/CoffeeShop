<?php
session_start();

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/31/2014
 * Time: 11:02 AM
 */

if (isset($_POST['cart'])) {

    if (!isset($_SESSION['cart'])) {

        $_SESSION['cart'][0] = json_decode($_POST['cart'], true);

    } else {

        $new_item = json_decode($_POST['cart'], true);

        $not_exist = true;
        foreach ($_SESSION['cart'] as $key => $session) {


            if ($session['item_id'] == $new_item['item_id'] && $session['size_id'] == $new_item['size_id']) {

                if (count($new_item['extra']) == count($session['extra']) &&
                !array_diff($new_item['extra'], $session['extra']) ? true : false
                ) {
                    $new_item['qty'] = $session['qty'] + $new_item['qty'];
                    $not_exist = false;
                    $_SESSION['cart'][$key] = $new_item;
                    break;
                }

            }

        }

        if ($not_exist)
            array_push($_SESSION['cart'], $new_item);
    }

    setcookie("n_cart", count($_SESSION['cart']), 0, "/");

    echo count($_SESSION['cart']);
}