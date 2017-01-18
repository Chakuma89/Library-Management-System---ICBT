<?php

include "dbconfig.php";

class user {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }

    public function showData($table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->data[] = $rows;
        }

        return $this->data;
    }

    public function get_userbyid($id) {

        $sql = "SELECT * FROM users WHERE uid='$id'";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->dataSelect[] = $rows;
        }

        return $this->dataSelect;
    }

    public function reg_user($name, $username, $password, $email) {

        $password = md5($password);
        $sql = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

        //checking if the username or email is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        //if the username is not in db then insert to the table
        if ($count_row == 0) {
            $sql1 = "INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    public function delete($id) {

        $sql = "DELETE FROM users WHERE uid='$id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be deleted");

        if ($result) {
            return $result;
        }
    }

    public function check_login($emailusername, $password) {

        $password = md5($password);
        $sql2 = "SELECT fullname from users WHERE (uemail='$emailusername' or uname='$emailusername') and upass='$password'";

        //checking if the username is available in the table
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;

        if ($count_row == 1) {
            // this login var will use for the session thing
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['fullname'];
            return true;
        } else {
            return false;
        }
    }

    public function user_logout() {
        unset($_SESSION['uid']);
    }

    public function update_user($uid, $name, $username, $password, $email) {

        $password = md5($password);
        $sql="SELECT * FROM users WHERE (uname='$username' OR uemail='$email') AND uid != '$uid'"; 
        //checking if the username or email is available in db
        $check =  $this->db->query($sql) ;
        $count_row = $check->num_rows;
        //if the username is not in db then insert to the table
        if ($count_row == 0){
        $sql1 = "UPDATE users SET uname='$username', upass='$password', fullname='$name', uemail='$email'
						WHERE uid='$uid'";
        $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
        return $result;
        }
        else { 
            return false;
            
        }
    }

}

?>