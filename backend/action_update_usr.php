<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/9/2015
 * Time: 10:55 PM
 */

include "../backend/classes/Usr.php";

if (isset($_POST['data'])) {

    $usr = new Usr();
    $usr->__update();

}