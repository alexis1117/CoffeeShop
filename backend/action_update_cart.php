<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 6:19 PM
 */
session_start();

if (isset($_POST['cart'])) {

    $item = json_decode($_POST['cart'], true);

    foreach ($_SESSION['cart'] as $key => $session)

        if ($session['item_id'] == $item['item_id'] && $session['size_id'] == $item['size_id']) {

            if (count($item['extra']) == count($session['extra']) &&
            !array_diff($item['extra'], $session['extra']) ? true : false
            ) {
                $_SESSION['cart'][$key] = $item;
                break;
            }
        }
}