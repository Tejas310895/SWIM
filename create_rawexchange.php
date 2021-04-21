
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
        <a class="btn btn-success float-right" href="index.php?view_rawexchange">Go Back</a>
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
                                <div class="form-group row" id="insert_exchange" action="">
                                    <label class="col-sm-3 col-form-label">Reciever Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="exchange_vendor_id" id="exchange_vendor_id" required>
                                    <option disabled selected value>Choose the Reciever</option>
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
                                    <select class="form-control" name="exchange_item_id" id="exchange_item_id" required>
                                    <option disabled selected value>Select Raw Item</option>
                                    <?php 
                                    
                                    $get_items = "select * from raw_items";
                                    $run_items = mysqli_query($con,$get_items);
                                    while($row_items=mysqli_fetch_array($run_items)){
                                    
                                    $item_id = $row_items['item_id'];
                                    $item_name = $row_items['item_name'];
                                    $item_stock = $row_items['item_stock'];

                                    if($item_stock>0){

                                    echo "<option value='$item_id'>$item_name</option>";

                                    }
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
                                <label class="col-sm-3 col-form-label" id="label_qty">Quantity<h6 id="qty_unit" class="text-uppercase text-info mb-0"></h6></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="exchange_item_qty" id="exchange_item_qty" placeholder="" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <button type="submit" id="raw_exchange" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
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