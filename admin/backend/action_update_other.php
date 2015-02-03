<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/1/2015
 * Time: 8:31 PM
 */
include "./classes/Other.php";

if (isset($_POST['data'])) {

    $other = new Other();
    $other->__createNew();
    $other->__update();

}