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

    $in_year = date("y") - 1;

    $today = date("d-m-Y");

    $raw_fin_year = (date("y") - 1) . "-" . (date("y"));

    $get_partner_count = "SELECT * FROM invoice where LEFT(invoice_no, 2)='$invoice_pre' and MID(invoice_no, 3, 5)='$raw_fin_year' order by RIGHT(invoice_no, 3) desc limit 1";
    $run_partner_count = mysqli_query($con, $get_partner_count);
    $row_partner_count = mysqli_fetch_array($run_partner_count);
    $count_fin_yer = mysqli_num_rows($run_partner_count);

    $invoice_no_bef = (!empty($row_partner_count)) ? $row_partner_count['invoice_no'] : 0;

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
if (isset($_POST['pay_submit'])) {
    $invoice_id = $_POST['invoice_id'];
    $pay_date = $_POST['pay_date'];
    $pay_type = $_POST['pay_type'];
    $pay_amt = $_POST['pay_amt'];
    $invoice_update = "update invoice set pay_date='$pay_date',pay_type='$pay_type',pay_amt='$pay_amt' where invoice_id='$invoice_id'";
    $run_invoice_update = mysqli_query($con, $invoice_update);

    if ($run_invoice_update) {
        echo "<script>alert('Invoice entry successfull')</script>";
        echo "<script>window.open('../index.php?invoice_bulk_entries','_self')</script>";
    } else {
        echo "<script>alert('Invoice entry failed')</script>";
        echo "<script>window.open('../index.php?invoice_bulk_entries','_self')</script>";
    }
}


if (isset($_POST['datatable'])) {
    $params = 'i.invoice_id as invoice_id,i.invoice_no as invoice_no,i.partner_id as partner_id,i.invoice_date as invoice_date,i.billed_title as billed_title,i.pay_date as pay_date,i.pay_type as pay_type,i.pay_amt as pay_amt';
    $params .= ',sum((ip.unit_rate*ip.carton_qty) + ((ip.unit_rate*ip.carton_qty)*(ip.gst_rate/100))) as invoice_tax_total,sum(ip.unit_rate*ip.carton_qty) as invoice_total';
    $get_invoice_entries = "select $params from invoice i inner join invoice_products ip on i.invoice_no=ip.invoice_no group by ip.invoice_no order by invoice_id desc";
    $run_invoice_entries = mysqli_query($con, $get_invoice_entries);
    $data = [];
    while ($row__invoice_entries = mysqli_fetch_array($run_invoice_entries)) {

        $invoice_id = $row__invoice_entries['invoice_id'];
        $invoice_no = $row__invoice_entries['invoice_no'];
        $partner_id = $row__invoice_entries['partner_id'];
        $invoice_date = $row__invoice_entries['invoice_date'];
        $billed_title = $row__invoice_entries['billed_title'];
        $pay_date = $row__invoice_entries['pay_date'];
        $pay_type = $row__invoice_entries['pay_type'];
        $pay_amt = $row__invoice_entries['pay_amt'];

        $get_partner = "select * from partners where partner_id='$partner_id'";
        $run_partner = mysqli_query($con, $get_partner);
        $row_partner = mysqli_fetch_array($run_partner);

        $partner_title = $row_partner['partner_title'];

        $invoice_total = $row__invoice_entries['invoice_total'];
        $invoice_tax_total = $row__invoice_entries['invoice_tax_total'];
        $action_str = '<a class="btn btn-primary" href="index.php?update_paid=' . $invoice_id . '"><i class="fa fa-pen"></i></a>';
        $temp_data = [
            'inc_id' => $invoice_id,
            'date' => date("d-M-Y", strtotime($invoice_date)),
            'inc_no' => $invoice_no,
            'billed_to' => $billed_title,
            'comp_name' => $partner_title,
            'taxa_amt' => round($invoice_total, 2),
            'tot_amt' => ($partner_id == 3) ? ($invoice_total - $pay_amt) : (round($invoice_tax_total, 2)),
            'balance' => ($partner_id == 3) ? ($invoice_total - $pay_amt) : (round($invoice_tax_total, 2) - $pay_amt),
            'status' => ($partner_id == 3) ? ($invoice_total - $pay_amt) : (((round($invoice_tax_total, 2) - $pay_amt) == 0) ? 'Paid ' . date('d-m-y', strtotime($pay_date)) : (((round($invoice_tax_total, 2) - $pay_amt) > 0 && (round($invoice_tax_total, 2) - $pay_amt) < round($invoice_tax_total, 2)) ? 'Partial Paid ' . date('d-m-y', strtotime($pay_date)) : 'Pending')),
            'action' => $action_str
        ];

        array_push($data, $temp_data);
    }

    echo json_encode($data);
}

