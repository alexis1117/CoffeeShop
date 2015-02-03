<?php

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 2:56 PM
 */

include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Extra
{
    private $id;
    private $title;
    private $price;

    public function __construct()
    {

    }

    public function __create(array $extra)
    {
        $this->id = $extra['id'];
        $this->title = $extra['title'];
        $this->price = $extra['price'];
    }

    public function __createBy($id)
    {
        global $db;
        $result_extra = $db->query("SELECT * FROM tbl_extra WHERE id='$id' LIMIT 1");
        $result_extra->data_seek(0);
        $extra = $result_extra->fetch_assoc();

        $this->title = $extra['ext_title'];
        $this->price = $extra['ext_price'];
    }

    public function __update()
    {
        global $db;

        $result_extra = $db->query("SELECT * FROM tbl_extra WHERE id='$this->id'");

        if ($result_extra->num_rows > 0)

            $db->query("UPDATE tbl_extra SET ext_title='$this->title', ext_price='$this->price' WHERE id='$this->id'");

        else

            $db->query("INSERT INTO tbl_extra (id, ext_title, ext_price) VALUES ('$this->id', '$this->title', '$this->price')");

        echo mysqli_error($db);

    }

    public function getTitleById($id)
    {
        global $db;

        $result_extra = $db->query("SELECT ext_title FROM tbl_extra WHERE id='$id'");

        return $result_extra->fetch_row()[0];

    }

    public function getAll()
    {
        global $db;

        return $db->query("SELECT * FROM tbl_extra");

    }

    public function __deleteBy($id) {

        global $db;

        $db->query("DELETE FROM tbl_extra WHERE id='$id'");

        echo mysqli_error($db);

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


} 