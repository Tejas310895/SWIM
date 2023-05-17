<?php

include("../includes/db.php");

if (isset($_POST['add_partner'])) {
    $partner_title = $_POST['partner_title'];
    $partner_contact = $_POST['partner_contact'];
    $partner_email = $_POST['partner_email'];
    $partner_address = $_POST['partner_address'];
    $partner_state = $_POST['partner_state'];
    $partner_state_code = $_POST['partner_state_code'];
    $bank_name = $_POST['bank_name'];
    $ac_number = $_POST['ac_number'];
    $branch_name = $_POST['branch_name'];
    $ifsc_code = $_POST['ifsc_code'];
    $ac_holder = $_POST['ac_holder'];
    $partner_gst = $_POST['partner_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_partner = "insert into partners (partner_title,
                                           partner_contact,
                                           partner_email,
                                           partner_address,
                                           partner_state,
                                           partner_state_code,
                                           bank_name,
                                           ac_number,
                                           branch_name,
                                           ifsc_code,
                                           ac_holder,
                                           partner_gst,
                                           partner_created_at,
                                           partner_updated_at)
                                            values
                                            ('$partner_title',
                                            '$partner_contact',
                                            '$partner_email',
                                            '$partner_address',
                                            '$partner_state',
                                            '$partner_state_code',
                                            '$bank_name',
                                            '$ac_number',
                                            '$branch_name',
                                            '$ifsc_code',
                                            '$ac_holder',
                                            '$partner_gst',
                                            '$today',
                                            '$today'
                                            )";
    $run_partner = mysqli_query($con, $insert_partner);

    if ($run_partner) {
        echo "<div class='alert alert-success' role='alert' id='vendor_success'>
        <strong>Done!</strong> Your Partner is added successfully.
      </div>";
    } else {
        echo "
        <div class='alert alert-Danger' role='alert' id='vendor_failed'>
        <strong>Error!</strong> Failed to add the Partner try again.
        </div>
        ";
    }
}

