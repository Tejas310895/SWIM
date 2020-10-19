<?php 

include ("includes/db.php");

$to = 'shirsatbp@gmail.com';
$subject = 'Daily Production Reports';
$from = 'tshirsat700@gmail.com';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$message = '<html><body>';
$message .= '<h1>RAW STOCK</h1>';
$message .= '<table>';
$message .= '<tbody>';
$get_raw_stock = "select * from raw_items";
$run_raw_stock = mysqli_query($con,$get_raw_stock);
while($row_raw_stock = mysqli_fetch_array($run_raw_stock)){

    $item_name = $row_raw_stock['item_name'];
    $item_unit = $row_raw_stock['item_unit'];
    $item_stock = round($row_raw_stock['item_stock'],2);
    if($item_stock<1000){$text_color='red';}else{$text_color='Black';};
    $message .= '<tr>';
    $message .= '<td style="color:'.$text_color.';">'.$item_name.' - '.$item_stock.' '.$item_unit.'</td>';
    $message .= '</tr>';
}
$message .= '</tbody>';
$message .= '</table>';
//product stock
$message .= '<h1>PRODUCT STOCK</h1>';
$message .= '<table>';
$message .= '<tbody>';
$get_cartons_stock = "select * from cartons";
$run_cartons_stock = mysqli_query($con,$get_cartons_stock);
while($row_cartons_stock = mysqli_fetch_array($run_cartons_stock)){

    $carton_title = $row_cartons_stock['carton_title'];
    $carton_stock = $row_cartons_stock['carton_stock'];

    if($carton_stock<100){$carton_color='red';}else{$carton_color='Black';};
    $message .= '<tr>';
    $message .= '<td style="color:'.$carton_color.';">'.$carton_title.' - '.$carton_stock.'</td>';
    $message .= '</tr>';
}
$message .= '</tbody>';
$message .= '</table>';
$message .= '</body></html>';

mail($to, $subject, $message, $headers);

?>