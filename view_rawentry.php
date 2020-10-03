
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Purchase Entry</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?create_rawentry">Add Purchase</a>
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
                    <th>Vendor Name</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Unit Cost</th>
                    <th>Amount Total</th>
                    <th>Invoice No.</th>
                    <th>Extra Paid</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $get_entry = "SELECT * FROM raw_entry order by entry_id desc";
                    $run_entry = mysqli_query($con,$get_entry);
                    $counter = 0;
                    while($row_entry=mysqli_fetch_array($run_entry)){

                        $counter = ++$counter;
                        $vendor_id = $row_entry['vendor_id'];
                        $item_id = $row_entry['item_id'];
                        $item_qty = $row_entry['item_qty'];
                        $item_unit_cost = $row_entry['item_unit_cost'];
                        $item_total_cost = $row_entry['item_total_cost'];
                        $item_invoice = $row_entry['item_invoice'];
                        $item_extra = $row_entry['item_extra'];
                        $entry_created_at = $row_entry['entry_created_at'];

                        $get_shop = "select * from vendors where vendor_id=$vendor_id";
                        $run_shop = mysqli_query($con,$get_shop);
                        $row_shop = mysqli_fetch_array($run_shop);

                        $shop_title = $row_shop['shop_title'];

                        $get_item = "select * from raw_items where item_id=$item_id";
                        $run_item = mysqli_query($con,$get_item);
                        $row_item = mysqli_fetch_array($run_item);

                        $item_name = $row_item['item_name'];
                    
                    ?>
                    <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo date("d-M-y, H:i A", strtotime($entry_created_at)); ?></td>
                    <td><?php echo $shop_title; ?></td>
                    <td><?php echo $item_name; ?></td>
                    <td><?php echo $item_qty; ?></td>
                    <td><?php echo $item_unit_cost; ?></td>
                    <td><?php echo $item_total_cost; ?></td>
                    <td><?php echo $item_invoice; ?></td>
                    <td><?php echo $item_extra; ?></td>
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