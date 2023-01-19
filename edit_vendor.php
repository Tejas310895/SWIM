<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <?php

    include("includes/db.php");

    if (isset($_GET['edit_vendor'])) {

        $vendor_id = $_GET['edit_vendor'];

        $get_vendor = "select * from vendors where vendor_id='$vendor_id'";
        $run_vendor = mysqli_query($con, $get_vendor);
        $row_vendor = mysqli_fetch_array($run_vendor);

        $shop_title = $row_vendor['shop_title'];
        $item_desc = $row_vendor['item_desc'];
        $vendor_gstn = $row_vendor['vendor_gstn'];
        $vendor_email = $row_vendor['vendor_email'];
        $vendor_contact = $row_vendor['vendor_contact'];
        $vendor_status = $row_vendor['vendor_status'];
        $vendor_address = $row_vendor['vendor_address'];
        $vendor_state_code = $row_vendor['vendor_state_code'];

    ?>
        <div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
            <div class="col-6">
                <h4 class="py-2">Edit Vendor Details</h4>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="index.php?view_vendor">Go Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin px-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Enter the vendor details</h4>
                        <form class="form-sample" method='post' action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Supplier Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="shop_title" id="shop_title" value='<?php echo $shop_title; ?>' required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Item Type</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="item_desc" id="item_desc" value='<?php echo $item_desc; ?>' required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shop_address" id="shop_address" value='<?php echo $vendor_address; ?>' required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Item Type</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shop_state_code" id="shop_state_code" value='<?php echo $vendor_state_code; ?>' required />
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="vendor_email" id="vendor_email" value='<?php echo $vendor_email; ?>' required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vendor_contact" id="vendor_contact" value='<?php echo $vendor_contact; ?>' required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GSTN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vendor_gstn" id="vendor_gstn" value='<?php echo $vendor_gstn; ?>' required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="vendor_status" id="vendor_status">
                                        <option value="<?php echo $vendor_status; ?>"><?php if ($vendor_status === 'true') {
                                                                                            echo "Active";
                                                                                        } else {
                                                                                            echo "Inactive";
                                                                                        } ?></option>
                                        <option value="<?php if ($vendor_status === 'true') {
                                                            echo "false";
                                                        } else {
                                                            echo "true";
                                                        } ?>"><?php if ($vendor_status === 'true') {
                                                                    echo "Inactive";
                                                                } else {
                                                                    echo "Active";
                                                                } ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" id="edit_vendor" name="edit_vendor" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    <?php

    if (isset($_POST['edit_vendor'])) {
        $shop_title = $_POST['shop_title'];
        $item_desc = $_POST['item_desc'];
        $vendor_email = $_POST['vendor_email'];
        $vendor_contact = $_POST['vendor_contact'];
        $vendor_gstn = $_POST['vendor_gstn'];
        $vendor_status = $_POST['vendor_status'];
        $shop_address = $_POST['shop_address'];
        $shop_state_code = $_POST['shop_state_code'];

        date_default_timezone_set('Asia/Kolkata');

        $today = date("Y-m-d H:i:s");

        $update_vendor = "update vendors set shop_title='$shop_title',
                                         item_desc='$item_desc',
                                         vendor_gstn='$vendor_gstn',
                                         vendor_email='$vendor_email',
                                         vendor_contact='$vendor_contact',
                                         vendor_address='$shop_address',
                                         vendor_state_code='$shop_state_code',
                                         vendor_status='$vendor_status',
                                         vendor_updated_at='$today'
                                        where vendor_id='$vendor_id'";
        $run_update_vendor = mysqli_query($con, $update_vendor);

        if ($run_update_vendor) {
            echo "<script>alert('Vendor Details Updated Successfully')</script>";
            echo "<script>window.open('index.php?view_vendor','_self')</script>";
        } else {
            echo "<script>alert('Updated Failed try again')</script>";
        }
    }


    ?>
<?php } ?>