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
                $bookAuthor = $_POST['book_author'];
                $bookQuantity = $_POST['book_quantity'];
                $bookLanguage = $_POST['book_language'];
                $bookType = $_POST['book_type'];
                $bookStream = $_POST['book_stream'];
                $bookCategory = $_POST['book_category'];
                $addBook = $book->addBooks($bookCode, $bookName, $bookAuthor, $bookQuantity, $bookLanguage, $bookType, $bookStream, $bookCategory);
                if ($addBook) {
                    // Registration Success
                    $success = 'Book details have been successfully added'; 
                } else {
                    // Registration Failed
                    $error = 'Failed! Book details already exits, please try again';
                }
            }
            
            if (isset($_GET['deleteid'])) {
                $uid = $_GET['deleteid'];
                $delete = $book->delete($uid);
            } 
            
            if (isset($_GET['editid'])) {
                $edit_tag = 1;
            } else {
                $bookCode = $addBook = $book->getBookCode(); 
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
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3  id="set-title" class="box-title">Add New Book</h3>
                                </div>
                                <!-- /.box-header -->

                                <!-- form start -->
                                <form action="books_book.php" method="post" class="form-horizontal"> 
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
                                                <input type="text" class="form-control" required id="book_name" name="book_name" placeholder="Book Name">
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
                                                        <option value="<?php echo $author_id; ?>"><?php echo $author_name; ?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_qty" class="col-sm-3 control-label" >Quantity</label>

                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="book_quantity" required name="book_quantity" placeholder="Quantity">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_language" class="col-sm-3 control-label">Language</label>

                                            <div class="col-sm-9">
                                                <select class="form-control" required id="book_language" name="book_language">
                                                    <option value="">- Select Language -</option>
                                                    <option value="Sinhala">Sinhala</option>
                                                    <option value="English">English</option>
                                                    <option value="Tamil">Tamil</option>
                                                    <option value="Spanish">Spanish</option>
                                                    <option value="Japanese">Japanese</option>  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_type" class="col-sm-3 control-label">Type</label>

                                            <div class="col-sm-9" >
                                                <select class="form-control" required id="book_type" name="book_type">
                                                    <option value="">- Select Type -</option>
                                                    <option value="1">Only 2 days</option>
                                                    <option value="2">Only 3 days</option>
                                                    <option value="3">Only 5 days</option>
                                                    <option value="4">Only 7 days</option>
                                                    <option value="5">Only for reading at library</option>
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
                                                        <option value="<?php echo $stream_id; ?>"><?php echo $stream_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_cat" class="col-sm-3 control-label">Category</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" required id="book_category" name="book_category" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option value="">- Select Category -</option>   
                                                    <?php
                                                    foreach ($book->showCategories() as $val) {
                                                        extract($val);
                                                        ?>
                                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
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
                                                    <span id="show-create-btn"><button type="submit" name="save" class="btn btn-success"> &nbsp; Add New &nbsp;  </button></span>
                                                    <?php
                                                }
                                                if ($edit_tag == 1) {
                                                    ?>
                                                    <input type="hidden" name="uid" class='form-control' required value="<?php echo $uid; ?>" >
                                                    <span id="show-create-btn"><button type="submit" name="Update" class="btn btn-success">Update</button></span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                        
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Book List </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered" id="book-tbl">
                                        <tr>
                                            <th>Book Code</th>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Quantity</th>
                                            <th>Language</th>
                                            <th>Type</th>
                                            <th>Stream</th>
                                            <th>Category</th>
                                            <th></th>
                                        </tr>
                                        
                                        <?php
                                        foreach ($book->showBooks("books") as $val) {
                                            extract($val);
                                            $authorName = $book->getAuthorNameById($author); 
                                            $streamName = $book->getStreamNameById($stream); 
                                            $categoryName = $book->getCategoryNameById($category);   
                                            if($type==1){ $typeName = 'Only 2 days';}
                                            elseif ($type==2) {$typeName = 'Only 3 days';}
                                            elseif ($type==3) {$typeName = 'Only 5 days';}
                                            elseif ($type==4) {$typeName = 'Only 5 days';}
                                            else {$typeName ='Only for reading at library';} 
                                              
                                            ?>
                                            <tr>
                                                <td scope="row"><?php echo $book_code; ?></td>
                                                <td><?php echo $book_name; ?></td>  
                                                <td><?php echo $authorName; ?></td>
                                                <td><?php echo $quantity; ?></td>
                                                <td><?php echo $language; ?></td>
                                                <td><?php echo $typeName; ?></td>
                                                <td><?php echo $streamName; ?></td> 
                                                <td><?php echo $categoryName; ?></td>    
                                                <td>
                                                    <a data-toggle="modal" data-target="#show-book-copies" href="books_modal.php?editid=<?php echo $book_id; ?>" >View Copies</a> | <a>Add Copies</a> | <a href="books_book.php?editid=<?php echo $book_id; ?>">Edit</a> | <a href="books_book.php?deleteid=<?php echo $book_id; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-----------------------------------------------Books Page Content------------------------------------->
                    </div>
                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <div class="modal modal-primary fade" id="show-book-copies" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
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