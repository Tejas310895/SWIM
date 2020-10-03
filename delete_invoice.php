<?php 

include("includes/db.php");

if(isset($_GET['invoice_no'])){

    $invoice_no = $_GET['invoice_no'];

    $get_carton = "select * from invoice_products where invoice_no='$invoice_no'";
    $run_carton = mysqli_query($con,$get_carton);
    while($row_carton = mysqli_fetch_array($run_carton)){

        $carton_id = $row_carton['carton_id'];
        $carton_qty = $row_carton['carton_qty'];

        $reverse_stock = "update cartons set carton_stock=carton_stock+'$carton_qty' where carton_id='$carton_id'";
        $run_reverse_stock = mysqli_query($con,$reverse_stock);

        if($run_reverse_stock){
            $delete_inc_pro = "delete from invoice_products where invoice_no='$invoice_no'";
            $run_delete_inc_pro = mysqli_query($con,$delete_inc_pro);
        }

    }

    $delete_invoice = "delete from invoice where invoice_no='$invoice_no'";
    $run_delete_invoice = mysqli_query($con,$delete_invoice);


    if($run_delete_invoice){
        echo "<script>alert('Invoice Deleted')</script>";
        echo "<script>window.open('index.php?invoice_entries','_self')</script>";   
    }else{
        echo "<script>alert('Invoice Deletion Failed Try Again')</script>";
        echo "<script>window.open('index.php?invoice_entries','_self')</script>";   
    }

}

?>