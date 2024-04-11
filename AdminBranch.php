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
                <h1 class="h3 text-gray-800">List of Branches</h1>

                <!-- Content Row -->
                <div class="row pl-1 pr-1">
                    <div class="col col-lg-12">
                        <div class="d-flex">
                            <button type="button" class="btn mt-3 mb-3" style="background-color: #45d43d; color: white;"
                                    data-toggle="modal" data-target="#addBranchModal">
                                <i class="ml-1 fas fa-fw fa-plus"></i> Add Branch
                            </button>
                        </div>
                        <table id="adminTable" class="table table-success shadow-lg hover" style="width:100%; border:none">
                            <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="color: black">
                            <?php
                            $sql = "SELECT `ID`, `branch` FROM `branches`";
                            $result = $conn -> query($sql);

                            $count = 1; // Initialize count variable

                            if($result-> num_rows > 0) {
                                while ($row = $result -> fetch_assoc()) {
                                    echo "<tr>
                                            <td>".$count."</td>
                                            <td>".$row["branch"]."</td>
                                            <td>
                                                <button type=\"button\" class=\"btn btn-primary btn-sm edit-branch-btn\" data-toggle=\"modal\" data-target=\"#editBranchModal\" data-branch-id=\"".$row["ID"]."\" data-branch-name=\"".$row["branch"]."\">
                                                <i class='fas fa-pen'></i>
                                                </button>
                                                <button type=\"button\" class=\"btn btn-danger btn-sm delete-branch-btn\" data-toggle=\"modal\" data-target=\"#deleteBranchModal\" data-branch-id=\"".$row["ID"]."\">
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

        <!-- Add New Branch Modal -->
        <div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#4dd145; color:white">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="branchaddsave.php" method="post"> <!-- Move the form tag here -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="branch_name">Branch Name:</label>
                                <input type="text" name="branch_name" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" style="background-color: #2ca125; color:white">Save</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form> <!-- Move the form tag here -->
                </div>
            </div>
        </div>

        <!-- End Add New Branch Modal -->

        <!-- Edit Branch Modal -->
        <div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #007bff; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Branch</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editBranchForm" action="brancheditsave.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_branch_name">Branch Name:</label>
                                <input type="text" name="edit_branch_name" id="edit_branch_name" class="form-control" required>
                                <input type="hidden" name="edit_branch_id" id="edit_branch_id">
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
        <!-- End of Edit Branch Modal -->

        <!-- Delete Branch Modal -->
        <div class="modal fade" id="deleteBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Branch</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this branch?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger confirm-delete-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Delete Branch Modal -->

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
        $('.edit-branch-btn').click(function() {
            var branchId = $(this).data('branch-id');
            var branchName = $(this).data('branch-name');

            $('#edit_branch_id').val(branchId);
            $('#edit_branch_name').val(branchName);
        });

        $('.delete-branch-btn').click(function() {
            var branchId = $(this).data('branch-id');
            $('#deleteBranchModal').find('.confirm-delete-btn').data('branch-id', branchId);
        });

        $('.confirm-delete-btn').click(function() {
            var branchId = $(this).data('branch-id');
            // AJAX request to delete the branch
            $.ajax({
                url: 'branchdelete.php',
                type: 'POST',
                data: {branchId: branchId},
                success: function(response) {
                    // Handle success, like updating the table
                    $('#deleteBranchModal').modal('hide');
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
