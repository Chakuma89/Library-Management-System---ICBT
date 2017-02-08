<?php

class student {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }

    public function addStudent($studentCode, $fullname, $sGrade, $sClass, $sMedium, $sAddress, $sEmail) {

        $sql = "SELECT * FROM students WHERE student_code='$studentCode'";

        //checking if the username or email is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        if ($count_row == 0) {
            $sql1 = "INSERT INTO students SET student_code='$studentCode', full_name='$fullname', grade='$sGrade', class='$sClass', medium='$sMedium', address='$sAddress', email='$sEmail', status='1'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
            return $result;
        } else {
            return false;
        }
    }

    public function getStudentCode() {
        $sql = "SELECT student_id FROM students ORDER BY student_id DESC LIMIT 1";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $studId = $rows['student_id'] + 1;
        $studCode = sprintf("%05d", $studId);
        return $studCode;
    }

    public function showStudents($table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->data[] = $rows;
        }

        return $this->data;
    }

    public function getStudentById($id) {

        $sql = "SELECT * FROM students WHERE student_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $dataSelect = array();
        while ($rows = mysqli_fetch_array($result)) {
            $dataSelect[] = $rows;
        }
        return $dataSelect;    
    }

    public function updateStudent($uid, $studentCode, $fullname, $sGrade, $sClass, $sMedium, $sAddress, $sEmail) {

        $sql = "SELECT * FROM students WHERE student_code='$studentCode' AND student_id != '$uid'";
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        //if the data is not in db then insert to the table
        if ($count_row == 0) {
            $sql1 = "UPDATE students SET student_code='$studentCode', full_name='$fullname', grade='$sGrade', class='$sClass', medium='$sMedium', address='$sAddress', email='$sEmail', status='1' WHERE student_id='$uid'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
            return $result;
        } else {
            return false;
        }
    }

    public function deleteStudent($id) {

        $sql = "DELETE FROM students WHERE student_id='$id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be deleted");

        if ($result) {
            return $result;
        }
    }

    public function getStudntByNameORCode($searchText) {

        $sql = "SELECT * FROM students WHERE student_code='$searchText' OR full_name LIKE '%$searchText%' LIMIT 1";  
        $result = mysqli_query($this->db, $sql);
        $dataSelect = array();
        while ($rows = mysqli_fetch_array($result)) {
            $dataSelect[] = $rows;
        }

        return $dataSelect;
    }

}

?>    