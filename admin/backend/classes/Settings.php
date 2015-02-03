<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/29/2015
 * Time: 11:35 AM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Settings
{

    private $del_fee;
    private $tax;
    private $min_order;

    public function __construct()
    {

    }

    public function __create()
    {
        global $db;

        $result_other = $db->query("SELECT * FROM tbl_other LIMIT 1");

        $result_other->data_seek(0);
        $other = $result_other->fetch_assoc();

        $this->del_fee = $other['del_fee'];
        $this->tax = $other['tax'];
        $this->min_order = $other['min_order'];
    }

    /**
     * @return mixed
     */
    public function getDelFee()
    {
        return $this->del_fee;
    }

    /**
     * @return mixed
     */
    public function getMinOrder()
    {
        return $this->min_order;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }
} 