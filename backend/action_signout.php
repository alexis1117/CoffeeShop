<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/3/2015
 * Time: 11:26 AM
 */

if (isset($_COOKIE['usrlogin'])) {

    setcookie('usrlogin', '', time() - 60, '/');
}