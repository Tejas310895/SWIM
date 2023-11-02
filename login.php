<?php 

session_start();
include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Silver Wrap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="jquery/dist/jquery.min.js"></script>
    <style>
        *{
            background-image: url("images/background.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-card {
            width: 500px;
            height: 500px;
            
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            
            margin: auto;
        }
        #myVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mt-5 login-card">
                <div class="card p-5">
                    <div class="card-head">
                        <h5 class="text-center">LOGIN HERE</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="email" class="form-control" name="admin_user" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="admin_pass" placeholder="Password">
                            </div>
                            <button type="submit" name="admin_login" class="btn btn-primary btn-lg btn-block">LOG IN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php 

    if(isset($_POST['admin_login'])){

        $admin_user = mysqli_real_escape_string($con,$_POST['admin_user']);

        $admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

        $get_admin = "select * from admin where admin_username='$admin_user' AND admin_password='$admin_pass'";

        $run_admin = mysqli_query($con,$get_admin);

        $count = mysqli_num_rows($run_admin);

        if($count==1){

            $_SESSION['admin_user']=$admin_user;

            echo "<script>alert('Logged in. Welcome to SWAF')</script>";

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        }else{

            echo "<script>alert('Username or Password is Worng')</script>"; 

        }

    }

?>