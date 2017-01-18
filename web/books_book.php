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
                                <form class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="b_code" class="col-sm-3 control-label">Book Code</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="b_code" name="b_code" placeholder="Book Code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="b_name" class="col-sm-3 control-label">Book Name</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="b_name" placeholder="Book Name">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="b_author" class="col-sm-3 control-label">Author</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" id="b_author" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                                            <label for="b_qty" class="col-sm-3 control-label">Quantity</label>

                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="b_qty" placeholder="Quantity">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_language" class="col-sm-3 control-label">Language</label>

                                            <div class="col-sm-9">
                                                <select class="form-control" id="b_language">
                                                    <option>Select Language...</option>
                                                    <option>Sinhala</option>
                                                    <option>English</option>
                                                    <option>Tamil</option>
                                                    <option>Spanish</option>
                                                    <option>Japanese</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_author" class="col-sm-3 control-label">Type</label>

                                            <div class="col-sm-9">
                                                <select class="form-control" id="b_ty">
                                                    <option>Select Type...</option>
                                                    <option>Can keep 7 days</option>
                                                    <option>Only 3 days</option>
                                                    <option>Only for reading at library</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="b_cat" class="col-sm-3 control-label">Stream</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" id="b_cat" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                                            <label for="b_cat2" class="col-sm-3 control-label">Category</label>

                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible" id="b_cat2" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                                                <span id="show-create-btn"><button type="submit" class="btn btn-danger">Add New</button></span>
                                                <span id="show-update-btn" style="display: none;"><button type="submit" class="btn btn-info">Update</button></span>
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
                                            <th>Category I</th>
                                            <th>Category II</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>11111</td>
                                            <td>Village By the Sea</td>
                                            <td>Anita Desai</td>
                                            <td>10</td>
                                            <td>English</td>
                                            <td>Can keep 7 days</td>
                                            <td>Art</td>
                                            <td>Novel</td>
                                            <td><a data-toggle="modal" data-target="#show-book-copies">View Copies</a> | <a>Add Copies</a> | <a onclick="updateBook(this);">Edit</a> | <a onclick="deleteTblRow(this);">Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td>11111</td>
                                            <td>Village By the Sea</td>
                                            <td>Anita Desai</td>
                                            <td>10</td>
                                            <td>English</td>
                                            <td>Can keep 7 days</td>
                                            <td>Art</td>
                                            <td>Novel</td>
                                            <td><a data-toggle="modal" data-target="#show-book-copies">View Copies</a> | <a>Add Copies</a> | <a onclick="updateBook(this);">Edit</a> | <a onclick="deleteTblRow(this);">Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td>11111</td>
                                            <td>Village By the Sea</td>
                                            <td>Anita Desai</td>
                                            <td>10</td>
                                            <td>English</td>
                                            <td>Can keep 7 days</td>
                                            <td>Art</td>
                                            <td>Novel</td>
                                            <td><a data-toggle="modal" data-target="#show-book-copies">View Copies</a> | <a>Add Copies</a> | <a onclick="updateBook(this);">Edit</a> | <a onclick="deleteTblRow(this);">Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td>11111</td>
                                            <td>Village By the Sea</td>
                                            <td>Anita Desai</td>
                                            <td>10</td>
                                            <td>English</td>
                                            <td>Can keep 7 days</td>
                                            <td>Art</td>
                                            <td>Novel</td>
                                            <td><a data-toggle="modal" data-target="#show-book-copies">View Copies</a> | <a>Add Copies</a> | <a onclick="updateBook(this);">Edit</a> | <a onclick="deleteTblRow(this);">Delete</a></td>
                                        </tr>
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
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Book Copies</h4>
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
                                            <tr>
                                                <td>11111</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="b_status">
                                                                <option selected>Missing</option>
                                                                <option>Stolen</option>
                                                                <option>Not Returned</option>
                                                                <option>Available</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11111</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="b_status">
                                                                <option>Missing</option>
                                                                <option selected>Stolen</option>
                                                                <option>Not Returned</option>
                                                                <option>Available</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11111</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="b_status">
                                                                <option>Missing</option>
                                                                <option>Stolen</option>
                                                                <option>Not Returned</option>
                                                                <option selected>Available</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11111</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="b_status">
                                                                <option>Missing</option>
                                                                <option>Stolen</option>
                                                                <option>Not Returned</option>
                                                                <option selected>Available</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->

                                </div>
                                <!-- /.box -->
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
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