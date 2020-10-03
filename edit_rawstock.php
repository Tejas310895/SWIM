
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<?php 

include("includes/db.php");

if(isset($_GET['edit_rawstock'])){

    $item_id = $_GET['edit_rawstock'];

    $get_item = "select * from raw_items where item_id='$item_id'";
    $run_item = mysqli_query($con,$get_item);
    $row_item = mysqli_fetch_array($run_item);

    $vendor_id = $row_item['vendor_id'];
    $item_name = $row_item['item_name'];
    $item_unit = $row_item['item_unit'];
    $unit_cost = $row_item['unit_cost'];
    $gst_rate = $row_item['gst_rate'];

    $get_vendor_title = "select * from vendors where vendor_id='$vendor_id'";
    $run_vendor_title = mysqli_query($con,$get_vendor_title);
    $row_vendor_title = mysqli_fetch_array($run_vendor_title);
    $vendor_title = $row_vendor_title['shop_title'];

?>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Edit Item Details</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_rawstock">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enter the Item details</h4>
                    <form class="form-sample" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="vendor_id" id="vendor_id">
                                    <option disabled selected value>Choose the Supplier</option>
                                    <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_title; ?></option>
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
                                    <input type="text" class="form-control" name="item_name" id="item_name" value="<?php echo $item_name; ?>" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Measuring Unit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="item_unit" id="item_unit" value="<?php echo $item_unit; ?>" required/>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Cost Per Unit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="unit_cost" id="unit_cost" value="<?php echo $unit_cost; ?>" required/>
                                    </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">GST Rate</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="gst_rate" id="gst_rate" value="<?php echo $gst_rate; ?>" required/>
                                    </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                 <button type="submit" id="add_raw" name="edit_raw" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php 

if(isset($_POST['edit_raw'])){
    $vendor_id = $_POST['vendor_id'];
    $item_name = $_POST['item_name'];
    $item_unit = $_POST['item_unit'];
    $unit_cost = $_POST['unit_cost'];
    $gst_rate = $_POST['gst_rate'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $update_item = "update raw_items set vendor_id='$vendor_id',
                                         item_name='$item_name',
                                         item_unit='$item_unit',
                                         unit_cost='$unit_cost',
                                         gst_rate='$gst_rate',
                                         item_updated_at='$today'
                                        where item_id='$item_id'";
    $run_update_item = mysqli_query($con,$update_item);

    if($run_update_item){
        echo "<script>alert('Item Details Updated Successfully')</script>";
        echo "<script>window.open('index.php?view_rawstock','_self')</script>";
    }else{
        echo "<script>alert('Updated Failed try again')</script>";
    }
}


?>
<?php } ?>