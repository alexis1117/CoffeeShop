<?php
/**
 * Created by PhpStorm.
 * User: Tuya
 * Date: 1/4/2015
 * Time: 10:20 AM
 */
include_once $_SERVER["DOCUMENT_ROOT"] . "/config/db_config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php";

class Usr
{

    private $usr_name;
    private $usr_address;
    private $usr_phone;
    private $usr_email;
    private $usr_pass;
    private $email_list;

    public function __construct()
    {
        if (isset($_COOKIE['usrlogin'])) {
            $this->usr_email = $_COOKIE['usrlogin'];
            global $db;

            $result_usr = $db->query("SELECT * FROM tbl_usr WHERE usr_email='$this->usr_email' LIMIT 1");

            $result_usr->data_seek(0);
            $usr = $result_usr->fetch_assoc();

            $this->usr_address = str_replace('_', ', ', $usr['usr_address']);
            $this->usr_name = $usr['usr_name'];
            $this->usr_phone = $usr['usr_phone'];
            $this->email_list = $usr['email_list'];

        }
    }

    public function __createBy($email)
    {
        global $db;

        $result_usr = $db->query("SELECT * FROM tbl_usr WHERE usr_email= '$email' LIMIT 1");

        if ($result_usr->num_rows === 1) {
            $result_usr->data_seek(0);

            $usr = $result_usr->fetch_assoc();

            $this->usr_email = $email;
            $this->usr_name = $usr['usr_name'];
            $this->usr_phone = $usr['usr_phone'];
            $this->usr_address = str_replace('_', ', ', $usr['usr_address']);
            $this->email_list = $usr['email_list'];
        }
    }

    private function __crypt($value)
    {
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", 10) . $salt;

        return crypt($value, $salt);

    }

    public function __add()
    {
        global $db;

        if (isset($_POST['new_usr'])) {
            $new_usr = json_decode($_POST['new_usr'], true);
            $this->usr_name = $new_usr['usr_name'];
            $this->usr_address = $new_usr['usr_address'];
            $this->usr_phone = $new_usr['usr_phone'];
            $this->usr_email = $new_usr['usr_email'];
            $this->usr_pass = $this->__crypt($new_usr['usr_pass']);
            $this->email_list = $new_usr['email_list'];

        }

        if ($db->query("SELECT * FROM tbl_usr WHERE usr_email ='$this->usr_email'")->num_rows == 0) {

            $db->query("INSERT INTO tbl_usr (usr_name, usr_email, usr_pass, usr_address, usr_phone, email_list, usr_type)
                    VALUES ('$this->usr_name', '$this->usr_email', '$this->usr_pass', '$this->usr_address', '$this->usr_phone', '$this->email_list', 'usr')");

            echo mysqli_error($db);

            if (!isset($_COOKIE['usrlogin'])) {

                setcookie("usrlogin", $this->usr_email, time() + 60 * 60 * 24, "/");

            }

        } else {

            echo "ERROR_DUPLICATE";
        }

    }

    public function __login()
    {
        if (!isset($_COOKIE['usrlogin'])) {

            global $db;

            $this->usr_email = $_POST['usr_email'];
            $this->usr_pass = $_POST['usr_pass'];

            $result = $db->query("SELECT usr_pass FROM tbl_usr WHERE usr_email ='$this->usr_email'");

            if ($result->num_rows == 1) {

                $hash_pass = $result->fetch_row()[0];

                if (!$this->check_block($this->usr_email)) {

                    if (hash_equals($hash_pass, crypt($this->usr_pass, $hash_pass))) {

                        setcookie("usrlogin", $this->usr_email, time() + 60 * 60 * 24, "/");
                        return true;

                    } else {
                        $this->update_attempt($this->usr_email);
                    }
                } else {
                    echo 'ERROR_BLOCK';
                    return false;
                }

            }
            echo "ERROR_CREDENTIAL";
            return false;
        }
    }

    function check_block($usr_email)
    {
        global $db;

        $result_attempts = $db->query("SELECT * FROM tbl_attempts WHERE usr_email = '$usr_email' LIMIT 1");

        if ($result_attempts->num_rows == 1) {

            $result_attempts->data_seek(0);
            $attempt = $result_attempts->fetch_assoc();

            $n_attempts = intval($attempt['n_attempts']);

            if ($n_attempts > 4)
                return true;

        }

        return false;
    }

    function  update_attempt($usr_email)
    {
        global $db;

        $result_attempts = $db->query("SELECT * FROM tbl_attempts WHERE usr_email = '$usr_email' LIMIT 1");

        if ($result_attempts->num_rows == 1) {

            $result_attempts->data_seek(0);
            $attempt = $result_attempts->fetch_assoc();
            $start_time = intval($attempt['start_time']);

            if ($start_time + 2 * 60 * 60 > time()) {

                $n_attempts = intval($attempt['n_attempts']) + 1;

                $db->query("UPDATE tbl_attempts SET n_attempts = '$n_attempts' WHERE usr_email = '$usr_email'");

            } else {

                $db->query("UPDATE tbl_attempts SET n_attempts = '1', start_time = '" . time() . "' WHERE usr_email = '$usr_email'");
                echo mysqli_error($db);
            }

        } else {

            $db->query("INSERT INTO tbl_attempts (usr_email, start_time, n_attempts) VALUES ('$usr_email', '" . time() . "', '1')");
        }

    }

    public function __update()
    {
        $data = json_decode($_POST['data'], true);
        $this->usr_email = $data['usr_email'];
        $this->usr_name = $data['usr_name'];
        $this->usr_phone = $data['usr_phone'];
        $this->usr_address = $data['usr_address'];
        $this->email_list = $data['email_list'];

        global $db;

        $db->query("UPDATE tbl_usr SET usr_name='$this->usr_name', usr_phone='$this->usr_phone',
                  usr_address='$this->usr_address', email_list='$this->email_list' WHERE usr_email='$this->usr_email'");

        echo mysqli_error($db);

    }

    public function  getAll()
    {
        global $db;

        return $db->query("SELECT * FROM tbl_usr");
    }

    public function  __update_pwd($old_pass, $new_pass)
    {
        global $db;

        $result_usr = $db->query("SELECT usr_pass FROM tbl_usr WHERE usr_email ='$this->usr_email' LIMIT 1");

        if ($result_usr->num_rows == 1) {

            $hash_pass = $result_usr->fetch_row()[0];

            if (hash_equals($hash_pass, crypt($old_pass, $hash_pass))) {

                $new_hash_pass = $this->__crypt($new_pass);
                $db->query("UPDATE tbl_usr SET usr_pass = '$new_hash_pass' WHERE usr_email='$this->usr_email'");

                echo mysqli_error($db);
                return true;
            }
        }

        echo "ERROR_CREDENTIAL";
        return false;
    }

    /**
     * @return mixed
     */
    public function getEmailList()
    {
        return $this->email_list;
    }

    /**
     * @return mixed
     */
    public function getUsrAddress()
    {
        return $this->usr_address;
    }

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getUsrName()
    {
        return $this->usr_name;
    }


    public function getUsrEmail()
    {
        if (isset($_COOKIE['usrlogin']))
            $this->usr_email = $_COOKIE['usrlogin'];

        return $this->usr_email;
    }

    /**
     * @return string
     */
    public function getUsrPass()
    {
        return $this->usr_pass;
    }

    /**
     * @return mixed
     */
    public function getUsrPhone()
    {
        return $this->usr_phone;
    }


}