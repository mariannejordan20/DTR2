<?php include 'connection.php';
session_start();
if(!isset($_SESSION["username"])) {
  header("location: AdminPortal.php");
}
if (isset($_GET['search'])) {
    // ... (your existing code)

    $row = mysqli_fetch_array($get_log_details);

    // Store Employee_ID and Employee_FullName in session
    $_SESSION["employeeId"] = $row['Employee_ID'];
    $_SESSION["employeeFullName"] = $row['Employee_FullName'];

    // Store the filtered data in a session variable
    $_SESSION["filteredData"] = $filteredData;

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
                    <!-- <div>
                        <a href="report.php" class="btn btn-primary mb-3">Print All</a>
                    </div> -->
                    
                    <div class="row pl-1 pr-1">
                        <div class="col col-lg-12">
                            <!-- Search Bar with Date Filters -->
                            <div class="input-group mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search by Employee ID/Employee Name" oninput="searchTable()">
                                
                                <!-- Date From -->
                                <input type="date" id="dateFrom" class="form-control" placeholder="From" onchange="searchTable()">
                                
                                <!-- Date To -->
                                <input type="date" id="dateTo" class="form-control" placeholder="To" onchange="searchTable()">
                                
                                <!-- <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="searchTable()">Search</button>
                                </div> -->
                                <!-- Print Button -->
                                <button class="btn btn-success" type="button" onclick="printTable()">Print</button>
                            </div>
                            <!-- Add these hidden input fields to store employee details -->

                            <!-- Table -->
                            <table class="table table-striped table-bordered" id="myTable" style="width: 100%;">    
                                <thead>
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
                                <tbody>
                                    <?php

                                    $get_log_details = mysqli_query($conn, "SELECT
                                    el.ID,
                                    el.Employee_ID,
                                    el.Employee_Date,
                                    el.Employee_Time,
                                    el.Employee_Status,
                                    ei.Employee_FullName,
                                    ei.Employee_Department,
                                    ei.Employee_Position,
                                    ei.Employee_Sex,
                                    ei.user_type,
                                    el.Employee_TimeInAm,
                                    el.Employee_TimeOutAm,
                                    el.Employee_TimeInPm,
                                    el.Employee_TimeOutPm,
                                    TIME_FORMAT(
                                        TIMEDIFF(
                                            GREATEST(el.Employee_TimeOutAm, el.Employee_TimeInAm),
                                            LEAST(el.Employee_TimeOutAm, el.Employee_TimeInAm)
                                        ), '%H:%i'
                                    ) AS DurationAM,
                                    TIME_FORMAT(
                                        TIMEDIFF(
                                            GREATEST(el.Employee_TimeOutPm, el.Employee_TimeInPm),
                                            LEAST(el.Employee_TimeOutPm, el.Employee_TimeInPm)
                                        ), '%H:%i'
                                    ) AS DurationPM,
                                    TIME_FORMAT(
                                        SEC_TO_TIME(
                                            TIME_TO_SEC(
                                                IFNULL(TIMEDIFF(GREATEST(el.Employee_TimeOutAm, el.Employee_TimeInAm), LEAST(el.Employee_TimeOutAm, el.Employee_TimeInAm)), 0)
                                            ) +
                                            TIME_TO_SEC(
                                                IFNULL(TIMEDIFF(GREATEST(el.Employee_TimeOutPm, el.Employee_TimeInPm), LEAST(el.Employee_TimeOutPm, el.Employee_TimeInPm)), 0)
                                            )
                                        ), '%H:%i'
                                    ) AS TotalDuration
                                    FROM
                                    employee_log el
                                    JOIN
                                    employee_information ei ON el.Employee_ID = ei.Employee_ID
                                    ORDER BY
                                    el.Employee_Date DESC;
                                    ");



                                    $counter = 1;

                                    while ($row = mysqli_fetch_array($get_log_details)) {
                                        ?>
                                        <tr>
                                            <td class="text-gray-700"><?php echo $counter ?></td>
                                            <td class="text-gray-900"><?php echo $row['Employee_ID'] ?></td>
                                            <td class="text-gray-900"><?php echo $row['Employee_FullName'] ?></td>
                                            <td class="text-gray-700"><?php echo date('Y-m-d', strtotime($row['Employee_Date'])); ?></td>
                                            <td class="text-gray-700 time-in-am"><?php echo $row['Employee_TimeInAm'] ?></td>
                                            <td class="text-gray-700 time-out-am"><?php echo $row['Employee_TimeOutAm'] ?></td>
                                            <td class="text-gray-700 time-in-pm"><?php echo $row['Employee_TimeInPm'] ?></td>
                                            <td class="text-gray-700 time-out-pm"><?php echo $row['Employee_TimeOutPm'] ?></td>
                                            <td class="text-gray-700"><?php echo $row['TotalDuration'] ?> Hours</td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" data-toggle="modal" data-target="#editModal" data-employee-id="<?php echo $row['ID']; ?>"><i class='fas fa-pen'></i></button>
                                                <button class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal" data-employee-id="<?php echo $row['ID']; ?>"><i class='fas fa-trash'></i></button>
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

     <!-- Edit Modal -->   
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Time Records</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                    <input type="hidden" id="employeeId" name="employeeId">
                        <div class="form-group">
                            <label for="timeInAm">Time In (AM)</label>
                            <input type="text" class="form-control" id="timeInAm" name="timeInAm">
                        </div>
                        <div class="form-group">
                            <label for="timeOutAm">Time Out (AM)</label>
                            <input type="text" class="form-control" id="timeOutAm" name="timeOutAm">
                        </div>
                        <div class="form-group">
                            <label for="timeInPm">Time In (PM)</label>
                            <input type="text" class="form-control" id="timeInPm" name="timeInPm">
                        </div>
                        <div class="form-group">
                            <label for="timeOutPm">Time Out (PM)</label>
                            <input type="text" class="form-control" id="timeOutPm" name="timeOutPm">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL FOR THE DELETE BUTTON -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Delete Log</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete the Log?</p>
                <!-- Add the password input field -->
                <input type="password" class="form-control" id="adminPassword" placeholder="Enter Admin Password">
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="AdminReportsDelete.php" method="post">
                    <input type="hidden" name="idToDelete" id="idToDelete" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="checkAdminPassword()">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL FOR THE DELETE BUTTON -->

<script>
    function checkAdminPassword() {
        // Get the entered password
        var enteredPassword = document.getElementById("adminPassword").value;

        // Perform your password check here
        // For demonstration purposes, I'll assume the correct password is "admin123"
        var correctPassword = "admin123";

        if (enteredPassword === correctPassword) {
            // If the password is correct, submit the delete form
            document.getElementById("deleteForm").submit();
        } else {
            // If the password is incorrect, show an error message (you can use a modal or other UI)
            alert("Incorrect password. Please try again.");
        }
    }
</script>

<script>
    $('.delete-btn').click(function() {
    var employeeIdToDelete = $(this).data('employee-id');
    $('#idToDelete').val(employeeIdToDelete);
});

</script>

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
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                var employeeId = $(this).data('employee-id');
                var timeInAm = $(this).closest('tr').find('.time-in-am').text();
                var timeOutAm = $(this).closest('tr').find('.time-out-am').text();
                var timeInPm = $(this).closest('tr').find('.time-in-pm').text();
                var timeOutPm = $(this).closest('tr').find('.time-out-pm').text();
                
                $('#employeeId').val(employeeId);
                $('#timeInAm').val(timeInAm);
                $('#timeOutAm').val(timeOutAm);
                $('#timeInPm').val(timeInPm);
                $('#timeOutPm').val(timeOutPm);
            });

            // JavaScript code in your HTML file

                   
            $('#editForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'reportedit.php',
                    data: formData,
                    success: function(response) {
                        // Parse the JSON response
                        var data = JSON.parse(response);

                        // Check the status of the response
                        if (data.status === 'success') {
                            // Display success message using SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                // Redirect to AdminReportsDaily.php
                                window.location.href = 'AdminReportsDaily.php';
                            });
                        } else {
                            // Display error message using SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error: ' + data.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('AJAX Error:', error);
                        // Display a generic error message to the user
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again later.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });


        });
        function searchTable() {
    var input, filter, table, tr, tdEmployeeID, tdFullName, i, fromDate, toDate;
    input = document.getElementById("searchInput");
    fromDate = document.getElementById("dateFrom").value;
    toDate = document.getElementById("dateTo").value;

    table = document.getElementById("myTable"); // Assuming your table has ID "myTable"
    tr = table.getElementsByTagName("tr");

    var filteredData = [];

    for (i = 0; i < tr.length; i++) {
        tdEmployeeID = tr[i].getElementsByTagName("td")[1]; // Assuming the employee ID is in the second column, adjust if needed
        tdFullName = tr[i].getElementsByTagName("td")[2]; // Assuming the full name is in the third column, adjust if needed
        var dateCell = tr[i].getElementsByTagName("td")[3]; // Assuming the date is in the fourth column, adjust if needed

        if (tdEmployeeID && tdFullName && dateCell) {
            filter = input.value.toUpperCase();
            var date = new Date(dateCell.innerHTML); // Parse the date from the cell content

            // Adjust toDate by adding one day to include the entire selected day
            var adjustedToDate = new Date(toDate);
            adjustedToDate.setDate(adjustedToDate.getDate() + 1);

            if (
                (tdEmployeeID.innerHTML.toUpperCase().indexOf(filter) > -1 || tdFullName.innerHTML.toUpperCase().indexOf(filter) > -1) &&
                (!fromDate || date >= new Date(fromDate)) &&
                (!toDate || date < adjustedToDate)
            ) {
                tr[i].style.display = "";
                // Collect the filtered data
                filteredData.push({
                    EmployeeID: tdEmployeeID.innerHTML,
                    FullName: tdFullName.innerHTML,
                    Date: dateCell.innerHTML,
                    // Add other fields as needed
                });
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    // Log or print the filtered data
    console.log(filteredData);
    // You can use this data to further process or display it as needed
}


function printTable() {
    var table = document.getElementById('myTable').cloneNode(true);

    // Remove the first column (entire column) from the cloned table
    var headerRow = table.querySelector('thead tr');
    headerRow.removeChild(headerRow.firstElementChild);

    var bodyRows = table.querySelectorAll('tbody tr');
    bodyRows.forEach(function (row) {
        row.removeChild(row.firstElementChild);
    });

    // Remove the "ACTIONS" column (last column) from the header
    var lastHeaderCell = headerRow.lastElementChild;
    headerRow.removeChild(lastHeaderCell);

    // Remove the "ACTIONS" column (last column) from each body row
    bodyRows.forEach(function (row) {
        row.removeChild(row.lastElementChild);
    });

    var fromDate = document.getElementById("dateFrom").value;
    var toDate = document.getElementById("dateTo").value;

    var employeeId = '<?php echo isset($_SESSION['employeeId']) ? $_SESSION['employeeId'] : ''; ?>';
    var employeeFullName = '<?php echo isset($_SESSION['employeeFullName']) ? $_SESSION['employeeFullName'] : ''; ?>';

    var printContent = table.outerHTML;

    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Daily Time Record</title>');
    printWindow.document.write('<style>body { font-family: Arial, sans-serif; font-size: 10px; padding: 20px; }</style>');
    printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }</style>');
    printWindow.document.write('<style>table, td { border: 1px solid black; }</style>');
    printWindow.document.write('<style>th { border: 1px solid black; font-size: 10px; }</style>');
    printWindow.document.write('<style>tbody { font-size: 10px; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<div style="position: relative; left: 80%; top: 20px;"><img src="https://1.bp.blogspot.com/-FfwzJE3UAIc/XQhohjACUEI/AAAAAAAABVU/hb30KuNRod4a0c2uCqWrL-VK8SkgxL0VQCLcBGAs/s1600/bizma.png" alt="Logo" style="max-width: 100px; max-height: 100px;"></div>');
    printWindow.document.write('<h1>Daily Time Record</h1>');
    printWindow.document.write('<p>Date Range: From: ' + fromDate + ' To: ' + toDate + '</p>');
    printWindow.document.write('<p>Date and time printed: ' + getCurrentDateTime() + '</p>');
    printWindow.document.write(printContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

    
    function getCurrentDateTime() {
        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleDateString();
        var formattedTime = currentDate.toLocaleTimeString();
        return formattedDate + ' ' + formattedTime;
    }
        </script>
    </body>  
</html>

