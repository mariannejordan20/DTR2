<?php include 'connection.php';
session_start();
if(!isset($_SESSION["username"])) {
  header("location: AdminPortal.php");
}
?>
<html> 
<head> 
<!-- CSS only --> 
<link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
<link href="myStyles/CSS/adminDashboard.css" rel="stylesheet" type="text/css"> 
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="myStyles/CSS/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<!-- alert plugin sweetalert2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<title>Admin_Page</title>
</head> 
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content"> 
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>  
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-700 small "><h5><i class="fas fa-user"></i>  <?php echo ''.$_SESSION["username"].'';?></h5></span> 
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown"> 
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li> 
                    </ul> 
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> 
                    </div> 
                    <!-- Content Row -->
                    <div class="row"> 
                        <!-- Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow-lg h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Mandaue Employees</div>
                                            <div class="h1 ml-1 font-weight-bold text-gray-800">
                                            <?php
                                                $query = "SELECT ID FROM `employee_information` WHERE `Employee_Department`= 'Malanday'";
                                                $Malanday = mysqli_query($conn, $query);

                                                $rowMalanday = mysqli_num_rows($Malanday);

                                                echo "<h2>$rowMalanday</h2>" 
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-600 mt-3"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow-lg h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sto. Niño Employees</div>
                                            <div class="h1 ml-1 font-weight-bold text-gray-800">
                                            <?php
                                                $query = "SELECT ID FROM `employee_information` WHERE `Employee_Department`= 'Sto. Niño'";
                                                $Sto_Niño = mysqli_query($conn, $query);

                                                $rowSto_Niño = mysqli_num_rows($Sto_Niño);

                                                echo "<h2>$rowSto_Niño</h2>" 
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-600 mt-3"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow-lg h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ibabao Employees</div>
                                            <div class="h1 ml-1 font-weight-bold text-gray-800">
                                                <?php
                                                    $query = "SELECT ID FROM `employee_information` WHERE `Employee_Department`= 'Tumana'";
                                                    $Tumana = mysqli_query($conn, $query);

                                                    $rowTumana = mysqli_num_rows($Tumana);

                                                    echo "<h2>$rowTumana</h2>" 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-600 mt-3"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow-lg h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Accounts</div>
                                            <div class="h1 ml-1 font-weight-bold text-gray-800">
                                                <?php
                                                    $query = "SELECT ID FROM `employee_information`";
                                                    $total = mysqli_query($conn, $query);

                                                    $rowTotal = mysqli_num_rows($total);

                                                    echo "<h2>$rowTotal</h2>" 
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-600 mt-3"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Company 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
 
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">Are you sure you want to "Logout"?<br> Select "Logout" below if you want to logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-dismiss="modal"><i class="far fa-times-circle"></i>  Cancel</button>
                    <a class="btn btn-danger" href="logout.php"><i class="far fa-check-circle"></i>  Logout</a>
                </div>
            </div>
        </div>
    </div>   
    <!-- start of page loader -->
    <div class="loader-wrapper">
    <h2 id="description">
	    Loading...
    </h2>
    <div id="loadingIndicator">
        <div class="loadingBar" id="loadingBar1"></div>
        <div class="loadingBar" id="loadingBar2"></div>
        <div class="loadingBar" id="loadingBar3"></div>
        <div class="loadingBar" id="loadingBar4"></div> 
    </div>
    </div>
    <!-- end of page loader -->
    <script src="myStyles/JS/loader.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="myStyles/JS/jquery.min.js"></script>
    <script src="myStyles/JS/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="myStyles/JS/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="myStyles/JS/sb-admin-2.min.js"></script>

    <!-- jqeury for page laoder -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" 2
    integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" 3
    crossorigin="anonymous"></script>
  <script src="dist/js/jquery.preloadinator.min.js"></script>

    <!-- Page level plugins -->
    <script src="myStyles/JS/Chart.min.js"></script>
    <script src="myStyles/JS/all.min.js"></script>
    
</body>
</html>