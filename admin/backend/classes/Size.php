<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 3:08 PM
 */

include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Size
{
    private $id;
    private $title;

    public function __construct()
    {

    }

    public function __createBy($id)
    {
        global $db;

        $result_size = $db->query("SELECT sz_title FROM tbl_size WHERE id='$id'");
        $this->title = $result_size->fetch_row()[0];
    }

    public function __createNew(array $size)
    {
        $this->id = $size['id'];
        $this->title = $size['title'];
    }

    public function __update()
    {
        global $db;

        $result_size = $db->query("SELECT * FROM tbl_size WHERE id='$this->id'");

        if ($result_size->num_rows > 0)

            $db->query("UPDATE tbl_size SET sz_title='$this->title' WHERE id='$this->id'");

        else

            $db->query("INSERT INTO tbl_size (id, sz_title) VALUES ('$this->id', '$this->title')");

        echo mysqli_error($db);

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getAll()
    {
        global $db;

        return $db->query("SELECT * FROM tbl_size");
    }

    public function getAll_Array()
    {
        global $db;

        $size_array = array();

        $result_size = $db->query("SELECT * FROM tbl_size");

        foreach ($result_size as $sz)
            $size_array[$sz['id']] = $sz['sz_title'];

        return $size_array;
    }

    public function __deleteBy($id)
    {

        global $db;

        $db->query("DELETE FROM tbl_size WHERE id='$id'");

        echo mysqli_error($db);
    }

    public function getById($id)
    {
        global $db;

        $result_sz = $db->query("SELECT sz_title FROM tbl_size WHERE id = '$id'");
        return $result_sz->fetch_row()[0];
    }
} 