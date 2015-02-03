<?php

/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/23/2015
 * Time: 12:27 PM
 */
include($_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php");

class Admin
{

    private $admin_id;
    private $admin_pass;

    function __construct($id, $pass)
    {
        $this->admin_id = $id;
        $this->admin_pass = $pass;

    }

    public function __login()
    {
        global $db;

        $result_admin = $db->query("SELECT admin_pass FROM tbl_admin WHERE admin_id = '$this->admin_id' LIMIT 1");
        $hash_pass = $result_admin->fetch_row()[0];
        echo mysqli_error($db);

        if ($result_admin->num_rows == 1) {
            if (!$this->check_block($this->admin_id)) {
                if (hash_equals($hash_pass, crypt($this->admin_pass, $hash_pass))) {

                    setcookie("admin_login", $this->admin_id, time() + 60 * 60 * 24, "/");
                    return true;

                } else {
                    $this->update_attempt($this->admin_id);
                }

            } else {
                echo "ERROR_BLOCK";
                return false;
            }
        }
        echo "ERROR_CREDENTIAL";
        return false;


    }

    function check_block($id)
    {
        global $db;

        $result_attempt = $db->query("SELECT n_attempts FROM tbl_admin_attempts WHERE admin_id = '$id' LIMIT 1");
        echo mysqli_error($db);

        if ($result_attempt->num_rows == 1) {
            $n_attempts = intval($result_attempt->fetch_row()[0]);

            if ($n_attempts > 2) {
                return true;
            }
        }
        return false;
    }


    function update_attempt($id)
    {
        global $db;

        $result_attempt = $db->query("SELECT n_attempts FROM tbl_admin_attempts WHERE admin_id = '$id' LIMIT 1");

        if ($result_attempt->num_rows == 1) {
            $n_attempts = intval($result_attempt->fetch_row()[0]) + 1;

            $db->query("UPDATE tbl_admin_attempts SET n_attempts='$n_attempts' WHERE admin_id = '$id'");
            echo mysqli_error($db);
        } else {
            $db->query("INSERT INTO tbl_admin_attempts(admin_id, n_attempts) VALUES ('$id', '1')");
            echo mysqli_error($db);
        }

    }


    function __add()
    {
        global $db;

        $result_admin = $db->query("SELECT * FROM tbl_admin WHERE admin_id = '$this->admin_id'");

        if ($result_admin->num_rows == 0) {

            $hash_pass = $this->__crypt($this->admin_pass);

            $db->query("INSERT INTO tbl_admin (admin_id, admin_pass) VALUES ('$this->admin_id', '$hash_pass')");
            echo mysqli_error($db);
        }

    }

    private function __crypt($value)
    {
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", 10) . $salt;

        return crypt($value, $salt);

    }

    function __update($new_pass, $old_pass)
    {
        global $db;

        $result_admin = $db->query("SELECT admin_pass FROM tbl_admin WHERE admin_id = 'admin' LIMIT 1");

        if ($result_admin->num_rows == 1) {

            $hash_pass = $result_admin->fetch_row()[0];

            if (hash_equals($hash_pass, crypt($old_pass, $hash_pass))) {

                $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
                $salt = sprintf("$2a$%02d$", 10) . $salt;

                $new_pass = crypt($new_pass, $salt);

                $db->query("UPDATE tbl_admin SET admin_pass = '$new_pass' WHERE admin_id ='admin'");

                return;
            }

        }
        echo "ERROR_CREDENTIAL";
    }

    function __delete()
    {

    }

    function __remove()
    {

    }


}