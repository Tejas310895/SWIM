
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <?php
        
        $get_vcount = "SELECT * FROM vendors";
        $run_vcount = mysqli_query($con,$get_vcount);
        $vcount = mysqli_num_rows($run_vcount);
        ?>
        <h4 class="py-2">Suppliers (<?php echo $vcount; ?>)</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?create_vendor">+ Add New Supplier</a>
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
                    <th>Shop Name</th>
                    <th>Item Type</th>
                    <th>GSTN</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $get_vendor = "SELECT * FROM vendors order by vendor_id desc";
                    $run_vendors = mysqli_query($con,$get_vendor);
                    $counter = 0;
                    while($row_vendor=mysqli_fetch_array($run_vendors)){

                        $counter = ++$counter;
                        $vendor_id = $row_vendor['vendor_id'];
                        $shop_title = $row_vendor['shop_title'];
                        $item_desc = $row_vendor['item_desc'];
                        $vendor_gstn = $row_vendor['vendor_gstn'];
                        $vendor_email = $row_vendor['vendor_email'];
                        $vendor_contact = $row_vendor['vendor_contact'];

                        if($row_vendor['vendor_status']==='true'){
                            $vendor_status = 'Active';
                        }else{
                            $vendor_status = 'In Active';
                        }
                    
                    ?>
                    <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $shop_title; ?></td>
                    <td><?php echo $item_desc; ?></td>
                    <td><?php echo $vendor_gstn; ?></td>
                    <td><?php echo $vendor_email; ?></td>
                    <td><?php echo $vendor_contact; ?></td>
                    <td><?php echo $vendor_status; ?></td>
                    <td><a type="button" class="btn btn-primary btn-icon-text" href="index.php?edit_vendor=<?php echo $vendor_id; ?>"> Edit <i class="mdi mdi-pencil-box btn-icon-append"></i></a></td>
                    </tr>
                    <?php 
                    }
                    ?>
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