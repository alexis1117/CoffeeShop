<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/27/2014
 * Time: 2:18 PM
 */
include "./classes/Extra.php";

if (isset($_POST['data'])) {

    $array_data = json_decode($_POST['data'], true);


    foreach ($array_data as $data) {

        $extra = new Extra();
        $extra->__create($data);
        $extra->__update();

    }

}
