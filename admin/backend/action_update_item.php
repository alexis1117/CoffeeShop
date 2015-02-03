<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/10/2014
 * Time: 11:52 AM
 */

include("./classes/Item.php");

if (isset($_POST['data'])) {

    $array_data = json_decode($_POST['data'], true);

    foreach ($array_data as $data) {

        $item = new Item();
        $item->__create($data);
        $item->__update();

    }

}
