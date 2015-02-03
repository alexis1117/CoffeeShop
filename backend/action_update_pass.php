<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/31/2015
 * Time: 3:12 AM
 */

include $_SERVER["DOCUMENT_ROOT"] . "/backend/classes/Usr.php";

if (isset($_POST)) {


    $usr = new Usr();
    $usr->__update_pwd($_POST['old_pass'], $_POST ['new_pass']);
}