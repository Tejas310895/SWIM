

<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<?php 

include("includes/db.php");

if(isset($_GET['edit_partner'])){

    $partner_id = $_GET['edit_partner'];

    $get_partner = "select * from partners where partner_id='$partner_id'";
    $run_partner = mysqli_query($con,$get_partner);
    $row_partner = mysqli_fetch_array($run_partner);

    $partner_title = $row_partner['partner_title'];
    $partner_contact = $row_partner['partner_contact'];
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
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Edit Partner Details</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_partner">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enter the Partner details</h4>
                    <form class="form-sample" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_title" id="partner_title" value="<?php echo $partner_title; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_contact" id="partner_contact" value="<?php echo $partner_contact; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="partner_email" id="partner_email" value="<?php echo $partner_email; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_address" id="partner_address" value="<?php echo $partner_address; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bank Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php echo $bank_name; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ac_number" id="ac_number" value="<?php echo $ac_number; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Branch Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="branch_name" id="branch_name" value="<?php echo $branch_name; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IFSC Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $ifsc_code; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Holder</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ac_holder" id="ac_holder" value="<?php echo $ac_holder; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_state" id="partner_state" value="<?php echo $partner_state; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_state_code" id="partner_state_code" value="<?php echo $partner_state_code; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GSTIN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="partner_gst" id="partner_gst" value="<?php echo $partner_gst; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                 <button type="submit" id="edit_partner" name="edit_partner" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php 

if(isset($_POST['edit_partner'])){
    $partner_title = $_POST['partner_title'];
    $partner_contact = $_POST['partner_contact'];
    $partner_email = $_POST['partner_email'];
    $partner_address = $_POST['partner_address'];
    $bank_name = $_POST['bank_name'];
    $ac_number = $_POST['ac_number'];
    $branch_name = $_POST['branch_name'];
    $ifsc_code = $_POST['ifsc_code'];
    $ac_holder = $_POST['ac_holder'];
    $partner_state = $_POST['partner_state'];
    $partner_state_code = $_POST['partner_state_code'];
    $partner_gst = $_POST['partner_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $update_partner = "update partners set partner_title='$partner_title',
                                            partner_contact='$partner_contact',
                                            partner_email='$partner_email',
                                            partner_address='$partner_address',
                                            partner_state='$partner_state',
                                            partner_state_code='$partner_state_code',
                                            bank_name='$bank_name',
                                            ac_number='$ac_number',
                                            branch_name='$branch_name',
                                            ifsc_code='$ifsc_code',
                                            ac_holder='$ac_holder',
                                            partner_gst='$partner_gst',
                                            partner_updated_at='$today'
                                            where partner_id='$partner_id'";
    $run_update_partner = mysqli_query($con,$update_partner);

    if($run_update_partner){
        echo "<script>alert('Partner Details Updated Successfully')</script>";
        echo "<script>window.open('index.php?view_partner','_self')</script>";
    }else{
        echo "<script>alert('Updated Failed try again')</script>";
    }
}


?>
<?php } ?>