<?php

if (isset($_GET['mail_sent'])) {

    include('pdf.php');

    // $file_tmp_name  = $_FILES['bill_image']['tmp_name'];
    // $file_name_oc = $_FILES['bill_image']['name'];

    // var_dump($attachment);
    $mail_inc_id = $_GET['mail_sent'];

    // $mail_inc_id = 'BS22-23/004';
    // $customer_email = 'tshirsat700@gmail.com';
    $message = '';

    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $connect = mysqli_connect('localhost', 'root', '', 'swaf');
    } else {
        $connect = mysqli_connect('localhost', 'u708087849_swaf', 'Silverwrap@11', 'u708087849_swaf');
    }
    // $connect = mysqli_connect('localhost:3308', 'root', '', 'swaf');
    // $connect = mysqli_connect('localhost', 'u708087849_swaf', 'Silverwrap@11', 'u708087849_swaf');

    $get_inc_ref = "select * from po_entries where po_number='$mail_inc_id'";
    $run_inc_ref = mysqli_query($connect, $get_inc_ref);
    $row_inc_ref = mysqli_fetch_array($run_inc_ref);

    $mail_inc_no = $row_inc_ref['po_number'];
    $vendor_id = $row_inc_ref['vendor_id'];
    $customer_email = $row_inc_ref['vendor_email'];
    $str_arr = explode(",", $customer_email);

    $get_customer_email = "select * from vendors where vendor_id='$vendor_id'";
    $run_customer_email = mysqli_query($connect, $get_customer_email);
    $row_customer_email = mysqli_fetch_array($run_customer_email);


    function AmountInWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
        ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
        ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
    " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
    }


    function fetch_customer_data($connect)
    {
        global $mail_inc_id;
        $get_inc_data = "select * from po_entries where po_number='$mail_inc_id'";
        $run_inc_data = mysqli_query($connect, $get_inc_data);
        $row_inc_data = mysqli_fetch_array($run_inc_data);

        $po_number = $row_inc_data['po_number'];
        $po_date = $row_inc_data['po_date'];
        $indent_number = $row_inc_data['indent_number'];
        $indent_date = $row_inc_data['indent_date'];
        $vendor_id = $row_inc_data['vendor_id'];
        $vendor_email = $row_inc_data['vendor_email'];
        $raw_product_array = $row_inc_data['raw_product_array'];
        $po_note = $row_inc_data['po_note'];
        $po_comment = $row_inc_data['po_comment'];
        $po_shcedule = $row_inc_data['po_shcedule'];
        $po_delivery_status = $row_inc_data['po_delivery_status'];

        $get_vendor = "select * from vendors where vendor_id='$vendor_id'";
        $run_vendor = mysqli_query($connect, $get_vendor);
        $row_vendor = mysqli_fetch_array($run_vendor);

        $shop_title = $row_vendor['shop_title'];
        $vendor_gstn = $row_vendor['vendor_gstn'];
        $vendor_contact = $row_vendor['vendor_contact'];
        $vendor_address = $row_vendor['vendor_address'];
        $vendor_state = $row_vendor['vendor_state'];
        $vendor_state_code = $row_vendor['vendor_state_code'];

        $inc_pre = substr($po_number, 0, 2);

        $get_partner = "select * from partners where LEFT(partner_title, 2)='$inc_pre'";
        $run_partner = mysqli_query($connect, $get_partner);
        $row_partner = mysqli_fetch_array($run_partner);

        $partner_title = $row_partner['partner_title'];
        $partner_contact = $row_partner['partner_contact'];
        $partner_address = $row_partner['partner_address'];
        $partner_state = $row_partner['partner_state'];
        $partner_state_code = $row_partner['partner_state_code'];

        $output = '
        <table class="table table-bordered mb-0" style="font-family: Poppins;">
            <tr>
                <th class="p-1" style="width:80%;">
                    <h4 class="text-center p-2 mb-0 mt-1 font-weight-bold">
                        PURCHASE ORDER
                    </h4>
                </th>
            </tr>
        </table>
        <table class="table table-bordered" style="font-family: Poppins;">
            <tr>
                <th style="width:50%";>
                    Po Number : ';
        $output .=            $po_number;
        $output .=            '<br>Po Date : ';
        $output .=            date("d-M-Y", strtotime($po_date));
        $output .= '
                </th 	>
                <th>
                Indent No';
        $output .=            $indent_number;
        $output .=            '<br>Indent Date : ';
        $output .=            date("d-M-Y", strtotime($indent_date));
        $output .= '
                </th>
            </tr>
            <tr>
                <th class="pb-0">
                    <h5>';
        $output .=            $shop_title;
        $output .=            '<br>';
        $output .=            $vendor_address;
        $output .= '</h5>
                    ';
        $output .= '
                </th>
                <th>
                    <h5 class="text-capitalize"><strong>Transportor</strong> : <br>
                    <strong>Bill to :</strong> </br>';
        $output .= strtoupper($partner_title) . '<br>';
        $output .= $partner_address . '<br>';
        $output .= $partner_state . ' (State Code : ' . $partner_state_code . ')<br>';
        $output .= '<strong>Ship to :<strong><br>';
        $output .= 'Unit.No 20 Building.No.D8 Bhumi World - Industrial Park, Pimplas Village, 
        Mumbai-Nashik Highway, Bhiwandi, Maharashtra 421302';
        $output .= '
                    </h5>
                </th>
            </tr>
        </table>
        <table class="table table-bordered text-dark" style="width:100%;font-family: Poppins;">
            <thead style="font-size:1.3rem;">
                <tr class="text-center">
                    <th class="align-middle text-center p-1">Sl.No</th>
                    <th class="align-middle text-center p-1">Description of goods</th>
                    <th class="align-middle text-center p-1">Quantity</th>
                    <th class="align-middle text-center p-1">Unit</th>
                    <th class="align-middle text-center p-1">Rate/Unit</th>
                    <th class="align-middle text-center p-1">Gst %</th>
                    <th class="align-middle text-center p-1">Gst Rate</th>
                    <th class="align-middle text-center p-1">Amount</th>
                </tr>
            </thead>
            <tbody style="font-size:0.7rem;">
            ';
        $get_inc_pro = "select * from po_entries where po_number='$mail_inc_id'";
        $run_inc_pro = mysqli_query($connect, $get_inc_pro);
        $pro_counter = 0;
        while ($row_inc_pro = mysqli_fetch_array($run_inc_pro)) {

            $raw_product_array = $row_inc_pro['raw_product_array'];

            $unserialized_array = unserialize($raw_product_array);
            $array_size = (count($unserialized_array) - 1);
            $total_amount = 0;
            for ($i = 0; $i <= $array_size; $i++) {

                $item_id = $unserialized_array[$i][0];
                $item_qty = $unserialized_array[$i][1];
                $unit_rate = $unserialized_array[$i][2];
                $gst_rate = $unserialized_array[$i][3];
                $item_desc = $unserialized_array[$i][4];


                $get_raw_id = "select * from raw_items where item_id='$item_id'";
                $run_raw_id = mysqli_query($connect, $get_raw_id);
                $row_raw_id = mysqli_fetch_array($run_raw_id);
                $item_name = $row_raw_id['item_name'];
                $item_unit = $row_raw_id['item_unit'];

                $taxable_amount = $unit_rate * $item_qty;
                $total_amount += $taxable_amount;
                $tax_amount = $taxable_amount * ($gst_rate / 100);

                $output .= '										
                <tr class="text-center" style="font-size:1rem;">
                    <td class=" p-1"> 
                    ';
                $output .= ++$pro_counter;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $item_name;
                $output .= '<br><small>(
                    ';
                $output .= $item_desc;
                $output .= '
                        )</small>';
                $output .= '				
                    </td>				
                    <td class=" p-1"> 
                    ';
                $output .= $item_qty;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $item_unit;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $unit_rate;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $gst_rate;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $tax_amount;
                $output .= '				
                    </td>
                    <td class=" p-1"> 
                    ';
                $output .= $taxable_amount;
                $output .= '	
                    </td>			
                </tr>						
                ';
            }
        }
        $get_inc_count = "select * from po_entries where po_number='$mail_inc_id'";
        $run_inc_count = mysqli_query($connect, $get_inc_count);
        $inc_count = mysqli_num_rows($run_inc_count);
        $req_count = 6 - $inc_count;

        if ($req_count > 1) {

            for ($x = 0; $x <= $req_count; $x++) {
                $output .= '
                    <tr>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                </tr>

                    ';
            }
        }
        $output .= '
            </tbody>
            <tfoot style="font-size:0.8rem;">
                <tr>
                    <th colspan="7" class="text-right pr-2">
                        <h5 class="mb-0 mt-1 font-weight-bold">TOTAL TAXABLE VALUE</h5>
                    </th>
                    <th class="text-center">
                        <h5 class="mb-0">
                        ';
        $output .= $total_amount;
        $output .= '								
                        </h5>
                    </th>
                </tr>
            </tfoot>
        </table>
        <table class="table table-bordered" style="font-family: Poppins;">
        <tr>
            <th style="width:40%">
                <h5 class="text-uppercase my-2">Payment : 30 Days after Delivery</h5>
                <h5 class="text-uppercase my-2">Price: Ex-Factory </h5>
                <h5 class="text-uppercase my-2">Delivery : Immediate </h5>
                <h5 class="text-uppercase my-2">Tax : GST</h5>
                <h5 class="text-uppercase mb-0 mt-1">GSTIN : 27AAVFB4499H1ZP</h5>
            </th>
            <th style="width:30%">
                <h6 class="font-weight-bold" style="font-size:1.5rem;text-align:center;">Customer Signature</h6>
            </th>
            <th class="p-0" style="width:30%">
                <table class="table table-bordered mb-0">
                ';
        $get_inc_pro_gst = "select * from po_entries where po_number='$mail_inc_id'";
        $run_inc_pro_gst = mysqli_query($connect, $get_inc_pro_gst);
        $gst_total_amount = 0;
        $grand_taxable_ex = 0;
        $grand_cgst_ex = 0;
        $grand_sgst_ex = 0;
        $grand_igst_ex = 0;
        while ($row_inc_pro_gst = mysqli_fetch_array($run_inc_pro_gst)) {

            $raw_product_array = $row_inc_pro_gst['raw_product_array'];

            $unserialized_array = unserialize($raw_product_array);
            $array_size = (count($unserialized_array) - 1);
            $cgst_amount_hsn_ex = 0;
            $sgst_amount_hsn_ex = 0;
            $igst_amount_hsn_ex = 0;
            for ($i = 0; $i <= $array_size; $i++) {

                $item_id = $unserialized_array[$i][0];
                $item_qty = $unserialized_array[$i][1];
                $unit_rate = $unserialized_array[$i][2];
                $gst_rate = $unserialized_array[$i][3];

                $taxable_amount = $unit_rate * $item_qty;
                $gst_total_amount += $taxable_amount;

                if ($vendor_state_code == 27) {
                    $cgst_amount_hsn_ex += $taxable_amount * (($gst_rate / 2) / 100);
                    $sgst_amount_hsn_ex += $taxable_amount * (($gst_rate / 2) / 100);
                    $igst_amount_hsn_ex += 0;
                } else {
                    $cgst_amount_hsn_ex += 0;
                    $sgst_amount_hsn_ex += 0;
                    $igst_amount_hsn_ex += $taxable_amount * ($gst_rate / 100);
                }
                $grand_taxable_ex += $taxable_amount;
            }
            $grand_cgst_ex += $cgst_amount_hsn_ex;
            $grand_sgst_ex += $sgst_amount_hsn_ex;
            $grand_igst_ex += $igst_amount_hsn_ex;
        }
        $output .= '																		
        
                    <tr>
                        <th class="py-1">Taxable Amount</th>
                        <td class="py-1 text-right">
                        ';
        $output .= $grand_taxable_ex;
        $output .= '																							
                        </td>
                    </tr>
                    <tr>
                        <th class="py-1 
                        ';
        if ($grand_cgst_ex >= 1) {
            $output .= "show";
        } else {
            $output .= "d-none";
        }
        $output .= '																												
                        ">CGST</th>
                        <td class="py-1 text-right">
                        ';
        $output .= $grand_cgst_ex;
        $output .= '																							
                        </td>
                    </tr>
                    <tr>
                        <th class="py-1 
                        ';
        if ($grand_sgst_ex >= 1) {
            $output .= "show";
        } else {
            $output .= "d-none";
        }
        $output .= '																																	
                        ">SGST</th>
                        <td class="py-1 text-right">
                        ';
        $output .= $grand_sgst_ex;
        $output .= '																							
                        </td>
                    </tr>
                    <tr>
                    <th class="py-1 
                    ';
        if ($grand_igst_ex >= 1) {
            $output .= "show";
        } else {
            $output .= "d-none";
        }
        $output .= '																																	
                    ">IGST</th>
                    <td class="py-1 text-right">
                    ';
        $output .= $grand_igst_ex;
        $output .= '																							
                    <tr>
                        <th class="py-1 ">Total Tax</th>
                        <td class="py-1 text-right">
                        ';
        $output .= $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex;
        $output .= '																							
                        </td>
                    </tr>
                    <tr>							
                    <td class="py-1 text-right">
                        ';
        $output .= '																							
                    </tr>
                    <tr>
                        <th class="py-1">Grand Total</th>
                        <td class="py-1 text-right">
                        ';
        $output .= round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex);
        $output .= '																							
                        </td>
                    </tr>
                </table>
            </th>
        </tr>
        <tr>
            <th colspan="3">
                <h5 class="my-1 text-right text-uppercase font-weight-bold">TOTAL IN WORDS : 
                    ';
        $output .= AmountInWords(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex));
        $output .= '																											
                    ONLY</h5>
            </th>
        </tr>
        <tr>
        <th colspan="2">
            <h4><u>Note :</u></h4>
            <h5>
            * This Purchase Order is valid till 30 days from Order date. <br>
            * Please quote our Order No. and date in all correspondence pertaining to this order.<br>
            * Supplied material should meet statutory & regulatory requirement.
            </h5>
        </th>
        <th colspan="1">
            <h4><u>Additional Comments :-</u></h4>
            <h5>All Materials are urgent,Kindly process
            immediate for delivery on time.</h5>
        </th>
        </tr>
        <tr style="text-align:center;font-weight:bold;">
        <th colspan="2" style="word-spacing: 80px;">
        Prepared_by Approved_by Checked_by
        </th>
        <th colspan="1" style="height:50px;">
        ';
        $output .= $partner_title;
        $output .= '
        </th>
        </tr>
        </table>
    ';
        return $output;
    }
    $file_name = 'Po-Order.pdf';
    $html_code = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
    $html_code .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
    $html_code .= '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">';
    $html_code .= fetch_customer_data($connect);
    $pdf = new Pdf();
    $pdf->loadHtml($html_code, 'UTF-8');
    $pdf->setPaper("a4", "portrait");
    $pdf->render();
    $file = $pdf->output();
    file_put_contents($file_name, $file);

    require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;                                 //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com';        //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->SMTPKeepAlive = true;
    $mail->Port = 465;                                //Sets the default SMTP server port
    $mail->SMTPAuth = true;                            //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'swrapfoil@gmail.com';                    //Sets SMTP username
    $mail->Password = 'nratbfjkgipxzznj';                    //Sets SMTP password
    $mail->SMTPSecure = 'ssl';                            //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->SetFrom("swrapfoil@gmail.com", "Silver Wrap");
    $mail->addCC('shirsatbp@gmail.com');
    $mail->AddReplyTo("swrapfoil@gmail.com", "Silver Wrap");
    for ($i = 0; $i < count($str_arr); $i++) {
        $mail->AddAddress('shirsatbp@gmail.com', 'Invoice');        //Adds a "To" address
    }
    // $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);
    $mail->AddAttachment($file_name);
    $mail->Subject = 'Purchase Order from Silver Wrap PO No.' . $mail_inc_no;            //Sets the Subject of the message
    $mail->Body     = "<html><body><p><b>Dear Team, </b></p><p><i>Wellness Greetings.</i></p></body></html>";
    $mail->Body     .= "<html><body><p><b>I hope you’re well. Please see attached invoice. Don’t hesitate to reach out if you have any questions.</b></p><p><i>Kind Regards.</i></p></body></html>";
    if ($mail->Send())                                //Send an Email. Return true on success or false on error
    {
        echo "<script>alert('Mail Sent to customer')</script>";
        echo "<script>window.open('../index.php?view_poentry','_self')</script>";
    } else {
        echo "<script>alert('Mail Error! Try again')</script>";
        echo "<script>window.open('../index.php?view_poentry','_self')</script>";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    unlink($file_name);
} else {
    echo "<script>alert('PO number invalid! Try again')</script>";
    echo "<script>window.open('../index.php?sales_invoices','_self')</script>";
}
