<?php

if (!isset($_SESSION['admin_user'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {
?>

  <ul class="nav nav-pills border-0 mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Raw Inventory</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Product Inventory</a>
    </li>
    <li class="nav-item <?php if ($_SESSION['admin_user'] === "shirsatbp@gmail.com") {
                          echo "show";
                        } else {
                          echo "d-none";
                        } ?>">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-sale" role="tab" aria-controls="pills-sale" aria-selected="false">Sale Inventory</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-work_order" role="tab" aria-controls="pills-work_order" aria-selected="false">Work Order</a>
    </li>
    <li class="nav-item <?php if ($_SESSION['admin_user'] === "shirsatbp@gmail.com") {
                          echo "show";
                        } else {
                          echo "d-none";
                        } ?>">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-accounts" role="tab" aria-controls="pills-accounts" aria-selected="false">Accounting</a>
    </li>
  </ul>
  <div class="tab-content border-0" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="row">
        <?php

        $get_raw = "select * from raw_items";
        $run_raw = mysqli_query($con, $get_raw);
        while ($row_raw = mysqli_fetch_array($run_raw)) {
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
                    <div class="icon icon-box-<?php if ($item_stock < 500) {
                                                echo "danger blink";
                                              } else {
                                                echo "success";
                                              } ?>">
                      <span class="mdi mdi-arrow-<?php if ($item_stock < 500) {
                                                    echo "bottom-left";
                                                  } else {
                                                    echo "top-right";
                                                  } ?> icon-item"></span>
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

        $get_carton = "select * from cartons order by carton_stock asc";
        $run_carton = mysqli_query($con, $get_carton);
        while ($row_carton = mysqli_fetch_array($run_carton)) {
          $product_id = $row_carton['product_id'];
          $carton_title = $row_carton['carton_title'];
          $carton_qty = $row_carton['carton_qty'];
          $carton_stock = $row_carton['carton_stock'];

          $get_sku = "select * from products where product_id='$product_id'";
          $run_sku = mysqli_query($con, $get_sku);
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
                    <div class="icon icon-box-<?php if ($carton_stock < 20) {
                                                echo "danger blink";
                                              } else {
                                                echo "success";
                                              } ?>">
                      <span class="mdi mdi-arrow-<?php if ($carton_stock < 20) {
                                                    echo "bottom-left";
                                                  } else {
                                                    echo "top-right";
                                                  } ?> icon-item"></span>
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
                  $run_req = mysqli_query($con, $get_req);
                  while ($row_req = mysqli_fetch_array($run_req)) {
                    $item_id = $row_req['item_id'];
                    $item_qty = $row_req['item_qty'];

                    $get_rawitem = "select * from raw_items where item_id='$item_id'";
                    $run_rawitem = mysqli_query($con, $get_rawitem);
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
    <div class="tab-pane" id="pills-sale" role="tabpanel" aria-labelledby="pills-sale-tab">
      <div class="row">
        <div id="accordion" class="w-100">
          <?php

          $get_uni_month = "SELECT EXTRACT(YEAR_MONTH FROM invoice_product_created_at) AS mou from invoice_products group by EXTRACT(YEAR_MONTH FROM invoice_product_created_at) order by invoice_product_id desc";
          $run_uni_month = mysqli_query($con, $get_uni_month);
          while ($row_uni_month = mysqli_fetch_array($run_uni_month)) {

            $mou_date = $row_uni_month['mou'];
            $month = substr($mou_date, -2);
            $Year = substr($mou_date, 0, 4);
            $year_month = $Year . "-" . $month;
            $display_delivery_date = date('M-Y', strtotime($year_month));

          ?>
            <div class="card m-2">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-info btn-lg btn-block" data-toggle="collapse" data-target="#mou<?php echo $mou_date; ?>" aria-expanded="true" aria-controls="collapseOne">
                    <h5 clas="mb-0">SALE DATA FOR MONTH <?php echo $display_delivery_date; ?></h5>
                  </button>
                </h5>
              </div>
              <div id="mou<?php echo $mou_date; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#mou<?php echo $mou_date; ?>">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sl.No</th>
                          <th>Name</th>
                          <th>Sold Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $invoice_array = array();

                        $get_invoice_array = "select * from invoice where EXTRACT(YEAR_MONTH FROM invoice_date)='$mou_date'";
                        $run_invoice_array = mysqli_query($con, $get_invoice_array);
                        while ($row_invoice_array = mysqli_fetch_array($run_invoice_array)) {
                          $array_invoice_no = $row_invoice_array['invoice_no'];

                          array_push($invoice_array, $array_invoice_no);
                        }

                        $get_inc_comp = "select * from invoice_products where invoice_no IN ('" . implode("','", $invoice_array) . "') group by LEFT(invoice_no, 2)";
                        $run_inc_comp = mysqli_query($con, $get_inc_comp);
                        while ($row_inc_comp = mysqli_fetch_array($run_inc_comp)) {

                          $inc_comp = $row_inc_comp['invoice_no'];
                          $comp = substr($inc_comp, 0, 2);

                          $get_comp_name = "select * from partners where LEFT(partner_title, 2)='$comp'";
                          $run_comp_name = mysqli_query($con, $get_comp_name);
                          $row_comp_name = mysqli_fetch_array($run_comp_name);

                          $partner_title = $row_comp_name['partner_title'];

                          echo "
                            
                            <tr>
                              <th colspan='3' class='text-center text-uppercase bg-danger'>$partner_title</th>
                            </tr>
                            
                            ";
                          $get_inc_products = "select * from invoice_products where invoice_no IN ('" . implode("','", $invoice_array) . "') and LEFT(invoice_no, 2)='$comp' group by carton_id";
                          $run_inc_products = mysqli_query($con, $get_inc_products);
                          $counter = 0;
                          $total_s_qty = 0;
                          while ($row_inc_products = mysqli_fetch_array($run_inc_products)) {
                            $carton_id = $row_inc_products['carton_id'];
                            $unit_rate = $row_inc_products['unit_rate'];
                            $gst_rate = $row_inc_products['gst_rate'];

                            $get_carton_name = "select * from cartons where carton_id='$carton_id'";
                            $run_carton_name = mysqli_query($con, $get_carton_name);
                            $row_carton_name =  mysqli_fetch_array($run_carton_name);

                            $carton_name = $row_carton_name['carton_title'];

                            $get_sold_qty = "select sum(carton_qty) as sold_qty from invoice_products where invoice_no IN ('" . implode("','", $invoice_array) . "') and LEFT(invoice_no, 2)='$comp' and carton_id='$carton_id'";
                            $run_sold_qty = mysqli_query($con, $get_sold_qty);
                            $row_sold_qty = mysqli_fetch_array($run_sold_qty);

                            $sold_qty = $row_sold_qty['sold_qty'];

                            $total_s_qty += $sold_qty;
                        ?>
                            <tr>
                              <td><?php echo ++$counter; ?></td>
                              <td><?php echo $carton_name; ?></td>
                              <td><?php echo $sold_qty; ?></td>
                            </tr>
                          <?php } ?>
                          <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th><?php echo $total_s_qty; ?></th>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="pills-work_order" role="tabpanel" aria-labelledby="pills-sale-tab">
      <div class="row">
        <div id="accordion" class="w-100">
          <section class="section">
            <div class="card">
              <div class="card-body">
                <table class='table table-striped' id="table1">
                  <thead>
                    <tr class="text-center">
                      <th>Date</th>
                      <th>Reference No</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $get_work_orders = "select * from work_order_task where work_order_status='active' order by work_order_entry_id desc";
                    $run_work_orders = mysqli_query($con, $get_work_orders);
                    while ($row_work_orders = mysqli_fetch_array($run_work_orders)) {
                    ?>
                      <tr class="text-center">
                        <td><?php echo date('d-M-Y H:i A', strtotime($row_work_orders['work_order_task_created_at'])); ?></td>
                        <td><?php echo $row_work_orders['work_order_ref_no']; ?></td>
                        <td class="text-center">
                          <a href="work_order_print.php?work_order_print=<?php echo $row_work_orders['work_order_entry_id']; ?>" class="btn btn-info">Print</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

          </section>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="pills-accounts" role="tabpanel" aria-labelledby="pills-accounts">
      <div class="row">
        <div id="accordion" class="w-100">
          <?php

          $get_uni_month = "SELECT EXTRACT(YEAR_MONTH FROM invoice_product_created_at) AS mou from invoice_products group by EXTRACT(YEAR_MONTH FROM invoice_product_created_at) order by invoice_product_id desc";
          $run_uni_month = mysqli_query($con, $get_uni_month);
          while ($row_uni_month = mysqli_fetch_array($run_uni_month)) {

            $mou_date = $row_uni_month['mou'];
            $month = substr($mou_date, -2);
            $Year = substr($mou_date, 0, 4);
            $year_month = $Year . "-" . $month;
            $display_delivery_date = date('M-Y', strtotime($year_month));

          ?>
            <div class="card m-2">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-info btn-lg btn-block" data-toggle="collapse" data-target="#mou<?php echo $mou_date; ?>" aria-expanded="true" aria-controls="collapseOne">
                    <h5 clas="mb-0">ACCOUNTING DATA FOR MONTH <?php echo $display_delivery_date; ?></h5>
                  </button>
                </h5>
              </div>
              <div id="mou<?php echo $mou_date; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#mou<?php echo $mou_date; ?>">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>SALE</th>
                          <th>SALE GST</th>
                          <th>PURCHASE</th>
                          <th>PURCHASE GST</th>
                          <th>TAX DIFFERENCE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $invoice_array = array();

                        $get_invoice_array = "select * from invoice where EXTRACT(YEAR_MONTH FROM invoice_date)='$mou_date'";
                        $run_invoice_array = mysqli_query($con, $get_invoice_array);
                        while ($row_invoice_array = mysqli_fetch_array($run_invoice_array)) {
                          $array_invoice_no = $row_invoice_array['invoice_no'];

                          array_push($invoice_array, $array_invoice_no);
                        }

                        $get_inc_comp = "select * from invoice_products where invoice_no IN ('" . implode("','", $invoice_array) . "') group by LEFT(invoice_no, 2)";
                        $run_inc_comp = mysqli_query($con, $get_inc_comp);
                        while ($row_inc_comp = mysqli_fetch_array($run_inc_comp)) {

                          $inc_comp = $row_inc_comp['invoice_no'];
                          $comp = substr($inc_comp, 0, 2);

                          $get_comp_name = "select * from partners where LEFT(partner_title, 2)='$comp'";
                          $run_comp_name = mysqli_query($con, $get_comp_name);
                          $row_comp_name = mysqli_fetch_array($run_comp_name);

                          $partner_id = $row_comp_name['partner_id'];
                          $partner_title = $row_comp_name['partner_title'];

                          echo "
                            
                            <tr>
                              <th colspan='5' class='text-center text-uppercase bg-danger'>$partner_title</th>
                            </tr>
                            
                            ";
                          $get_inc_products = "select sum(unit_rate*carton_qty) as sold_qty,sum((unit_rate*carton_qty)*(gst_rate/100)) as gst_amt from invoice_products where invoice_no IN ('" . implode("','", $invoice_array) . "') and LEFT(invoice_no, 2)='$comp' group by LEFT(invoice_no, 2)";
                          $run_inc_products = mysqli_query($con, $get_inc_products);
                          $row_inc_products = mysqli_fetch_array($run_inc_products);
                          $sold_qty = $row_inc_products['sold_qty'];
                          $gst_amt = $row_inc_products['gst_amt'];

                          $get_inc_pur = "select sum(taxable) as pur_qty,sum((taxable)*(gst_rate/100)) as gst_amt from purchase_filling where EXTRACT(YEAR_MONTH FROM filling_date)='$mou_date' and partner_id='$partner_id' group by partner_id";
                          $run_inc_pur = mysqli_query($con, $get_inc_pur);
                          $row_inc_pur = mysqli_fetch_array($run_inc_pur);
                          $pur_qty = $row_inc_pur['pur_qty'];
                          $pur_gst_amt = $row_inc_pur['gst_amt'];

                          $tax_diff = $gst_amt - $pur_gst_amt;
                        ?>
                          <tr>
                            <td><?php echo round($sold_qty, 2); ?></td>
                            <td><?php echo round($gst_amt, 2); ?></td>
                            <td><?php echo round($pur_qty, 2); ?></td>
                            <td><?php echo round($pur_gst_amt, 2); ?></td>
                            <td><?php echo round($tax_diff, 2); ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="js/script.js"></script>
  <script>
    $(function() {
      $('[data-toggle="popover"]').popover()
    })
  </script>
<?php } ?>