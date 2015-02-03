<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/28/2015
 * Time: 3:48 PM
 */
include "./classes/Category.php";

if (isset($_POST)) {
    
    $cat_id = $_POST['id'];
    $image = $_POST['images'];

    $cat = new Category();
    $cat->__updateImg($cat_id, $image);

}