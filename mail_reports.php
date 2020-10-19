<?php 

include ("includes/db.php");

$to = 'tshirsat700@gmail.com';
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
    $item_stock = $row_raw_stock['item_stock'];

    $message .= '<td>'.$item_name.' - '.$item_stock.' '.$item_unit.'</td>';

}
$message .= '</tbody>';
$message .= '</table>';
$message .= '</body></html>';

mail($to, $subject, $message, $headers);

?>