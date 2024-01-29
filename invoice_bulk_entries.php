<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">Entries Of Invoices</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?generate_invoice">Generate New Invoice</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 grid-margin stretch-card px-0">
            <div class="card">
                <div class="card-body">
                    </p>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>INC ID</th>
                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Bill To</th>
                                    <th>Company Name</th>
                                    <th>Taxable Amount</th>
                                    <th>Total Amount</th>
                                    <th>Balance</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $params = 'i.invoice_id as invoice_id,i.invoice_no as invoice_no,i.partner_id as partner_id,i.invoice_date as invoice_date,i.billed_title as billed_title,i.pay_date as pay_date,i.pay_type as pay_type,i.pay_amt as pay_amt';
                                $params .= ',sum((ip.unit_rate*ip.carton_qty) + ((ip.unit_rate*ip.carton_qty)*(ip.gst_rate/100))) as invoice_tax_total,sum(ip.unit_rate*ip.carton_qty) as invoice_total';
                                $get_invoice_entries = "select $params from invoice i inner join invoice_products ip on i.invoice_no=ip.invoice_no group by ip.invoice_no order by invoice_id desc";
                                $run_invoice_entries = mysqli_query($con, $get_invoice_entries);
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

                                    // $get_invoice_amount = "select * from invoice_products where invoice_no='$invoice_no'";
                                    // $run_invoice_amount = mysqli_query($con, $get_invoice_amount);
                                    // while ($row_invoice_amount = mysqli_fetch_array($run_invoice_amount)) {
                                    //     $unit_rate = $row_invoice_amount['unit_rate'];
                                    //     $carton_qty = $row_invoice_amount['carton_qty'];
                                    //     $gst_rate = $row_invoice_amount['gst_rate'];

                                    //     @$invoice_amount = $unit_rate * $carton_qty;
                                    //     $tax_total = $invoice_amount * ($gst_rate / 100);
                                    //     $invoice_tax = $invoice_amount + $tax_total;

                                    //     $invoice_total += $invoice_amount;
                                    //      $invoice_tax_total += $invoice_tax;
                                    // }
                                ?>
                                    <tr>
                                        <td><?php echo $invoice_id; ?></td>
                                        <td><?php echo date("d-M-Y", strtotime($invoice_date)); ?></td>
                                        <td><?php echo $invoice_no; ?></td>
                                        <td><?php echo $billed_title; ?></td>
                                        <td><?php echo $partner_title; ?></td>
                                        <td><?php echo round($invoice_total, 2); ?></td>
                                        <td><?php echo ($partner_id == 3) ? ($invoice_total - $pay_amt) : (round($invoice_tax_total, 2)); ?></td>
                                        <td><?php echo ($partner_id == 3) ? ($invoice_total - $pay_amt) : (round($invoice_tax_total, 2) - $pay_amt); ?></td>
                                        <td><?php echo ($partner_id == 3) ? ($invoice_total - $pay_amt) : (((round($invoice_tax_total, 2) - $pay_amt) == 0) ? 'Paid ' . date('d-m-y', strtotime($pay_date)) : (((round($invoice_tax_total, 2) - $pay_amt) > 0 && (round($invoice_tax_total, 2) - $pay_amt) < round($invoice_tax_total, 2)) ? 'Partial Paid ' . date('d-m-y', strtotime($pay_date)) : 'Pending')); ?></td>
                                        <td><button type="button" class="btn btn-block py-3 btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $invoice_id; ?>">
                                                <i class="fa fa-pen"></i>
                                            </button></td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $invoice_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="ajaxphp/ajaxinvoice.php" method="post">
                                                    <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Payment Date</label>
                                                                <input type="date" class="form-control" name="pay_date" id="" aria-describedby="helpId" placeholder="" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Payment Type</label>
                                                                <select class="form-control" name="pay_type" id="" required>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="transfer">Transfer</option>
                                                                    <option value="cheque">Cheque</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Amount</label>
                                                                <input type="text" class="form-control" name="pay_amt" id="" aria-describedby="helpId" placeholder="Enter amount" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="pay_submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
    <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
    <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
    <script src='js/datatable.js'></script>
<?php } ?>