<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/1/2015
 * Time: 11:30 PM
 */

include "./classes/Size.php";

if (isset($_POST['data'])) {

    $array_data = json_decode($_POST['data'], true);

    foreach ($array_data as $data) {

        $size = new Size();
        $size->__createNew($data);
        $size->__update();
    }

}