if (isset($_POST['invoice_entry'])) {
    //variables//
    $partner_id = $_POST['partner_id'];
    $invoice_pre = $_POST['invoice_pre'];
    $invoice_suf = $_POST['invoice_suf'];
    $invoice_date = $_POST['invoice_date'];
    $transporter_title = $_POST['transporter_title'];
    $vehicle_no = $_POST['vehicle_no'];
    $eway_no = $_POST['eway_no'];
    $ship_date = $_POST['ship_date'];
    $billed_title = $_POST['billed_title'];
    $billed_contact = $_POST['billed_contact'];
    $billed_address = $_POST['billed_address'];
    $billed_gst = $_POST['billed_gst'];
    $billed_state = $_POST['billed_state'];
    $billed_state_code = $_POST['billed_state_code'];
    $ship_title = $_POST['ship_title'];
    $ship_contact = $_POST['ship_contact'];
    $ship_address = $_POST['ship_address'];
    $ship_gst = $_POST['ship_gst'];
    $ship_state = $_POST['ship_state'];
    $ship_state_code = $_POST['ship_state_code'];
    $due_date = $_POST['due_date'];
    //arrays//
    $invoice_no = $invoice_pre . $invoice_suf;
    $carton_idArr = $_POST['carton_id'];
    $carton_qtyArr = $_POST['carton_qty'];
    $unit_rateArr = $_POST['unit_rate'];
    $gst_typeArr = $_POST['gst_type'];
    $discountArr = $_POST['discount'];


    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    if (!empty($carton_idArr)) {
        $count_carton = 0;
        $count_stock = 0;
        for ($i = 0; $i < count($carton_idArr); $i++) {
            if (!empty($carton_idArr[$i])) {
                $carton_id = $carton_idArr[$i];
                $carton_qty = $carton_qtyArr[$i];

                $get_stock = "select * from cartons where carton_id='$carton_id'";
                $run_stock = mysqli_query($con, $get_stock);
                $row_stock = mysqli_fetch_array($run_stock);
                $avai_quantity = $row_stock['carton_stock'];
                if ($avai_quantity < $carton_qty) {
                    $count_stock = 0;
                } else {
                    $count_stock = ++$count_stock;
                }
            }
            $count_carton = ++$count_carton;
        }
    }

    $get_invoice = "select * from invoice where invoice_no='$invoice_no'";
    $run_invoice = mysqli_query($con, $get_invoice);
    $count_invoice = mysqli_num_rows($run_invoice);

    if ($count_invoice == 0) {

        if ($count_stock == $count_carton) {

            if (!empty($carton_idArr)) {
                for ($i = 0; $i < count($carton_idArr); $i++) {
                    if (!empty($carton_idArr[$i])) {
                        $carton_id = $carton_idArr[$i];
                        $carton_qty = $carton_qtyArr[$i];
                        $unit_rate = $unit_rateArr[$i];
                        $gst_type = $gst_typeArr[$i];
                        $discount = $discountArr[$i];

                        $get_pro_id = "select * from cartons where carton_id='$carton_id'";
                        $run_pro_id = mysqli_query($con, $get_pro_id);
                        $row_pro_id = mysqli_fetch_array($run_pro_id);
                        $product_id = $row_pro_id['product_id'];

                        $get_hsn = "select * from products where product_id='$product_id'";
                        $run_hsn = mysqli_query($con, $get_hsn);
                        $row_hsn = mysqli_fetch_array($run_hsn);
                        $hsn_code = $row_hsn['hsn_code'];
                        $gst_rate = $row_hsn['gst_rate'];


                        $insert_inc_product = "insert into invoice_products (invoice_no,
                                                                    carton_id,
                                                                    carton_qty,
                                                                    unit_rate,
                                                                    gst_type,
                                                                    hsn_code,
                                                                    gst_rate,
                                                                    discount,
                                                                    invoice_product_created_at,
                                                                    invoice_product_updated_at) 
                                                                    values 
                                                                    ('$invoice_no',
                                                                    '$carton_id',
                                                                    '$carton_qty',
                                                                    '$unit_rate',
                                                                    '$gst_type',
                                                                    '$hsn_code',
                                                                    '$gst_rate',
                                                                    '$discount',
                                                                    '$today',
                                                                    '$today')";

                        $run_inc_product = mysqli_query($con, $insert_inc_product);

                        $update_stock = "update cartons set carton_stock=carton_stock-'$carton_qty' where carton_id='$carton_id'";
                        $run_update_stock = mysqli_query($con, $update_stock);
                    }
                }
            }

            $insert_invoice = "insert into invoice (partner_id,
                                            invoice_no,
                                            invoice_date,
                                            transporter_title,
                                            vehicle_no,
                                            eway_no,
                                            ship_date,
                                            billed_title,
                                            billed_contact,
                                            billed_address,
                                            billed_gst,
                                            billed_state,
                                            billed_state_code,
                                            ship_title,
                                            ship_contact,
                                            ship_address,
                                            ship_gst,
                                            ship_state,
                                            ship_state_code,
                                            due_date,
                                            invoice_created_at,
                                            invoice_updated_at)
                                            values
                                            ('$partner_id',
                                            '$invoice_no',
                                            '$invoice_date',
                                            '$transporter_title',
                                            '$vehicle_no',
                                            '$eway_no',
                                            '$ship_date',
                                            '$billed_title',
                                            '$billed_contact',
                                            '$billed_address',
                                            '$billed_gst',
                                            '$billed_state',
                                            '$billed_state_code',
                                            '$ship_title',
                                            '$ship_contact',
                                            '$ship_address',
                                            '$ship_gst',
                                            '$ship_state',
                                            '$ship_state_code',
                                            '$due_date',
                                            '$today',
                                            '$today')";
            $run_invoice = mysqli_query($con, $insert_invoice);

            if ($run_invoice) {
                echo "<script>alert('Invoice Generated')</script>";
                echo "<script>window.open('../index.php?invoice_entries','_self')</script>";
            } else {
                echo "<script>alert('Invoice Generation Failed')</script>";
                echo "<script>window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Product Out Of Stock')</script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Invoice Number Already Used')</script>";
        echo "<script>window.history.back();</script>";
    }
}

