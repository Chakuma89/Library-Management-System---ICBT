<!DOCTYPE html>
<html>    
    <!-------------------------Header Plugins ----------------------------->
    <title>School Library System | User Registration</title>
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
                $uid = $_GET['deleteid'];
                $delete = $user->delete($uid);
            }
            if (isset($_POST['save'])) {
                $uname = $_POST['Uname'];
                $fullname = $_POST['fullname'];
                $umail = $_POST['email'];
                $upass = $_POST['password'];
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
                        User Registration
                        <small>User Details Handling..</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Registration</li>
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
                        <!-----------------------------------------------Books Page Content-------------------------------------> 

                        <div class="col-md-12">                          
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 id="set-title" class="box-title">Add New User</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form action="add_user.php" method="post" class="form-horizontal">    
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="c_code" class="col-sm-3 control-label">User Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Uname" required name="Uname" placeholder="User Name" value="<?php echo $nameEdit; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" value="<?php echo $fullnameEdit; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" required name="email" placeholder="Email" value="<?php echo $emailEdit; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password" required name="password" placeholder="Password">
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
                                                    <span id="show-create-btn"><button type="submit" name="save" class="btn btn-primary">Add New User</button></span>
                                                    <?php
                                                }
                                                if ($edit_tag == 1) {
                                                    ?>
                                                    <input type="hidden" name="uid" class='form-control' required value="<?php echo $uid; ?>" >
                                                    <span id="show-create-btn"><button type="submit" name="Update" class="btn btn-warning">Update User</button></span>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">User List </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-bordered" id="user-tbl">
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Full Name</th>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th style="width: 90px;"></th>
                                                </tr>
                                            </thead>
                                            <?php
                                            foreach ($user->showData("users") as $val) {
                                                extract($val);
                                                ?>

                                                <tr>
                                                    <td scope="row"><?php echo $uid; ?></td>
                                                    <td><?php echo $uname; ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $uemail; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning" href="add_user.php?editid=<?php echo $uid; ?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn bg-navy" href="add_user.php?deleteid=<?php echo $uid; ?>" onclick="return confirm('Are you sure?');"><span class="fa fa-trash"></span></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">

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
                                                            $("#user-tbl").DataTable();
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