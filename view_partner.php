
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">OUR COMPANIES</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?create_partner">Add New Company</a>
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
                    <th>Partner Name</th>
                    <th>Partner Contact</th>
                    <th>State Code</th>
                    <th>Partner GST</th>
                    <th>Bank Details</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    
                    $get_partner = "SELECT * FROM partners order by partner_id desc";
                    $run_partner = mysqli_query($con,$get_partner);
                    $counter = 0;
                    while($row_partner=mysqli_fetch_array($run_partner)){

                        $counter = ++$counter;
                        $partner_id = $row_partner['partner_id'];
                        $partner_contact = $row_partner['partner_contact'];
                        $partner_title = $row_partner['partner_title'];
                        $partner_email = $row_partner['partner_email'];
                        $partner_address = $row_partner['partner_address'];
                        $partner_state = $row_partner['partner_state'];
                        $partner_state_code = $row_partner['partner_state_code'];
                        $bank_name = $row_partner['bank_name'];
                        $ac_number = $row_partner['ac_number'];
                        $branch_name = $row_partner['branch_name'];
                        $ifsc_code = $row_partner['ifsc_code'];
                        $ac_holder = $row_partner['ac_holder'];
                        $partner_gst = $row_partner['partner_gst'];
                    
                    ?>
                    <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $partner_title; ?></td>
                    <td><?php echo $partner_contact."</br>".$partner_email."</br>".$partner_address.", ".$partner_state; ?></td>
                    <td><?php echo $partner_state_code; ?></td>
                    <td>
                        <?php echo $ac_holder; ?><br>
                        <?php echo $ac_number; ?><br>
                        <?php echo $bank_name; ?><br>
                        <?php echo $branch_name; ?>
                        (<?php echo $ifsc_code; ?>)
                    </td>
                    <td><?php echo $partner_gst; ?></td>
                    <td><a href="index.php?edit_partner=<?php echo $partner_id; ?>" class="btn btn-primary">Edit</a></td>
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