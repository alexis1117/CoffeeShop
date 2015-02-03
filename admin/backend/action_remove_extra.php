<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/2/2015
 * Time: 12:41 PM
 */

include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Extra.php";

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $extra = new Extra();
    $extra->__deleteBy($id);


}