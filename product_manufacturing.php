
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="col-12" id="raw_alerts">

</div>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">UPDATE MANUFACTURING</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_manufacturing">Go Back</a>
    </div>
</div>

<form action="ajaxphp/ajaxproduct.php" method="post">
<div class="row">
    <div class="col-6">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Product Carton</label>
        <select class="form-control" name="carton_id">
            <?php
            
                echo "<option disabled selected value>Choose the Carton</option>";
                $get_carton = "select * from cartons";
                $run_carton = mysqli_query($con,$get_carton);
                while($row_carton=mysqli_fetch_array($run_carton)){
                
                $carton_id = $row_carton['carton_id'];
                $carton_name = $row_carton['carton_title'];

                echo "<option value='$carton_id'>$carton_name</option>";

                }
            
            ?>
        </select>
    </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Quantity Manufactured</label>
            <input type="text" class="form-control" name="carton_qty" placeholder="Enter Quantity">
        </div>
    </div>
</div>
  <button type="submit" name="make_product" class="btn btn-primary btn-lg float-right">Submit</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/product.js"></script>
            <?php } ?>
