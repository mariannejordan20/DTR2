<?php
include 'connection.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("location: AdminPortal.php");
    exit();
}

// Check if the reset form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $entered_password = $_POST['password'];

    // Fetch the admin password from the database using the username from the session
    $sql = "SELECT password FROM admin_accounts WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminPassword = $row['password'];

        if ($entered_password == $adminPassword) {
            // Establish a new connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to truncate the table
            $sql = "TRUNCATE TABLE logs";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page to avoid form resubmission
                header("Location: reset.php");
                exit();
            } else {
                $_SESSION['status'] = 'Error executing query: ' . $conn->error;
                $_SESSION['status_code'] = 'error';
            }

            // Close the connection
            $conn->close();
        } else {
            $_SESSION['status'] = 'Incorrect password';
            $_SESSION['status_code'] = 'error';
        }
    } else {
        $_SESSION['status'] = 'Error fetching password from the database';
        $_SESSION['status_code'] = 'error';
    }
}
// Check if the reset form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_admin_accounts'])) {
    $entered_password = $_POST['password'];

    // Fetch the admin password from the database using the username from the session
    $sql = "SELECT password FROM admin_accounts WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminPassword = $row['password'];

        if ($entered_password == $adminPassword) {
            // Establish a new connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to truncate the table
            $sql = "DELETE FROM admin_accounts WHERE username <> 'admin'";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page to avoid form resubmission
                header("Location: reset.php");
                exit();
            } else {
                $_SESSION['status'] = 'Error executing query: ' . $conn->error;
                $_SESSION['status_code'] = 'error';
            }

            // Close the connection
            $conn->close();
        } else {
            $_SESSION['status'] = 'Incorrect password';
            $_SESSION['status_code'] = 'error';
        }
    } else {
        $_SESSION['status'] = 'Error fetching password from the database';
        $_SESSION['status_code'] = 'error';
    }
}
// Check if the reset form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_employee_accounts'])) {
    $entered_password = $_POST['password'];

    // Fetch the admin password from the database using the username from the session
    $sql = "SELECT password FROM admin_accounts WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $adminPassword = $row['password'];

        if ($entered_password == $adminPassword) {
            // Establish a new connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to truncate the table
            $sql = "TRUNCATE TABLE employee_information";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page to avoid form resubmission
                header("Location: reset.php");
                exit();
            } else {
                $_SESSION['status'] = 'Error executing query: ' . $conn->error;
                $_SESSION['status_code'] = 'error';
            }

            // Close the connection
            $conn->close();
        } else {
            $_SESSION['status'] = 'Incorrect password';
            $_SESSION['status_code'] = 'error';
        }
    } else {
        $_SESSION['status'] = 'Error fetching password from the database';
        $_SESSION['status_code'] = 'error';
    }
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
       <?php include ('topbar.php');?>
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 text-gray-800">List of Branches</h1>

                <!-- Content Row -->
                <div class="row pl-1 pr-1">
                    <div class="col col-lg-12">
                        <table id="adminTable" class="table table-success shadow-lg hover" style="width:100%; border:none">
                            <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="color: black">
                                <tr>
                                    <td>1</td>
                                    <td>Employee Logs</td>
                                    <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#resetModalEmployeeLog">
                                        <i class='fas fa-history'></i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Admin Accounts</td>
                                    <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#resetModalAdminAccount">
                                        <i class='fas fa-history'></i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Employee Accounts</td>
                                    <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#resetModalEmployeeAccount">
                                        <i class='fas fa-history'></i> 
                                    </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- End of Main Content -->
<!-- Reset Modal Employee Logs-->
<div class="modal fade" id="resetModalEmployeeLog" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="resetModalLabel">Reset Employee Logs Records?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <input type="password" class="form-control font-weight-bold border-danger" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="reset_password">Reset Records</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Reset Modal -->

<!-- Reset Modal Admin Accounts-->
<div class="modal fade" id="resetModalAdminAccount" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="resetModalLabel">Reset Admin Records?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <input type="password" class="form-control font-weight-bold border-danger" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="reset_admin_accounts">Reset Record</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Reset Modal -->

<!-- Reset Modal Employee Accounts-->
<div class="modal fade" id="resetModalEmployeeAccount" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="resetModalLabel">Reset Employee Records?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="form-group">
                        <input type="password" class="form-control font-weight-bold border-danger" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="reset_employee_accounts">Reset Record</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Reset Modal -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; BizMaTech 2024</span>
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
<!-- SweetAlert script -->
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
</body>
</html>
