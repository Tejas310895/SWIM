<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="col-12" id="entry_alerts">

    </div>
    <div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">Add Purchase Filling</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?purchase_filing">Go Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Complete the entry form</h4>
                    <form class="form-sample" id="insert_pur_filling" action="" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Partner Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="pur_partner_id" id="pur_partner_id" required>
                                            <option disabled selected value>Choose the Partner</option>
                                            <?php

                                            $get_partners = "select * from partners";
                                            $run_partners = mysqli_query($con, $get_partners);
                                            while ($row_partners = mysqli_fetch_array($run_partners)) {

                                                $partner_id = $row_partners['partner_id'];
                                                $partner_title = $row_partners['partner_title'];
                                            ?>
                                                <option value="<?php echo $partner_id; ?>"><?php echo $partner_title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="pur_vendor_id" id="pur_vendor_id" required>
                                            <option disabled selected value>Choose the Supplier</option>
                                            <?php

                                            $get_vendors = "select * from vendors";
                                            $run_vendors = mysqli_query($con, $get_vendors);
                                            while ($row_vendors = mysqli_fetch_array($run_vendors)) {

                                                $vendor_id = $row_vendors['vendor_id'];
                                                $shop_title = $row_vendors['shop_title'];
                                            ?>
                                                <option value="<?php echo $vendor_id; ?>"><?php echo $shop_title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Invoice No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pur_inc_no" id="pur_inc_no" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Taxable Amount</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pur_taxable" id="pur_taxable" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">GST Rate %</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pur_gst_rate" id="pur_gst_rate" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="pur_date" id="pur_date" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pur_desc" id="pur_desc" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="pur_filling_entry" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
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