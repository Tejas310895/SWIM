<?php

if (!isset($_SESSION['admin_user'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <div class="row p-3" style="background-color:#191c24;border-radius:5px;">
        <div class="col-6">
            <h4 class="py-2">Entries Of Invoices</h4>
        </div>
        <div class="col-6">
            <a class="btn btn-success float-right" href="index.php?generate_invoice">Generate New Invoice</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 grid-margin stretch-card px-0">
            <div class="card">
                <div class="card-body">
                    </p>
                    <div class="table-responsive">
                        <table id="invoice" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js'></script>
    <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' defer></script>
    <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap.js' defer></script>
    <script src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.js' defer></script>
    <script src='js/datatable.js'></script>
<?php } ?>