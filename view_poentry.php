<div class="row">
    <div class="page-title col-md-10">
        <h3>Purchase Enquires</h3>
        <p class="text-subtitle text-muted">Below are the details of purchase enquires</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_po_order" class="btn btn-primary" style="float:right;">New Purchase Enquiry</a>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-striped' id="example">
                <thead>
                    <tr class="text-center">
                        <th>Date</th>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $get_purchase_entries = "select * from po_entries order by po_id desc";
                    $run_purchase_entries = mysqli_query($con, $get_purchase_entries);
                    while ($row_purchase_entries = mysqli_fetch_array($run_purchase_entries)) {

                        $vendor_id = $row_purchase_entries['vendor_id'];

                        $get_vendor = "select * from vendors where vendor_id='$vendor_id'";
                        $run_vendor = mysqli_query($con, $get_vendor);
                        $row_vendor = mysqli_fetch_array($run_vendor);
                    ?>
                        <tr>
                            <td>
<a href="sendpdf/resend_mail.php?mail_sent=<?php echo $row_purchase_entries['po_number']; ?>" type="button" class="btn btn-primary <?php if ($row_purchase_entries['po_delivery_status'] === 'shipped' || $row_purchase_entries['po_delivery_status'] === 'cancelled') {
                                                                                                                                                                            echo "d-none";
                                                                                                                                                                        } ?>" title="Resend Mail">
                                        <i class="mdi mdi-email-outline"></i>
                                    </a>
</td>
                            <td class="text-uppercase"><?php echo $row_vendor['shop_title']; ?></td>
                            <td><?php echo $row_purchase_entries['vendor_email']; ?></td>
                            <td><?php echo date('d-M-y', strtotime($row_purchase_entries['po_shcedule'])); ?></td>
                            <td class="text-uppercase"><?php echo $row_purchase_entries['po_delivery_status']; ?></td>
                            <td>
                                <div class="btn-group d-flex" role="group" aria-label="Basic example">
                                    <div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-information-outline"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Quantity</th>
                                                            <th>Unit rate</th>
                                                            <th>Gst %</th>
                                                            <th>Gst rate</th>
                                                            <th>Taxable Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $unserialized_array = unserialize($row_purchase_entries['raw_product_array']);
                                                        $array_size = (count($unserialized_array) - 1);
                                                        $total_gst = 0;
                                                        $total_taxable = 0;
                                                        for ($i = 0; $i <= $array_size; $i++) {

                                                            $item_id = $unserialized_array[$i][0];
                                                            $item_qty = $unserialized_array[$i][1];
                                                            $unit_rate = $unserialized_array[$i][2];
                                                            $gst_rate = $unserialized_array[$i][3];
                                                            $item_desc = $unserialized_array[$i][4];

                                                            $gst_amount = ($unit_rate * $item_qty) * ($gst_rate / 100);
                                                            $taxable_amount = $unit_rate * $item_qty;

                                                            $total_gst += $gst_amount;
                                                            $total_taxable += $taxable_amount;

                                                            $get_raw_id = "select * from raw_items where item_id='$item_id'";
                                                            $run_raw_id = mysqli_query($con, $get_raw_id);
                                                            $row_raw_id = mysqli_fetch_array($run_raw_id);
                                                            $raw_title = $row_raw_id['item_name'];
                                                            $raw_unit = $row_raw_id['item_unit'];


                                                            echo "
                                                            <tr>
                                                                <td class='text-bold-500'>$raw_title <br>
                                                                <small>($item_desc)</small>
                                                                </td>
                                                                <td>$item_qty $raw_unit</td>
                                                                <td>$unit_rate</td>
                                                                <td>$gst_rate</td>
                                                                <td>$gst_amount</td>
                                                                <td>$taxable_amount</td>
                                                            </tr>
                                                        ";
                                                        }

                                                        ?>
                                                        <tr>
                                                            <th colspan="4" class="text-right">Total</th>
                                                            <th><?php echo "$total_gst"; ?></th>
                                                            <th><?php echo "$total_taxable"; ?></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="sendpdf/resend_mail.php?mail_sent=<?php echo $row_purchase_entries['po_number']; ?>" type="button" class="btn btn-primary <?php if ($row_purchase_entries['po_delivery_status'] === 'shipped' || $row_purchase_entries['po_delivery_status'] === 'cancelled') {
                                                                                                                                                                            echo "d-none";
                                                                                                                                                                        } ?>" title="Resend Mail">
                                        <i class="mdi mdi-email-outline"></i>
                                    </a>
                                    <a href="ajaxphp/ajaxvendor.php?update_enquiry=<?php echo $row_purchase_entries['po_id']; ?>" type="button" class="btn btn-primary <?php if ($row_purchase_entries['po_delivery_status'] === 'shipped' || $row_purchase_entries['po_delivery_status'] === 'cancelled') {
                                                                                                                                                                            echo "d-none";
                                                                                                                                                                        } ?>" title="Update Shipped">
                                        <i class="mdi mdi-check"></i>
                                    </a>
                                    <a href="ajaxphp/ajaxvendor.php?delete_enquiry=<?php echo $row_purchase_entries['po_id']; ?>" type="button" class="btn btn-primary <?php if ($row_purchase_entries['po_delivery_status'] === 'shipped' || $row_purchase_entries['po_delivery_status'] === 'cancelled') {
                                                                                                                                                                            echo "d-none";
                                                                                                                                                                        } ?>" title="Cancel">
                                        <i class="mdi mdi-window-close"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>