<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="col-12" id="vendor_alerts">

    </div>
    <div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">Create New Vendor</h4>
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
                    <form class="form-sample" id="insert_vendor" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shop_title" id="shop_title" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Item Type</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="item_desc" id="item_desc" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shop_address" id="shop_address" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="shop_state_code" id="shop_state_code" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="vendor_email" id="vendor_email" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="vendor_contact" id="vendor_contact" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">GSTN</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="vendor_gstn" id="vendor_gstn" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="vendor_status" id="vendor_status">
                                            <option value="true">Active</option>
                                            <option value="false">In Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" id="add_vendor" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/vendor.js"></script>
<?php } ?>