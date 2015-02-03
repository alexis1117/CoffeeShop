<?php

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/7/2015
 * Time: 11:11 AM
 */
include_once $_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php";

class Order
{

    private $order_id;
    private $usr_email;
    private $order_status;
    private $order_date;
    private $payment_type;
    private $order_type;


    public function __construct()
    {
        if (isset($_COOKIE['usrlogin'])) {
            $this->usr_email = $_COOKIE['usrlogin'];
        }

    }

    public function __creatBy($usr_email)
    {
        $this->usr_email = $usr_email;
    }

    public function getOrder()
    {
        global $db;

        $result_order = $db->query("SELECT * FROM tbl_order WHERE usr_email='$this->usr_email'");

        $array_orders = array();

        for ($i = 0; $i < $result_order->num_rows; $i++) {

            $result_order->data_seek($i);
            $order = $result_order->fetch_assoc();

            $order_id = $order['order_id'];

            $result__cur_order = $db->query("SELECT * FROM tbl_order_detail WHERE order_id = '$order_id'");

            $array_cur_orders = array();

            for ($j = 0; $j < $result__cur_order->num_rows; $j++) {

                $result__cur_order->data_seek($j);
                $cur_order = $result__cur_order->fetch_assoc();

                $temp = array();

                $temp['order_date'] = $order['order_date'];
                $temp['order_type'] = $order['order_type'];
                $temp['order_status'] = $order['order_status'];
                $temp['item_id'] = $cur_order['item_id'];
                $temp['sz_id'] = $cur_order['sz_id'];
                $temp['extra'] = explode(",", $cur_order['extra']);
                $temp['qty'] = $cur_order['qty'];
                $temp['subtotal'] = $cur_order['subtotal'];

                array_push($array_cur_orders, $temp);
            }


            $array_orders[$order_id] = $array_cur_orders;
        }

        return $array_orders;

    }

    public function __createtByOrderId($order_id)
    {

        global $db;

        $result_order = $db->query("SELECT * FROM tbl_order WHERE order_id = '$order_id' LIMIT 1");
        $result_order->data_seek(0);

        $order = $result_order->fetch_assoc();

        $this->order_date = $order['order_date'];
        $this->order_status = $order['order_status'];
        $this->payment_type = $order['payment_type'];
        $this->usr_email = $order['usr_email'];
        $this->order_type = $order['order_type'];
    }

    public function getAll()
    {
        global $db;

        return $db->query("SELECT * FROM tbl_order");
    }


    public function __add()
    {
        session_start();

        global $db;

        $usr_id = "";

        $result_user = $db->query("SELECT id from tbl_usr WHERE usr_email='$this->usr_email'");
        if ($result_user->num_rows == 1)
            $usr_id = $result_user->fetch_row()[0];

        $_is_first_time = true;
        $_is_successful = true;
        $cart_items = json_decode($_POST['cart'], true);

        foreach ($cart_items as $item) {

            $item_id = $item['item_id'];
            $item_sz_id = $item['size_id'];
            $extra = implode(',', $item['extra']);
            $qty = $item['qty'];
            $subtotal = $item['subtotal'];
            $type = $item['type'];

            date_default_timezone_set('America/Los_Angeles');
            $this->order_date = date("Y-m-d H:i:s");
            $this->order_status = 'Preparing';

            if ($_is_first_time) {

                $_is_first_time = false;

                $db->query("INSERT INTO tbl_order_detail (item_id, sz_id, extra, qty, subtotal)
                            VALUES ('$item_id', '$item_sz_id', '$extra', '$qty', '$subtotal')");

                $this->order_id = $usr_id . "-" . $db->insert_id;

                $db->query("UPDATE tbl_order_detail SET order_id='$this->order_id' WHERE id='$db->insert_id'");

                $db->query("INSERT INTO tbl_order (order_id, order_date, usr_email, order_type, order_status)
                          VALUES('$this->order_id', '$this->order_date', '$this->usr_email', '$type', '$this->order_status')");

            } else {

                $db->query("INSERT INTO tbl_order_detail (order_id, item_id, sz_id, extra, qty, subtotal)
                            VALUES ('$this->order_id', '$item_id', '$item_sz_id', '$extra', '$qty', '$subtotal')");
            }

            if (mysqli_error($db) != "") {
                $_is_successful = false;
                echo mysqli_error($db);
            }

        }

        if ($_is_successful) {

            unset($_SESSION['cart']);
            setcookie('n_cart', '', time() - 60, '/');
            session_destroy();
        }

    }

    public function getByStatus($status)
    {
        global $db;

        return $db->query("SELECT * FROM tbl_order WHERE order_status = '$status'");
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->order_type;
    }

    /**
     * @return mixed
     */
    public function getUsrEmail()
    {
        return $this->usr_email;
    }

} 