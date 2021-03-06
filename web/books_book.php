<!DOCTYPE html>
<html>
    <!-------------------------Header Plugins ----------------------------->
    <?php include_once 'header_includes.php'; ?>
    <!-------------------------Header Plugins ----------------------------->

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-------------------------Header----------------------------->
            <?php include_once 'l_header.php'; ?>
            <!-------------------------Header----------------------------->


            <?php
            include_once '../controllers/class.book.php';
            $book = new book();

            if (isset($_POST['save'])) {
                $bookCode = $_POST['book_code'];
                $bookName = $_POST['book_name'];
                $bookDes = $_POST['book_des'];
                $bookAuthor = $_POST['book_author'];
                $bookQuantity = $_POST['book_quantity'];
                $bookLanguage = $_POST['book_language'];
                $bookType = $_POST['book_type'];
                $bookStream = $_POST['book_stream'];
                $bookCategory = $_POST['book_category'];
                $addBook = $book->addBooks($bookCode, $bookName, $bookDes, $bookAuthor, $bookQuantity, $bookLanguage, $bookType, $bookStream, $bookCategory);
                if ($addBook) {
                    // Registration Success
                    $success = 'Book details have been successfully added';
                } else {
                    // Registration Failed
                    $error = 'Failed! Book details already exits, please try again';
                }
            }

            if (isset($_POST['Update'])) {
                $uid = strip_tags($_POST['uid']);
                $bookCode = $_POST['book_code'];
                $bookName = $_POST['book_name'];
                $bookDes = $_POST['book_des'];
                $bookAuthor = $_POST['book_author'];
                $bookQuantity = $_POST['book_quantity'];
                $bookLanguage = $_POST['book_language'];
                $bookType = $_POST['book_type'];
                $bookStream = $_POST['book_stream'];
                $bookCategory = $_POST['book_category'];
                $updateBook = $book->updateBook($uid, $bookCode, $bookName, $bookDes, $bookAuthor, $bookQuantity, $bookLanguage, $bookType, $bookStream, $bookCategory);

                if ($updateBook) {
                    // Registration Success
                    $success = 'Book details have been successfully updated';
                } else {
                    // Registration Failed
                    $error = 'Book Failed. Book details already exits, please try again';
                }
            }


            if (isset($_GET['deleteid'])) {
                $uid = $_GET['deleteid'];
                $delete = $book->delete($uid);
            }

            if (isset($_GET['editid'])) {
                $ueditId = $_GET['editid'];
                foreach ($book->getBookById($ueditId) as $val) {
                    extract($val);
                    $uid = $book_id;
                    $bookCode = $book_code;
                    $bookName = $book_name;
                    $bookDes = $description;
                    $bookAuthorId = $author;
                    $bookQuantity = $quantity;
                    $bookLanguageId = $language;
                    $bookTypeId = $type;
                    $bookStreamId = $stream;
                    $bookCategoryId = $category;

                    $edit_tag = 1;
                }

                //$bookCode = $addBook = $book->getBookCode();
                $edit_tag = 1;
            } else {
                $bookCode = $addBook = $book->getBookCode();
                $bookName = '';
                $bookDes = '';
                $bookAuthorId = '';
                $bookQuantity = '';
                $bookLanguageId = '';
                $bookTypeId = '';
                $bookStreamId = '';
                $bookCategoryId = '';
                $edit_tag = 0;
            }
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Books Handling
                        <small>Books Registration..</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Books Handling</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->

                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-----------------------------------------------Books Page Content-------------------------------------> 
                        <div class="col-md-12">
                            <!-- Horizontal Form -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3  id="set-title" class="box-title">Add New Book</h3>
                                </div>
                                <!-- /.box-header -->

                                <!-- form start -->
                                <form action="books_book.php" method="post" name="addBooksForm" class="form-horizontal"> 
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="b_code" class="col-sm-3 control-label">Book Code</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" required id="book_code" name="book_code" value="<?php echo $bookCode; ?>" readonly placeholder="Book Code">
                                            </div>
                                        </div>   

                                        <div class="form-group">
                                            <label for="b_name" class="col-sm-3 control-label">Book Name</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" required id="book_name" name="book_name" value="<?php echo $bookName; ?>" placeholder="Book Name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_cat_name" class="col-sm-3 control-label">Book Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="book_des" name="book_des" rows="3" placeholder="Enter Book Description..." ><?php echo $bookDes; ?></textarea>
                                            </div>  
                                        </div>

                                        <div class="form-group"> 
                                            <label for="b_language" class="col-sm-3 control-label">Language</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" required id="book_language" name="book_language" onchange="getBookCode()" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Language -</option>
                                                    <?php
                                                    foreach ($book->showLanguages() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <?php if ($bookLanguageId == $language_id) { ?>
                                                            <option selected value="<?php echo $language_id; ?>"><?php echo $language; ?></option> 
                                                        <?php } else { ?>     
                                                            <option value="<?php echo $language_id; ?>"><?php echo $language; ?></option>  
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_cat" class="col-sm-3 control-label">Category</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" required id="book_category" name="book_category" onchange="getBookCode()" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Category -</option>   
                                                    <?php
                                                    foreach ($book->showCategories() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <?php if ($bookCategoryId == $category_id) { ?>
                                                            <option selected="" value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                        <?php } ?>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="b_author" class="col-sm-3 control-label">Author</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" required id="book_author" name="book_author" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Author -</option>
                                                    <?php
                                                    foreach ($book->showAuthors() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <?php if ($bookAuthorId == $author_id) { ?>
                                                            <option selected value="<?php echo $author_id; ?>"><?php echo $author_name; ?></option> 
                                                        <?php } else { ?>     
                                                            <option value="<?php echo $author_id; ?>"><?php echo $author_name; ?></option>  
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_qty" class="col-sm-3 control-label" >Quantity</label>

                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="book_quantity" required name="book_quantity" value="<?php echo $bookQuantity; ?>" placeholder="Quantity">
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label for="b_type" class="col-sm-3 control-label">Type</label>

                                            <div class="col-sm-9" >

                                                <select class="form-control select2 select2-hidden-accessible" required id="book_type" name="book_type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Type -</option>
                                                    <?php
                                                    foreach ($book->showTypes() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <?php if ($bookTypeId == $type_id) { ?>
                                                            <option selected value="<?php echo $type_id; ?>"><?php echo $type_name; ?></option> 
                                                        <?php } else { ?>     
                                                            <option value="<?php echo $type_id; ?>"><?php echo $type_name; ?></option>  
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_strm" class="col-sm-3 control-label">Stream</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" id="book_stream" name="book_stream" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Stream -</option>
                                                    <?php
                                                    foreach ($book->showStreams() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <?php if ($bookStreamId == $stream_id) { ?>
                                                            <option selected="" value="<?php echo $stream_id; ?>"><?php echo $stream_name; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $stream_id; ?>"><?php echo $stream_name; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <?php if (isset($success)) { ?>
                                                    <div class="alert alert-info">
                                                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $success; ?> !
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($error)) { ?>
                                                    <div class="alert alert-danger">
                                                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                                                    </div>
                                                <?php } ?>

                                                <?php if ($edit_tag == 0) { ?>
                                                    <span id="show-create-btn"><button type="submit" name="save" class="btn btn-primary"> &nbsp; Add New &nbsp;  </button></span>
                                                    <?php
                                                }
                                                if ($edit_tag == 1) {
                                                    ?>
                                                    <input type="hidden" name="uid" class='form-control' required value="<?php echo $uid; ?>" >
                                                    <span id="show-create-btn"><button type="submit" name="Update" class="btn btn-warning">Update</button></span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                        <?php ?>


                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Book List </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div >
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-bordered addedbooklist" id="book-tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Book Code</th>
                                                        <th>Book Name</th>
                                                        <!--<th>Description</th>-->
                                                        <th>Author</th>
                                                        <th>Quantity</th>
                                                        <!--<th>Language</th>-->
                                                        <th>Type</th>
                                                        <th>Stream</th>
                                                        <!--<th>Category</th>-->
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($book->showBooks("books") as $val) {
                                                    extract($val);
                                                    $authorName = $book->getAuthorNameById($author);
                                                    $streamName = $book->getStreamNameById($stream);
                                                    $categoryName = $book->getCategoryNameById($category);
                                                    $languageName = $book->getCategoryLanguageById($language);
                                                    $typeName = $book->getCategoryTypeById($type);
                                                    ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $book_code; ?></td>
                                                            <td><?php echo $book_name; ?></td>  
                                                            <!--<td><?php // echo $description; ?></td>-->  
                                                            <td><?php echo $authorName; ?></td>
                                                            <td><?php echo $quantity; ?></td>
                                                            <!--<td><?php // echo $languageName; ?></td>-->
                                                            <td><?php echo $typeName; ?></td>
                                                            <td><?php echo $streamName; ?></td> 
                                                            <!--<td><?php // echo $categoryName; ?></td>-->    
                                                            <td style="min-width: 180px; width: 180px;">
                                                                <a data-toggle="tooltip" title="Edit" class="btn btn-warning" href="books_book.php?editid=<?php echo $book_id; ?>"><span class="fa fa-pencil"></span></a>
                                                                <span data-toggle="tooltip" title="Add Copies"><a class="btn btn-danger"  data-toggle="modal" data-target="#add-book-copies"><span class="fa fa-plus"></span></a></span>
                                                                <span data-toggle="tooltip" title="Availability of Copies"><a class="btn btn-facebook" data-toggle="modal" data-target="#show-book-copies" href="books_modal.php?editid=<?php echo $book_id; ?>" ><span class="fa fa-copy"></span></a></span>
                                                                <a data-toggle="tooltip" title="Delete" class="btn bg-navy" href="books_book.php?deleteid=<?php echo $book_id; ?>" onclick="return confirm('Are you sure?');"><span class="fa fa-trash"></span></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <!--                                <div class="box-footer clearfix">
                                                                    <ul class="pagination pagination-sm no-margin pull-right">
                                                                        <li><a href="#">&laquo;</a></li>
                                                                        <li><a href="#">1</a></li>
                                                                        <li><a href="#">2</a></li>
                                                                        <li><a href="#">3</a></li>
                                                                        <li><a href="#">&raquo;</a></li>
                                                                    </ul>
                                                                </div>-->
                            </div>

                            <?php
                            if (isset($_POST['saveModal'])) {
                                $cnt = $_POST['noOfCoppies'];
                                for ($x = 1; $x < $cnt; $x++) {
                                    $copyId = $_POST['coppyId_' . $x];
                                    $bookStatusId = $_POST['bookStatus_' . $x];
                                    $updateBook = $book->updateBookCoppyStatus($copyId, $bookStatusId);
                                }
                            }
                            ?>

                            <!-- /.box -->
                        </div>
                        <!-----------------------------------------------Books Page Content------------------------------------->
                    </div>
                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-----------------------------------------------Modal One - Book Copies Availability------------------------------------->
            <div class="modal modal-primary fade" id="show-book-copies" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>

            <!-----------------------------------------------Modal Two - Add New Book Copies------------------------------------->
            <div class="modal" id="add-book-copies" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Add New Book Copies</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-5">Book Name : </label>
                                    <div class="col-md-7">Gamperaliya</div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-md-5">No of Copies in the System : </label>
                                    <div class="col-md-7">10</div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="book_add_copy" class="col-sm-5 control-label">No of Newly Adding Copies : </label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control" id="book_add_copy" placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger">Add Copies</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-----------------------------------------------Modal End------------------------------------->


            <!-------------------------Footer----------------------------->
            <?php
            include_once 'l_footer.php';
            ?>
            <!-------------------------Footer----------------------------->





            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->


        <script>
                                                    function getBookCode() {
                                                        var catID = $('#book_category').val();
                                                        var lanID = $('#book_language').val();
                                                        var bookCode = $('#book_code').val();
                                                        var lastItem = bookCode.split("/").pop(-1);
                                                        var today = new Date();
                                                        var year = today.getFullYear();

                                                        if (catID != '' && lanID != '') {

                                                            var lng = $('#book_language').find(":selected").text();
                                                            var lngCode = lng.substring(0, 3);

                                                            var cat = $('#book_category').find(":selected").text();
                                                            var categoryCode = cat.substring(0, 3);

                                                            //var bla = $('#book_category').find(":selected").text();
                                                            //var matches = bla.match(/\b(\w)/g);
                                                            // var categoryCode = matches.join('');

                                                            var bookCodeNew = lngCode + '/' + categoryCode + '/' + year + '/' + lastItem;
                                                            var bookCodeNewUpp = bookCodeNew.toUpperCase();
                                                            $('#book_code').val(bookCodeNewUpp);
                                                        } else {
                                                            var bookCodeNew = year + '/' + lastItem;
                                                            var bookCodeNewUpp = bookCodeNew.toUpperCase();
                                                            $('#book_code').val(bookCodeNewUpp);
                                                        }


                                                    }


        </script>


        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="js/jquery-ui.min.js.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
            $(function() {
                //Initialize Select2 Elements
                $(".select2").select2();


                $(".addedbooklist").DataTable();
            });
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="js/raphael-min.js"></script>
        <script src="plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="plugins/knob/jquery.knob.js"></script>
        <!-- Select2 -->
        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="plugins/input-mask/jquery.inputmask.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- daterangepicker -->
        <script src="js/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!--<script src="js/pages/dashboard.js"></script>-->
        <!-- AdminLTE for demo purposes -->
        <script src="js/demo.js"></script>

        <script src="js/pages/books.js"></script>
    </body>
</html>