if (isset($_POST['invoice_table'])) {

    $get_invoice = "SELECT * FROM invoice order by invoice_id DESC";
    $run_invoice = mysqli_query($con, $get_invoice);
    $counter = 0;
    $data = [];
    while ($row_invoice = mysqli_fetch_array($run_invoice)) {

        $counter = ++$counter;
        $partner_id = $row_invoice['partner_id'];
        $invoice_no = $row_invoice['invoice_no'];
        $invoice_date = $row_invoice['invoice_date'];
        $transporter_title = $row_invoice['transporter_title'];
        $vehicle_no = $row_invoice['vehicle_no'];
        $eway_no = $row_invoice['eway_no'];
        $ship_date = $row_invoice['ship_date'];
        $billed_title = $row_invoice['billed_title'];
        $billed_contact = $row_invoice['billed_contact'];
        $billed_address = $row_invoice['billed_address'];
        $billed_state = $row_invoice['billed_state'];
        $billed_state_code = $row_invoice['billed_state_code'];
        $billed_gst = $row_invoice['billed_gst'];
        $ship_title = $row_invoice['ship_title'];
        $ship_contact = $row_invoice['ship_contact'];
        $ship_address = $row_invoice['ship_address'];
        $ship_state = $row_invoice['ship_state'];
        $ship_state_code = $row_invoice['ship_state_code'];
        $ship_gst = $row_invoice['ship_gst'];
        $discount = $row_invoice['discount'];
        $due_date = $row_invoice['due_date'];

        $get_partner = "select * from partners where partner_id='$partner_id'";
        $run_partner = mysqli_query($con, $get_partner);
        $row_partner = mysqli_fetch_array($run_partner);

        $partner_title = $row_partner['partner_title'];

        $comp_det = 'Invoice Date : ' . date("d-M-Y", strtotime($invoice_date)) . '<br>'
            . 'Invoice Number : ' . $invoice_no . '<br>'
            . 'Company : ' . $partner_title . '<br>'
            . 'Transporter Name : ' . $transporter_title . '<br>'
            . 'Vehicle Number : ' . $vehicle_no . '<br>'
            . 'E Way Bill : ' . $eway_no . '<br>'
            . 'Shipping Date  ' . date("d-M-Y", strtotime($ship_date));
        $custo_det = '<h5>Billed To</h5><br>'
            . $billed_title . '<br>'
            . $billed_contact . '<br>'
            . $billed_address . '<br>'
            . $billed_state
            . '(State Code :' . $billed_state_code . ') <br>'
            . $billed_gst . ' <br> <br>'
            . '<h5>Shipped To</h5><br>'
            . $ship_title . '<br>'
            . $ship_contact . '<br>'
            . $ship_address . '<br>'
            . $ship_state
            . '(State Code :' . $ship_state_code . ') <br>'
            . $ship_gst;
        $action_str = '<a href="' . (($partner_id == 3) ? 'cash_invoice.php' : 'print_invoice.php') . '?invoice_no=' . $invoice_no . '" target="_blank" class="btn btn-primary">Print</a><br>'
            . '<a href="' . (($partner_id == 3) ? 'dwnch_invoice.php' : 'invoice.php') . '?invoice_no=' . $invoice_no . '" target="_blank" class="btn btn-primary mt-2">Download</a><br>'
            . '<a href="delete_invoice.php?invoice_no=' . $invoice_no . '" class="btn btn-danger mt-2" onclick="return confirm(\'Are you sure?\')">Delete</a>';

        $temp_data = [
            'sl_no' => $counter++,
            'company_details' => $comp_det,
            'cust_details' => $custo_det,
            'action' => $action_str
        ];

        array_push($data, $temp_data);
    }
    echo json_encode($data);
}
