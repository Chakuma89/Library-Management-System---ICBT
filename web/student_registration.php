<!DOCTYPE html>
<html>    
    <!-------------------------Header Plugins ----------------------------->
    <title>School Library System | Student Registration</title>
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
            $student = new student();


            if (isset($_GET['deleteid'])) {
                $sid = $_GET['deleteid'];
                $delete = $student->deleteStudent($sid);   
            }
            if (isset($_POST['save'])) {
                $studentCode = $_POST['studentCode'];
                $fullname = $_POST['fullname'];
                $sGrade = $_POST['Sgrade'];
                $sClass = $_POST['Sclass'];
                $sMedium = $_POST['Smedium'];
                $sGrade = $_POST['Sgrade'];
                $sAddress = $_POST['saddress'];
                $sEmail = $_POST['semail'];
                $register = $student->addStudent($studentCode, $fullname, $sGrade, $sClass, $sMedium, $sAddress, $sEmail);
                if ($register) {
                    // Registration Success
                    $success = 'Student details have been successfully added';
                } else {
                    // Registration Failed
                    $error = 'Failed! Student details already exits, please try again';
                }
            }

            if (isset($_GET['editid'])) {
                $ueditId = $_GET['editid'];
                foreach ($student->getStudentById($ueditId) as $val) {
                    extract($val);
                    $studentId = $student_id;
                    $studCode = $student_code;
                    $studGrade = $grade;
                    $studClass = $class;
                    $studMedium = $medium;
                    $studFullName = $full_name;
                    $studAddress = $address;
                    $studEmail = $email;
                    $edit_tag = 1;
                }
            } else {
                $studCode = $student->getStudentCode();
                $studGrade = '';
                $studClass = '';
                $studMedium = '';
                $studFullName = '';
                $studAddress = '';;
                $studEmail = '';
                $edit_tag = 0;
            }

            if (isset($_POST['Update'])) {

                $studentCode = $_POST['studentCode'];
                $fullname = $_POST['fullname'];
                $sGrade = $_POST['Sgrade'];
                $sClass = $_POST['Sclass'];
                $sMedium = $_POST['Smedium'];
                $sGrade = $_POST['Sgrade'];
                $sAddress = $_POST['saddress'];
                $sEmail = $_POST['semail'];
                $uid = strip_tags($_POST['uid']);

                $register = $student->updateStudent($uid, $studentCode, $fullname, $sGrade, $sClass, $sMedium, $sAddress, $sEmail);

                if ($register) {
                    // Registration Success
                    $success = 'Student details have been successfully updated!';
                } else {
                    // Registration Failed
                    $error = 'Failed! Student details already exits, please try again';
                }
            }
            ?> 


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Student Registration
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
                        <!-----------------------------------------------Student Registration Page Content-------------------------------------> 

                        <div class="col-md-12">                          
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 id="set-title" class="box-title">Add New Student</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form action="student_registration.php" method="post" class="form-horizontal">    
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Student ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="studentCode" name="studentCode" required placeholder="Student ID" value="<?php echo $studCode; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" required value="<?php echo $studFullName; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_code" class="col-sm-3 control-label">Grade</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" required id="Sgrade" name="Sgrade" onchange="getStudentCode()">
                                                    <option value="">Select Grade...</option>  
                                                    <option <?php if ($studGrade == "6") echo 'selected="selected"'; ?> value="6">6</option>
                                                    <option <?php if ($studGrade == "7") echo 'selected="selected"'; ?> value="7">7</option>
                                                    <option <?php if ($studGrade == "8") echo 'selected="selected"'; ?> value="8">8</option>
                                                    <option <?php if ($studGrade == "9") echo 'selected="selected"'; ?> value="9">9</option>
                                                    <option <?php if ($studGrade == "10") echo 'selected="selected"'; ?> value="10">10</option>
                                                    <option <?php if ($studGrade == "11") echo 'selected="selected"'; ?> value="11">11</option>
                                                    <option <?php if ($studGrade == "12M") echo 'selected="selected"'; ?> value="12M">12 - Maths</option>
                                                    <option <?php if ($studGrade == "13M") echo 'selected="selected"'; ?> value="13M">13 - Maths</option>
                                                    <option <?php if ($studGrade == "12B") echo 'selected="selected"'; ?> value="12B">12 - Bio Science</option>
                                                    <option <?php if ($studGrade == "12B") echo 'selected="selected"'; ?> value="13B">13 - Bio Science</option>
                                                    <option <?php if ($studGrade == "12C") echo 'selected="selected"'; ?> value="12C">12 - Commerce</option>
                                                    <option <?php if ($studGrade == "12C") echo 'selected="selected"'; ?> value="12C">13 - Commerce</option>
                                                    <option <?php if ($studGrade == "12A") echo 'selected="selected"'; ?> value="12A">12 - Arts</option>
                                                    <option <?php if ($studGrade == "12A") echo 'selected="selected"'; ?> value="13A">13 - Arts</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="c_code" class="col-sm-3 control-label">Class</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" required id="Sclass" name="Sclass" onchange="getStudentCode()">
                                                    <option value="">Select Class...</option>
                                                    <option <?php if ($studClass == "A") echo 'selected="selected"'; ?> value="A">A</option>
                                                    <option <?php if ($studClass == "B") echo 'selected="selected"'; ?> value="B">B</option>
                                                    <option <?php if ($studClass == "C") echo 'selected="selected"'; ?> value="C">C</option>
                                                    <option <?php if ($studClass == "D") echo 'selected="selected"'; ?> value="D">D</option> 
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_code" class="col-sm-3 control-label">Medium</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" required id="Smedium" name="Smedium" onchange="getStudentCode()" >
                                                    <option value="">Select Medium...</option>
                                                    <option <?php if ($studMedium == "Sinhala") echo 'selected="selected"'; ?> value="Sinhala">Sinhala</option>
                                                    <option <?php if ($studMedium == "English") echo 'selected="selected"'; ?> value="English">English</option>
                                                    <option <?php if ($studMedium == "Tamil") echo 'selected="selected"'; ?> value="Tamil">Tamil</option>  
                                                </select>  
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_cat_name" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="saddress" name="saddress" rows="3" placeholder="Enter Student Address..." ><?php echo $studAddress; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="c_name" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="semail" name="semail" placeholder="Enter email..." placeholder="Email" value="<?php echo $studEmail; ?>">
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
                                                    <span id="show-create-btn"><button type="submit" name="save" class="btn btn-success">Add New Student</button></span>
                                                    <?php
                                                }
                                                if ($edit_tag == 1) {
                                                    ?>
                                                    <input type="hidden" name="uid" class='form-control' required value="<?php echo $studentId; ?>" >
                                                    <span id="show-create-btn"><button type="submit" name="Update" class="btn btn-success">Update Student</button></span>
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
                                    <h3 class="box-title">Registered Student List </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered" id="cat-tbl">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Full Name</th>
                                                <th>Grade</th>
                                                <th>Class</th>
                                                <th>Medium</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($student->showStudents("students") as $val) {
                                            extract($val);
                                            if ($grade == '12M') {
                                                $grade = '12 - Maths';
                                            }
                                            if ($grade == '13M') {
                                                $grade = '13 - Maths';
                                            }
                                            if ($grade == '12B') {
                                                $grade = '12 - Bio Science';
                                            }
                                            if ($grade == '13B') {
                                                $grade = '13 - Bio Science';
                                            }
                                            if ($grade == '12C') {
                                                $grade = '12 - Commerce';
                                            }
                                            if ($grade == '13C') {
                                                $grade = '13 - Commerce';
                                            }
                                            if ($grade == '12A') {
                                                $grade = '12 - Arts';
                                            }
                                            if ($grade == '13A') {
                                                $grade = '13 - Arts';
                                            }
                                            ?>

                                            <tr>
                                                <td scope="row"><?php echo $student_code; ?></td>
                                                <td><?php echo $full_name; ?></td>
                                                <td><?php echo $grade; ?></td>
                                                <td><?php echo $class; ?></td>
                                                <td><?php echo $medium; ?></td>
                                                <td><?php echo $address; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td>
                                                    <a href="student_registration.php?editid=<?php echo $student_id; ?>">Edit</a> | <a href="student_registration.php?deleteid=<?php echo $student_id; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">

                                </div>
                            </div>
                            <!-- /.box -->
                        </div>

                        <!-----------------------------------------------Student Registration Page Content------------------------------------->
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


        <script>
            function getStudentCode() {
                var gradeId = $('#Sgrade').val();
                var classID = $('#Sclass').val();
                var mediumId = $('#Smedium').val();
                var studentCode = $('#studentCode').val();

                var lastItem = studentCode.substring(studentCode.length - 5);

                if (gradeId != '' && classID != '' && mediumId != '') {  //alert('test');
                    var size = 3;
                    var s = "000" + gradeId;
                    var gradeCode = s.substr(s.length - size);

                    var mcode = $('#Smedium').find(":selected").text();
                    var mdcode = mcode.substring(0, 3);


                    var studentCodeNew = gradeCode + '/' + classID + '/' + mdcode + '/' + lastItem;
                    var studentCodeNewUpp = studentCodeNew.toUpperCase();
                    $('#studentCode').val(studentCodeNewUpp);
                } else {
                    var studentCodeNew = lastItem;
                    var studentCodeNewUpp = studentCodeNew.toUpperCase();
                    $('#studentCode').val(studentCodeNewUpp);
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