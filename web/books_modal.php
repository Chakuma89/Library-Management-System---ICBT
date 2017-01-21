<?php
if (isset($_GET['editid'])) {
    echo $ueditId = $_GET['editid'];
}
?>

<!-- form start -->
<form action="#" method="post" class="form-horizontal"> 
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
                            <td>222</td>
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
        <button type="submit" name="saveModal" class="btn btn-primary" > Save Changes </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>