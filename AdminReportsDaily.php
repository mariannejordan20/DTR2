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
    <link rel="icon" href="Images/logofinal.png" type="image/png">
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
                <h1 class="h3 text-gray-800">Reports</h1>
                    <!-- Search Bar with Date Filters -->
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control mr-3 rounded" placeholder="Search by Employee ID/Employee Name" oninput="searchTable()">
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded">From</span>
                            <input type="date" id="dateFrom" class="form-control mr-3 rounded" onchange="searchTable()">
                        </div>
                        
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded">To</span>
                            <input type="date" id="dateTo" class="form-control rounded mr-3" onchange="searchTable()">
                        </div>
                        
                        <button class="btn btn-success" type="button" onclick="printTable()">Print</button>
                    </div>

                <!-- Content Row -->
                <div class="row pl-1 pr-1">
                    <div class="col col-lg-12">
                        <table id="myTable" class="table table shadow-lg hover" style="width:100%; border:none">
                            <thead class="text-center">
                            <tr>
                                <th class="font-weight-bold">NO.</th>
                                <th class="font-weight-bold">ID</th>
                                <th class="font-weight-bold">NAME</th>
                                <th class="font-weight-bold">DATE</th>
                                <th class="font-weight-bold">FIRST (in)</th>
                                <th class="font-weight-bold">FIRST (out)</th>
                                <th class="font-weight-bold">SECOND (in)</th>
                                <th class="font-weight-bold">SECOND (out)</th>
                                <th class="font-weight-bold">TOTAL</th>
                                <th class="font-weight-bold">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="color: black">
                            <?php
                            $sql = "SELECT
                            logs.id,
                            logs.Employee_ID,
                            logs.DateLog,
                            logs.TimeLog1,
                            logs.TimeLog2,
                            logs.TimeLog3,
                            logs.TimeLog4,
                            employee_information.Employee_FullName,
                            employee_information.Employee_Department,
                            employee_information.Employee_Position,
                            employee_information.Employee_Sex,
                            employee_information.user_type,
                            employee_information.Employee_Branch,
                            TIME_FORMAT(TIMEDIFF(logs.TimeLog2, logs.TimeLog1), '%H:%i') AS FirstTimeLog,
                            TIME_FORMAT(TIMEDIFF(logs.TimeLog4, logs.TimeLog3), '%H:%i') AS SecondTimeLog,
                            TIME_FORMAT(
                                SEC_TO_TIME(
                                    TIME_TO_SEC(TIMEDIFF(logs.TimeLog2, logs.TimeLog1)) +
                                    TIME_TO_SEC(TIMEDIFF(logs.TimeLog4, logs.TimeLog3))
                                ), '%H:%i'
                            ) AS TotalDuration
                        FROM
                            LOGS
                        INNER JOIN
                            employee_information ON logs.Employee_ID = employee_information.Employee_ID
                        ORDER BY
                            logs.DateLog DESC";
                            $result = $conn -> query($sql);

                            $count = 1; // Initialize count variable

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $count . "</td>
                                            <td>" . $row["Employee_ID"] . "</td>
                                            <td>" . $row["Employee_FullName"] . "</td>
                                            <td>" . $row["DateLog"] . "</td>
                                            <td>" . $row["TimeLog1"] . "</td>
                                            <td>" . $row["TimeLog2"] . "</td>
                                            <td>" . $row["TimeLog3"] . "</td>
                                            <td>" . $row["TimeLog4"] . "</td>
                                            <td>";
                        
                                    // Display TotalDuration if available
                                    if (!empty($row["TotalDuration"])) {
                                        echo $row["TotalDuration"];
                                    } elseif (!empty($row["SecondTimeLog"])) {
                                        // Display SecondTimeLog if available and if the record is only in TimeLog3 and TimeLog4
                                        echo $row["SecondTimeLog"];
                                    } else {
                                        // Display FirstTimeLog if the record is not only in TimeLog3 and TimeLog4
                                        echo $row["FirstTimeLog"];
                                    }
                        
                                    echo " Hrs</td>
                                            <td>
                                                <button type=\"button\" class=\"btn btn-primary btn-sm edit-ip-btn\" data-toggle=\"modal\" data-target=\"#editIpModal\" 
                                                    data-id=\"" . $row["id"] . "\" 
                                                    data-log1=\"" . $row["TimeLog1"] . "\" 
                                                    data-log2=\"" . $row["TimeLog2"] . "\" 
                                                    data-log3=\"" . $row["TimeLog3"] . "\"
                                                    data-log4=\"" . $row["TimeLog4"] . "\">
                                                <i class='fas fa-pen'></i>
                                                </button>
                                                <button type=\"button\" class=\"btn btn-danger btn-sm delete-Ip-btn\" data-toggle=\"modal\" data-target=\"#deleteIpModal\" data-id=\"" . $row["id"] . "\">
                                                <i class='fas fa-trash'></i>
                                                </button>
                                            </td>
                                        </tr>";
                                    $count++; // Increment count for the next row
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



        <!-- Edit Logs Modal -->
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
                                <label for="edit_ip_name">INPUT PASSWORD FIRST!</label>
                                <input style="font-weight: bold;" type="password" name="passwordlog" id="passwordlog" class="form-control border-danger" placeholder="Enter Password" >
                                <label for="edit_ip_name">First (in):</label>
                                <input type="text" name="edit_employee_log1" id="edit_employee_log1" class="form-control" >
                                <label for="edit_ip_name">First (out):</label>
                                <input type="text" name="edit_employee_log2" id="edit_employee_log2" class="form-control" >
                                <label for="edit_ip_name">Second (in):</label>
                                <input type="text" name="edit_employee_log3" id="edit_employee_log3" class="form-control" >
                                <label for="edit_ip_name">Second (out):</label>
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
        <!-- End of Edit Logs Modal -->

        <!-- Delete Logs Modal -->
        <div class="modal fade" id="deleteIpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Delete IP</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="deleteIpForm" action="AdminReportsDelete.php" method="post">
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Log report?</p>
                            <div class="form-group">
                                <label for="passwordlog">Enter Admin Password:</label>
                                <input style="font-weight: bold;" type="password" name="passwordlog" id="passwordlog" class="form-control border-danger" placeholder="Enter Password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger confirm-delete-btn">Delete</button>
                        </div>
                        <input type="hidden" name="edit_employee_Id" id="edit_employee_Id">
                    </form>
                </div>
            </div>
        </div>

        <!-- End of Delete Logs Modal -->

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

<!-- jquery and datatable plugin -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="myStyles/JS/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<!-- Core plugin JavaScript-->
<script src="myStyles/JS/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="myStyles/JS/sb-admin-2.min.js"></script>


<script src="myStyles/JS/adminlistJS.js"></script>
<script src="myStyles/JS/loader.js"></script>
<script>
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
}

</script>
</body>
</html>
