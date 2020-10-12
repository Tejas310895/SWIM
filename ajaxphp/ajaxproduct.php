<?php

include("../includes/db.php");

if(isset($_POST['submit'])){
    $itemArr = $_POST['item'];
    $qtyArr = $_POST['qty'];
    $sku_id = $_POST['sku_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $hsn_code = $_POST['hsn_code'];
    $gst_rate = $_POST['gst_rate'];


    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $get_sku = "select * from products where SKU_id='$sku_id'";

    $run_sku = mysqli_query($con,$get_sku);

    $count_sku = mysqli_num_rows($run_sku);

    if($count_sku<1){

            if(!empty($itemArr)){
                for($i = 0; $i < count($itemArr); $i++){
                    if(!empty($itemArr[$i])){
                        $item = $itemArr[$i];
                        $qty = $qtyArr[$i];

                        $insert_required = "insert into raw_required (SKU_id,item_id,item_qty) values ('$sku_id','$item','$qty')";

                        $run_required = mysqli_query($con,$insert_required);
                        
                    }
                }
            }

            $insert_product = "insert into products (product_name,product_type,SKU_id,hsn_code,gst_rate,product_created_at,product_updated_at) values ('$product_name','$product_type','$sku_id','$hsn_code','$gst_rate','$today','$today')";

            $run_product = mysqli_query($con,$insert_product);

            if($run_required){
                echo "<script>alert('Done')</script>";
                echo "<script>window.open('../index.php?view_product','_self')</script>";
            }else{
                echo "<script>alert('Failed')</script>";
                echo "<script>window.open('../index.php?create_product','_self')</script>";
            }

    }else{
        echo "<script>alert('Same SKU ID, Please Use Different SKU ID')</script>";
        echo "<script>window.open('../index.php?create_product','_self')</script>";
    }
}

if(isset($_POST['carton_entry'])){
    $carton_title = $_POST['carton_title'];
    $product_id = $_POST['product_id'];
    $carton_qty = $_POST['carton_qty'];
    $carton_lable = $_POST['carton_lable'];
    $carton_sub_lable = $_POST['carton_sub_lable'];
    $carton_box_size = $_POST['carton_box_size'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");

    $insert_carton = "insert into cartons (product_id,
                                           carton_title,
                                           carton_qty,
                                           carton_lable,
                                           carton_sub_lable,
                                           carton_box_size,
                                           carton_created_at,
                                           carton_updated_at)
                                            values
                                            ('$product_id',
                                            '$carton_title',
                                            '$carton_qty',
                                            '$carton_lable',
                                            '$carton_sub_lable',
                                            '$carton_box_size',
                                            '$today',
                                            '$today'
                                            )";
    $run_carton = mysqli_query($con,$insert_carton);

    if($run_carton){
        echo "<div class='alert alert-success' role='alert'>
        <strong>Done!</strong> Your Carton is added successfully.
      </div>";
    }else{
        echo "
        <div class='alert alert-Danger' role='alert'>
        <strong>Error!</strong> Failed to add the Carton try again.
        </div>
        ";
    }
}

if(isset($_POST['make_product'])){
    $carton_id = $_POST['carton_id'];
    $carton_qty = $_POST['carton_qty'];

    date_default_timezone_set('Asia/Kolkata');

    $today = date("Y-m-d H:i:s");
 
    $get_proid = "select * from cartons where carton_id='$carton_id'";
    $run_proid = mysqli_query($con,$get_proid);
    $row_proid = mysqli_fetch_array($run_proid);
    $pro_id = $row_proid['product_id'];
    $pro_count = $row_proid['carton_qty'];

    $get_sku = "select * from products where product_id='$pro_id'";
    $run_sku = mysqli_query($con,$get_sku);
    $row_sku = mysqli_fetch_array($run_sku);
    $sku_id = $row_sku['SKU_id'];

    $get_required = "select * from raw_required where SKU_id='$sku_id'";
    $run_required = mysqli_query($con,$get_required);
    $stock = 0;
    $check = 0;
    while($row_required = mysqli_fetch_array($run_required)){
        $item_id = $row_required['item_id'];
        $item_qty = $row_required['item_qty'];

        $get_item = "select * from raw_items where item_id='$item_id'";
        $run_item = mysqli_query($con,$get_item);
        $count_item = mysqli_num_rows($run_item);
        $row_item = mysqli_fetch_array($run_item);
        $item_stock = $row_item['item_stock'];

        $stock_check = $item_qty*($pro_count*$carton_qty);

        if($item_stock<$stock_check){
            $check = 0;
        }else {
            $check = ++$check;
        }
        $stock = ++$stock;
    }

    if($stock==$check){

        $get_print_id = "select * from manufacturing order by print_id desc";
        $run_print_id = mysqli_query($con,$get_print_id);
        $row_print_id = mysqli_fetch_array($run_print_id);

        $print_bef_id = $row_print_id['print_id'];
        $print_id = $print_bef_id+1;
        
        $get_productid = "select * from cartons where carton_id='$carton_id'";
        $run_productid = mysqli_query($con,$get_productid);
        $row_productid = mysqli_fetch_array($run_productid);
        $product_id = $row_productid['product_id'];
        $product_count = $row_productid['carton_qty'];

        $get_skuid = "select * from products where product_id='$product_id'";
        $run_skuid = mysqli_query($con,$get_skuid);
        $row_skuid = mysqli_fetch_array($run_skuid);
        $sku_id2 = $row_skuid['SKU_id'];

        $get_raw_required = "SELECT DISTINCT(item_id) from raw_required where SKU_id='$sku_id2'";
        $run_raw_required = mysqli_query($con,$get_raw_required);
        while($row_raw_required = mysqli_fetch_array($run_raw_required)){
            $requireditem_id = $row_raw_required['item_id'];

            $get_itemqty = "select * from raw_required where item_id='$requireditem_id' and SKU_id='$sku_id2'";
            $run_itemqty = mysqli_query($con,$get_itemqty);
            $row_itemqty=mysqli_fetch_array($run_itemqty);
            $requireditem_qty = $row_itemqty['item_qty'];

            $stock_reduce = $requireditem_qty*($pro_count*$carton_qty);

            $update_stock = "update raw_items set item_stock=item_stock-'$stock_reduce',item_updated_at='$today' where item_id='$requireditem_id'";
            $run_update_stock = mysqli_query($con,$update_stock);

    }

    if($update_stock){
            $insert_manufacturing = "insert into manufacturing (print_id,
                                                                carton_id,
                                                                carton_qty,
                                                                manufacturing_created_at,
                                                                manufacturing_updated_at)
                                                                values 
                                                                ('$print_id',
                                                                '$carton_id',
                                                                '$carton_qty',
                                                                '$today',
                                                                '$today')
                                                                ";
            $run_manufacturing = mysqli_query($con,$insert_manufacturing);

            $update_carton_stock = "update cartons set carton_stock=carton_stock+'$carton_qty' where carton_id='$carton_id'";
            $run_carton_stock = mysqli_query($con,$update_carton_stock);

            echo "<script>alert('Products Manufacturing Successfull')</script>";
            echo "<script>window.open('../print_stock.php?print_id=$print_id','_self')</script>";    
    }else {
        echo "<script>alert('Products Manufacturing Failed')</script>";
        echo "<script>window.open('../index.php?product_manufacturing','_self')</script>";   
    }

    }else{
        echo "<script>alert('Stock Unavailable')</script>";
        echo "<script>window.open('../index.php?product_manufacturing','_self')</script>";
    }
}
?>