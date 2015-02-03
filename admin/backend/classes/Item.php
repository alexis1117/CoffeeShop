<?php

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 12:19 PM
 */

include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");
include_once $_SERVER["DOCUMENT_ROOT"] . "/config/CONSTANTS.php";

class Item
{
    private $id;
    private $size_id;
    private $title;
    private $price;
    private $size_title;
    private $array_sz_price = array();
    private $cat_id;
    private $img;
    private $desc;


    public function __construct()
    {

    }

    public function __create(array $item)
    {
        if (array_key_exists('id', $item))
            $this->id = $item['id'];


        $this->title = $item['item_title'];
        $this->array_sz_price = json_decode($item['sz_price']);
        $this->cat_id = $item['cat_id'];
        $this->desc = $item['item_desc'];
        if (array_key_exists('item_img', $item))
            $this->img = $item['item_img'];
    }


    public function __createBy($item_id, $size_id)
    {
        $this->id = $item_id;
        $this->size_id = $size_id;

        global $db;

        $result_item = $db->query("SELECT * FROM tbl_item WHERE id='$this->id' AND sz_id='$this->size_id' LIMIT 1");
        echo mysqli_error($db);

        $result_item->data_seek(0);
        $item = $result_item->fetch_assoc();

        $this->title = $item['item_title'];
        $this->price = $item['item_price'];
        $this->img = UPLOAD_DIR . explode(',', $item['item_img'])[0];

        $result_size = $db->query("SELECT sz_title FROM tbl_size WHERE id='$this->size_id' LIMIT 1");
        $this->size_title = $result_size->fetch_row()[0];

        echo mysqli_error($db);
    }


    public function __add()
    {
        global $db;

        $first_time = true;

        foreach ($this->array_sz_price as $sz_price) {

            $sz_id = $sz_price->sz_id;
            $price = $sz_price->price;

            if ($first_time) {

                $db->query("INSERT INTO tbl_item (item_title, cat_id, sz_id, item_price, item_img, item_desc)
                          VALUES('$this->title', '$this->cat_id', '$sz_id', '$price', '$this->img', '$this->desc')");
                $first_time = false;

            } else

                $db->query("INSERT INTO tbl_item (id, item_title, cat_id, sz_id, item_price, item_img, item_desc)
                          VALUES('$db->insert_id', '$this->title', '$this->cat_id', '$sz_id', '$price', '$this->img', '$this->desc')");


            echo mysqli_error($db);
        }
    }


    public function __update()
    {
        global $db;

        foreach ($this->array_sz_price as $sz_price) {

            $sz_id = $sz_price->sz_id;
            $price = $sz_price->price;

            $result_item = $db->query("SELECT * FROM tbl_item WHERE id='$this->id' AND sz_id ='$sz_id'");

            if ($result_item->num_rows > 0)

                $db->query("UPDATE tbl_item SET item_title='$this->title', item_price = '$price', item_desc= '$this->desc'
                            WHERE id='$this->id' AND sz_id='$sz_id'");

            else

                $db->query("INSERT INTO tbl_item(id, item_title, cat_id, sz_id, item_price, item_desc)
                            VALUES('$this->id', '$this->title', '$this->cat_id', '$sz_id', '$price', '$this->desc')");

            echo mysqli_error($db);

        }
    }

    public function __updateImg($id, $img_src)
    {
        global $db;

        $db->query("UPDATE tbl_item SET item_img= '$img_src' WHERE id='$id'");

        echo mysqli_error($db);
    }

    public function getByCatId($cat_id)
    {
        global $db;

        return $db->query("SELECT * FROM tbl_item WHERE cat_id = '$cat_id'");
    }

    public function getByItemId($id)
    {
        global $db;

        return $db->query("SELECT * FROM tbl_item WHERE id='$id'");
    }

    public function __deleteBy($id)
    {
        global $db;
        
        $db->query("DELETE FROM tbl_item WHERE id='$id'");

        echo mysqli_error($db);
    }

    /**
     * @return array|mixed
     */
    public function getArraySzPrice()
    {
        return $this->array_sz_price;
    }

    /**
     * @return mixed
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getSizeTitle()
    {
        return $this->size_title;
    }


} 