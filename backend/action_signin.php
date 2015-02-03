<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 12/30/2014
 * Time: 5:40 AM
 */


include "./classes/Usr.php";

if (isset($_POST['usr_email']) && isset($_POST['usr_pass'])) {

    $usr = new Usr();
    $usr->__login();
}