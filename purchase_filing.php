<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">Purchase Filling</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?new_purchase_filing">Add Purchase</a>
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
                                    <th>Sl.No</th>
                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Vendor Name</th>
                                    <th>Taxable</th>
                                    <th>Gst Rate</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $get_entry = "SELECT * FROM purchase_filling order by purchase_filling_id desc";
                                $run_entry = mysqli_query($con, $get_entry);
                                $counter = 0;
                                while ($row_entry = mysqli_fetch_array($run_entry)) {

                                    $counter = ++$counter;
                                    $invoice_no = $row_entry['invoice_no'];
                                    $vendor_id = $row_entry['vendor_id'];
                                    $taxable = $row_entry['taxable'];
                                    $gst_rate = $row_entry['gst_rate'];
                                    $filling_date = $row_entry['filling_date'];
                                    $created_date = $row_entry['created_date'];
                                    $purchase_desc = $row_entry['purchase_desc'];

                                    $get_shop = "select * from vendors where vendor_id=$vendor_id";
                                    $run_shop = mysqli_query($con, $get_shop);
                                    $row_shop = mysqli_fetch_array($run_shop);

                                    $shop_title = $row_shop['shop_title'];

                                ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo date("d-M-y", strtotime($filling_date)); ?></td>
                                        <td><?php echo $invoice_no; ?></td>
                                        <td><?php echo $shop_title; ?></td>
                                        <td><?php echo $taxable; ?></td>
                                        <td><?php echo $gst_rate; ?></td>
                                        <td><?php echo $purchase_desc; ?></td>
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