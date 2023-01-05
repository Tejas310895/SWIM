<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo"><img src="assets/images/logo.png" alt="logo" /></a>
    <!-- <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a> -->
  </div>
  <ul class="nav position-fixed mt-2">
    <li class="nav-item menu-items">
      <a class="nav-link" href="index.php?dashboard">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-raw" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-cube-send"></i>
        </span>
        <span class="menu-title">PURCHASE</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-raw">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?view_vendor">ADD SUPPLIER</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_rawstock">ADD NEW RAW PRODUCT</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_rawentry">ADD PURCHASE</a></li>
          <li class="nav-item <?php if ($_SESSION['admin_user'] === "shirsatbp@gmail.com") {
                                echo "show";
                              } else {
                                echo "d-none";
                              } ?>"> <a class="nav-link" href="index.php?purchase_filing">PURCHASE FILLING</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_poentry">GENERATE PO</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_rawexchange">EXCHANGE</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-cart"></i>
        </span>
        <span class="menu-title">READY STOCK</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-product">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?work_orders">WORK ORDER</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_product">BUILD NEW PRODUCT</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_carton">ADD PACK SIZE</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_manufacturing">TODAY READY STOCK</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?product_stock">READY STOCK IN FACTORY</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-invoice" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-printer"></i>
        </span>
        <span class="menu-title">INVOICE</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-invoice">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?view_customer">ADD CUSTOMER</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?view_partner">ADD COMPANY</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?generate_invoice">GENERATE INVOCE</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?invoice_entries">INVOICE ENTRIES</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?invoice_bulk_entries">INVOICE BULK ENTRIES</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
<!-- partial -->