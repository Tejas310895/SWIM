<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">GENERATE SALE INVOICE</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?invoice_entries">View Entries</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin px-0">
            <form class="form-sample" id="invoice_form" action="ajaxphp/ajaxinvoice.php" method="post">
                <div class="card mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Company Details</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Company Name</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="partner_id" id="partner_id" required>
                                            <option disabled selected value>Choose the Partner</option>
                                            <?php

                                            $get_partner = "select * from partners";
                                            $run_partner = mysqli_query($con, $get_partner);
                                            while ($row_partner = mysqli_fetch_array($run_partner)) {

                                                $partner_id = $row_partner['partner_id'];
                                                $partner_title = $row_partner['partner_title'];
                                            ?>
                                                <option value="<?php echo $partner_id; ?>"><?php echo $partner_title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" id="label_qty">Invoice Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="invoice_pre" id="invoice_pre" value="" placeholder="" required />
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="invoice_suf" id="invoice_suf" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" id="label_qty">Invoice Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="invoice_date" id="invoice_date" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" id="label_qty">Due Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="due_date" id="due_date" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Transporter Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Transporter Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="transporter_title" id="transporter_title" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Vehicle Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">E-Way Bill Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="eway_no" id="eway_no" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Shipping Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="ship_date" id="ship_date" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Details Of Reciever (Billed To)</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Partner Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="billed_title" id="billed_title" required>
                                            <option disabled selected value>Choose the Customers</option>
                                            <?php

                                            $get_customer = "select * from customers";
                                            $run_customer = mysqli_query($con, $get_customer);
                                            while ($row_customer = mysqli_fetch_array($run_customer)) {

                                                $customer_title = $row_customer['customer_title'];
                                            ?>
                                                <option value="<?php echo $customer_title; ?>"><?php echo $customer_title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="billed_contact" id="billed_contact" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="billed_address" id="billed_address" value="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">GSTIN Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="billed_gst" id="billed_gst" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">State</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="billed_state" id="billed_state" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">State Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="billed_state_code" id="billed_state_code" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check my-5 ml-5">
                        <input type="checkbox" class="form-check-input" id="match_billed">
                        <label class="form-check-label text-white" for="exampleCheck1">
                            <h5>Same as Billed</h5>
                        </label>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Details Of consignee (Shipped To)</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ship_title" id="ship_title" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ship_contact" id="ship_contact" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="ship_address" id="ship_address" value="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">GSTIN Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ship_gst" id="ship_gst" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">State</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ship_state" id="ship_state" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" id="label_qty">State Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ship_state_code" id="ship_state_code" value="" placeholder="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Add Products Carton</h4>
                        <div class="form-group fieldGroup">
                            <div class="input-group">
                                <select class="form-control mx-5" name="carton_id[]" id="carton_id" required>
                                    <?php

                                    echo "<option disabled selected value>Product</option>";
                                    $get_carton = "select * from cartons where carton_stock>'0'";
                                    $run_carton = mysqli_query($con, $get_carton);
                                    while ($row_carton = mysqli_fetch_array($run_carton)) {

                                        $carton_id = $row_carton['carton_id'];
                                        $carton_title = $row_carton['carton_title'];
                                        $carton_stock = $row_carton['carton_stock'];

                                        echo "<option value='$carton_id'>$carton_title ($carton_stock-Instock)</option>";
                                    }

                                    ?>
                                </select>
                                <label for=""></label>
                                <input type="text" name="carton_qty[]" id="carton_qty" class="form-control" placeholder="Quantity" required />
                                <input type="text" name="unit_rate[]" id="unit_rate" class="form-control" placeholder="Unit Rate" required />
                                <input type="text" name="discount[]" id="discount" class="form-control" placeholder="Discount %" />
                                <select class="form-control mx-5" name="gst_type[]" id="gst_type" required>
                                    <option disabled selected value>GST TYPE</option>
                                    <option value="STA_TAX">STATE TAX</option>
                                    <option value="CEN_TAX">CENTER TAX</option>
                                </select>
                                <div class="input-group-addon mx-3 mt-1">
                                    <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="invoice_entry" name="invoice_entry" class="btn btn-success mr-2 btn-lg float-right py-2">
                            <h5>Generate Invoice</h5>
                        </button>
                    </div>
                </div>
                <!-- <div class="row">
                            <div class="col-md-6">
                            </div>
                        </div> -->
            </form>
            <!-- copy of input fields group -->
            <div class="form-group fieldGroupCopy" style="display: none;">
                <div class="input-group">
                    <select class="form-control mx-5" name="carton_id[]" id="carton_id" required>
                        <?php

                        echo "<option disabled selected value>Product</option>";
                        $get_carton = "select * from cartons where carton_stock>'0'";
                        $run_carton = mysqli_query($con, $get_carton);
                        while ($row_carton = mysqli_fetch_array($run_carton)) {

                            $carton_id = $row_carton['carton_id'];
                            $carton_title = $row_carton['carton_title'];
                            $carton_stock = $row_carton['carton_stock'];

                            echo "<option value='$carton_id'>$carton_title ($carton_stock-Instock)</option>";
                        }

                        ?>
                    </select>
                    <input type="text" name="carton_qty[]" id="carton_qty" class="form-control" placeholder="Quantity" required />
                    <input type="text" name="unit_rate[]" id="unit_rate" class="form-control" placeholder="Unit Rate" required />
                    <input type="text" name="discount[]" id="discount" class="form-control" placeholder="Discount %" />
                    <select class="form-control mx-5" name="gst_type[]" id="gst_type" required>
                        <option disabled selected value>GST TYPE</option>
                        <option value="STA_TAX">STATE TAX</option>
                        <option value="CEN_TAX">CENTER TAX</option>
                    </select>
                    <div class="input-group-addon mx-4 mt-1">
                        <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/vendor.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });
    </script>
<?php } ?>