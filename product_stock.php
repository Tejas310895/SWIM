
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">READY STOCK IN FACTORY</h4>
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
                    <th>Carton Name</th>
                    <th>Product Name</th>
                    <th>Carton Stock</th>
                    <th>Product Stock</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                
                $counter = 0;

                $get_stock = "select * from cartons";
                $run_stock = mysqli_query($con,$get_stock);
                while($row_stock=mysqli_fetch_array($run_stock)){
                $product_id = $row_stock['product_id'];
                $carton_title = $row_stock['carton_title'];
                $carton_qty = $row_stock['carton_qty'];
                $carton_stock = $row_stock['carton_stock'];

                $get_product = "select * from products where product_id='$product_id'";
                $run_product = mysqli_query($con,$get_product);
                $row_products =  mysqli_fetch_array($run_product);
                $product_name = $row_products['product_name'];

                $counter = ++$counter;

                ?>
                    <tr class="text-center">
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $carton_title; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $carton_stock; ?></td>
                    <td><?php echo $carton_stock*$carton_qty; ?></td>
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