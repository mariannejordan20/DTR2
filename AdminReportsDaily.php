<?php include 'connection.php';
session_start();
if(!isset($_SESSION["username"])) {
  header("location: AdminPortal.php");
}
?>
<html>  
<head>   
<!-- plugin css -->
<link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
<link href="myStyles/CSS/AdminPage.css" rel="stylesheet" type="text/css"> 
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">   
<!-- CSS only --> 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
<!-- Ajax  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<!-- jquery and datatable plugin -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
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
                    <h1 class="h3 text-gray-800 mb-4">Daily Logs Lists</h1> 
                    <!-- Content Row -->
                    <div>
        <a href="report.php" class="btn btn-primary">Print All</a>
    </div>
    <div class="row pl-1 pr-1">
        <div class="col col-lg-12">
            <!-- Search Bar -->
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Employee ID">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="searchTable()">Search</button>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-striped table-bordered" id="myTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="font-weight-bold">NO.</th>
                        <th class="font-weight-bold">EMPLOYEE ID</th>
                        <th class="font-weight-bold">DATE</th>
                        <th class="font-weight-bold">TIME</th>
                        <th class="font-weight-bold">STATUS</th>
                        <th class="font-weight-bold">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "connection.php"; // Include your database connection file

                    $get_log_details = mysqli_query($conn, "SELECT * FROM employee_log");

                    $counter = 1;

                    while ($row = mysqli_fetch_array($get_log_details)) {
                        ?>
                        <tr>
                            <td class="text-gray-700"><?php echo $counter ?></td>
                            <td class="text-gray-900"><?php echo $row['Employee_ID'] ?></td>
                            <td class="text-gray-700"><?php echo $row['Employee_Date'] ?></td>
                            <td class="text-gray-700"><?php echo $row['Employee_Time'] ?></td>
                            <td class="text-gray-700"><?php echo $row['Employee_Status'] ?></td>
                            <td>
                                <a href="report.php?search=<?php echo $row['Employee_ID']; ?>" class="btn btn-primary btn-sm">Print</a>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 corresponds to the EMPLOYEE ID column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

                </div>
                <!-- /.container-fluid --> 
            </div>
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Employee Information</h5>
                    <button type="button" class="fas fa-lg fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row was-validated"> 
                        <div class="col">
                        <div class="card shadow-lg h-100% py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">  
                                        <input type="text" id="userType" name="userType" class="form-control is-valid" value="admin" hidden required>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin Username</div> 
                                            <div class="h2 mb-3 pl-1">
                                                <input type="text" id="AdminUser" name="AdminUser" class="form-control is-valid" placeholder="Type Admin Username" required readonly>
                                            </div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin Password</div>
                                            <div class="h2 mb-3 pl-1">
                                                <input type="text" id="AdminPassword" name="AdminPassword" class="form-control" placeholder="Type Admin Password" required> 
                                            </div> 
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin Fullname</div>
                                            <div class="h2 mb-3 pl-1">
                                                <input type="text" id="AdminFullname" name="AdminFullname" class="form-control" placeholder="Type Admin Fullname" required>
                                            </div>
                                            <button type="button" id="submitEditAccount" name="submitEditAccount" class="col-lg-12 mt-2 btn btn-success">Update Account</button> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div> 
                </div> 
            </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">Delete Employee Information</h5>
                    <button type="button" class="fas fa-lg fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
      <div class="modal-body">
        <input type="text" id="EmployeeDelete_ID" name="EmployeeDelete_ID" hidden> 
        <p class="text-center"><b>Are you sure you want to delete this data?</b></p>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-danger" id="deleteEmployeeButton">Delete</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
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
    <!-- Bootstrap 5 plugin -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <!-- jquery and datatable plugin -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <!-- Bootstrap core JavaScript--> 
    <script src="myStyles/JS/bootstrap.bundle.min.js"></script> 
    <!-- Core plugin JavaScript-->
    <script src="myStyles/JS/jquery.easing.min.js"></script> 
    <!-- Custom scripts for all pages-->
    <script src="myStyles/JS/sb-admin-2.min.js"></script> 
    <script src="myStyles/JS/dailyLogs.js"></script> 
    <script src="myStyles/JS/loader.js"></script>
    </body>  
</html>