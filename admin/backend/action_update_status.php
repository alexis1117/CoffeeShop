<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/25/2015
 * Time: 8:52 AM
 */
include_once $_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php";

if (isset($_POST['data'])) {

    $array_data = json_decode($_POST['data'], true);


    foreach ($array_data as $key => $data) {

        $order_id = $data['order_id'];
        $order_status = $data['order_status'];

        $db->query("UPDATE tbl_order SET order_status = '$order_status' WHERE order_id = '$order_id'");
        echo mysqli_error($db);
    }

    $result_neworder = $db->query("SELECT * FROM tbl_order WHERE order_status = 'Preparing'");
    $result_pastorder = $db->query("SELECT * FROM tbl_order WHERE order_status != 'Preparing'");

    $result = array();

    $result['n_neworder'] = $result_neworder->num_rows;
    $result['n_pastorder'] = $result_pastorder->num_rows;


    echo json_encode($result);

}

