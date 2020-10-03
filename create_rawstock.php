
<?php 

if(!isset($_SESSION['admin_user'])){

    echo "<script>window.open('login.php','_self')</script>";

}else{
  ?>
<div class="col-12" id="raw_alerts">

</div>
<div class="row p-3 mb-3" style="background-color:#191c24;border-radius:5px;">
    <div class="col-6">
        <h4 class="py-2">Create New Item</h4>
    </div>
    <div class="col-6">
        <a class="btn btn-success float-right" href="index.php?view_rawstock">Go Back</a>
    </div>
</div>
<div class="row">
        <div class="col-12 grid-margin px-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enter the Item details</h4>
                    <form class="form-sample" id="insert_raw" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_name" id="item_name" required/>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item Type</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="item_type" id="item_type" required/>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Measuring Unit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="item_unit" id="item_unit" required/>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Cost Per Unit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="unit_cost" id="unit_cost" required/>
                                    </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">GST Rate</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="gst_rate" id="gst_rate" required/>
                                    </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                 <button type="submit" id="add_raw" class="btn btn-primary mr-2 btn-lg float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/dist/jquery.min.js"></script>
    <script src="js/vendor.js"></script>
                                    <?php } ?>