if (isset($_POST['add_customer'])) {
    $customer_title = $_POST['customer_title'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $customer_state = $_POST['customer_state'];
    $customer_state_code = $_POST['customer_state_code'];
    $customer_gst = $_POST['customer_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_customer = "insert into customers (customer_title,
                                            customer_contact,
                                            customer_email,
                                            customer_address,
                                            customer_state,
                                            customer_state_code,
                                            customer_gst,
                                            customer_created_at,
                                            customer_updated_at)
                                            values
                                            ('$customer_title',
                                            '$customer_contact',
                                            '$customer_email',
                                            '$customer_address',
                                            '$customer_state',
                                            '$customer_state_code',
                                            '$customer_gst',
                                            '$today',
                                            '$today'
                                            )";
    $run_customer = mysqli_query($con, $insert_customer);

    if ($run_customer) {
        echo "<div class='alert alert-success' role='alert' id='vendor_success'>
        <strong>Done!</strong> Your Customer is added successfully.
      </div>";
    } else {
        echo "
        <div class='alert alert-Danger' role='alert' id='vendor_failed'>
        <strong>Error!</strong> Failed to add the Customer try again.
        </div>
        ";
    }
}

if (isset($_POST['customer_title'])) {
    $billed_title = $_POST['customer_title'];

    $get_cust = "select * from customers where customer_title like '%$billed_title%'";
    $run_cust = mysqli_query($con, $get_cust);
    $row_cust = mysqli_fetch_array($run_cust);

    $customer_contact = $row_cust['customer_contact'];
    $customer_address = $row_cust['customer_address'];
    $customer_state = $row_cust['customer_state'];
    $customer_state_code = $row_cust['customer_state_code'];
    $customer_gst = $row_cust['customer_gst'];

    echo json_encode(array(
        "customer_contact" => $customer_contact,
        "customer_address" => $customer_address,
        "customer_state" => $customer_state,
        "customer_state_code" => $customer_state_code,
        "customer_gst" => $customer_gst
    ));
}

if (isset($_POST['invoice_pre'])) {

    $invoice_pre = $_POST['invoice_pre'];

    date_default_timezone_set('Asia/Kolkata');

    $in_year = date("y");

    $today = date("d-m-Y");

    $raw_fin_year = (date("y")) . "-" . (date("y")+1);

    $get_partner_count = "SELECT * FROM invoice where LEFT(invoice_no, 2)='$invoice_pre' and MID(invoice_no, 3, 5)='$raw_fin_year' order by RIGHT(invoice_no, 3) desc limit 1";
    $run_partner_count = mysqli_query($con, $get_partner_count);
    $row_partner_count = mysqli_fetch_array($run_partner_count);
    $count_fin_yer = mysqli_num_rows($run_partner_count);

    $invoice_no_bef = $row_partner_count['invoice_no'];

    if ($count_fin_yer > 0) {

        $invoice_no_aft = substr($invoice_no_bef, -3, 3);
    } else {
        $invoice_no_aft = 000;
    }

    $aftyear = $in_year + 1;

    // $get_fin_year = "select  MID(invoice_no, 3, 5) as demo from invoice limit 1";
    // $run_fin_year = mysqli_query($con,$get_fin_year);
    // $fin_count = mysqli_num_rows($run_fin_year);
    // $row_fin_year =mysqli_fetch_array($run_fin_year);
    // $demo_yer = $row_fin_year['demo'];

    if (($invoice_no_aft + 1) < 10) {
        $serial = "00" . ($invoice_no_aft + 1);
    } elseif (($invoice_no_aft + 1) >= 10 && ($invoice_no_aft + 1) < 100) {
        $serial = "0" . ($invoice_no_aft + 1);
    } else {
        $serial = $invoice_no_aft + 1;
    }

    $invoice_no = $in_year . "-" . $aftyear . "/" . $serial;

    if ($run_partner_count) {
        echo "$invoice_no";
    } else {
        echo "error";
    }
}
