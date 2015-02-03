<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 12:39 PM
 */
include_once "classes/Admin.php";

if (isset($_POST['admin_id']) && isset($_POST['admin_pass'])) {

    $admin = new Admin($_POST['admin_id'], $_POST['admin_pass']);
    $admin->__login();

}