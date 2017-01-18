<?php

//include "dbconfig.php";

class book {

    public $db;

    public function __construct() {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) {

            echo "Error: Could not connect to database.";

            exit;
        }
    }
    
    public function showAuthors() {

        $sqlAuth = "SELECT * FROM authors";
        $resultAuth  = mysqli_query($this->db, $sqlAuth);

        while ($rowsAuth  = mysqli_fetch_array($resultAuth)) {
            $this->dataAuth[] = $rowsAuth;
        }

        return $this->dataAuth;
    }
    
    public function showStreams() {

        $sqlStrm = "SELECT * FROM book_streams";
        $resultStrm = mysqli_query($this->db, $sqlStrm);

        while ($rowsStrm = mysqli_fetch_array($resultStrm)) {
            $this->dataStrm[] = $rowsStrm;
        }

        return $this->dataStrm;
    }
    
    public function showCategories() {

        $sqlCat = "SELECT * FROM book_categories";
        $resultCat = mysqli_query($this->db, $sqlCat);

        while ($rowsCat = mysqli_fetch_array($resultCat)) {
            $this->dataCat[] = $rowsCat;
        }

        return $this->dataCat;
    }
    
    
}

?>