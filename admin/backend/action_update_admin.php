<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/26/2015
 * Time: 9:40 AM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Admin.php");

if (isset($_POST)) {

    $old_pass = preg_replace('/\s+/', '', $_POST['old_pass']);
    $new_pass = preg_replace('/\s+/', '', $_POST['new_pass']);

    $admin = new Admin("", "");
    $admin->__update($new_pass, $old_pass);


}