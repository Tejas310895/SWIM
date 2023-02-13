<div id="loader" class="loader-center"></div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Purchase Enquiry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?view_poentry" class="btn btn-primary" style="float:right;">Purchase Orders</a>
    </div>
</div>
<form id="insert_raw_product" method="post" action="">
    <div class="row">
        <div class="col-md-4">
            <h6>Supplier</h6>
            <fieldset class="form-group">
                <select class="form-control" id="vendor_id" name="vendor_id" required>
                    <option disabled selected>Choose the Supplier</option>
                    <?php

                    $get_supplier = "select * from vendors";
                    $run_supplier = mysqli_query($con, $get_supplier);
                    while ($row_supplier = mysqli_fetch_array($run_supplier)) {
                        echo "<option class='text-uppercase' value='" . $row_supplier['vendor_id'] . "'>" . $row_supplier['shop_title'] . "</option>";
                    }

                    ?>
                </select>
            </fieldset>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Supplier Email</label>
                <input type="text" class="form-control" name="vendor_email" id="vendor_email" aria-describedby="" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Delivery Schedule</label>
                <input type="date" class="form-control" name="po_shcedule" id="po_shcedule" aria-describedby="" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Company Name</label>
                <select class="form-control" name="po_number" id="po_number" required>
                    <option disabled selected value>Choose the Partner</option>
                    <?php

                    $get_partner = "select * from partners";
                    $run_partner = mysqli_query($con, $get_partner);
                    while ($row_partner = mysqli_fetch_array($run_partner)) {
                        $partner_id = $row_partner['partner_id'];
                        $partner_title = $row_partner['partner_title'];

                        $invoice_pre = substr($partner_title, 0, 2);

                        date_default_timezone_set('Asia/Kolkata');

                        $in_year = date("y");

                        $today = date("d-m-Y");

                        $raw_fin_year = date("y") . "-" . ((date("y") + 1));

                        $get_partner_count = "SELECT * FROM po_entries where LEFT(po_number, 2)='$invoice_pre' and MID(po_number, 3, 5)='$raw_fin_year' order by RIGHT(po_number, 3) desc limit 1";
                        $run_partner_count = mysqli_query($con, $get_partner_count);
                        $row_partner_count = mysqli_fetch_array($run_partner_count);
                        $count_fin_yer = mysqli_num_rows($run_partner_count);

                        $invoice_no_bef = $row_partner_count['po_number'];

                        if ($count_fin_yer > 0) {

                            $invoice_no_aft = substr($invoice_no_bef, -3, 3);
                        } else {
                            $invoice_no_aft = 000;
                        }

                        $aftyear = $in_year + 1;

                        if (($invoice_no_aft + 1) < 10) {
                            $serial = "00" . ($invoice_no_aft + 1);
                        } elseif (($invoice_no_aft + 1) >= 10 && ($invoice_no_aft + 1) < 100) {
                            $serial = "0" . ($invoice_no_aft + 1);
                        } else {
                            $serial = $invoice_no_aft + 1;
                        }

                        $po_no = $invoice_pre . $in_year . "-" . $aftyear . "/" . $serial;
                    ?>
                        <option value="<?php echo $po_no; ?>"><?php echo $partner_title . " -" . $po_no; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Indent Number</label>
                <input type="text" class="form-control" name="indent_number" id="indent_number" aria-describedby="" placeholder="Enter Indent Number" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>Indent Date</label>
                <input type="date" class="form-control" name="indent_date" id="indent_date" aria-describedby="" placeholder="Enter Indent Date" required>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Po Comment</label>
                <textarea class="form-control" id="po_comment" name="po_comment" placeholder="Enter Comment" rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Po Note</label>
                <textarea class="form-control" id="po_note" name="po_note" placeholder="Enter Note" rows="3"></textarea>
            </div>
        </div>
    </div>
    <h5 class="text-uppercase">Products to be Requested</h5>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control mx-5" id="raw_product_enquiry" name="raw_product_id[]" required>
                <option selected disabled value="">Choose the product</option>
                <?php

                $get_raw_products = "select * from raw_items";
                $run_raw_products = mysqli_query($con, $get_raw_products);
                while ($row_raw_products = mysqli_fetch_array($run_raw_products)) {

                    $raw_products_id = $row_raw_products['item_id'];
                    $raw_products_title = $row_raw_products['item_name'];
                    $raw_products_unit = $row_raw_products['item_unit'];

                    $get_enquires = "select * from po_entries where po_delivery_status='initiated'";
                    $run_enquires = mysqli_query($con, $get_enquires);
                    $comment = 0;
                    while ($row_enquires = mysqli_fetch_array($run_enquires)) {
                        $unserialized_array = unserialize($row_enquires['raw_product_array']);
                        $array_size = (count($unserialized_array) - 1);
                        for ($i = 0; $i <= $array_size; $i++) {

                            $item_id = $unserialized_array[$i][0];

                            if ($raw_products_id == $item_id) {
                                $comment += 1;
                            } else {
                                $comment += 0;
                            }
                        }
                    }

                    if ($comment > 0) {
                        echo "<option class='text-danger' value='$raw_products_id'>$raw_products_title in $raw_products_unit (Already enquiry placed for this item)</option>";
                    } else {
                        echo "<option value='$raw_products_id'>$raw_products_title in $raw_products_unit </option>";
                    }
                }

                ?>
            </select>
            <input type="text" name="raw_product_desc[]" id="raw_product_desc" class="form-control" placeholder="Enter product description" required />
            <input type="number" step="any" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Enter Qty required" required />
            <input type="number" step="any" name="raw_product_unit_rate[]" id="raw_product_unit_rate" class="form-control" placeholder="Enter unit rate" required />
            <input type="number" name="raw_product_gst_rate[]" id="raw_product_gst_rate" class="form-control" placeholder="Enter gst rate" required />
            <div class="input-group-addon mx-3 mt-1">
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>

    <button type="submit" name="add_raw_enquiry" id="add_raw_enquiry" class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>

</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
        <select class="form-control mx-5" id="raw_product_enquiry" name="raw_product_id[]" required>
            <option selected disabled value="">Choose the product</option>
            <?php

            $get_raw_products = "select * from raw_items";
            $run_raw_products = mysqli_query($con, $get_raw_products);
            while ($row_raw_products = mysqli_fetch_array($run_raw_products)) {

                $raw_products_id = $row_raw_products['item_id'];
                $raw_products_title = $row_raw_products['item_name'];
                $raw_products_unit = $row_raw_products['item_unit'];

                $get_enquires = "select * from po_entries where po_delivery_status='intiated'";
                $run_enquires = mysqli_query($con, $get_enquires);
                $comment = 0;
                while ($row_enquires = mysqli_fetch_array($run_enquires)) {
                    $unserialized_array = unserialize($row_enquires['raw_product_array']);
                    $array_size = (count($unserialized_array) - 1);
                    for ($i = 0; $i <= $array_size; $i++) {

                        $item_id = $unserialized_array[$i][0];

                        if ($raw_products_id == $item_id) {
                            $comment += 1;
                        } else {
                            $comment += 0;
                        }
                    }
                }

                if ($comment <= 0) {
                    echo "<option class='text-danger' value='$raw_products_id'>$raw_products_title in $raw_products_unit (Already enquiry placed for this item)</option>";
                } else {
                    echo "<option value='$raw_products_id'>$raw_products_title in $raw_products_unit $comment </option>";
                }
            }

            ?>
        </select>
        <input type="text" name="raw_product_desc[]" id="raw_product_desc" class="form-control" placeholder="Enter product description" required />
        <input type="number" step="any" name="raw_product_qty[]" id="raw_product_qty" class="form-control" placeholder="Enter Qty required" required />
        <input type="number" step="any" name="raw_product_unit_rate[]" id="raw_product_unit_rate" class="form-control" placeholder="Enter unit rate" required />
        <input type="number" name="raw_product_gst_rate[]" id="raw_product_gst_rate" class="form-control" placeholder="Enter gst rate %" required />
        <div class="input-group-addon mx-4 mt-1">
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/vendor.js"></script>
<script src="js/script.js"></script>
<?php

//purchase enquiry insert query

if (isset($_POST['add_raw_enquiry'])) {

    $po_number = $_POST['po_number'];
    $vendor_email = $_POST['vendor_email'];
    $po_shcedule = $_POST['po_shcedule'];
    $indent_number = $_POST['indent_number'];
    $indent_date = $_POST['indent_date'];
    $po_comment = $_POST['po_comment'];
    $po_note = $_POST['po_note'];
    $itemArr = $_POST['raw_product_id'];
    $item_descArr = $_POST['raw_product_desc'];
    $qtyArr = $_POST['raw_product_qty'];
    $unit_rateArr = $_POST['raw_product_unit_rate'];
    $gst_rateArr = $_POST['raw_product_gst_rate'];
    $vendor_id = $_POST['vendor_id'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $purchase_enquiry_created_at = date('M d, Y', strtotime($today));

    $enquiry_product = array();
    if (!empty($itemArr)) {
        for ($i = 0; $i < count($itemArr); $i++) {
            if (!empty($itemArr[$i])) {
                $item = $itemArr[$i];
                $item_desc = $item_descArr[$i];
                $qty = $qtyArr[$i];
                $unit_rate = $unit_rateArr[$i];
                $gst_rate = $gst_rateArr[$i];

                $raw_array = array($item, $qty, $unit_rate, $gst_rate, $item_desc);
                array_push($enquiry_product, $raw_array);
            }
        }
    }

    $serialized_array = serialize($enquiry_product);

    $insert_purchase_enquiry = "INSERT into po_entries (po_number,
                                                        po_date,
                                                        indent_number,
                                                        indent_date,
                                                        vendor_id,
                                                        vendor_email,
                                                        raw_product_array,
                                                        po_note,
                                                        po_comment,
                                                        po_shcedule,
                                                        po_delivery_status,
                                                        po_created_at,
                                                        po_updated_at) 
                                                        values 
                                                        ('$po_number',
                                                        '$today',
                                                        '$indent_number',
                                                        '$indent_date',
                                                        '$vendor_id',
                                                        '$vendor_email',
                                                        '$serialized_array',
                                                        '$po_note',
                                                        '$po_comment',
                                                        '$po_shcedule',
                                                        'initiated',
                                                        '$today',
                                                        '$today')";
    $run_purchase_enquiry = mysqli_query($con, $insert_purchase_enquiry);


    if ($run_purchase_enquiry) {
        // include('./sendpdf/index.php');
        echo "<script>alert('Entry Done and mail sent')</script>";
        echo "<script>window.open('index.php?view_poentry','_self')</script>";
    } else {
        echo "<script>alert('Failed, Try again')</script>";
    }
}



?>
<script>
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector("#loader").style.visibility = "visible";
        } else {
            document.querySelector("#loader").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
        }
    };
</script>