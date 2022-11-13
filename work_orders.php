<div class="row">
    <div class="page-title col-md-10">
        <h3>Work Order Entries</h3>
        <p class="text-subtitle text-muted">Below are the details of work order entries</p>
    </div>
    <div class="col-md-2">
        <a href="index.php?new_work_order" class="btn btn-primary" style="float:right;">New Work Order Entry</a>
    </div>
</div>
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
                                <a href="ajaxphp/ajaxhelper.php?work_order_delete=<?php echo $row_work_orders['work_order_entry_id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>