<?php

class stream {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }

    public function add_stream($strmName, $strmDescription) {

        $sql = "SELECT * FROM book_streams WHERE stream_name='$strmName'";

        //checking if category is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        if ($count_row == 0) {
            $sql1 = "INSERT INTO book_streams SET stream_name='$strmName', description='$strmDescription'";  
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    public function showStreams($table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->data[] = $rows;
        }

        return $this->data;
    }

    public function delete($id) {

        $sql = "DELETE FROM book_streams WHERE stream_id='$id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be deleted");

        if ($result) {
            return $result;
        }
    }

    public function get_streambyid($id) { 

        $sql = "SELECT * FROM book_streams WHERE stream_id='$id'";  
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->dataSelect[] = $rows;
        }

        return $this->dataSelect;
    }
    
    public function update_stream($uid, $strmName, $strmDescription) {

        $sql = "SELECT * FROM book_streams WHERE stream_name='$strmName' AND stream_id != '$uid'";  
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        //if the data is not in db then insert to the table
        if ($count_row == 0) {
            $sql1 = "UPDATE book_streams SET stream_name='$strmName', description='$strmDescription' WHERE stream_id='$uid'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
            return $result;
        } else {
            return false;
        }
    }
    
}

?>    