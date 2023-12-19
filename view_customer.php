<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">OUR CUSTOMERS</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?create_customer">Add New Customer</a>
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
                                    <th>Customer Name</th>
                                    <th>Customer Contact</th>
                                    <th>Customer Email</th>
                                    <th>Customer Address</th>
                                    <th>Customer State Code</th>
                                    <th>Customer GST</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $get_customer = "SELECT * FROM customers order by customer_id desc";
                                $run_customer = mysqli_query($con, $get_customer);
                                $counter = 0;
                                while ($row_customer = mysqli_fetch_array($run_customer)) {

                                    $counter = ++$counter;
                                    $customer_id = $row_customer['customer_id'];
                                    $customer_title = $row_customer['customer_title'];
                                    $customer_contact = $row_customer['customer_contact'];
                                    $customer_email = $row_customer['customer_email'];
                                    $customer_address = $row_customer['customer_address'];
                                    $customer_state = $row_customer['customer_state'];
                                    $customer_state_code = $row_customer['customer_state_code'];
                                    $customer_gst = $row_customer['customer_gst'];

                                ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $customer_title; ?></td>
                                        <td><?php echo $customer_contact ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address . ", " . $customer_state; ?></td>
                                        <td><?php echo $customer_state_code; ?></td>
                                        <td><?php echo $customer_gst; ?></td>
                                        <td><a href="index.php?edit_customer=<?php echo $customer_id; ?>" class="btn btn-primary">Edit</a></td>
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