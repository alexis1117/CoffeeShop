<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/28/2015
 * Time: 3:31 PM
 */

include_once "./classes/Item.php";

if (isset($_POST)) {

    $item_id = $_POST['id'];
    $item_img = $_POST['images'];

    $item = new Item();
    $item->__updateImg($item_id, $item_img);

}