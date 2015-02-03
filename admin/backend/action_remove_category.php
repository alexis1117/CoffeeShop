<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/2/2015
 * Time: 12:41 PM
 */

include $_SERVER["DOCUMENT_ROOT"] . "/admin/backend/classes/Category.php";

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $cat = new Category();
    $cat->__deleteBy($id);
    
}