
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
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
                    <th>Sl.No</th>
                    <th>Company Details</th>
                    <th>Customer</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $get_invoice = "SELECT * FROM invoice order by invoice_id DESC";
                    $run_invoice = mysqli_query($con,$get_invoice);
                    $counter = 0;
                    while($row_invoice=mysqli_fetch_array($run_invoice)){

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
                        $run_partner = mysqli_query($con,$get_partner);
                        $row_partner = mysqli_fetch_array($run_partner);

                        $partner_title = $row_partner['partner_title'];                    
                    ?>
                    <tr>
                    <td><?php echo $counter; ?></td>
                    <td>
                        Invoice Date : <?php echo date("d-M-Y", strtotime($invoice_date)); ?><br>
                        Invoice Number : <?php echo $invoice_no; ?><br>
                        Company : <?php echo $partner_title; ?> <br>
                        Transporter Name : <?php echo $transporter_title; ?><br>
                        Vehicle Number : <?php echo $vehicle_no; ?><br>
                        E Way Bill : <?php echo $eway_no; ?><br>
                        Shipping Date :<?php echo date("d-M-Y", strtotime($ship_date)); ?>
                    </td>
                    <td>
                        <h5>Billed To</h5><br>
                        <?php echo $billed_title; ?><br>
                        <?php echo $billed_contact; ?><br>
                        <?php echo $billed_address; ?><br>
                        <?php echo $billed_state; ?>
                        (State Code :<?php echo $billed_state_code; ?>) <br>
                        <?php echo $billed_gst; ?> <br> <br>
                        <h5>Shipped To</h5><br>
                        <?php echo $ship_title; ?><br>
                        <?php echo $ship_contact; ?><br>
                        <?php echo $ship_address; ?><br>
                        <?php echo $ship_state; ?>
                        (State Code :<?php echo $ship_state_code; ?>) <br>
                        <?php echo $ship_gst; ?>
                    </td>
                    <td>
                        <a href="print_invoice.php?invoice_no=<?php echo $invoice_no; ?>" target="_blank" class="btn btn-primary">Print</a><br>
                        <a href="invoice.php?invoice_no=<?php echo $invoice_no; ?>" target="_blank" class="btn btn-primary mt-2">Download</a><br>
                        <a href="delete_invoice.php?invoice_no=<?php echo $invoice_no; ?>" class="btn btn-danger mt-2" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
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
<script  src='js/datatable.js'></script>
                    <?php } ?>