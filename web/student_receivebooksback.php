<!DOCTYPE html>
<html>    
    <!-------------------------Header Plugins ----------------------------->
    <title>School Library System | Books Receiving from Students</title>
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
                        Books Receiving from Students
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


                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">List of Borrowed Books</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered" id="cat-tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Book Code</th>
                                                        <th>Book</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Penalty</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                foreach ($user->showData("users") as $val) {
                                                    extract($val);
                                                    ?>

                                                <tr>
                                                    <td scope="row"><?php echo $uid; ?></td>
                                                    <td>Gam Peraliya</td>
                                                    <td>20-01-2017</td>
                                                    <td>02-02-2017</td>
                                                    <td> Rs. 50.00 &nbsp;&nbsp;<span class="btn btn-warning" >Pay</span></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="checkbox" name="status">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="br_reason" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option selected="selected">None</option>
                                                            <option>Lost</option>
                                                            <option>Damaged</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td scope="row"><?php echo $uid; ?></td>
                                                    <td>Gam Peraliya</td>
                                                    <td>20-01-2017</td>
                                                    <td>25-02-2017</td>
                                                    <td> 2 days more </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="checkbox" name="status">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="br_reason" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                            <option selected="selected">None</option>
                                                            <option>Lost</option>
                                                            <option>Damaged</option>
                                                        </select>
                                                    </td>
                                                </tr>
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


                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">

                                        </div>
                                    </div>


                                </div>


                            </div>
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
        <!-- iCheck 1.0.1 -->
        <script src="plugins/iCheck/icheck.min.js"></script>
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


                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                });

//                //iCheck for checkbox and radio inputs
//                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//                    checkboxClass: 'icheckbox_minimal-blue',
//                    radioClass: 'iradio_minimal-blue'
//                });
//                //Red color scheme for iCheck
//                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
//                    checkboxClass: 'icheckbox_minimal-red',
//                    radioClass: 'iradio_minimal-red'
//                });
//                //Flat red color scheme for iCheck
//                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//                    checkboxClass: 'icheckbox_flat-green',
//                    radioClass: 'iradio_flat-green'
//                });


            });


        </script>
        <script src="js/pages/books.js"></script>
    </body>
</html>