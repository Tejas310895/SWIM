
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Available Products</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?create_product">Build New Product</a>
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
                    <tr class="text-center">
                    <th>Sl.No</th>
                    <th>Product Type</th>
                    <th>Product Name</th>
                    <th>Raw Items Required</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $get_product = "select * from products order by product_id desc";

                    $run_product = mysqli_query($con,$get_product);

                    $counter = 0;

                    while($row_product = mysqli_fetch_array($run_product)){

                    $counter = ++$counter;

                    $pro_name = $row_product['product_name'];

                    $SKU_id = $row_product['SKU_id'];

                    $get_required = "select * from raw_required where SKU_id='$SKU_id'";

                    $run_required = mysqli_query($con,$get_required);

                    $count_required = mysqli_num_rows($run_required);
                    
                    ?>
                    <tr class="text-center">
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $pro_name; ?></td>
                    <td><?php echo $SKU_id; ?></td>
                    <td><?php echo $count_required; ?></td>
                    <td><a href="" class="btn btn-danger m-2" onclick="return confirm('Are you sure?')">Delete Product</a></td>
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