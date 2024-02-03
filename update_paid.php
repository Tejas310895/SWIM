<div class="col-12" id="customer_alerts">

</div>
<div class="row">
    <div class="col-12 grid-margin px-0">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter the Payment details</h4>
                <form action="ajaxphp/ajaxinvoice.php" method="post">
                    <input type="hidden" name="invoice_id" value="<?php echo $_GET['update_paid']; ?>">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Payment Date</label>
                                <input type="date" class="form-control" name="pay_date" id="" aria-describedby="helpId" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Payment Type</label>
                                <select class="form-control" name="pay_type" id="" required>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" class="form-control" name="pay_amt" id="" aria-describedby="helpId" placeholder="Enter amount" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="pay_submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="js/invoice.js"></script>