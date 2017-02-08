<!DOCTYPE html>
<html>    
    <!-------------------------Header Plugins ----------------------------->
    <title>School Library System | Borrowing Books by Students</title>
    <?php include_once 'header_includes.php'; ?>
    <!-------------------------Header Plugins ----------------------------->

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-------------------------Header----------------------------->
            <?php
            include_once 'l_header.php';
            ?>
            <!-------------------------Header----------------------------->

            <?php
            include_once '../controllers/class.student.php';
            include_once '../controllers/class.book.php';
            $student = new student();
            $book = new book();

            $studentId = '';
            $studCode = '';
            $studGrade = '';
            $studClass = '';
            $studMedium = '';
            $streamName = '';
            $languageName = '';
            $typeName = '';
            $studFullName = '';
            $studAddress = '';
            $studEmail = '';
            $bookCopyId = '';
            $bookCode = '';
            $bookCopyCode = '';
            $bookName = '';
            $author = '';
            $category = '';


            if (isset($_GET['newpage'])) {
                $TrancateTmpTable = $book->truncateTmpTable();
            }

            if (isset($_GET['deleteTmpId'])) {
                $_POST['selectedStudId'] = $_GET['refStudID'];
                $delTmpId = $_GET['deleteTmpId'];
                $deleteTmp = $book->deleteTmpByID($delTmpId);
            }

            if (isset($_POST['searchStu'])) {
                $searchText = $_POST['searchText'];
                $studentData = $student->getStudntByNameORCode($searchText);
                if (count($studentData) > 0 && $searchText != '') {
                    foreach ($studentData as $val) {
                        extract($val);
                        $studentId = $student_id;
                        $studCode = $student_code;
                        $studGrade = $grade;
                        $studClass = $class;
                        $studMedium = $medium;
                        $studFullName = $full_name;
                        $studAddress = $address;
                        $studEmail = $email;
                    }
                }
            } elseif (isset($_POST['selectedStudId']) && $_POST['selectedStudId'] != '') {
                $selectedStudId = $_POST['selectedStudId'];
                $studentData2 = $student->getStudentById($selectedStudId);
                if (count($studentData2) > 0) {
                    foreach ($studentData2 as $val2) {
                        extract($val2);
                        $studentId = $student_id;
                        $studCode = $student_code;
                        $studGrade = $grade;
                        $studClass = $class;
                        $studMedium = $medium;
                        $studFullName = $full_name;
                        $studAddress = $address;
                        $studEmail = $email;
                    }
                }
            }

            if (isset($_POST['searchBook'])) {
                $searchBookText = $_POST['searchBookText'];
                $booksData = $book->getBookByNameORCode($searchBookText);
                if (count($booksData) > 0 && $searchBookText != '') {
                    foreach ($booksData as $valb) {
                        extract($valb);
                        $bookCopyId = $book_copy_id;
                        $bookCode = $book_code;
                        $bookCopyCode = $book_copy_code;
                        $bookName = $book_name;
                        $author = $book->getAuthorNameById($author);
                        $category = $book->getCategoryNameById($category);
                        $streamName = $book->getStreamNameById($stream);
                        $languageName = $book->getCategoryLanguageById($language);
                        $typeName = $book->getCategoryTypeById($type);
                    }
                }
            }

            if (isset($_POST['addBook'])) {
                $vardate = $_POST['selDate'];
                $datecon = str_replace('/', '-', $vardate);
                $dbDate = date('Y-m-d', strtotime($datecon));

                $dbStudId = $_POST['selectedStudId'];
                $dbBookCopyId = $_POST['selBookCopyId'];
                $dbDate = $dbDate;
                $addTmoBook = $book->borrowTmpBooks($dbStudId, $dbBookCopyId, $dbDate);
            }

            if (isset($_POST['issueBook'])) {
                $issueBook = $book->issueBooks();
            }


            if (isset($_POST['save'])) {
                $fullname = $_POST['fullname'];
                $sgrade = $_POST['grade'];
                $saddress = $_POST['address'];
                $semail = $_POST['email'];
                $stelephone = $_POST['telephone'];
                $register = $user->reg_user($fullname, $uname, $upass, $umail);
                if ($register) {
                    // Registration Success
                    $success = 'User details have been successfully added';
                } else {
                    // Registration Failed
                    $error = 'Failed! Email or Username already exits please try again';
                }
            }

            if (isset($_GET['editid'])) {
                $ueditId = $_GET['editid'];
                foreach ($user->get_userbyid($ueditId) as $val) {
                    extract($val);
                    $nameEdit = $uname;
                    $fullnameEdit = $fullname;
                    $emailEdit = $uemail;
                    $edit_tag = 1;
                }
            } else {
                $nameEdit = '';
                $fullnameEdit = '';
                $emailEdit = '';
                $edit_tag = 0;
            }

            if (isset($_POST['Update'])) {
                $fullname = strip_tags($_POST['fullname']);
                $uname = strip_tags($_POST['Uname']);
                $umail = strip_tags($_POST['email']);
                $upass = strip_tags($_POST['password']);
                $uid = strip_tags($_POST['uid']);

                $register = $user->update_user($uid, $fullname, $uname, $upass, $umail);

                if ($register) {
                    // Registration Success
                    $success = 'User details have been successfully updated!';
                } else {
                    // Registration Failed
                    $error = 'Update Failed. Email or Username already exits please try again';
                }
            }
            ?> 


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Borrowing Books by Students
                        <small>Books Borrowing Details..</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Borrowing Books by Students</li>
                    </ol>
                </section>


                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-----------------------------------------------Books Issuing for Students Page Content-------------------------------------> 

                        <div class="col-md-12">  
                            <form action="student_issuebooks.php" name="search" method="post" class="form-horizontal">   
                                <div class="row">

                                    <div class="col-sm-3">

                                        <!-- Profile Image -->
                                        <div class="box box-primary">
                                            <div class="box-body box-profile">
                                                <img class="profile-user-img img-responsive img-circle" src="img/comman/default_user.png" alt="User profile picture">

                                                <h3 class="profile-username text-center"><?php echo $studFullName; ?></h3>

                                                <p class="text-muted text-center">Student</p>

                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                        <b>Id</b> <a class="pull-right"><?php echo $studCode; ?></a>
                                                    </li>
                                                    <!--                                                    <li class="list-group-item">
                                                                                                            <b>Name</b> <a class="pull-right"></a>
                                                                                                        </li>-->
                                                    <li class="list-group-item">
                                                        <b>Grade</b> <a class="pull-right"><?php echo $studGrade; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Class</b> <a class="pull-right"><?php echo $studClass; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Medium</b> <a class="pull-right"><?php echo $studMedium; ?></a>
                                                    </li>

                                                </ul>
                                                <input type="hidden" name="selectedStudId" value="<?php echo $studentId; ?>" >    
                                                <a href="#studentreg" data-toggle="tab" class="btn btn-primary btn-block"><b>Edit</b></a>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>





                                    <div class="col-sm-9">     

                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Select Student</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="input-group input-group-sm">
                                                            <input class="form-control input-sm" name="searchText" id="searchText" placeholder="Student Id or Name...">
                                                            <span class="input-group-btn">
                                                                <button type="submit" name="searchStu" class="btn btn-primary btn-flat"><i class="fa fa-search margin-r-5"></i> Search</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.row -->

                                            </div>

                                            <?php if (isset($_POST['searchStu']) && $studentId == '') { ?>  
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info"> 
                                                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; No Student Found! Please Try Again! 
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <!-- /.box-body -->
                                            <div class="box-footer">
                                                You should enter Student Id or name ...
                                            </div> 
                                        </div>

                                        <div class="box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Select Books</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">

                                                    <div class="col-sm-7">
                                                        <div class="input-group input-group-sm">
                                                            <input class="form-control input-sm" name="searchBookText" id="searchBookText" placeholder="Book Code or Name...">
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-danger btn-flat" name="searchBook" id="searchBook"><i class="fa fa-book margin-r-5"></i>Search</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="datepicker"  name="selDate" value="<?php echo date("d/m/Y"); ?>">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <input type="hidden" name="selBookCopyId" id="selBookCopyId" class='form-control' required value="<?php echo $bookCopyId; ?>" >
                                                        <button type="submit" class="btn btn-danger" name="addBook" id="addBook" >Add Book</button>
                                                    </div>
                                                    <?php if (isset($_POST['searchBook']) && $studentId != '') { ?>

                                                        <?php if (isset($_POST['searchBook']) && count($booksData) > 0) { ?>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-book margin-r-5"></i> Book Name</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted">
                                                                        <?php echo $bookName; ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-barcode margin-r-5"></i> Book Copy Code</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted"><?php echo $bookCopyCode; ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-list margin-r-5"></i> Book Category</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted"><?php echo $category; ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-user margin-r-5"></i> Book Author</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted"><?php echo $author; ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-user margin-r-5"></i>Language</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted"><?php echo $languageName; ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3">
                                                                    <strong><i class="fa fa-user margin-r-5"></i>Type</strong>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <p class="text-muted"><?php echo $typeName; ?></p>
                                                                </div>
                                                            </div>


                                                        <?php } else { ?>
                                                            <div class="col-sm-12">
                                                                <div class="alert alert-info"> 
                                                                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; No Book Found! Please Try Again!
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if (isset($_POST['searchBook']) && $studentId == '') { ?>
                                                        <div class="col-sm-12">
                                                            <div class="alert alert-info"> 
                                                                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Please Select a Student First!
                                                            </div>
                                                        </div>
                                                    <?php } ?>


                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>

                                                    <?php
                                                    $borrowedBooks = $book->getBorrowedBooks($studentId);
                                                    if (count($borrowedBooks) > 0) {
                                                        ?> 

                                                        <div class="col-sm-12">
                                                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Borrowed Books History </strong>

                                                            <div class="col-md-12 table-responsive" style="padding-top: 10px;">
                                                                <table class="table table-bordered" id="book-issue-tbl">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Book</th>
                                                                            <th>Book Code</th>
                                                                            <th>Date From</th>
                                                                            <th>Date To</th>
                                                                            <th style="width: 100px;"></th>
                                                                        </tr>
                                                                    </thead>


                                                                    <?php
                                                                    foreach ($borrowedBooks as $valbrBok) {
                                                                        extract($valbrBok);
                                                                        foreach ($book->getBookByBookCopyId($br_book_copy_id) as $valCopy) {
                                                                            extract($valCopy);
                                                                            $brrCopyBookName = $book_name;
                                                                            $brrCopyBookCode = $book_copy_code;
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td scope="row"><?php echo $brrCopyBookCode; ?></td>  
                                                                            <td><?php echo $brrCopyBookName; ?></td>
                                                                            <td><?php echo $br_issue_date; ?></td>  
                                                                            <td><?php echo $br_return_date; ?></td>           
                                                                            <td>
                                                                                <a data-toggle="tooltip" title="Receiving Books" class="btn btn-success" href="add_user.php?editid="><span class="glyphicon glyphicon-check"></span></a>
                                                                                <!--<a class="btn bg-navy" href="student_issuebooks.php?deleteTmpId=<?php //echo $borrow_books_tem_id;         ?>&refStudID=<?php //echo $studentId;         ?>" onclick="return confirm('Are you sure?');"><span class="fa fa-trash"></span></a>-->
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>

                                                                </table>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="alert alert-danger">
                                                                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Select a Student first!
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="alert alert-info"> 
                                                                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Select a Student first!
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-12">
                                                                <div class="alert alert-warning"> 
                                                                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Select a Student first!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?> 
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.box-body -->

                                        </div>


                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Books Issuing for Students</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-bordered" id="book-issue-tbl">
                                                    <thead>
                                                        <tr>
                                                            <th>Book Code</th>
                                                            <th>Book Name</th>
                                                            <th>Date From</th>
                                                            <th>Date To</th>
                                                            <th style="width: 100px;"></th>
                                                        </tr>
                                                    </thead>


                                                    <?php
                                                    foreach ($book->getTmpBooks($studentId) as $val) {
                                                        extract($val);
                                                        foreach ($book->getBookByBookCopyId($book_copy_id) as $valCopy) {
                                                            extract($valCopy);
                                                            $copyBookName = $book_name;
                                                            $copyBookCode = $book_copy_code;
                                                        }
                                                        //$returnDate = $book->getBookRetunDateByCopyID($book_copy_id, $issue_date);    
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $copyBookCode; ?></td>  
                                                            <td><?php echo $copyBookName; ?></td>
                                                            <td><?php echo $issue_date; ?></td>  
                                                            <td><?php echo $return_date; ?></td>        
                                                            <td>
                                                                <a class="btn bg-navy" href="student_issuebooks.php?deleteTmpId=<?php echo $borrow_books_tem_id; ?>&refStudID=<?php echo $studentId; ?>" onclick="return confirm('Are you sure?');"><span class="fa fa-trash"></span></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </table>


                                                <div class="form-group">
                                                    <div class="col-sm-12 text-right">
                                                        <br/>
                                                        <input type="hidden" name="refStudCode" id="refStudCode" class='form-control' required value="<?php //echo $studCode;                         ?>" >
                                                        <span id="show-create-btn"><button type="submit" name="issueBook" class="btn btn-primary">Issue Books</button></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer clearfix">

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>

                        <?php
                        ?>

                        <!-----------------------------------------------Books Issuing for Students Page Content------------------------------------->
                    </div>
                    <!-- /.row (main row) -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


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
        <script>
                                                                    $.widget.bridge('uibutton', $.ui.button);
                                                                    $(function() {
                                                                        //Initialize Select2 Elements
                                                                        $(".select2").select2();
                                                                    });

                                                                    //Date picker
                                                                    $('#datepicker').datepicker({
                                                                        autoclose: true
                                                                    });
        </script>
        <script src="js/pages/books.js"></script>
    </body>
</html>