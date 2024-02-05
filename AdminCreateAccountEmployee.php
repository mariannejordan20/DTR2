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
                                        <form action="createEmployeeAddSave.php" method="post">
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
                                                        <option value="" selected disabled>Select Department</option>
                                                        <?php
                                                                $sqlDepartments = "SELECT ID, Department FROM departments";
                                                                $resultDepartments = $conn->query($sqlDepartments);

                                                                if ($resultDepartments->num_rows > 0) {
                                                                    while ($rowDepartments = $resultDepartments->fetch_assoc()) {
                                                                        echo '<option value="' . $rowDepartments['Department'] . '">' . $rowDepartments['Department'] . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="" disabled>No Departments available</option>';
                                                                }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Branch (Select)</div>
                                                    <div class="h2 mb-3 pl-1">
                                                        <select class="form-control" id="employeeBranch" name="employeeBranch" aria-label="Default select example" required>  
                                                            <option value="" selected disabled style="color:white;">Select Branch</option>
                                                            <?php
                                                                $sqlBranch = "SELECT ID, Branch FROM branches";
                                                                $resultBranch = $conn->query($sqlBranch);

                                                                if ($resultBranch->num_rows > 0) {
                                                                    while ($rowBranch = $resultBranch->fetch_assoc()) {
                                                                        echo '<option value="' . $rowBranch['Branch'] . '">' . $rowBranch['Branch'] . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="" disabled>No Branch available</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Position (Select)</div>
                                                <div class="h2 mb-3 pl-1">
                                                    <select class="form-control" id="employeePosition" name="employeePosition" aria-label="Default select example" required> 
                                                        <option value="" selected disable>Select Position</option> 
                                                        <option value="Staff">Staff</option>
                                                        <option value="Driver">Driver</option>
                                                        <option value="Intern">Intern</option> 
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
                                                <button type="submit" class="col-lg-12 mt-2 btn btn-success">Create Account</button>
                                                <!-- <button type="submit" class="btn" style="background-color: #2ca125; color:white">Save</button> -->
                                            </div>
                                        </form>
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
    <script>
    <?php
    if (isset($_SESSION['status'])) {
        echo "Swal.fire({
                            icon: '" . ($_SESSION['status_code'] == 'success' ? 'success' : 'error') . "',
                            title: '" . $_SESSION['status'] . "',
                            showConfirmButton: false,
                            timer: 1000
                        });";
        unset($_SESSION['status']); // Clear the session variable
        unset($_SESSION['status_code']); // Clear the session variable
    }
    ?>
</script>
    <!-- end of page loader -->
    <script src="myStyles/JS/loader.js"></script>
    
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