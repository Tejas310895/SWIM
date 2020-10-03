
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="col-12" id="entry_alerts">

</div>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Raw Stock Inventory Update</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_rawentry">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Complete the entry form</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row" id="insert_entry" action="">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="vendor_id" id="vendor_id" required>
                                    <option disabled selected value>Choose the Supplier</option>
                                    <?php 
                                        
                                        $get_vendors = "select * from vendors";
                                        $run_vendors = mysqli_query($con,$get_vendors);
                                        while($row_vendors=mysqli_fetch_array($run_vendors)){
                                        
                                        $vendor_id = $row_vendors['vendor_id'];
                                        $shop_title = $row_vendors['shop_title'];
                                        ?>
                                        <option value="<?php echo $vendor_id; ?>"><?php echo $shop_title; ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Item Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="item_id" id="item_id" required>
                                    <option disabled selected value>Select the Supplier First</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label" id="label_qty">Quantity</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_qty" id="item_qty" placeholder="" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Per Unit Cost</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_unit_cost" id="item_unit_cost" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total Cost</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_total_cost" id="item_total_cost" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Invoice/Bill No.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_invoice" id="item_invoice" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Extra Paid</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="item_extra" id="item_extra" required/>
                                    </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                 <button type="submit" id="raw_entry" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/vendor.js"></script>
                                    <?php } ?>