<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/2/2015
 * Time: 12:41 PM
 */

include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Item.php";

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $item = new Item();
    $item->__deleteBy($id);


}