
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
            <div class="row">
              <div class="col-12"> 
                <div class="card mb-2">
                  <div class="card-body py-3">
                      <h5 class="mb-0">
                        RAW INVENTORY
                      </h5>
                  </div>
                </div>
              </div>
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
                    <h6 class="text-muted font-weight-normal text-capitalize"><?php echo $item_name; ?></h6>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-12"> 
                <div class="card mb-2">
                  <div class="card-body py-3">
                      <h5 class="mb-0">
                        PRODUCT STOCK
                      </h5>
                  </div>
                </div>
              </div>
              <?php 
              
              $get_carton = "select * from cartons";
              $run_carton = mysqli_query($con,$get_carton);
              while($row_carton = mysqli_fetch_array($run_carton)){
                  $product_id = $row_carton['product_id'];
                  $carton_title = $row_carton['carton_title'];
                  $carton_qty = $row_carton['carton_qty'];
                  $carton_stock = $row_carton['carton_stock'];
              ?>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
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
                    <h6 class="text-muted font-weight-normal text-capitalize"><?php echo $carton_title; ?></h6>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <script src="js/script.js"></script>
              <?php } ?>