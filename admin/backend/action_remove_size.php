<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/2/2015
 * Time: 12:41 PM
 */

include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Size.php";

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $size = new Size();
    $size->__deleteBy($id);


}