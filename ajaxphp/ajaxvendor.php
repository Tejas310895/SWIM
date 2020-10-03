<?php 

include("../includes/db.php");

if(isset($_POST['add_vendor'])){
    $shop_title = $_POST['shop_title'];
    $item_desc = $_POST['item_desc'];
    $vendor_gstn = $_POST['vendor_gstn'];
    $vendor_email = $_POST['vendor_email'];
    $vendor_contact = $_POST['vendor_contact'];
    $vendor_status = $_POST['vendor_status'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_vendor = "insert into vendors (shop_title,
                                           item_desc,
                                           vendor_gstn,
                                           vendor_email,
                                           vendor_contact,
                                           vendor_status,
                                           vendor_created_at,
                                           vendor_updated_at)
                                            values
                                            ('$shop_title',
                                            '$item_desc',
                                            '$vendor_gstn',
                                            '$vendor_email',
                                            '$vendor_contact',
                                            '$vendor_status',
                                            '$today',
                                            '$today'
                                            )";
    $run_vendor = mysqli_query($con,$insert_vendor);

    if($run_vendor){
        echo "<div class='alert alert-success' role='alert' id='vendor_success'>
        <strong>Done!</strong> Your Vendor is added successfully.
      </div>";
    }else{
        echo "
        <div class='alert alert-Danger' role='alert' id='vendor_failed'>
        <strong>Error!</strong> Failed to add the vendor try again.
        </div>
        ";
    }
}

if(isset($_POST['add_raw'])){
    $item_type = $_POST['item_type'];
    $item_name = $_POST['item_name'];
    $item_unit = $_POST['item_unit'];
    $unit_cost = $_POST['unit_cost'];
    $gst_rate = $_POST['gst_rate'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_raw = "insert into raw_items (item_type,
                                        item_name,
                                        item_unit,
                                        unit_cost,
                                        gst_rate,
                                        item_stock,
                                        item_created_at,
                                        item_updated_at)
                                        values
                                        ('$item_type',
                                        '$item_name',
                                        '$item_unit',
                                        '$unit_cost',
                                        '$gst_rate',
                                        '0',
                                        '$today',
                                        '$today')";
    $run_raw = mysqli_query($con,$insert_raw);

    if($run_raw){
        echo "<div class='alert alert-success' role='alert' id='vendor_success'>
        <strong>Done!</strong> Your Item is added successfully.
      </div>";
    }else{
        echo "
        <div class='alert alert-Danger' role='alert' id='vendor_failed'>
        <strong>Error!</strong> Failed to add the Item try again.
        </div>
        ";
    }
}

if(isset($_POST['raw_entry'])){
    $vendor_id = $_POST['vendor_id'];
    $item_id = $_POST['item_id'];
    $item_qty = $_POST['item_qty'];
    $item_unit_cost = $_POST['item_unit_cost'];
    $item_total_cost = $_POST['item_total_cost'];
    $item_invoice = $_POST['item_invoice'];
    $item_extra = $_POST['item_extra'];


    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_entry = "insert into raw_entry (vendor_id,
                                            item_id,
                                            item_qty,
                                            item_unit_cost,
                                            item_total_cost,
                                            item_invoice,
                                            item_extra,
                                            entry_created_at,
                                            entry_updated_at)
                                            values
                                            ('$vendor_id',
                                            '$item_id',
                                            '$item_qty',
                                            '$item_unit_cost',
                                            '$item_total_cost',
                                            '$item_invoice',
                                            '$item_extra',
                                            '$today',
                                            '$today')";
    $run_entry = mysqli_query($con,$insert_entry);

        $update_stock = "update raw_items set item_stock=item_stock+'$item_qty' where item_id='$item_id'";

        $run_update_stock = mysqli_query($con,$update_stock);

    if($run_entry){
        echo "<div class='alert alert-success' role='alert' id='vendor_success'>
        <strong>Done!</strong> Your Entry is Updated successfully.
      </div>";
    }else{
        echo "
        <div class='alert alert-Danger' role='alert' id='vendor_failed'>
        <strong>Error!</strong> Failed to Update the entry try again.
        </div>
        ";
    }
}

?>