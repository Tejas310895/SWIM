<?php

include("includes/db.php");

?>
<?php

if (isset($_GET['invoice_no'])) {

    $invoice_no = $_GET['invoice_no'];

    $get_print = "select * from invoice where invoice_no='$invoice_no'";
    $run_print = mysqli_query($con, $get_print);
    $row_print = mysqli_fetch_array($run_print);

    $partner_id = $row_print['partner_id'];
    $invoice_date = $row_print['invoice_date'];
    $transporter_title = $row_print['transporter_title'];
    $vehicle_no = $row_print['vehicle_no'];
    $eway_no = $row_print['eway_no'];
    $ship_date = $row_print['ship_date'];
    $billed_title = $row_print['billed_title'];
    $billed_contact = $row_print['billed_contact'];
    $billed_address = $row_print['billed_address'];
    $billed_state = $row_print['billed_state'];
    $billed_state_code = $row_print['billed_state_code'];
    $billed_gst = $row_print['billed_gst'];
    $ship_title = $row_print['ship_title'];
    $ship_contact = $row_print['ship_contact'];
    $ship_address = $row_print['ship_address'];
    $ship_state = $row_print['ship_state'];
    $ship_state_code = $row_print['ship_state_code'];
    $ship_gst = $row_print['ship_gst'];
    $discount = $row_print['discount'];
    $due_date = $row_print['due_date'];

    $get_partner = "select * from partners where partner_id='$partner_id'";
    $run_partner = mysqli_query($con, $get_partner);
    $row_partner = mysqli_fetch_array($run_partner);

    $partner_title = $row_partner['partner_title'];
    $partner_contact = $row_partner['partner_contact'];
    $partner_email = $row_partner['partner_email'];
    $partner_address = $row_partner['partner_address'];
    $partner_state = $row_partner['partner_state'];
    $partner_state_code = $row_partner['partner_state_code'];
    $bank_name = $row_partner['bank_name'];
    $ac_number = $row_partner['ac_number'];
    $branch_name = $row_partner['branch_name'];
    $ifsc_code = $row_partner['ifsc_code'];
    $ac_holder = $row_partner['ac_holder'];
    $partner_gst = $row_partner['partner_gst'];



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Silver Wrap</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="assets/images/favicon.png" />
        <style>
            @media print {
                .pagebreak {
                    page-break-before: always;
                }
            }

            @page {
                margin: 2%;
            }
        </style>
        <script>
            window.onload = function() {
                window.print();
            }

            window.onafterprint = function() {
                window.close();
            }
        </script>
    </head>

    <body>

        <div class="container-fluid text-dark bg-white">
            <div class="row">
                <div class="col-9 px-0" style="border:1px solid #000;">
                    <h4 class="text-center p-2 mb-0">
                        TAX INVOICE
                    </h4>
                </div>
                <div class="col-3 px-0" style="border:1px solid #000;">
                    <h5 class="text-center p-2 mb-0">
                        Original For Recipient
                    </h5>
                </div>
                <div class="col-6 pt-2 text-center pt-2" style="border:1px solid #000;text-transform: uppercase;">
                    <h1 class="mb-0 text-uppercase"><?php echo $partner_title; ?></h1>
                </div>
                <div class="col-6 p-2" style="border:1px solid #000;">
                    <h5 class="text-center mb-0 text-capitalize"><?php echo $partner_address; ?></h5>
                    <h5 class="text-center mb-0">✆ +91 <?php echo $partner_contact; ?> | ✉ <?php echo $partner_email; ?></h5>
                </div>
                <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                    <h5>GSTIN Number : <?php echo $partner_gst; ?></h5>
                    <h5>Invoice Number : <?php echo $invoice_no; ?></h5>
                    <h5>Invoice Date : <?php echo date("d-M-Y", strtotime($invoice_date)); ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: <?php echo $partner_state; ?>
                        <table class="float-right mr-5">
                            <th class="px-2">State Code :</th>
                            <th class="px-3"> <?php echo $partner_state_code; ?></th>
                        </table>
                    </h5>
                </div>
                <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Transportor : <?php echo $transporter_title; ?></h5>
                    <h5>E-way Number : <?php echo $eway_no; ?></h5>
                    <h5 class="text-uppercase">Vehicle Number: <?php echo $vehicle_no; ?></h5>
                    <h5 class="mb-0">Supply Date : <?php echo date("d-M-Y", strtotime($ship_date)); ?></h5>
                </div>
                <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                    <h4 class="mb-0">Details Of Reciever (Billed To)</h4>
                </div>
                <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                    <h4 class="mb-0">Details Of consignee (Shipped To)</h4>
                </div>
                <!-- Billed to -->
                <div class="col-6 pt-2" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Name : <?php echo $billed_title; ?></h5>
                    <h5>Contact : +91 <?php echo $billed_contact; ?></h5>
                    <h5>Address : <?php echo $billed_address; ?></h5>
                    <h5 class="text-uppercase">GSTIN Number: <?php echo $billed_gst; ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: <?php echo $billed_state; ?>
                        <table class="float-right mr-5">
                            <th class="px-2">State Code :</th>
                            <th class="px-3"> <?php echo $billed_state_code; ?></th>
                        </table>
                    </h5>
                </div>
                <!-- Shipped to -->
                <div class="col-6 pt-2" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Name : <?php echo $ship_title; ?></h5>
                    <h5>Contact : +91 <?php echo $ship_contact; ?></h5>
                    <h5 class="text-capitalize">Address : <?php echo $ship_address; ?></h5>
                    <h5 class="text-uppercase">GSTIN Number: <?php echo $ship_gst; ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: <?php echo $ship_state; ?>
                        <table class="float-right mr-5">
                            <th class="px-2">State Code :</th>
                            <th class="px-3"> <?php echo $ship_state_code; ?></th>
                        </table>
                    </h5>
                </div>
                <div class="col-12 px-0 mt-2">
                    <table class="border-0 text-dark" style="width:100%;">
                        <thead style="font-size:1.1rem;">
                            <tr class="text-center">
                                <th class="align-middle p-1">Sl.No</th>
                                <th class="align-middle p-1">Description of goods</th>
                                <th class="align-middle p-1">HSN Code</th>
                                <th class="align-middle p-1">Quantity</th>
                                <th class="align-middle p-1">Rate<br><small>(Per Carton/<br>Bundle)</small></th>
                                <th class="align-middle p-1">Amount</th>
                                <th class="align-middle p-1">Discount</th>
                                <th class="align-middle  p-1">Taxable Value</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:0.7rem;">
                            <?php

                            $get_inc_pro = "select * from invoice_products where invoice_no='$invoice_no'";
                            $run_inc_pro = mysqli_query($con, $get_inc_pro);
                            $pro_counter = 0;
                            $total_amount = 0;
                            while ($row_inc_pro = mysqli_fetch_array($run_inc_pro)) {
                                $carton_id = $row_inc_pro['carton_id'];
                                $inc_carton_qty = $row_inc_pro['carton_qty'];
                                $unit_rate = $row_inc_pro['unit_rate'];
                                $gst_type = $row_inc_pro['gst_type'];
                                $hsn_code = $row_inc_pro['hsn_code'];
                                $gst_rate = $row_inc_pro['gst_rate'];
                                $discount = $row_inc_pro['discount'];

                                $get_carton = "select * from cartons where carton_id='$carton_id'";
                                $run_carton = mysqli_query($con, $get_carton);
                                $row_carton = mysqli_fetch_array($run_carton);
                                $product_id = $row_carton['product_id'];
                                $carton_title = $row_carton['carton_title'];
                                $carton_qty = $row_carton['carton_qty'];

                                $get_product = "select * from products where product_id='$product_id'";
                                $run_product = mysqli_query($con, $get_product);
                                $row_product = mysqli_fetch_array($run_product);
                                $product_name = $row_product['product_name'];


                                $taxable_amount = $unit_rate * $inc_carton_qty;
                                $total = $taxable_amount - ($taxable_amount * ($discount / 100));
                                $total_amount += $total;

                            ?>
                                <tr class="text-center" style="font-size:1rem;">
                                    <td class=" p-1"><?php echo ++$pro_counter; ?></td>
                                    <td class=" p-1"><?php echo $carton_title; ?></td>
                                    <td class=" p-1"><?php echo $hsn_code; ?></td>
                                    <td class=" p-1"><?php echo $inc_carton_qty; ?></td>
                                    <td class=" p-1"><?php echo $unit_rate; ?></td>
                                    <td class=" p-1"><?php echo $taxable_amount; ?></td>
                                    <td class=" p-1"><?php echo $discount; ?> %</td>
                                    <td class=" p-1"><?php echo $taxable_amount - ($taxable_amount * ($discount / 100)); ?></td>
                                </tr>
                            <?php } ?>
                            <?php

                            $get_inc_count = "select * from invoice_products where invoice_no='$invoice_no'";
                            $run_inc_count = mysqli_query($con, $get_inc_count);
                            $inc_count = mysqli_num_rows($run_inc_count);
                            $req_count = 10 - $inc_count;

                            if ($req_count > 1) {

                                for ($x = 0; $x <= $req_count; $x++) {
                                    echo "
                                <tr>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                </tr>
                            ";
                                }
                            } else {
                                echo "";
                            }

                            ?>
                        </tbody>
                        <tfoot style="font-size:0.8rem;">
                            <tr>
                                <th colspan="7" class="text-right pr-2">
                                    <h5 class="mb-0">TOTAL TAXABLE VALUE</h5>
                                </th>
                                <th class="text-center">
                                    <h5 class="mb-0"><?php echo $total_amount; ?></h5>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 px-0 mt-2 mb-2">
                    <table style="width:100%;">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">HSN/SAC</th>
                                <th rowspan="2">Taxable Value</th>
                                <th colspan="2">CGST</th>
                                <th colspan="2">SGST</th>
                                <th colspan="2">IGST</th>
                                <th rowspan="2">Total Tax Amount</th>
                            </tr>
                            <tr class="text-center">
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_dis_hsn = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                            $run_dis_hsn = mysqli_query($con, $get_dis_hsn);
                            $grand_taxable = 0;
                            $grand_cgst = 0;
                            $grand_sgst = 0;
                            $grand_igst = 0;
                            while ($row_dis_hsn = mysqli_fetch_array($run_dis_hsn)) {
                                $dis_hsn = $row_dis_hsn['hsn_code'];

                                $get_gst_rate = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                $run_gst_rate = mysqli_query($con, $get_gst_rate);
                                $row_gst_rate = mysqli_fetch_array($run_gst_rate);
                                $dis_gst_rate = $row_gst_rate['gst_rate'];
                                $dis_gst_type = $row_gst_rate['gst_type'];
                                $dis_carton_qty = $row_gst_rate['carton_qty'];
                                $dis_unit_rate = $row_gst_rate['unit_rate'];

                                if ($dis_gst_type === 'STA_TAX') {
                                    $cgst_tax_hsn = $dis_gst_rate / 2;
                                    $sgst_tax_hsn = $dis_gst_rate / 2;
                                    $igst_tax_hsn = 0;
                                } else {
                                    $cgst_tax_hsn = 0;
                                    $sgst_tax_hsn = 0;
                                    $igst_tax_hsn = $dis_gst_rate;
                                }


                                $get_hsn = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                $run_hsn = mysqli_query($con, $get_hsn);
                                $cgst_amount_hsn = 0;
                                $sgst_amount_hsn = 0;
                                $igst_amount_hsn = 0;
                                $total_taxable_amount_hsn = 0;
                                while ($row_hsn = mysqli_fetch_array($run_hsn)) {

                                    $carton_qty_hsn = $row_hsn['carton_qty'];
                                    $unit_rate_hsn = $row_hsn['unit_rate'];
                                    $gst_type_hsn = $row_hsn['gst_type'];
                                    $gst_rate_hsn = $row_hsn['gst_rate'];
                                    $gst_discount_hsn = $row_hsn['discount'];

                                    $taxable_amount_hsn_bef_discount_hsn = $unit_rate_hsn * $carton_qty_hsn;
                                    $taxable_amount_hsn = $taxable_amount_hsn_bef_discount_hsn - ($taxable_amount_hsn_bef_discount_hsn * ($gst_discount_hsn / 100));
                                    $total_taxable_amount_hsn += $taxable_amount_hsn;

                                    if ($gst_type_hsn === 'STA_TAX') {
                                        $cgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                        $sgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                        $igst_amount_hsn += 0;
                                    } else {
                                        $cgst_amount_hsn += 0;
                                        $sgst_amount_hsn += 0;
                                        $igst_amount_hsn += $taxable_amount_hsn * ($gst_rate_hsn / 100);
                                    }
                                }
                                $grand_taxable += $total_taxable_amount_hsn;
                                $grand_cgst += $cgst_amount_hsn;
                                $grand_sgst += $sgst_amount_hsn;
                                $grand_igst += $igst_amount_hsn;
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $dis_hsn; ?></td>
                                    <td><?php echo $total_taxable_amount_hsn; ?></td>
                                    <td><?php echo $cgst_tax_hsn; ?> %</td>
                                    <td><?php echo $cgst_amount_hsn; ?></td>
                                    <td><?php echo $sgst_tax_hsn; ?> %</td>
                                    <td><?php echo $sgst_amount_hsn; ?></td>
                                    <td><?php echo $igst_tax_hsn; ?> %</td>
                                    <td><?php echo $igst_amount_hsn; ?></td>
                                    <td><?php echo $cgst_amount_hsn + $sgst_amount_hsn + $igst_amount_hsn; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>TOTAL</th>
                                <th><?php echo $grand_taxable; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_cgst; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_sgst; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_igst; ?></th>
                                <th><?php echo $grand_cgst + $grand_sgst + $grand_igst; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-5 pt-2" style="border:1px solid #000;">
                    <h5 class="text-uppercase"><u>Bank Details</u></h5>
                    <h5 class="text-uppercase">Bank : <?php echo $bank_name; ?></h5>
                    <h5 class="text-uppercase">AC Number : <?php echo $ac_number; ?> </h5>
                    <h5 class="text-uppercase">Branch : <?php echo $branch_name; ?> (IFSC:<?php echo $ifsc_code; ?>)</h5>
                    <h5 class="text-uppercase">AC Holder : <?php echo $ac_holder; ?></h5>
                    <h5 class="text-uppercase">Due Date : <?php echo date("d-M-Y", strtotime($due_date)); ?></h5>
                </div>
                <div class="col-3 pt-2" style="border:1px solid #000;">
                    <h6 style="font-size:0.8rem;text-align:center;">Customer Signature</h6>
                </div>
                <div class="col-4 px-0">
                    <table class="table text-dark" style="height:100%;">
                        <?php

                        $get_dis_ex = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                        $run_dis_ex = mysqli_query($con, $get_dis_ex);
                        $grand_taxable_ex = 0;
                        $grand_cgst_ex = 0;
                        $grand_sgst_ex = 0;
                        $grand_igst_ex = 0;
                        while ($row_dis_ex = mysqli_fetch_array($run_dis_ex)) {
                            $dis_hsn_ex = $row_dis_ex['hsn_code'];

                            $get_gst_rate_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                            $run_gst_rate_ex = mysqli_query($con, $get_gst_rate_ex);
                            $row_gst_rate_ex = mysqli_fetch_array($run_gst_rate_ex);
                            $dis_gst_rate_ex = $row_gst_rate_ex['gst_rate'];
                            $dis_gst_type_ex = $row_gst_rate_ex['gst_type'];
                            $dis_carton_qty_ex = $row_gst_rate_ex['carton_qty'];
                            $dis_unit_rate_ex = $row_gst_rate_ex['unit_rate'];

                            if ($dis_gst_type_ex === 'STA_TAX') {
                                $cgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                $sgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                $igst_tax_hsn_ex = 0;
                            } else {
                                $cgst_tax_hsn_ex = 0;
                                $sgst_tax_hsn_ex = 0;
                                $igst_tax_hsn_ex = $dis_gst_rate_ex;
                            }


                            $get_hsn_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                            $run_hsn_ex = mysqli_query($con, $get_hsn_ex);
                            $cgst_amount_hsn_ex = 0;
                            $sgst_amount_hsn_ex = 0;
                            $igst_amount_hsn_ex = 0;
                            $total_taxable_amount_hsn_ex = 0;
                            while ($row_hsn_ex = mysqli_fetch_array($run_hsn_ex)) {

                                $carton_qty_hsn_ex = $row_hsn_ex['carton_qty'];
                                $unit_rate_hsn_ex = $row_hsn_ex['unit_rate'];
                                $gst_type_hsn_ex = $row_hsn_ex['gst_type'];
                                $gst_rate_hsn_ex = $row_hsn_ex['gst_rate'];
                                $gst_discount_hsn_ex = $row_hsn_ex['discount'];

                                $taxable_amount_hsn_bef_discount_ex = $unit_rate_hsn_ex * $carton_qty_hsn_ex;
                                $taxable_amount_hsn_ex = $taxable_amount_hsn_bef_discount_ex - ($taxable_amount_hsn_bef_discount_ex * ($gst_discount_hsn_ex / 100));
                                $total_taxable_amount_hsn_ex += $taxable_amount_hsn_ex;

                                if ($gst_type_hsn_ex === 'STA_TAX') {
                                    $cgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                    $sgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                    $igst_amount_hsn_ex += 0;
                                } else {
                                    $cgst_amount_hsn_ex += 0;
                                    $sgst_amount_hsn_ex += 0;
                                    $igst_amount_hsn_ex += $taxable_amount_hsn_ex * ($gst_rate_hsn_ex / 100);
                                }
                            }
                            $grand_taxable_ex += $total_taxable_amount_hsn_ex;
                            $grand_cgst_ex += $cgst_amount_hsn_ex;
                            $grand_sgst_ex += $sgst_amount_hsn_ex;
                            $grand_igst_ex += $igst_amount_hsn_ex;
                        }

                        ?>
                        <tr>
                            <th class="py-1">Taxable Amount</th>
                            <td class="py-1 text-right"><?php echo $grand_taxable_ex; ?></td>
                        </tr>
                        <tr class="<?php if ($grand_cgst_ex >= 1) {
                                        echo "show";
                                    } else {
                                        echo "d-none";
                                    } ?>">
                            <th class="py-1">Output CGST</th>
                            <td class="py-1 text-right"><?php echo $grand_cgst_ex; ?></td>
                        </tr>
                        <tr class="<?php if ($grand_sgst_ex >= 1) {
                                        echo "show";
                                    } else {
                                        echo "d-none";
                                    } ?>">
                            <th class="py-1">Output SGST</th>
                            <td class="py-1 text-right"><?php echo $grand_sgst_ex; ?></td>
                        </tr>
                        <tr class="<?php if ($grand_igst_ex >= 1) {
                                        echo "show";
                                    } else {
                                        echo "d-none";
                                    } ?>">
                            <th class="py-1">Output IGST</th>
                            <td class="py-1 text-right"><?php echo $grand_igst_ex; ?></td>
                        </tr>
                        <tr>
                            <th class="py-1">Total Tax</th>
                            <td class="py-1 text-right"><?php echo $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex; ?></td>
                        </tr>
                        <tr>
                            <th class="py-1">Round Off</th>
                            <td class="py-1 text-right"><?php echo round(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex) - ($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex), 2); ?></td>
                        </tr>
                        <tr>
                            <th class="py-1">Grand Total</th>
                            <td class="py-1 text-right"><?php echo round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-12" style="border:1px solid #000;">
                    <h5 class="my-2 text-right text-uppercase">
                        TOTAL IN WORDS : INR
                        <?php
                        // Create a function for converting the amount in words
                        function AmountInWords(float $amount)
                        {
                            $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
                            // Check if there is any number after decimal
                            $amt_hundred = null;
                            $count_length = strlen($num);
                            $x = 0;
                            $string = array();
                            $change_words = array(
                                0 => '', 1 => 'One', 2 => 'Two',
                                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
                            );
                            $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                            while ($x < $count_length) {
                                $get_divider = ($x == 2) ? 10 : 100;
                                $amount = floor($num % $get_divider);
                                $num = floor($num / $get_divider);
                                $x += $get_divider == 10 ? 1 : 2;
                                if ($amount) {
                                    $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                                    $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                                    $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
                            ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
                            ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
                                } else $string[] = null;
                            }
                            $implode_to_Rupees = implode('', array_reverse($string));
                            $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
                        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
                            return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
                        }


                        // call the function here
                        $amt_words = $total_amount;
                        // nummeric value in variable

                        $get_grand_amount = AmountInWords(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex));
                        echo $get_grand_amount;

                        ?> Only
                    </h5>
                </div>
                <div class="col-8 py-2" style="border:1px solid #000;">
                    <h4><u>TERMS & CONDITIONS:</u></h4>
                    <p class="mb-0 font-italic">
                        1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
                        2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
                        3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
                        4. Goods once sold will not be taken back. <br>
                        5. All disputes are subject to Mumbai Juridiction only.
                    </p>
                </div>
                <div class="col-4 text-center py-2" style="border:1px solid #000;">
                    <p class="text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
                    <h5 class="text-center text-uppercase">For <?php echo $partner_title; ?></h5> <br>
                    <br>
                    <br>
                    <br>
                    <h5 class="text-center">Authorised Signature</h5>
                </div>
            </div>
        </div>

        <div class="pagebreak">
            <div class="container-fluid text-dark bg-white">
                <div class="row">
                    <div class="col-8 px-0" style="border:1px solid #000;">
                        <h4 class="text-center p-2 mb-0">
                            TAX INVOICE
                        </h4>
                    </div>
                    <div class="col-4 px-0" style="border:1px solid #000;">
                        <h5 class="text-center p-2 mb-0">
                            Duplicate For Transporter
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-4 pt-2 text-center pt-2" style="border:1px solid #000;text-transform: uppercase;">
                            <h1 class="mb-0 text-uppercase"><?php echo $partner_title; ?></h1>
                        </div>
                        <div class="col-6 p-2" style="border:1px solid #000;">
                            <h5 class="text-center mb-0 text-capitalize"><?php echo $partner_address; ?></h5>
                            <h5 class="text-center mb-0">✆ +91 <?php echo $partner_contact; ?> | ✉ <?php echo $partner_email; ?></h5>
                        </div>
                    </div>
                    <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                        <h5>GSTIN Number : <?php echo $partner_gst; ?></h5>
                        <h5>Invoice Number : <?php echo $invoice_no; ?></h5>
                        <h5>Invoice Date : <?php echo date("d-M-Y", strtotime($invoice_date)); ?></h5>
                        <h5 class="mb-0 text-uppercase">
                            State: <?php echo $partner_state; ?>
                            <table class="float-right mr-5">
                                <th class="px-2">State Code :</th>
                                <th class="px-3"> <?php echo $partner_state_code; ?></th>
                            </table>
                        </h5>
                    </div>
                    <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                        <h5 class="text-capitalize">Transportor : <?php echo $transporter_title; ?></h5>
                        <h5>E-way Number : <?php echo $eway_no; ?></h5>
                        <h5 class="text-uppercase">Vehicle Number: <?php echo $vehicle_no; ?></h5>
                        <h5 class="mb-0">Supply Date : <?php echo date("d-M-Y", strtotime($ship_date)); ?></h5>
                    </div>
                    <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                        <h4 class="mb-0">Details Of Reciever (Billed To)</h4>
                    </div>
                    <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                        <h4 class="mb-0">Details Of consignee (Shipped To)</h4>
                    </div>
                    <!-- Billed to -->
                    <div class="col-6 pt-2" style="border:1px solid #000;">
                        <h5 class="text-capitalize">Name : <?php echo $billed_title; ?></h5>
                        <h5>Contact : +91 <?php echo $billed_contact; ?></h5>
                        <h5>Address : <?php echo $billed_address; ?></h5>
                        <h5 class="text-uppercase">GSTIN Number: <?php echo $billed_gst; ?></h5>
                        <h5 class="mb-0 text-uppercase">
                            State: <?php echo $billed_state; ?>
                            <table class="float-right mr-5">
                                <th class="px-2">State Code :</th>
                                <th class="px-3"> <?php echo $billed_state_code; ?></th>
                            </table>
                        </h5>
                    </div>
                    <!-- Shipped to -->
                    <div class="col-6 pt-2" style="border:1px solid #000;">
                        <h5 class="text-capitalize">Name : <?php echo $ship_title; ?></h5>
                        <h5>Contact : +91 <?php echo $ship_contact; ?></h5>
                        <h5 class="text-capitalize">Address : <?php echo $ship_address; ?></h5>
                        <h5 class="text-uppercase">GSTIN Number: <?php echo $ship_gst; ?></h5>
                        <h5 class="mb-0 text-uppercase">
                            State: <?php echo $ship_state; ?>
                            <table class="float-right mr-5">
                                <th class="px-2">State Code :</th>
                                <th class="px-3"> <?php echo $ship_state_code; ?></th>
                            </table>
                        </h5>
                    </div>
                    <div class="col-12 px-0 mt-2">
                        <table class="border-0 text-dark" style="width:100%;">
                            <thead style="font-size:1.1rem;">
                                <tr class="text-center">
                                    <th class="align-middle p-1">Sl.No</th>
                                    <th class="align-middle p-1">Description of goods</th>
                                    <th class="align-middle p-1">HSN Code</th>
                                    <th class="align-middle p-1">Quantity</th>
                                    <th class="align-middle p-1">Rate<br><small>(Per Carton/<br>Bundle)</small></th>
                                    <th class="align-middle p-1">Amount</th>
                                    <th class="align-middle p-1">Discount</th>
                                    <th class="align-middle  p-1">Taxable Value</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:0.7rem;">
                                <?php

                                $get_inc_pro = "select * from invoice_products where invoice_no='$invoice_no'";
                                $run_inc_pro = mysqli_query($con, $get_inc_pro);
                                $pro_counter = 0;
                                $total_amount = 0;
                                while ($row_inc_pro = mysqli_fetch_array($run_inc_pro)) {
                                    $carton_id = $row_inc_pro['carton_id'];
                                    $inc_carton_qty = $row_inc_pro['carton_qty'];
                                    $unit_rate = $row_inc_pro['unit_rate'];
                                    $gst_type = $row_inc_pro['gst_type'];
                                    $hsn_code = $row_inc_pro['hsn_code'];
                                    $gst_rate = $row_inc_pro['gst_rate'];
                                    $discount = $row_inc_pro['discount'];

                                    $get_carton = "select * from cartons where carton_id='$carton_id'";
                                    $run_carton = mysqli_query($con, $get_carton);
                                    $row_carton = mysqli_fetch_array($run_carton);
                                    $product_id = $row_carton['product_id'];
                                    $carton_title = $row_carton['carton_title'];
                                    $carton_qty = $row_carton['carton_qty'];

                                    $get_product = "select * from products where product_id='$product_id'";
                                    $run_product = mysqli_query($con, $get_product);
                                    $row_product = mysqli_fetch_array($run_product);
                                    $product_name = $row_product['product_name'];


                                    $taxable_amount = $unit_rate * $inc_carton_qty;
                                    $total = $taxable_amount - ($taxable_amount * ($discount / 100));
                                    $total_amount += $total;

                                ?>
                                    <tr class="text-center" style="font-size:1rem;">
                                        <td class=" p-1"><?php echo ++$pro_counter; ?></td>
                                        <td class=" p-1"><?php echo $carton_title; ?></td>
                                        <td class=" p-1"><?php echo $hsn_code; ?></td>
                                        <td class=" p-1"><?php echo $inc_carton_qty; ?></td>
                                        <td class=" p-1"><?php echo $unit_rate; ?></td>
                                        <td class=" p-1"><?php echo $taxable_amount; ?></td>
                                        <td class=" p-1"><?php echo $discount; ?> %</td>
                                        <td class=" p-1"><?php echo $taxable_amount - ($taxable_amount * ($discount / 100)); ?></td>
                                    </tr>
                                <?php } ?>
                                <?php

                                $get_inc_count = "select * from invoice_products where invoice_no='$invoice_no'";
                                $run_inc_count = mysqli_query($con, $get_inc_count);
                                $inc_count = mysqli_num_rows($run_inc_count);
                                $req_count = 10 - $inc_count;

                                if ($req_count > 1) {

                                    for ($x = 0; $x <= $req_count; $x++) {
                                        echo "
                                <tr>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                </tr>
                            ";
                                    }
                                } else {
                                    echo "";
                                }

                                ?>
                            </tbody>
                            <tfoot style="font-size:0.8rem;">
                                <tr>
                                    <th colspan="7" class="text-right pr-2">
                                        <h5 class="mb-0">TOTAL</h5>
                                    </th>
                                    <th class="text-center">
                                        <h5 class="mb-0"><?php echo $total_amount; ?></h5>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 px-0 mt-2 mb-2">
                        <table style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2">HSN/SAC</th>
                                    <th rowspan="2">Taxable Value</th>
                                    <th colspan="2">CGST</th>
                                    <th colspan="2">SGST</th>
                                    <th colspan="2">IGST</th>
                                    <th rowspan="2">Total Tax Amount</th>
                                </tr>
                                <tr class="text-center">
                                    <th class=" p-1">Rate</th>
                                    <th class=" p-1">Amount</th>
                                    <th class=" p-1">Rate</th>
                                    <th class=" p-1">Amount</th>
                                    <th class=" p-1">Rate</th>
                                    <th class=" p-1">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get_dis_hsn = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                                $run_dis_hsn = mysqli_query($con, $get_dis_hsn);
                                $grand_taxable = 0;
                                $grand_cgst = 0;
                                $grand_sgst = 0;
                                $grand_igst = 0;
                                while ($row_dis_hsn = mysqli_fetch_array($run_dis_hsn)) {
                                    $dis_hsn = $row_dis_hsn['hsn_code'];

                                    $get_gst_rate = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                    $run_gst_rate = mysqli_query($con, $get_gst_rate);
                                    $row_gst_rate = mysqli_fetch_array($run_gst_rate);
                                    $dis_gst_rate = $row_gst_rate['gst_rate'];
                                    $dis_gst_type = $row_gst_rate['gst_type'];
                                    $dis_carton_qty = $row_gst_rate['carton_qty'];
                                    $dis_unit_rate = $row_gst_rate['unit_rate'];

                                    if ($dis_gst_type === 'STA_TAX') {
                                        $cgst_tax_hsn = $dis_gst_rate / 2;
                                        $sgst_tax_hsn = $dis_gst_rate / 2;
                                        $igst_tax_hsn = 0;
                                    } else {
                                        $cgst_tax_hsn = 0;
                                        $sgst_tax_hsn = 0;
                                        $igst_tax_hsn = $dis_gst_rate;
                                    }


                                    $get_hsn = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                    $run_hsn = mysqli_query($con, $get_hsn);
                                    $cgst_amount_hsn = 0;
                                    $sgst_amount_hsn = 0;
                                    $igst_amount_hsn = 0;
                                    $total_taxable_amount_hsn = 0;
                                    while ($row_hsn = mysqli_fetch_array($run_hsn)) {

                                        $carton_qty_hsn = $row_hsn['carton_qty'];
                                        $unit_rate_hsn = $row_hsn['unit_rate'];
                                        $gst_type_hsn = $row_hsn['gst_type'];
                                        $gst_rate_hsn = $row_hsn['gst_rate'];
                                        $gst_discount_hsn = $row_hsn['discount'];

                                        $taxable_amount_hsn_bef_discount_hsn = $unit_rate_hsn * $carton_qty_hsn;
                                        $taxable_amount_hsn = $taxable_amount_hsn_bef_discount_hsn - ($taxable_amount_hsn_bef_discount_hsn * ($gst_discount_hsn / 100));
                                        $total_taxable_amount_hsn += $taxable_amount_hsn;

                                        if ($gst_type_hsn === 'STA_TAX') {
                                            $cgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                            $sgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                            $igst_amount_hsn += 0;
                                        } else {
                                            $cgst_amount_hsn += 0;
                                            $sgst_amount_hsn += 0;
                                            $igst_amount_hsn += $taxable_amount_hsn * ($gst_rate_hsn / 100);
                                        }
                                    }
                                    $grand_taxable += $total_taxable_amount_hsn;
                                    $grand_cgst += $cgst_amount_hsn;
                                    $grand_sgst += $sgst_amount_hsn;
                                    $grand_igst += $igst_amount_hsn;
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $dis_hsn; ?></td>
                                        <td><?php echo $total_taxable_amount_hsn; ?></td>
                                        <td><?php echo $cgst_tax_hsn; ?> %</td>
                                        <td><?php echo $cgst_amount_hsn; ?></td>
                                        <td><?php echo $sgst_tax_hsn; ?> %</td>
                                        <td><?php echo $sgst_amount_hsn; ?></td>
                                        <td><?php echo $igst_tax_hsn; ?> %</td>
                                        <td><?php echo $igst_amount_hsn; ?></td>
                                        <td><?php echo $cgst_amount_hsn + $sgst_amount_hsn + $igst_amount_hsn; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>TOTAL</th>
                                    <th><?php echo $grand_taxable; ?></th>
                                    <th>0</th>
                                    <th><?php echo $grand_cgst; ?></th>
                                    <th>0</th>
                                    <th><?php echo $grand_sgst; ?></th>
                                    <th>0</th>
                                    <th><?php echo $grand_igst; ?></th>
                                    <th><?php echo $grand_cgst + $grand_sgst + $grand_igst; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-5 pt-2" style="border:1px solid #000;">
                        <h5 class="text-uppercase"><u>Bank Details</u></h5>
                        <h5 class="text-uppercase">Bank : <?php echo $bank_name; ?></h5>
                        <h5 class="text-uppercase">AC Number : <?php echo $ac_number; ?> </h5>
                        <h5 class="text-uppercase">Branch : <?php echo $branch_name; ?> (IFSC:<?php echo $ifsc_code; ?>)</h5>
                        <h5 class="text-uppercase">AC Holder : <?php echo $ac_holder; ?></h5>
                        <h5 class="text-uppercase">Due Date : <?php echo date("d-M-Y", strtotime($due_date)); ?></h5>
                    </div>
                    <div class="col-3 pt-2" style="border:1px solid #000;">
                        <h6 style="font-size:0.8rem;text-align:center;">Customer Signature</h6>
                    </div>
                    <div class="col-4 px-0">
                        <table class="table text-dark" style="height:100%;">
                            <?php

                            $get_dis_ex = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                            $run_dis_ex = mysqli_query($con, $get_dis_ex);
                            $grand_taxable_ex = 0;
                            $grand_cgst_ex = 0;
                            $grand_sgst_ex = 0;
                            $grand_igst_ex = 0;
                            while ($row_dis_ex = mysqli_fetch_array($run_dis_ex)) {
                                $dis_hsn_ex = $row_dis_ex['hsn_code'];

                                $get_gst_rate_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                                $run_gst_rate_ex = mysqli_query($con, $get_gst_rate_ex);
                                $row_gst_rate_ex = mysqli_fetch_array($run_gst_rate_ex);
                                $dis_gst_rate_ex = $row_gst_rate_ex['gst_rate'];
                                $dis_gst_type_ex = $row_gst_rate_ex['gst_type'];
                                $dis_carton_qty_ex = $row_gst_rate_ex['carton_qty'];
                                $dis_unit_rate_ex = $row_gst_rate_ex['unit_rate'];

                                if ($dis_gst_type_ex === 'STA_TAX') {
                                    $cgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                    $sgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                    $igst_tax_hsn_ex = 0;
                                } else {
                                    $cgst_tax_hsn_ex = 0;
                                    $sgst_tax_hsn_ex = 0;
                                    $igst_tax_hsn_ex = $dis_gst_rate_ex;
                                }


                                $get_hsn_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                                $run_hsn_ex = mysqli_query($con, $get_hsn_ex);
                                $cgst_amount_hsn_ex = 0;
                                $sgst_amount_hsn_ex = 0;
                                $igst_amount_hsn_ex = 0;
                                $total_taxable_amount_hsn_ex = 0;
                                while ($row_hsn_ex = mysqli_fetch_array($run_hsn_ex)) {

                                    $carton_qty_hsn_ex = $row_hsn_ex['carton_qty'];
                                    $unit_rate_hsn_ex = $row_hsn_ex['unit_rate'];
                                    $gst_type_hsn_ex = $row_hsn_ex['gst_type'];
                                    $gst_rate_hsn_ex = $row_hsn_ex['gst_rate'];
                                    $gst_discount_hsn_ex = $row_hsn_ex['discount'];

                                    $taxable_amount_hsn_bef_discount_ex = $unit_rate_hsn_ex * $carton_qty_hsn_ex;
                                    $taxable_amount_hsn_ex = $taxable_amount_hsn_bef_discount_ex - ($taxable_amount_hsn_bef_discount_ex * ($gst_discount_hsn_ex / 100));
                                    $total_taxable_amount_hsn_ex += $taxable_amount_hsn_ex;

                                    if ($gst_type_hsn_ex === 'STA_TAX') {
                                        $cgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                        $sgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                        $igst_amount_hsn_ex += 0;
                                    } else {
                                        $cgst_amount_hsn_ex += 0;
                                        $sgst_amount_hsn_ex += 0;
                                        $igst_amount_hsn_ex += $taxable_amount_hsn_ex * ($gst_rate_hsn_ex / 100);
                                    }
                                }
                                $grand_taxable_ex += $total_taxable_amount_hsn_ex;
                                $grand_cgst_ex += $cgst_amount_hsn_ex;
                                $grand_sgst_ex += $sgst_amount_hsn_ex;
                                $grand_igst_ex += $igst_amount_hsn_ex;
                            }

                            ?>
                            <tr>
                                <th class="py-1">Taxable Amount</th>
                                <td class="py-1 text-right"><?php echo $grand_taxable_ex; ?></td>
                            </tr>
                            <tr class="<?php if ($grand_cgst_ex >= 1) {
                                            echo "show";
                                        } else {
                                            echo "d-none";
                                        } ?>">
                                <th class="py-1">Output CGST</th>
                                <td class="py-1 text-right"><?php echo $grand_cgst_ex; ?></td>
                            </tr>
                            <tr class="<?php if ($grand_sgst_ex >= 1) {
                                            echo "show";
                                        } else {
                                            echo "d-none";
                                        } ?>">
                                <th class="py-1">Output SGST</th>
                                <td class="py-1 text-right"><?php echo $grand_sgst_ex; ?></td>
                            </tr>
                            <tr class="<?php if ($grand_igst_ex >= 1) {
                                            echo "show";
                                        } else {
                                            echo "d-none";
                                        } ?>">
                                <th class="py-1">Output IGST</th>
                                <td class="py-1 text-right"><?php echo $grand_igst_ex; ?></td>
                            </tr>
                            <tr>
                                <th class="py-1">Total Tax</th>
                                <td class="py-1 text-right"><?php echo $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex; ?></td>
                            </tr>
                            <tr>
                                <th class="py-1">Round Off</th>
                                <td class="py-1 text-right"><?php echo round(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex) - ($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex), 2); ?></td>
                            </tr>
                            <tr>
                                <th class="py-1">Grand Total</th>
                                <td class="py-1 text-right"><?php echo round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12" style="border:1px solid #000;">
                        <h5 class="my-2 text-right text-uppercase">
                            TOTAL IN WORDS : INR
                            <?php
                            // call the function here
                            $amt_words = $total_amount;
                            // nummeric value in variable

                            $get_grand_amount = AmountInWords(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex));
                            echo $get_grand_amount;

                            ?> Only
                        </h5>
                    </div>
                    <div class="col-8 py-2" style="border:1px solid #000;">
                        <h4><u>TERMS & CONDITIONS:</u></h4>
                        <p class="mb-0 font-italic">
                            1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
                            2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
                            3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
                            4. Goods once sold will not be taken back. <br>
                            5. All disputes are subject to Mumbai Juridiction only.
                        </p>
                    </div>
                    <div class="col-4 text-center py-2" style="border:1px solid #000;">
                        <p class="text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
                        <h5 class="text-center text-uppercase">For <?php echo $partner_title; ?></h5> <br>
                        <br>
                        <br>
                        <br>
                        <h5 class="text-center">Authorised Signature</h5>
                    </div>
                </div>
            </div>
            <div class="pagebreak">
                <div class="container-fluid text-dark bg-white">
                    <div class="row">
                        <div class="col-9 px-0" style="border:1px solid #000;">
                            <h4 class="text-center p-2 mb-0">
                                TAX INVOICE
                            </h4>
                        </div>
                        <div class="col-3 px-0" style="border:1px solid #000;">
                            <h5 class="text-center p-2 mb-0">
                                Triplicate For Supplier
                            </h5>
                        </div>
                        <div class="col-6 pt-2 text-center pt-2" style="border:1px solid #000;text-transform: uppercase;">
                            <h1 class="mb-0 text-uppercase"><?php echo $partner_title; ?></h1>
                        </div>
                        <div class="col-6 p-2" style="border:1px solid #000;">
                            <h5 class="text-center mb-0 text-capitalize"><?php echo $partner_address; ?></h5>
                            <h5 class="text-center mb-0">✆ +91 <?php echo $partner_contact; ?> | ✉ <?php echo $partner_email; ?></h5>
                        </div>
                        <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                            <h5>GSTIN Number : <?php echo $partner_gst; ?></h5>
                            <h5>Invoice Number : <?php echo $invoice_no; ?></h5>
                            <h5>Invoice Date : <?php echo date("d-M-Y", strtotime($invoice_date)); ?></h5>
                            <h5 class="mb-0 text-uppercase">
                                State: <?php echo $partner_state; ?>
                                <table class="float-right mr-5">
                                    <th class="px-2">State Code :</th>
                                    <th class="px-3"> <?php echo $partner_state_code; ?></th>
                                </table>
                            </h5>
                        </div>
                        <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                            <h5 class="text-capitalize">Transportor : <?php echo $transporter_title; ?></h5>
                            <h5>E-way Number : <?php echo $eway_no; ?></h5>
                            <h5 class="text-uppercase">Vehicle Number: <?php echo $vehicle_no; ?></h5>
                            <h5 class="mb-0">Supply Date : <?php echo date("d-M-Y", strtotime($ship_date)); ?></h5>
                        </div>
                        <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                            <h4 class="mb-0">Details Of Reciever (Billed To)</h4>
                        </div>
                        <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                            <h4 class="mb-0">Details Of consignee (Shipped To)</h4>
                        </div>
                        <!-- Billed to -->
                        <div class="col-6 pt-2" style="border:1px solid #000;">
                            <h5 class="text-capitalize">Name : <?php echo $billed_title; ?></h5>
                            <h5>Contact : +91 <?php echo $billed_contact; ?></h5>
                            <h5>Address : <?php echo $billed_address; ?></h5>
                            <h5 class="text-uppercase">GSTIN Number: <?php echo $billed_gst; ?></h5>
                            <h5 class="mb-0 text-uppercase">
                                State: <?php echo $billed_state; ?>
                                <table class="float-right mr-5">
                                    <th class="px-2">State Code :</th>
                                    <th class="px-3"> <?php echo $billed_state_code; ?></th>
                                </table>
                            </h5>
                        </div>
                        <!-- Shipped to -->
                        <div class="col-6 pt-2" style="border:1px solid #000;">
                            <h5 class="text-capitalize">Name : <?php echo $ship_title; ?></h5>
                            <h5>Contact : +91 <?php echo $ship_contact; ?></h5>
                            <h5 class="text-capitalize">Address : <?php echo $ship_address; ?></h5>
                            <h5 class="text-uppercase">GSTIN Number: <?php echo $ship_gst; ?></h5>
                            <h5 class="mb-0 text-uppercase">
                                State: <?php echo $ship_state; ?>
                                <table class="float-right mr-5">
                                    <th class="px-2">State Code :</th>
                                    <th class="px-3"> <?php echo $ship_state_code; ?></th>
                                </table>
                            </h5>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <table class="border-0 text-dark" style="width:100%;">
                                <thead style="font-size:1.1rem;">
                                    <tr class="text-center">
                                        <th class="align-middle p-1">Sl.No</th>
                                        <th class="align-middle p-1">Description of goods</th>
                                        <th class="align-middle p-1">HSN Code</th>
                                        <th class="align-middle p-1">Quantity</th>
                                        <th class="align-middle p-1">Rate<br><small>(Per Carton/<br>Bundle)</small></th>
                                        <th class="align-middle p-1">Amount</th>
                                        <th class="align-middle p-1">Discount</th>
                                        <th class="align-middle  p-1">Taxable Value</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size:0.7rem;">
                                    <?php

                                    $get_inc_pro = "select * from invoice_products where invoice_no='$invoice_no'";
                                    $run_inc_pro = mysqli_query($con, $get_inc_pro);
                                    $pro_counter = 0;
                                    $total_amount = 0;
                                    while ($row_inc_pro = mysqli_fetch_array($run_inc_pro)) {
                                        $carton_id = $row_inc_pro['carton_id'];
                                        $inc_carton_qty = $row_inc_pro['carton_qty'];
                                        $unit_rate = $row_inc_pro['unit_rate'];
                                        $gst_type = $row_inc_pro['gst_type'];
                                        $hsn_code = $row_inc_pro['hsn_code'];
                                        $gst_rate = $row_inc_pro['gst_rate'];
                                        $discount = $row_inc_pro['discount'];

                                        $get_carton = "select * from cartons where carton_id='$carton_id'";
                                        $run_carton = mysqli_query($con, $get_carton);
                                        $row_carton = mysqli_fetch_array($run_carton);
                                        $product_id = $row_carton['product_id'];
                                        $carton_title = $row_carton['carton_title'];
                                        $carton_qty = $row_carton['carton_qty'];

                                        $get_product = "select * from products where product_id='$product_id'";
                                        $run_product = mysqli_query($con, $get_product);
                                        $row_product = mysqli_fetch_array($run_product);
                                        $product_name = $row_product['product_name'];


                                        $taxable_amount = $unit_rate * $inc_carton_qty;
                                        $total = $taxable_amount - ($taxable_amount * ($discount / 100));
                                        $total_amount += $total;

                                    ?>
                                        <tr class="text-center" style="font-size:1rem;">
                                            <td class=" p-1"><?php echo ++$pro_counter; ?></td>
                                            <td class=" p-1"><?php echo $carton_title; ?></td>
                                            <td class=" p-1"><?php echo $hsn_code; ?></td>
                                            <td class=" p-1"><?php echo $inc_carton_qty; ?></td>
                                            <td class=" p-1"><?php echo $unit_rate; ?></td>
                                            <td class=" p-1"><?php echo $taxable_amount; ?></td>
                                            <td class=" p-1"><?php echo $discount; ?> %</td>
                                            <td class=" p-1"><?php echo $taxable_amount - ($taxable_amount * ($discount / 100)); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php

                                    $get_inc_count = "select * from invoice_products where invoice_no='$invoice_no'";
                                    $run_inc_count = mysqli_query($con, $get_inc_count);
                                    $inc_count = mysqli_num_rows($run_inc_count);
                                    $req_count = 10 - $inc_count;

                                    if ($req_count > 1) {

                                        for ($x = 0; $x <= $req_count; $x++) {
                                            echo "
                                <tr>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                    <td class='p-3'></td>
                                </tr>
                            ";
                                        }
                                    } else {
                                        echo "";
                                    }

                                    ?>
                                </tbody>
                                <tfoot style="font-size:0.8rem;">
                                    <tr>
                                        <th colspan="7" class="text-right pr-2">
                                            <h5 class="mb-0">TOTAL</h5>
                                        </th>
                                        <th class="text-center">
                                            <h5 class="mb-0"><?php echo $total_amount; ?></h5>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 px-0 mt-2 mb-2">
                            <table style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">HSN/SAC</th>
                                        <th rowspan="2">Taxable Value</th>
                                        <th colspan="2">CGST</th>
                                        <th colspan="2">SGST</th>
                                        <th colspan="2">IGST</th>
                                        <th rowspan="2">Total Tax Amount</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th class=" p-1">Rate</th>
                                        <th class=" p-1">Amount</th>
                                        <th class=" p-1">Rate</th>
                                        <th class=" p-1">Amount</th>
                                        <th class=" p-1">Rate</th>
                                        <th class=" p-1">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_dis_hsn = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                                    $run_dis_hsn = mysqli_query($con, $get_dis_hsn);
                                    $grand_taxable = 0;
                                    $grand_cgst = 0;
                                    $grand_sgst = 0;
                                    $grand_igst = 0;
                                    while ($row_dis_hsn = mysqli_fetch_array($run_dis_hsn)) {
                                        $dis_hsn = $row_dis_hsn['hsn_code'];

                                        $get_gst_rate = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                        $run_gst_rate = mysqli_query($con, $get_gst_rate);
                                        $row_gst_rate = mysqli_fetch_array($run_gst_rate);
                                        $dis_gst_rate = $row_gst_rate['gst_rate'];
                                        $dis_gst_type = $row_gst_rate['gst_type'];
                                        $dis_carton_qty = $row_gst_rate['carton_qty'];
                                        $dis_unit_rate = $row_gst_rate['unit_rate'];

                                        if ($dis_gst_type === 'STA_TAX') {
                                            $cgst_tax_hsn = $dis_gst_rate / 2;
                                            $sgst_tax_hsn = $dis_gst_rate / 2;
                                            $igst_tax_hsn = 0;
                                        } else {
                                            $cgst_tax_hsn = 0;
                                            $sgst_tax_hsn = 0;
                                            $igst_tax_hsn = $dis_gst_rate;
                                        }


                                        $get_hsn = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn'";
                                        $run_hsn = mysqli_query($con, $get_hsn);
                                        $cgst_amount_hsn = 0;
                                        $sgst_amount_hsn = 0;
                                        $igst_amount_hsn = 0;
                                        $total_taxable_amount_hsn = 0;
                                        while ($row_hsn = mysqli_fetch_array($run_hsn)) {

                                            $carton_qty_hsn = $row_hsn['carton_qty'];
                                            $unit_rate_hsn = $row_hsn['unit_rate'];
                                            $gst_type_hsn = $row_hsn['gst_type'];
                                            $gst_rate_hsn = $row_hsn['gst_rate'];
                                            $gst_discount_hsn = $row_hsn['discount'];

                                            $taxable_amount_hsn_bef_discount_hsn = $unit_rate_hsn * $carton_qty_hsn;
                                            $taxable_amount_hsn = $taxable_amount_hsn_bef_discount_hsn - ($taxable_amount_hsn_bef_discount_hsn * ($gst_discount_hsn / 100));
                                            $total_taxable_amount_hsn += $taxable_amount_hsn;

                                            if ($gst_type_hsn === 'STA_TAX') {
                                                $cgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                                $sgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
                                                $igst_amount_hsn += 0;
                                            } else {
                                                $cgst_amount_hsn += 0;
                                                $sgst_amount_hsn += 0;
                                                $igst_amount_hsn += $taxable_amount_hsn * ($gst_rate_hsn / 100);
                                            }
                                        }
                                        $grand_taxable += $total_taxable_amount_hsn;
                                        $grand_cgst += $cgst_amount_hsn;
                                        $grand_sgst += $sgst_amount_hsn;
                                        $grand_igst += $igst_amount_hsn;
                                    ?>
                                        <tr class="text-center">
                                            <td><?php echo $dis_hsn; ?></td>
                                            <td><?php echo $total_taxable_amount_hsn; ?></td>
                                            <td><?php echo $cgst_tax_hsn; ?> %</td>
                                            <td><?php echo $cgst_amount_hsn; ?></td>
                                            <td><?php echo $sgst_tax_hsn; ?> %</td>
                                            <td><?php echo $sgst_amount_hsn; ?></td>
                                            <td><?php echo $igst_tax_hsn; ?> %</td>
                                            <td><?php echo $igst_amount_hsn; ?></td>
                                            <td><?php echo $cgst_amount_hsn + $sgst_amount_hsn + $igst_amount_hsn; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>TOTAL</th>
                                        <th><?php echo $grand_taxable; ?></th>
                                        <th>0</th>
                                        <th><?php echo $grand_cgst; ?></th>
                                        <th>0</th>
                                        <th><?php echo $grand_sgst; ?></th>
                                        <th>0</th>
                                        <th><?php echo $grand_igst; ?></th>
                                        <th><?php echo $grand_cgst + $grand_sgst + $grand_igst; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-5 pt-2" style="border:1px solid #000;">
                            <h5 class="text-uppercase"><u>Bank Details</u></h5>
                            <h5 class="text-uppercase">Bank : <?php echo $bank_name; ?></h5>
                            <h5 class="text-uppercase">AC Number : <?php echo $ac_number; ?> </h5>
                            <h5 class="text-uppercase">Branch : <?php echo $branch_name; ?> (IFSC:<?php echo $ifsc_code; ?>)</h5>
                            <h5 class="text-uppercase">AC Holder : <?php echo $ac_holder; ?></h5>
                            <h5 class="text-uppercase">Due Date : <?php echo date("d-M-Y", strtotime($due_date)); ?></h5>
                        </div>
                        <div class="col-3 pt-2" style="border:1px solid #000;">
                            <h6 style="font-size:0.8rem;text-align:center;">Customer Signature</h6>
                        </div>
                        <div class="col-4 px-0">
                            <table class="table text-dark" style="height:100%;">
                                <?php

                                $get_dis_ex = "select distinct(hsn_code) from invoice_products where invoice_no='$invoice_no'";
                                $run_dis_ex = mysqli_query($con, $get_dis_ex);
                                $grand_taxable_ex = 0;
                                $grand_cgst_ex = 0;
                                $grand_sgst_ex = 0;
                                $grand_igst_ex = 0;
                                while ($row_dis_ex = mysqli_fetch_array($run_dis_ex)) {
                                    $dis_hsn_ex = $row_dis_ex['hsn_code'];

                                    $get_gst_rate_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                                    $run_gst_rate_ex = mysqli_query($con, $get_gst_rate_ex);
                                    $row_gst_rate_ex = mysqli_fetch_array($run_gst_rate_ex);
                                    $dis_gst_rate_ex = $row_gst_rate_ex['gst_rate'];
                                    $dis_gst_type_ex = $row_gst_rate_ex['gst_type'];
                                    $dis_carton_qty_ex = $row_gst_rate_ex['carton_qty'];
                                    $dis_unit_rate_ex = $row_gst_rate_ex['unit_rate'];

                                    if ($dis_gst_type_ex === 'STA_TAX') {
                                        $cgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                        $sgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
                                        $igst_tax_hsn_ex = 0;
                                    } else {
                                        $cgst_tax_hsn_ex = 0;
                                        $sgst_tax_hsn_ex = 0;
                                        $igst_tax_hsn_ex = $dis_gst_rate_ex;
                                    }


                                    $get_hsn_ex = "select * from invoice_products where invoice_no='$invoice_no' and hsn_code='$dis_hsn_ex'";
                                    $run_hsn_ex = mysqli_query($con, $get_hsn_ex);
                                    $cgst_amount_hsn_ex = 0;
                                    $sgst_amount_hsn_ex = 0;
                                    $igst_amount_hsn_ex = 0;
                                    $total_taxable_amount_hsn_ex = 0;
                                    while ($row_hsn_ex = mysqli_fetch_array($run_hsn_ex)) {

                                        $carton_qty_hsn_ex = $row_hsn_ex['carton_qty'];
                                        $unit_rate_hsn_ex = $row_hsn_ex['unit_rate'];
                                        $gst_type_hsn_ex = $row_hsn_ex['gst_type'];
                                        $gst_rate_hsn_ex = $row_hsn_ex['gst_rate'];
                                        $gst_discount_hsn_ex = $row_hsn_ex['discount'];

                                        $taxable_amount_hsn_bef_discount_ex = $unit_rate_hsn_ex * $carton_qty_hsn_ex;
                                        $taxable_amount_hsn_ex = $taxable_amount_hsn_bef_discount_ex - ($taxable_amount_hsn_bef_discount_ex * ($gst_discount_hsn_ex / 100));
                                        $total_taxable_amount_hsn_ex += $taxable_amount_hsn_ex;

                                        if ($gst_type_hsn_ex === 'STA_TAX') {
                                            $cgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                            $sgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
                                            $igst_amount_hsn_ex += 0;
                                        } else {
                                            $cgst_amount_hsn_ex += 0;
                                            $sgst_amount_hsn_ex += 0;
                                            $igst_amount_hsn_ex += $taxable_amount_hsn_ex * ($gst_rate_hsn_ex / 100);
                                        }
                                    }
                                    $grand_taxable_ex += $total_taxable_amount_hsn_ex;
                                    $grand_cgst_ex += $cgst_amount_hsn_ex;
                                    $grand_sgst_ex += $sgst_amount_hsn_ex;
                                    $grand_igst_ex += $igst_amount_hsn_ex;
                                }

                                ?>
                                <tr>
                                    <th class="py-1">Taxable Amount</th>
                                    <td class="py-1 text-right"><?php echo $grand_taxable_ex; ?></td>
                                </tr>
                                <tr class="<?php if ($grand_cgst_ex >= 1) {
                                                echo "show";
                                            } else {
                                                echo "d-none";
                                            } ?>">
                                    <th class="py-1">Output CGST</th>
                                    <td class="py-1 text-right"><?php echo $grand_cgst_ex; ?></td>
                                </tr>
                                <tr class="<?php if ($grand_sgst_ex >= 1) {
                                                echo "show";
                                            } else {
                                                echo "d-none";
                                            } ?>">
                                    <th class="py-1">Output SGST</th>
                                    <td class="py-1 text-right"><?php echo $grand_sgst_ex; ?></td>
                                </tr>
                                <tr class="<?php if ($grand_igst_ex >= 1) {
                                                echo "show";
                                            } else {
                                                echo "d-none";
                                            } ?>">
                                    <th class="py-1">Output IGST</th>
                                    <td class="py-1 text-right"><?php echo $grand_igst_ex; ?></td>
                                </tr>
                                <tr>
                                    <th class="py-1">Total Tax</th>
                                    <td class="py-1 text-right"><?php echo $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex; ?></td>
                                </tr>
                                <tr>
                                    <th class="py-1">Round Off</th>
                                    <td class="py-1 text-right"><?php echo round(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex) - ($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex), 2); ?></td>
                                </tr>
                                <tr>
                                    <th class="py-1">Grand Total</th>
                                    <td class="py-1 text-right"><?php echo round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12" style="border:1px solid #000;">
                            <h5 class="my-2 text-right text-uppercase">
                                TOTAL IN WORDS : INR
                                <?php
                                // call the function here
                                $amt_words = $total_amount;
                                // nummeric value in variable

                                $get_grand_amount = AmountInWords(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex));
                                echo $get_grand_amount;

                                ?> Only
                            </h5>
                        </div>
                        <div class="col-8 py-2" style="border:1px solid #000;">
                            <h4><u>TERMS & CONDITIONS:</u></h4>
                            <p class="mb-0 font-italic">
                                1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
                                2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
                                3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
                                4. Goods once sold will not be taken back. <br>
                                5. All disputes are subject to Mumbai Juridiction only.
                            </p>
                        </div>
                        <div class="col-4 text-center py-2" style="border:1px solid #000;">
                            <p class="text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
                            <h5 class="text-center text-uppercase">For <?php echo $partner_title; ?></h5> <br>
                            <br>
                            <br>
                            <br>
                            <h5 class="text-center">Authorised Signature</h5>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php

            include("includes/footer.php");

            ?>