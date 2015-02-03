<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/24/2014
 * Time: 3:42 AM
 */
include "./classes/Category.php";

if (isset($_POST['data'])) {

    $array_data = json_decode($_POST['data'], true);

    foreach ($array_data as $data) {

        $cat = new Category();
        $cat->__createBy($data);
        $cat->__update();

    }
}
