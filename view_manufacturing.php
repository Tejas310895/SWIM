<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">READY STOCK ENTRY</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?product_manufacturing">Add Today Ready Stock</a>
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
                                    <th>Manufactured Date</th>
                                    <th>Product Name</th>
                                    <th>Carton Type</th>
                                    <th>Product Quantity</th>
                                    <th>Carton Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $get_manufacturing = "select * from manufacturing order by manufacturing_id desc";
                                $run_manufacturing = mysqli_query($con, $get_manufacturing);
                                $counter = 0;
                                while ($row_manufacturing = mysqli_fetch_array($run_manufacturing)) {

                                    $counter = ++$counter;
                                    $manufacturing_id = $row_manufacturing['manufacturing_id'];
                                    $print_id = $row_manufacturing['print_id'];
                                    $carton_id = $row_manufacturing['carton_id'];
                                    $manufacturing_carton_qty = $row_manufacturing['carton_qty'];
                                    $manufacturing_created_at = $row_manufacturing['manufacturing_created_at'];

                                    $get_carton = "select * from cartons where carton_id='$carton_id'";
                                    $run_carton = mysqli_query($con, $get_carton);
                                    $row_carton = mysqli_fetch_array($run_carton);
                                    $carton_title = $row_carton['carton_title'];
                                    $carton_qty = $row_carton['carton_qty'];
                                    $product_id = $row_carton['product_id'];

                                    $get_product = "select * from products where product_id='$product_id'";
                                    $run_product = mysqli_query($con, $get_product);
                                    $row_product = mysqli_fetch_array($run_product);
                                    $product_name = $row_product['product_name'];

                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo date("d-M-Y, H:i A", strtotime($manufacturing_created_at)); ?></td>
                                        <td><?php echo $product_name; ?></td>
                                        <td><?php echo $carton_title; ?></td>
                                        <td><?php echo $carton_qty; ?></td>
                                        <td><?php echo $manufacturing_carton_qty; ?></td>
                                        <td> <a href="print_ready.php?print_id=<?php echo $print_id; ?>" class="btn btn-primary">Print</a> </td>
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