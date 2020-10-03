
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<?php 

include("includes/db.php");

if(isset($_GET['edit_customer'])){

    $customer_id = $_GET['edit_customer'];

    $get_customer = "select * from customers where customer_id='$customer_id'";
    $run_customer = mysqli_query($con,$get_customer);
    $row_customer = mysqli_fetch_array($run_customer);

    $customer_title = $row_customer['customer_title'];
    $customer_contact = $row_customer['customer_contact'];
    $customer_email = $row_customer['customer_email'];
    $customer_address = $row_customer['customer_address'];
    $customer_state = $row_customer['customer_state'];
    $customer_state_code = $row_customer['customer_state_code'];
    $customer_gst = $row_customer['customer_gst'];

?>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Edit Customer Details</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_customer">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enter the Customer details</h4>
                    <form class="form-sample" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_title" id="customer_title" value="<?php echo $customer_title; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_contact" id="customer_contact" value="<?php echo $customer_contact; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="customer_email" id="customer_email" value="<?php echo $customer_email; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_address" id="customer_address" value="<?php echo $customer_address; ?>"required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_state" id="customer_state" value="<?php echo $customer_state; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_state_code" id="customer_state_code" value="<?php echo $customer_state_code; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GSTIN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_gst" id="customer_gst" value="<?php echo $customer_gst; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                 <button type="submit" id="edit_customer" name="edit_customer" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php 

if(isset($_POST['edit_customer'])){
    $customer_title = $_POST['customer_title'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $customer_state = $_POST['customer_state'];
    $customer_state_code = $_POST['customer_state_code'];
    $customer_gst = $_POST['customer_gst'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $update_customer = "update customers set customer_title='$customer_title',
                                           customer_contact='$customer_contact',
                                           customer_email='$customer_email',
                                           customer_address='$customer_address',
                                           customer_state='$customer_state',
                                           customer_state_code='$customer_state_code',
                                           customer_gst='$customer_gst',
                                           customer_updated_at='$today'
                                           where customer_id='$customer_id'";
    $run_update_customer = mysqli_query($con,$update_customer);

    if($run_update_customer){
        echo "<script>alert('Customer Details Updated Successfully')</script>";
        echo "<script>window.open('index.php?view_customer','_self')</script>";
    }else{
        echo "<script>alert('Updated Failed try again')</script>";
    }
}


?>
<?php } ?>