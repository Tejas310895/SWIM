
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="col-12" id="customer_alerts">

</div>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Add New Customer</h4>
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
                    <form class="form-sample" id="insert_customer" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_title" id="customer_title" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_contact" id="customer_contact" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="customer_email" id="customer_email" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Customer Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_address" id="customer_address" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_state" id="customer_state" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_state_code" id="customer_state_code" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GSTIN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="customer_gst" id="customer_gst" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                 <button type="submit" id="add_customer" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/invoice.js"></script>
<?php } ?>