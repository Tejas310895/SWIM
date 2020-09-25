<?php 

include("../includes/db.php");

if(isset($_POST['item_id'])){

    $item_id = $_POST['item_id'];

    $get_item_id = "select * from raw_items where item_id='$item_id'";

    $run_item_id = mysqli_query($con,$get_item_id);

    $row_item_id = mysqli_fetch_array($run_item_id);

    $item_unit = $row_item_id['item_unit'];

    echo "Quantity in ".$item_unit;
}

if(isset($_POST['vendor_id'])){

    $vendor_id = $_POST['vendor_id'];

    echo "<option disabled selected value>Choose the raw Item</option>";
    $get_items = "select * from raw_items where vendor_id='$vendor_id'";
    $run_items = mysqli_query($con,$get_items);
    while($row_items=mysqli_fetch_array($run_items)){
    
    $item_id = $row_items['item_id'];
    $item_name = $row_items['item_name'];

    echo "<option value='$item_id'>$item_name</option>";

    }
}


?>