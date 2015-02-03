<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/31/2014
 * Time: 10:52 PM
 */

session_start();

if (isset($_POST['cart'])) {

    $item = json_decode($_POST['cart'], true);

    foreach ($_SESSION['cart'] as $key => $session) {

        if ($session['item_id'] == $item['item_id'] && $session['size_id'] == $item['size_id']) {

            if (count($item['extra']) == count($session['extra']) &&
            !array_diff($item['extra'], $session['extra']) ? true : false
            ) {
                unset($_SESSION['cart'][$key]);
                break;
            }


        }

    }

    if (count($_SESSION['cart']) > 0)
        setcookie('n_cart', count($_SESSION['cart']), 0, '/');
    else
        setcookie('n_cart', '', time() - 60, '/');


    echo count($_SESSION['cart']);
}