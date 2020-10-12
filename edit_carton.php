
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
  <?php 
  
  if(isset($_GET['edit_carton'])){

    $carton_id = $_GET['edit_carton'];

    $get_carton = "select * from cartons where carton_id='$carton_id'";
    $run_carton = mysqli_query($con,$get_carton);
    $row_carton = mysqli_fetch_array($run_carton);

    $pro_id = $row_carton['product_id'];
    $carton_title = $row_carton['carton_title'];
    $carton_qty = $row_carton['carton_qty'];
    $carton_lable = $row_carton['carton_lable'];
    $carton_sub_lable = $row_carton['carton_sub_lable'];
    $carton_box_size = $row_carton['carton_box_size'];

    $get_pro = "select * from products where product_id='$pro_id'";
    $run_pro = mysqli_query($con,$get_pro);
    $row_pro = mysqli_fetch_array($run_pro);

    $pro_id = $row_pro['product_id'];
    $pro_name = $row_pro['product_name'];
  
  ?>
<div class="col-12" id="carton_alerts">

</div>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Edit Carton</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_carton">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Complete the entry form</h4>
                    <form class="form-sample" action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Carton Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="carton_title" id="carton_title" value="<?php echo $carton_title; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row" id="insert_entry" action="">
                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="product_id" id="product_id" required>
                                    <option value="<?php echo $pro_id; ?>"><?php echo $pro_name; ?></option>
                                    <?php 
                                        
                                        $get_product = "select * from products";
                                        $run_product = mysqli_query($con,$get_product);
                                        while($row_product=mysqli_fetch_array($run_product)){
                                        
                                        $product_id = $row_product['product_id'];
                                        $product_name = $row_product['product_name'];
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
                                    <input type="text" class="form-control" name="carton_qty" id="carton_qty" value="<?php echo $carton_qty; ?>" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Carton Lable</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="carton_lable" id="carton_lable" value="<?php echo $carton_lable; ?>" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Carton Sub Lable</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="carton_sub_lable" id="carton_sub_lable" value="<?php echo $carton_sub_lable; ?>" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Box Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="carton_box_size" id="carton_box_size" value="<?php echo $carton_box_size; ?>" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <button type="submit" name="carton_entry" id="carton_entry" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    
    if(isset($_POST['carton_entry'])){
        $carton_title = $_POST['carton_title'];
        $product_id = $_POST['product_id'];
        $carton_qty = $_POST['carton_qty'];
        $carton_lable = $_POST['carton_lable'];
        $carton_sub_lable = $_POST['carton_sub_lable'];
        $carton_box_size = $_POST['carton_box_size'];
    
        date_default_timezone_set('Asia/Kolkata');
    
        $today = date("Y-m-d H:i:s");
    
        $update_carton = "update cartons set product_id='$product_id',
                                             carton_title='$carton_title',
                                             carton_qty='$carton_qty',
                                             carton_lable='$carton_lable',
                                             carton_sub_lable='$carton_sub_lable',
                                             carton_box_size='$carton_box_size',
                                             carton_updated_at='$today'
                                             where carton_id='$carton_id'";
        $run_update_carton = mysqli_query($con,$update_carton);
    
        if($run_update_carton){
            echo "<script>alert('Carton Details Updated Successfully')</script>";
            echo "<script>window.open('index.php?view_carton','_self')</script>";    
        }else{
            echo "<script>alert('Carton Details Updation Failed')</script>";
            echo "<script>window.open('index.php?view_carton','_self')</script>";    
        }
    }
    
    ?>

    <?php } } ?>