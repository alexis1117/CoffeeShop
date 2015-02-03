<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/29/2014
 * Time: 7:49 PM
 */

include "./classes/Usr.php";

if (isset($_POST['new_usr'])) {

    $new_usr = new Usr();
    $new_usr->__add();

}