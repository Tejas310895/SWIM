<?php

session_start();

if (!isset($_SESSION['admin_user'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {

  include("includes/header.php");
  include("includes/db.php");

?>
  <div class="container-scroller">
    <?php

    include("includes/sidebar.php");

    ?>
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a> -->
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="assets/images/face.jpeg" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">Silver Wrap</p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0 text-center">Profile</h6>
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="logout.php">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php

          if (isset($_GET['dashboard'])) {

            include("dashboard.php");
          }

          if (isset($_GET['view_vendor'])) {

            include("view_vendor.php");
          }

          if (isset($_GET['create_vendor'])) {

            include("create_vendor.php");
          }

          if (isset($_GET['edit_vendor'])) {

            include("edit_vendor.php");
          }

          if (isset($_GET['create_rawstock'])) {

            include("create_rawstock.php");
          }

          if (isset($_GET['view_rawstock'])) {

            include("view_rawstock.php");
          }

          if (isset($_GET['edit_rawstock'])) {

            include("edit_rawstock.php");
          }

          if (isset($_GET['view_rawentry'])) {

            include("view_rawentry.php");
          }

          if (isset($_GET['create_rawentry'])) {

            include("create_rawentry.php");
          }

          if (isset($_GET['view_poentry'])) {

            include("view_poentry.php");
          }

          if (isset($_GET['new_po_order'])) {

            include("new_po_order.php");
          }

          if (isset($_GET['view_product'])) {

            include("view_product.php");
          }

          if (isset($_GET['create_product'])) {

            include("create_product.php");
          }

          if (isset($_GET['view_carton'])) {

            include("view_carton.php");
          }

          if (isset($_GET['create_carton'])) {

            include("create_carton.php");
          }


          if (isset($_GET['edit_carton'])) {

            include("edit_carton.php");
          }

          if (isset($_GET['view_manufacturing'])) {

            include("view_manufacturing.php");
          }

          if (isset($_GET['product_manufacturing'])) {

            include("product_manufacturing.php");
          }

          if (isset($_GET['product_stock'])) {

            include("product_stock.php");
          }

          if (isset($_GET['generate_invoice'])) {

            include("generate_invoice.php");
          }

          if (isset($_GET['invoice_entries'])) {

            include("invoice_entries.php");
          }

          if (isset($_GET['view_partner'])) {

            include("view_partner.php");
          }

          if (isset($_GET['create_partner'])) {

            include("create_partner.php");
          }

          if (isset($_GET['edit_partner'])) {

            include("edit_partner.php");
          }

          if (isset($_GET['view_customer'])) {

            include("view_customer.php");
          }

          if (isset($_GET['create_customer'])) {

            include("create_customer.php");
          }

          if (isset($_GET['edit_customer'])) {

            include("edit_customer.php");
          }

          if (isset($_GET['invoice_bulk_entries'])) {

            include("invoice_bulk_entries.php");
          }

          if (isset($_GET['view_rawexchange'])) {

            include("view_rawexchange.php");
          }

          if (isset($_GET['create_rawexchange'])) {

            include("create_rawexchange.php");
          }

          if (isset($_GET['work_orders'])) {

            include("work_orders.php");
          }

          if (isset($_GET['new_work_order'])) {

            include("new_work_order.php");
          }

          if (isset($_GET['purchase_filing'])) {

            include("purchase_filing.php");
          }

          if (isset($_GET['new_purchase_filing'])) {

            include("new_purchase_filing.php");
          }

          ?>
          <!-- content-wrapper ends -->
          <?php

          include("includes/footer.php");

          ?>
        <?php } ?>