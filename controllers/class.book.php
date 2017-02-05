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
        $resultAuth = mysqli_query($this->db, $sqlAuth);

        while ($rowsAuth = mysqli_fetch_array($resultAuth)) {
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

    public function showLanguages() {

        $sqlLang = "SELECT * FROM languages";
        $resultLang = mysqli_query($this->db, $sqlLang);

        while ($rowsLang = mysqli_fetch_array($resultLang)) {
            $this->dataLang[] = $rowsLang;
        }

        return $this->dataLang;
    }

    public function showTypes() {

        $sqlType = "SELECT * FROM types";
        $resultType = mysqli_query($this->db, $sqlType);

        while ($rowsType = mysqli_fetch_array($resultType)) {
            $this->dataType[] = $rowsType;
        }

        return $this->dataType;
    }

    public function addBooks($bookCode, $bookName, $bookDes, $bookAuthor, $bookQuantity, $bookLanguage, $bookType, $bookStream, $bookCategory) {

        $addedDate = $date = date('Y-m-d H:i:s');
        $addedBy = $_SESSION['uid'];

        $sql = "SELECT * FROM books WHERE book_name='$bookName'";

        //checking if the book is available in db
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        if ($count_row == 0) {
            $sql1 = "INSERT INTO books SET book_code='$bookCode', book_name='$bookName', description='$bookDes', author='$bookAuthor', quantity='$bookQuantity', language='$bookLanguage', type='$bookType', stream='$bookStream', category='$bookCategory', added_date='$addedDate', added_by='$addedBy'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");

            $sqlLast = "SELECT book_id  FROM books ORDER BY book_id DESC LIMIT 1";
            $resultLast = mysqli_query($this->db, $sqlLast);
            $data = mysqli_fetch_array($resultLast);
            $lastBookId = $data['book_id']; 

            for ($x = 1; $x <= $bookQuantity; $x++) {
                $copySubId= sprintf("%02d", $x);      
                $bookCopyCode = $bookCode.'/'. $copySubId ;    
                
                $sql2 = "INSERT INTO book_copies SET ref_book_id='$lastBookId', book_copy_code='$bookCopyCode', book_copy_status='1'";      
                $result2 = mysqli_query($this->db, $sql2) or die(mysqli_connect_errno() . "Data cannot inserted");
            }

            return $result;
        } else {
            return false;
        }
    }

    public function showBooks($table) {

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->data[] = $rows;
        }

        return $this->data;
    }

    public function getBookById($id) {

        $sql = "SELECT * FROM books WHERE book_id='$id'";
        $result = mysqli_query($this->db, $sql);

        while ($rows = mysqli_fetch_array($result)) {
            $this->dataSelect[] = $rows;
        }

        return $this->dataSelect;
    }

    public function updateBook($uid, $bookCode, $bookName, $bookDes, $bookAuthor, $bookQuantity, $bookLanguage, $bookType, $bookStream, $bookCategory) {

        $sql = "SELECT * FROM books WHERE book_name='$bookName' AND book_id != '$uid'";
        $check = $this->db->query($sql);
        $count_row = $check->num_rows;

        //if the data is not in db then insert to the table   
        if ($count_row == 0) {
            $sql1 = "UPDATE books SET book_code='$bookCode', book_name='$bookName', description='$bookDes', author='$bookAuthor', quantity='$bookQuantity', language='$bookLanguage', type='$bookType', stream='$bookStream', category='$bookCategory' WHERE book_id='$uid'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
            return $result;
        } else {
            return false;
        }
    }

    public function delete($id) {

        $sql = "DELETE FROM books WHERE book_id='$id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno() . "Data cannot be deleted");

        if ($result) {
            return $result;
        }
    }

    public function getBookCode() {
        $sql = "SELECT book_id FROM books ORDER BY book_id DESC LIMIT 1";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $bookId = $rows['book_id'] + 1;
        $bookCode = date("Y") . '/' . sprintf("%04d", $bookId);
        return $bookCode;
    }

    public function getAuthorNameById($id) {

        $sql = "SELECT * FROM authors WHERE author_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $authorName = $rows['author_name'];
        return $authorName;
    }

    public function getStreamNameById($id) {

        $sql = "SELECT * FROM book_streams WHERE stream_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $streamName = $rows['stream_name'];
        return $streamName;
    }

    public function getCategoryNameById($id) {

        $sql = "SELECT * FROM book_categories WHERE category_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $categoryName = $rows['category_name'];
        return $categoryName;
    }

    public function getCategoryLanguageById($id) {

        $sql = "SELECT * FROM languages WHERE language_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $languageName = $rows['language'];
        return $languageName;
    }

    public function getCategoryTypeById($id) {

        $sql = "SELECT * FROM types WHERE type_id='$id'";
        $result = mysqli_query($this->db, $sql);
        $rows = mysqli_fetch_array($result);
        $typeName = $rows['type_name'];
        return $typeName;
    }
    
    
    public function getBookCoppiesByBookID($id) {

        $sqlBookCoppies= "SELECT * FROM book_copies WHERE ref_book_id='$id'";
        $resultBookCoppies = mysqli_query($this->db, $sqlBookCoppies);
        $dataBookCoppies = array();     
        while ($rowsLang = mysqli_fetch_array($resultBookCoppies)) {
            $dataBookCoppies[] = $rowsLang;
        }
        return $dataBookCoppies; 
    }
    
    
    public function updateBookCoppyStatus($copyId, $bookStatusId) {
            $sql1 = "UPDATE book_copies SET book_copy_status='$bookStatusId' WHERE book_copy_id='$copyId'";
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot updates");
            return $result;  
    }
    
    public function showBookStatus() {

        $sqlStus= "SELECT * FROM book_status";
        $resultStus = mysqli_query($this->db, $sqlStus);
        $dataStus = array();
        while ($rowsStus= mysqli_fetch_array($resultStus)) {
            $dataStus[] = $rowsStus; 
        }

        return $dataStus;  
    }
}

?>