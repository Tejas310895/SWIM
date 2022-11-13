<div class="result_alerts">

</div>
<div class="row">
    <div class="page-title col-md-10">
        <h3>New Work Order Entry</h3><br><br>
    </div>
    <div class="col-md-2">
        <a href="index.php?work_orders" class="btn btn-primary" style="float:right;">Work Order Entries</a>
    </div>
</div>
<form id="insert_work_order" method="post" action="">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Work Order Note</h5>
                </label>
                <input type="text" class="form-control" name="work_order_note" aria-describedby="" placeholder="Enter Note for the staff" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Work Order Date</h5>
                </label>
                <input type="date" class="form-control" name="work_order_date" aria-describedby="" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Grams/Meter</h5>
                </label>
                <input type="text" class="form-control" name="work_grams_mtr" aria-describedby="" placeholder="Grams/Meter" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Microns</h5>
                </label>
                <input type="text" class="form-control" name="work_microns" aria-describedby="" placeholder="Microns" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Paper tube</h5>
                </label>
                <input type="text" class="form-control" name="work_paper_tube" aria-describedby="" placeholder="Paper tube" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Inner box</h5>
                </label>
                <input type="text" class="form-control" name="work_inner_box" aria-describedby="" placeholder="Inner box" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>MRP</h5>
                </label>
                <input type="text" class="form-control" name="work_mrp" aria-describedby="" placeholder="M R P" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Total box</h5>
                </label>
                <input type="text" class="form-control" name="work_total_box" aria-describedby="" placeholder="Total box" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>
                    <h5>Customer</h5>
                </label>
                <input type="text" class="form-control" name="work_customer" aria-describedby="" placeholder="Customer" required>
            </div>
        </div>
    </div>




    <button type="submit" name="add_work_order" id="add_work_order" class="btn btn-lg btn-primary mx-5 mt-5 float-end">Submit</button>

</form>


<script src="js/script.js"></script>
<?php

if (isset($_POST['add_work_order'])) {

    $work_order_note = $_POST['work_order_note'];
    $work_order_date = $_POST['work_order_date'];
    $work_grams_mtr = $_POST['work_grams_mtr'];
    $work_microns = $_POST['work_microns'];
    $work_paper_tube = $_POST['work_paper_tube'];
    $work_inner_box = $_POST['work_inner_box'];
    $work_mrp = $_POST['work_mrp'];
    $work_total_box = $_POST['work_total_box'];
    $work_customer = $_POST['work_customer'];


    date_default_timezone_set('Asia/Kolkata');
    $today = date("Y-m-d H:i:s");

    $get_last_id = "SELECT * from work_order_task order by work_order_entry_id desc limit 1";
    $run_last_id = mysqli_query($con, $get_last_id);
    $row_last_id = mysqli_fetch_array($run_last_id);

    $last_id = $row_last_id['work_order_entry_id'];

    $ref_no = rand();

    $work_order_ref_no = $ref_no . $last_id;

    $get_check_ref = "select * from work_order_task where work_order_ref_no='$work_order_ref_no'";
    $run_check_ref = mysqli_query($con, $get_check_ref);
    $count_ref = mysqli_num_rows($run_check_ref);

    if ($count_ref < 1) {

        $enquiry_product = array($work_grams_mtr, $work_microns, $work_paper_tube, $work_inner_box, $work_mrp, $work_total_box, $work_customer);

        $serialized_array = serialize($enquiry_product);

        $insert_work_order = "INSERT into work_order_task (work_order_ref_no,
                                                    work_order_status,
                                                    work_order_pro_det,
                                                    work_order_date,
                                                    work_order_note,
                                                    work_order_task_created_at,
                                                    work_order_task_updated_at) 
                                                    values 
                                                    ('$work_order_ref_no',
                                                    'active',
                                                    '$serialized_array',
                                                    '$work_order_date',
                                                    '$work_order_note',
                                                    '$today',
                                                    '$today')";
        $run_work_order = mysqli_query($con, $insert_work_order);

        if ($run_work_order) {
            echo "<script>alert('Done')</script>";
            echo "<script>window.open('index.php?work_orders','_self')</script>";
        } else {
            echo "<script>alert('Failed, Try again $work_order_ref_no')</script>";
            echo "<script>window.open('index.php?work_orders','_self')</script>";
        }
    } else {
        echo "<script>alert('Same Ref No., Please try again')</script>";
    }
}


?>

<script src="jquery/dist/jquery.min.js"></script>
<script src="js/ready_stock.js"></script>