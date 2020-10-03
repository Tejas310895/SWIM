
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Raw Material Stock</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?create_rawstock">+ Add New Raw Product</a>
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
                    <th>Item Name</th>
                    <th>Measure Unit</th>
                    <th>Available Stock</th>
                    <th>Cost Of per unit</th>
                    <th>Cost Of Stock</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $get_raw = "SELECT * FROM raw_items order by item_id desc";
                    $run_raw = mysqli_query($con,$get_raw);
                    $counter = 0;
                    while($row_raw=mysqli_fetch_array($run_raw)){

                        $counter = ++$counter;
                        $item_id = $row_raw['item_id'];
                        $item_name = $row_raw['item_name'];
                        $item_unit = $row_raw['item_unit'];
                        $unit_cost = $row_raw['unit_cost'];
                        $item_stock = $row_raw['item_stock'];                    
                    ?>
                    <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $item_name; ?></td>
                    <td><?php echo $item_unit; ?></td>
                    <td><?php echo round($item_stock, 2); ?></td>
                    <td><?php echo $unit_cost; ?></td>
                    <td><?php echo $item_stock*$unit_cost; ?></td>
                    <td><a type="button" class="btn btn-primary btn-icon-text" href="index.php?edit_rawstock=<?php echo $item_id; ?>"> Edit <i class="mdi mdi-pencil-box btn-icon-append"></i></a></td>
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