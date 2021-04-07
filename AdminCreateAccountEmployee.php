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
<link href="myStyles/CSS/AdminPage.css" rel="stylesheet" type="text/css">
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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="AdminDashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Company</div>
            </a> 
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="AdminDashboard.php">
                    <i class="ml-1 fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <h6>User Settings</h6>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCreate"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-plus"></i>
                    <span>Create Account</span>
                </a>
                <div id="collapseCreate" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item active" href="AdminCreateAccountEmployee.php"><i class="fas fa-fw fa-user"></i> Employee Accounts</a> 
                        <a class="collapse-item" href="AdminCreateAccountAdmin.php"><i class="fas fa-fw fa-user"></i> Admin Accounts</a>  
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li>  
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounts"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-user"></i>
                    <span>Account Lists</span>
                </a>
                <div id="collapseAccounts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                    <a class="collapse-item" href="AdminDashboardEmployeeAccounts.php"><i class="fas fa-fw fa-user"></i> Employee Accounts</a> 
                        <a class="collapse-item" href="AdminDashboardAdminAccounts.php"><i class="fas fa-fw fa-user"></i> Admin Accounts</a>   
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li> 
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <h6>Generate</h6>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="ml-1 fas fa-fw fa-folder"></i>
                    <span>Reports</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> 
                        <a class="collapse-item" href="AdminReportsDaily.php"><i class="fas fa-fw fa-list"></i> Daily Logs</a> 
                        <div class="collapse-divider"></div> 
                    </div>
                </div>
            </li> 
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
  
        </ul>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><h5><i class="fas fa-user"></i>  <?php echo ''.$_SESSION["username"].'';?></h5></span> 
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown"> 
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="h3 mb-0 text-gray-800">Add Employee Account</h1> 
                    </div> 
                    <!-- Content Row --> 
                    <div class="row was-validated"> 
                        <div class="col">
                            <div class="card shadow-lg h-100% py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">  
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Number</div>
                                            <!-- m mean margin, p mean padding, l is left, r is right, t is top, b is bottom -->
                                            <div class="h2 mb-3 pl-1">
                                            <input type="text" id="userType" name="userType" class="form-control is-valid" value="employee" required hidden>
                                                <input type="number" id="employeeNumber" name="employeeNumber" class="form-control is-valid" placeholder="Type Employee Number" required>
                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Fullname</div>
                                            <div class="h2 mb-3 pl-1">
                                                <input type="text" id="employeeFullName" name="employeeFullName" class="form-control" placeholder="Type Employee Fullname" required>
                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Department (Select)</div>
                                                <div class="h2 mb-3 pl-1">
                                                <select class="form-control" id="employeeDepartment" name="employeeDepartment" aria-label="Default select example" required>  
                                                    <option value="" selected disable>Select Department</option>
                                                    <option value="Malanday">Malanday</option>
                                                    <option value="Sto. Niño">Sto. Niño</option>
                                                    <option value="Tumana">Tumana</option> 
                                                </select>
                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Position (Select)</div>
                                            <div class="h2 mb-3 pl-1">
                                            <select class="form-control" id="employeePosition" name="employeePosition" aria-label="Default select example" required> 
                                                <option value="" selected disable>Select Position</option> 
                                                <option value="Staff">Staff</option>
                                                <option value="Driver">Driver</option> 
                                            </select>
                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Sex (Select)</div>
                                            <div class="h2 mb-3 pl-1">
                                            <select class="form-control" id="employeeSex" name="employeeSex" aria-label="Default select example" required>
                                                <option value="" selected disable>Select Sex</option> 
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option> 
                                            </select>
                                            </div>  
                                            <!-- <input type="submit" id="submitNewAccount" name="submitNewAccount" class="col-lg-12 mt-2 btn btn-success" value="Create Account">  -->
                                            <button type="button" id="submitNewAccount" name="submitNewAccount" class="col-lg-12 mt-2 btn btn-success">Create Account</button> 
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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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
    <script src="myStyles/JS/adminCreateAccountEmployeeJS.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="myStyles/JS/jquery.min.js"></script>
    <script src="myStyles/JS/bootstrap.bundle.min.js"></script>  
    <!-- Core plugin JavaScript-->
    <script src="myStyles/JS/jquery.easing.min.js"></script> 
    <!-- Custom scripts for all pages-->
    <script src="myStyles/JS/sb-admin-2.min.js"></script> 
    <!-- Page level plugins -->
    <script src="myStyles/JS/Chart.min.js"></script>
    <script src="myStyles/JS/all.min.js"></script> 
    <!-- jqeury for page laoder -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" 2
    integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" 3
    crossorigin="anonymous"></script>
  <script src="dist/js/jquery.preloadinator.min.js"></script>
</body>
</html>