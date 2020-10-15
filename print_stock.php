<?php 

include("includes/db.php");

?>
<?php 

if(isset($_GET['print_id'])){

  $print_id = $_GET['print_id'];

  $get_manufacturing = "select * from manufacturing where print_id='$print_id'";
  $run_manufacturing = mysqli_query($con,$get_manufacturing);
  $row_manufacturing = mysqli_fetch_array($run_manufacturing);

  $carton_id = $row_manufacturing['carton_id'];
  $carton_qty = $row_manufacturing['carton_qty'];
  $manufacturing_created_at = $row_manufacturing['manufacturing_created_at'];

  $get_carton = "select * from cartons where carton_id='$carton_id'";
  $run_carton = mysqli_query($con,$get_carton);
  $row_carton = mysqli_fetch_array($run_carton);

  $product_id = $row_carton['product_id'];
  $carton_title = $row_carton['carton_title'];
  $carton_lable = $row_carton['carton_lable'];
  $carton_sub_lable = $row_carton['carton_sub_lable'];
  $carton_box_size = $row_carton['carton_box_size'];

  $get_product = "select * from products where product_id='$product_id'";
  $run_product = mysqli_query($con,$get_product);
  $row_product = mysqli_fetch_array($run_product);

  $product_name = $row_product['product_name'];
  $product_type = $row_product['product_type'];
  $SKU_id = $row_product['SKU_id'];

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Silver Wrap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39 Extended Text' rel='stylesheet'>
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="barcode/js/JsBarcode.all.min.js"></script>
    <style>
      #date{
        height:100px;
        width:230px;
      }
      
      #pro{
        height:100px;
        width:180px;
      }
   @media print 
            {
            @page
            {
                size: 100mm 100mm;
                /* size: portrait; */
                margin: 2mm 0mm 0mm 0mm;
            }
            .pagebreak { page-break-before: always; }
            }
    </style>
	<script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.location = 'index.php?product_manufacturing';
        }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      JsBarcode(".barcode").init();
      });
    </script>
  </head>
  <body>
  <?php 
    for ($x = 0; $x <=($carton_qty-1); $x++) {
    ?>
    <div class="pagebreak mt-1 ml-1">
    <table class="text-dark">
          <thead>
          <tr>
            <th colspan="3">
              <h4 class="text-center text-dark pt-1 mb-0">
                PRODUCT : <?php echo $product_type; ?>
              </h4>
            </th>
          </tr>
          <tr>
              <th class="px-3">
                <h1 class="text-center mb-0" style="font-size:6rem;font-family:Anton;"><?php echo $carton_lable; ?></h1>
                <h6 class="text-center mb-0 text-uppercase"><?php echo $carton_sub_lable; ?></h6> 
                <h6 class="text-center mb-0"><?php echo $carton_box_size; ?></h6>    
              </th>
              <th>
              <h4 class="text-center mb-0">Product Code</h4>
                  <svg class="barcode"
                      id="pro"
                      jsbarcode-format="ean13"
                      jsbarcode-value="<?php echo $SKU_id; ?>"
                      jsbarcode-textmargin="0"
                      jsbarcode-fontoptions="bold">
                  </svg>
              </th>
              <th>
              <h4 class="text-center mb-0">Manufacuring Date</h4>
                <svg class="barcode"
                      id="date"
                      jsbarcode-format="code128"
                      jsbarcode-value="<?php echo date("d-M-Y", strtotime($manufacturing_created_at)); ?>"
                      jsbarcode-textmargin="0"
                      jsbarcode-fontoptions="bold">
                  </svg>
              </th>
          </tr>
          </thead>
          <tbody>
              <tr class="rotate">
                  <th colspan="3">
                  <!-- <h3 class="text-center carton_name" style="font-size:1.2rem;font-weight:bold;">25 Pcs Box</h3> -->
                  <h4 class="text-center pt-1 mb-0">MADE IN INDIA</h4>
                  </th>
              </tr>
          </tbody>
      </table>
    </div>
    <?php } ?>
<?php 

include("includes/footer.php");

?>