
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="col-12" id="carton_alerts">

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
                    <form class="form-sample" id="carton_form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Carton Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="carton_title" id="carton_title" placeholder="" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row" id="insert_entry" action="">
                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="product_id" id="product_id" required>
                                    <option disabled selected value>Choose the Vendor</option>
                                    <?php 
                                        
                                        $get_vendors = "select * from products";
                                        $run_vendors = mysqli_query($con,$get_vendors);
                                        while($row_vendors=mysqli_fetch_array($run_vendors)){
                                        
                                        $product_id = $row_vendors['product_id'];
                                        $product_name = $row_vendors['product_name'];
                                        ?>
                                        <option value="<?php echo $product_id; ?>"><?php echo $product_name; ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Holding Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="carton_qty" id="carton_qty" required/>
                                    </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                 <button type="submit" id="carton_entry" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/product.js"></script>
                                    <?php } ?>