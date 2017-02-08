<?php
//include_once 'l_header.php';
session_start();
include_once '../controllers/class.user.php';
$user = new user();
include_once '../controllers/class.book.php';
$book = new book();

if (isset($_GET['editid'])) {
    $bookEditId = $_GET['editid'];
}
?>

<!-- form start -->
<form action="books_book.php" method="post" class="form-horizontal"> 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Book Copies Availability</h4>
    </div>
    <div class="modal-body">
        <div class="row">

            <div class="col-md-12">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered" id="book-tbl">
                        <tr>
                            <th>Book Copy Code</th>
                            <th>Status</th>
                        </tr>

                        <?php
                        $bookCoppies = $book->getBookCoppiesByBookID($bookEditId); 
                        $coppiesCount = count($bookCoppies);  
                        $x = 1;
                        if ($coppiesCount > 0) {                     
                            foreach ($bookCoppies as $val) { 
                                extract($val);
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $book_copy_code ?>
                                        <input type="hidden" name="coppyId_<?php echo $x; ?>" value="<?php echo $book_copy_id; ?>">
                                    </td>
                                    <td> 
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                
                                                <select class="form-control" id="bookStatus_<?php echo $x; ?><" name="bookStatus_<?php echo $x; ?>">
                                                    <?php
                                                    $BookStatus = $book->showBookStatus();
                                                     
                                                    foreach ($BookStatus as $valSt) {   
                                                        extract($valSt);
                                                        ?>
                                                        <?php if ($book_copy_status == $book_status_id) { ?>
                                                            <option selected="" value="<?php echo $book_status_id; ?>"><?php echo $name; ?></option> 
                                                        <?php } else { ?>
                                                            <option value="<?php echo $book_status_id; ?>"><?php echo $name; ?></option>
                                                        <?php } ?>                                                        
                                                    <?php } 
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php $x++; }
                        }
                        ?>

                    </table>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="noOfCoppies" value="<?php echo $x ?>">
        <button type="submit" name="saveModal" class="btn btn-primary" > Save Changes </button>
        <button type="submit" name="closeModal" class="btn btn-default" >Close</button>
    </div>
</form>