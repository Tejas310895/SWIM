
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>

<ul class="nav nav-pills border-0 mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Raw Inventory</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Product Inventory</a>
  </li>
</ul>
<div class="tab-content border-0" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="row">
      <?php 
      
      $get_raw = "select * from raw_items";
      $run_raw = mysqli_query($con,$get_raw);
      while($row_raw = mysqli_fetch_array($run_raw)){
          $item_name = $row_raw['item_name'];
          $item_unit = $row_raw['item_unit'];
          $item_stock = $row_raw['item_stock'];
      ?>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0"><?php echo round($item_stock, 2);  ?></h3>
                  <p class="text-success ml-2 mb-0 font-weight-medium"><?php echo $item_unit; ?></p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-<?php if($item_stock<500){echo"danger blink";}else{echo"success";} ?>">
                  <span class="mdi mdi-arrow-<?php if($item_stock<500){echo"bottom-left";}else{echo"top-right";} ?> icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="font-weight-normal text-capitalize"><?php echo $item_name; ?></h6>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="row">
        <?php 
        
        $get_carton = "select * from cartons";
        $run_carton = mysqli_query($con,$get_carton);
        while($row_carton = mysqli_fetch_array($run_carton)){
            $product_id = $row_carton['product_id'];
            $carton_title = $row_carton['carton_title'];
            $carton_qty = $row_carton['carton_qty'];
            $carton_stock = $row_carton['carton_stock'];

            $get_sku = "select * from products where product_id='$product_id'";
            $run_sku = mysqli_query($con,$get_sku);
            $row_sku = mysqli_fetch_array($run_sku);

            $sku_id = $row_sku['SKU_id'];
        ?>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
          <div class="card">
          <div class="card-header bg-info">
            <div class="card-title mb-0">
              <h6 class="font-weight-normal text-capitalize mb-0 text-center"><?php echo $carton_title; ?></h6>
            </div>
          </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-9">
                  <div class="d-flex align-items-center align-self-start">
                    <h3 class="mb-0"><?php echo $carton_stock;  ?></h3>
                    <p class="text-success ml-2 mb-0 font-weight-medium">Carton/Bundle</p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="icon icon-box-<?php if($carton_stock<20){echo"danger blink";}else{echo"success";} ?>">
                    <span class="mdi mdi-arrow-<?php if($carton_stock<20){echo"bottom-left";}else{echo"top-right";} ?> icon-item"></span>
                  </div>
                </div>
              </div>
              <div id="myPopoverContent">
                <h6 class="text-center bg-warning p-1 rounded">Product Content</h6>
              <?php 

              echo "
              
              <table class='table table-responsive'>
              <tr>
              <th>Name</th>
              <th>Quantity</th>
              </tr>
              ";
              
              $get_req = "select * from raw_required where SKU_id='$sku_id'";
              $run_req = mysqli_query($con,$get_req);
              while($row_req = mysqli_fetch_array($run_req)){
                $item_id = $row_req['item_id'];
                $item_qty = $row_req['item_qty'];

                $get_rawitem = "select * from raw_items where item_id='$item_id'";
                $run_rawitem = mysqli_query($con,$get_rawitem);
                $row_rawitem = mysqli_fetch_array($run_rawitem);

                $item_name = $row_rawitem['item_name'];
                $item_unit = $row_rawitem['item_unit'];

                echo "
                
                <tr>
                  <td class='px-2'>$item_name</td>
                  <td>$item_qty $item_unit</td>
                </tr>
                
                ";

              }   
              
              echo "</table>";
              ?>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
          <script src="js/script.js"></script>
          <script>
          $(function () {
            $('[data-toggle="popover"]').popover()
          })
          </script>
              <?php } ?>
