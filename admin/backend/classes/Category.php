<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 2:50 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Category
{
    private $id;
    private $title;
    private $img;

    public function __construct()
    {

    }

    public function __createByID($cat_id)
    {
        global $db;

        $result_cat = $db->query("SELECT * FROM tbl_category WHERE id='$cat_id' LIMIT 1");

        $result_cat->data_seek(0);

        $cat = $result_cat->fetch_assoc();

        echo mysqli_error($db);

        $this->id = $cat_id;
        $this->title = $cat['cat_title'];

    }

    public function __createBy(array $cat)
    {
        $this->id = $cat['id'];
        $this->title = $cat['title'];
    }

    public function __update()
    {
        global $db;

        $result_cat = $db->query("SELECT * FROM tbl_category WHERE id='$this->id'");

        if ($result_cat->num_rows > 0) {

            $db->query("UPDATE tbl_category SET cat_title='$this->title' WHERE id='$this->id'");

        } else {

            $db->query("INSERT INTO tbl_category (id, cat_title) VALUES ('$this->id', '$this->title')");
        }
        echo mysqli_error($db);

    }

    public function  __updateImg($id, $img_src)
    {
        global $db;

        $img_src = explode(',', $img_src)[0];

        $result_cat = $db->query("SELECT * FROM tbl_category WHERE id='$id'");

        if ($result_cat->num_rows == 1)
            $db->query("UPDATE tbl_category SET cat_img = '$img_src' WHERE id = '$id'");

        echo mysqli_error($db);
    }

    public function __deleteBy($id)
    {
        global $db;

        $db->query("DELETE FROM tbl_category WHERE id='$id'");

        echo mysqli_error($db);
    }

    public function getAll()
    {
        global $db;

        return $db->query("SELECT * FROM tbl_category");
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
    public function getImg()
    {
        return $this->img;
    }

} 