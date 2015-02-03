<?php

include("./classes/Item.php");

if (isset($_POST['data'])) {

    $item = new Item();
    $item->__create(json_decode($_POST['data'], true));
    $item->__add();

}