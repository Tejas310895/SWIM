
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">BUILD YOUR PRODUCT</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_products">Go Back</a>
    </div>
</div>

<form id="insert_product" method="post" action="ajaxphp/ajaxproduct.php">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>PRODUCT SKU ID</label>
                <input type="text" class="form-control" name="sku_id" aria-describedby="" placeholder="Enter SKU ID" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>PRODUCT NAME</label>
                <input type="text" class="form-control" name="product_name" aria-describedby="" placeholder="Enter Product Name" required>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label>PRODUCT TYPE</label>
                <input type="text" class="form-control" name="product_type" aria-describedby="" placeholder="Enter Product Type" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>HSN CODE</label>
                <input type="text" class="form-control" name="hsn_code" aria-describedby="" placeholder="Enter HSN CODE" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>GST RATE</label>
                <input type="text" class="form-control" name="gst_rate" aria-describedby="" placeholder="Enter GST rate in %" required>
            </div>
        </div>
    </div>
    <div class="form-group fieldGroup">
        <div class="input-group">
            <select class="form-control mx-5" id="exampleFormControlSelect1" name="item[]" id="item" required>
            <?php
            
                echo "<option disabled selected value>Choose the raw Item</option>";
                $get_items = "select * from raw_items";
                $run_items = mysqli_query($con,$get_items);
                while($row_items=mysqli_fetch_array($run_items)){
                
                $item_id = $row_items['item_id'];
                $item_name = $row_items['item_name'];

                echo "<option value='$item_id'>$item_name</option>";

                }
            
            ?>
            </select>
            <input type="text" name="qty[]" id="qty" class="form-control" placeholder="Enter Qty required per item" required/>
            <div class="input-group-addon mx-3 mt-1"> 
                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
            </div>
        </div>
    </div>
    
    <button type="submit" name="submit" id="add_product"  class="btn btn-lg btn-primary mx-5 mt-5 float-right">Submit</button>
    
</form>

<!-- copy of input fields group -->
<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
            <select class="form-control mx-5" id="exampleFormControlSelect1" name="item[]" id="item" required>
            <?php
            
            echo "<option disabled selected value>Choose the raw Item</option>";
            $get_items = "select * from raw_items";
            $run_items = mysqli_query($con,$get_items);
            while($row_items=mysqli_fetch_array($run_items)){
            
            $item_id = $row_items['item_id'];
            $item_name = $row_items['item_name'];

            echo "<option value='$item_id'>$item_name</option>";

            }
        
        ?>
        </select>
        <input type="text" name="qty[]" id="qty" class="form-control" placeholder="Enter Qty required per item" required/>
        <div class="input-group-addon mx-4 mt-1"> 
            <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>X</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/script.js"></script>
        <?php } ?>