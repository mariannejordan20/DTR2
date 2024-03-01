<?php
include 'connection.php';
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
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- jquery and datatable plugin -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- alert plugin sweetalert2 -->
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
                <h1 class="h3 text-gray-800">This is trial adminreportsdaily</h1>

                <!-- Content Row -->
                <div class="row pl-1 pr-1">
                    <div class="col col-lg-12">
                        <table id="" class="table table shadow-lg hover" style="width:100%; border:none">
                            <thead class="text-center">
                            <tr>
                                <th class="font-weight-bold">NO.</th>
                                <th class="font-weight-bold">ID</th>
                                <th class="font-weight-bold">NAME</th>
                                <th class="font-weight-bold">DATE</th>
                                <th class="font-weight-bold">TIMEIN (Am)</th>
                                <th class="font-weight-bold">TIMEOUT (Am)</th>
                                <th class="font-weight-bold">TIMEIN (Pm)</th>
                                <th class="font-weight-bold">TIMEOUT (Pm)</th>
                                <th class="font-weight-bold">TOTAL</th>
                                <th class="font-weight-bold">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="color: black">
                            <?php
                            $sql = "SELECT logs.id, logs.Employee_ID, logs.DateLog,
                            logs.TimeLog1, logs.TimeLog2, logs.TimeLog3, logs.TimeLog4,
                            employee_information.Employee_FullName, employee_information.Employee_Department, employee_information.Employee_Position,
                            employee_information.Employee_Sex, employee_information.user_type, employee_information.Employee_Branch,
                            TIME_FORMAT(
                                SEC_TO_TIME(
                                    TIME_TO_SEC(TIMEDIFF(logs.TimeLog2, logs.TimeLog1)) +
                                    TIME_TO_SEC(TIMEDIFF(logs.TimeLog4, logs.TimeLog3))
                                ), '%H:%i') AS TotalDuration
                            FROM logs
                            INNER JOIN employee_information ON logs.Employee_ID = employee_information.Employee_ID
                            ORDER BY logs.DateLog DESC";
                            $result = $conn -> query($sql);

                            $count = 1; // Initialize count variable

                            if($result-> num_rows > 0) {
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<tr>
                                            <td>".$count."</td>
                                            <td>".$row["Employee_ID"]."</td>
                                            <td>".$row["Employee_FullName"]."</td>
                                            <td>".$row["DateLog"]."</td>
                                            <td>".$row["TimeLog1"]."</td>
                                            <td>".$row["TimeLog2"]."</td>
                                            <td>".$row["TimeLog3"]."</td>
                                            <td>".$row["TimeLog4"]."</td>
                                            <td>".$row["TotalDuration"]." hrs</td>
                                            <td>
                                                <button type=\"button\" class=\"btn btn-primary btn-sm edit-ip-btn\" data-toggle=\"modal\" data-target=\"#editIpModal\" 
                                                    data-id=\"".$row["id"]."\" 
                                                    data-log1=\"".$row["TimeLog1"]."\" 
                                                    data-log2=\"".$row["TimeLog2"]."\" 
                                                    data-log3=\"".$row["TimeLog3"]."\"
                                                    data-log4=\"".$row["TimeLog4"]."\">
                                                <i class='fas fa-pen'></i>
                                                </button>
                                                <button type=\"button\" class=\"btn btn-danger btn-sm delete-Ip-btn\" data-toggle=\"modal\" data-target=\"#deleteIpModal\" data-id=\"".$row["id"]."\">
                                                <i class='fas fa-trash'></i>
                                                </button>
                                            </td>
                                        </tr>";
                                    $count++; // Increment count for next row
                                }
                                echo "</table>";
                            } else {
                                echo "0 result";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- End of Main Content -->



        <!-- Edit Ip Modal -->
        <div class="modal fade" id="editIpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #007bff; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit employee logs!</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editIpForm" action="reportedit.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_ip_name">TIMEIN (Am):</label>
                                <input type="text" name="edit_employee_log1" id="edit_employee_log1" class="form-control" >
                                <label for="edit_ip_name">TIMEOUT (Am):</label>
                                <input type="text" name="edit_employee_log2" id="edit_employee_log2" class="form-control" >
                                <label for="edit_ip_name">TIMEIN (Pm):</label>
                                <input type="text" name="edit_employee_log3" id="edit_employee_log3" class="form-control" >
                                <label for="edit_ip_name">TIMEOUT (Pm):</label>
                                <input type="text" name="edit_employee_log4" id="edit_employee_log4" class="form-control" >
                                <input type="hidden" name="edit_employee_Id" id="edit_employee_Id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Edit Ip Modal -->

        <!-- Delete Ip Modal -->
        <div class="modal fade" id="deleteIpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Delete IP</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Log report?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger confirm-delete-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Ip Modal -->

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
<!-- End of Logout Modal -->

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
<!-- Bootstrap 5 plugin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<!-- jquery and datatable plugin -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="myStyles/JS/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="myStyles/JS/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="myStyles/JS/sb-admin-2.min.js"></script>


<script src="myStyles/JS/adminlistJS.js"></script>
<script src="myStyles/JS/loader.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-ip-btn').click(function() {
            var employeeId = $(this).data('id');
            var employeelog1 = $(this).data('log1');
            var employeelog2 = $(this).data('log2');
            var employeelog3 = $(this).data('log3');
            var employeelog4 = $(this).data('log4');


            $('#edit_employee_Id').val(employeeId);
            $('#edit_employee_log1').val(employeelog1);
            $('#edit_employee_log2').val(employeelog2);
            $('#edit_employee_log3').val(employeelog3);
            $('#edit_employee_log4').val(employeelog4);
        });

        $('.delete-Ip-btn').click(function() {
        var employeeId = $(this).data('id');
        $('#deleteIpModal').find('.confirm-delete-btn').data('id', employeeId);
    });

    $('.confirm-delete-btn').click(function() {
        var employeeId = $(this).data('id');
        // AJAX request to delete the log
        $.ajax({
            url: 'AdminReportsDelete.php',
            type: 'POST',
            data: { edit_employee_Id: employeeId }, // Correct variable name
            success: function(response) {
                // Handle success, like updating the table
                $('#deleteIpModal').modal('hide');
                // You might want to reload the table or remove the deleted row
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
</body>
</html>
