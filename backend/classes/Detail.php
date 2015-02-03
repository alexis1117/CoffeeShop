<?php

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/29/2015
 * Time: 10:40 AM
 */
class Detail
{

    private $item_id;
    private $sz_id;
    private $extra;
    private $qty;
    private $subtotal;


    public function __construct()
    {

    }

    public function getAllByOrderId($order_id)
    {
        global $db;

        return $db->query("SELECT * FROM tbl_order_detail WHERE order_id = '$order_id'");
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @return mixed
     */
    public function getSzId()
    {
        return $this->sz_id;
    }

} 