<!DOCTYPE html>
<html>    
    <!-------------------------Header Plugins ----------------------------->
    <title>School Library System | Books Issuing for Students</title>
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
            if (isset($_GET['deleteid'])) {
                $sid = $_GET['deleteid'];
                $delete = $user->delete($sid);
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
                        Books Issuing for Students
                        <small>Student Details Handling</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Student Details Handling</li>
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
                            <div class="row">

                                <div class="col-md-3">

                                    <!-- Profile Image -->
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle" src="img/comman/default_user.png" alt="User profile picture">

                                            <h3 class="profile-username text-center">Student Name</h3>

                                            <p class="text-muted text-center">Student</p>

                                            <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item">
                                                    <b>Id</b> <a class="pull-right">121212FDF44</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Grade</b> <a class="pull-right">10</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Class</b> <a class="pull-right">B</a>
                                                </li>
                                            </ul>

                                            <a href="#studentreg" data-toggle="tab" class="btn btn-primary btn-block"><b>Edit</b></a>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>





                                <div class="col-md-9">     

                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Select Student</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="input-group input-group-sm">
                                                        <input class="form-control input-sm" placeholder="Student Id or Name...">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search margin-r-5"></i> Search</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            You should enter Student Id or name ...
                                        </div> 
                                    </div>


                                    <div class="box box-danger">
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
                                                        <input class="form-control input-sm" placeholder="Book Code or Name...">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-book margin-r-5"></i>Search</button>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" class="form-control pull-right" id="datepicker">
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-danger">Add Book</button>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="col-sm-3">
                                                        <strong><i class="fa fa-book margin-r-5"></i> Book Name</strong>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted">
                                                            Gam Peraliya
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <strong><i class="fa fa-barcode margin-r-5"></i> Book Code</strong>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted">21212121</p>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <strong><i class="fa fa-list margin-r-5"></i> Book Category</strong>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted">O/L</p>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <strong><i class="fa fa-user margin-r-5"></i> Book Author</strong>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted">Martin W.</p>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <strong><i class="fa fa-exchange margin-r-5"></i> Availability</strong>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p>
                                                            <span class="label label-danger">UI Design</span>
                                                            <span class="label label-success">Coding</span>
                                                            <span class="label label-info">Javascript</span>
                                                            <span class="label label-warning">PHP</span>
                                                            <span class="label label-primary">Node.js</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>

                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            You should enter your book code or name ...
                                        </div> 
                                    </div>


                                </div>


                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Books Issuing for Students</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered" id="cat-tbl">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Book</th>
                                                <th>Book Code</th>
                                                <th>Date From</th>
                                                <th>Date To</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($user->showData("users") as $val) {
                                            extract($val);
                                            ?>

                                            <tr>
                                                <td scope="row"><?php echo $uid; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td>Today</td>
                                                <td></td>
                                                <td>
                                                    <a href="add_user.php?editid=<?php echo $uid; ?>">Edit</a> | <a href="add_user.php?deleteid=<?php echo $uid; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>


                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <br/>
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
                                                <span id="show-create-btn"><button type="submit" name="save" class="btn btn-success">Issue Books</button></span>
                                                <?php
                                            }
                                            if ($edit_tag == 1) {
                                                ?>
                                                <input type="hidden" name="uid" class='form-control' required value="<?php echo $uid; ?>" >
                                                <span id="show-create-btn"><button type="submit" name="Update" class="btn btn-success">Issue Books</button></span>
                                            <?php } ?>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">

                                </div>
                            </div>
                            <!-- /.box -->
                        </div>

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