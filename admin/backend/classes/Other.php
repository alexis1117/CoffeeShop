<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 3:18 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Other
{
    private $delivery_fee;
    private $tax;
    private $min_order;


    public function __construct()
    {

    }

    public function __create()
    {
        global $db;

        $result_other = $db->query("SELECT * FROM tbl_other");
        $result_other->data_seek(0);
        $other = $result_other->fetch_assoc();

        $this->delivery_fee = $other['del_fee'];
        $this->tax = $other['tax'];
        $this->min_order = $other['min_order'];
    }

    public function __createNew()
    {
        if (isset($_POST['data'])) {
            $data = json_decode($_POST['data'], true);

            $this->delivery_fee = $data['del_fee'];
            $this->tax = $data['tax'];
            $this->min_order = $data['min_order'];
        }
    }

    public function __update()
    {
        global $db;

        $db->query("UPDATE tbl_other SET del_fee='$this->delivery_fee', tax='$this->tax', min_order='$this->min_order' WHERE id='1'");

        echo mysqli_error($db);
    }

    /**
     * @return mixed
     */
    public function getDeliveryFee()
    {
        return $this->delivery_fee;
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