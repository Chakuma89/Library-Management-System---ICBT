<?php

class category {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }

    public function add_category($catName, $catDescription) {

        $sql = "SELECT * FROM book_categories WHERE category_name='$catName'";

        //checking if category is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        if ($count_row == 0) {
            $sql1 = "INSERT INTO book_categories SET category_name='$catName', description='$catDescription'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    public function showCategories($table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->data[] = $rows;
        }

        return $this->data;
    }

    public function delete($id) {

        $sql = "DELETE FROM book_categories WHERE category_id='$id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be deleted");

        if ($result) {
            return $result;
        }
    }

    public function get_categorybyid($id) { 

        $sql = "SELECT * FROM book_categories WHERE category_id='$id'";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->dataSelect[] = $rows;
        }

        return $this->dataSelect;
    }
    
    public function update_category($uid, $catName, $catDescription) { 

        $sql = "SELECT * FROM book_categories WHERE category_name='$catName' AND category_id != '$uid'";  
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        //if the data is not in db then insert to the table
        if ($count_row == 0) {
            $sql1 = "UPDATE book_categories SET category_name='$catName', description='$catDescription' WHERE category_id='$uid'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
            return $result;
        } else {
            return false;
        }
    }
    
}

?>    