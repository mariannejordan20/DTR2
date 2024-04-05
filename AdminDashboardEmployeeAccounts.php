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
       <?php include ('topbar.php');?>
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 text-gray-800">List of Employee</h1>
                <!-- Search Bar -->
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Employee Name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row pl-1 pr-1">
                    <div class="col col-lg-12">
                        <div class="d-flex">
                            <!-- <button type="button" class="btn mt-3 mb-3" style="background-color: #45d43d; color: white;"
                                    data-toggle="modal" data-target="#addBranchModal">
                                <i class="ml-1 fas fa-fw fa-plus"></i> Add Branch
                            </button> -->
                        </div>
                        <table id="myTable" class="table table-bordered shadow-lg hover" style="width:100%; border:none">
                            <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Fullname_Name</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Sex</th>
                                <th class="text-center">
                                    <select id="statusFilter" style="border: none; font-weight: bold; color:#656565;">
                                        <option value="">Status</option>
                                    </select>
                                </th>
                                <th style="display:none">Status2</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" style="color: black">
                                <?php
                                // Add an array to map numeric status values to text values
                                $statusText = [
                                    1 => "Active",
                                    2 => "Inactive",
                                    3 => "Suspended",
                                    // Add more status text values if needed
                                ];

                                $sql = "SELECT ID, Employee_ID, Employee_FullName,Employee_Branch, Employee_Department, Employee_Position, Employee_Sex, Employee_Status FROM `employee_information`";
                                $result = $conn -> query($sql);

                                $count = 1; // Initialize count variable
                                
                                if($result-> num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $status = ""; // Initialize status variable
                                        $textColor = ""; // Initialize text color variable
                                        $status2 = isset($statusText[$row["Employee_Status"]]) ? $statusText[$row["Employee_Status"]] : "Unknown";

                                        // Set status and text color based on Employee_Status
                                        switch ($row["Employee_Status"]) {
                                            case 1:
                                                $status = "Active";
                                                $textColor = "success";
                                                break;
                                            case 2:
                                                $status = "Inactive";
                                                $textColor = "danger";
                                                break;
                                            case 3:
                                                $status = "Suspended";
                                                $textColor = "warning";
                                                break;
                                            default:
                                                $status = "Unknown";
                                                $textColor = "secondary";
                                                break;
                                        }
                                        echo "<tr>
                                            <td>".$count."</td>
                                            <td>".$row["Employee_ID"]."</td>
                                            <td>".$row["Employee_FullName"]."</td>
                                            <td>".$row["Employee_Branch"]."</td>
                                            <td>".$row["Employee_Department"]."</td>
                                            <td>".$row["Employee_Position"]."</td>
                                            <td>".$row["Employee_Sex"]."</td>
                                            <td>
                                                <button class='p-1 rounded text-".$textColor." btn edit-status-btn' data-toggle='modal' data-target='#statusModal' data-employee-id='".$row["Employee_ID"]."'>".$status."</button>
                                            </td>
                                            <td style='display:none'>".$status2."</td> <!-- Populate Status2 column with text value -->
                                            <td>
                                                <button type=\"button\" class=\"btn btn-primary btn-sm edit-employee-btn\" data-toggle=\"modal\" data-target=\"#editEmployeeModal\" 
                                                data-employee-id=\"".$row["Employee_ID"]."\" 
                                                data-employee-name=\"".$row["Employee_FullName"]."\"
                                                data-employee-branch=\"".$row["Employee_Branch"]."\"
                                                data-employee-department=\"".$row["Employee_Department"]."\"
                                                data-employee-position=\"".$row["Employee_Position"]."\"
                                                data-employee-sex=\"".$row["Employee_Sex"]."\">
                                                
                                                <i class='fas fa-pen'></i>
                                                </button>
                                                <button type=\"button\" class=\"btn btn-danger btn-sm delete-employee-btn\" data-toggle=\"modal\" data-target=\"#deleteEmployeeModal\" data-employee-id=\"".$row["Employee_ID"]."\">
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
        <!-- Status Modal -->
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: white; color: black">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="employeeId">
                        <button type="button" class="btn btn-success update-status-btn" data-status="1">Active</button>
                        <button type="button" class="btn btn-danger update-status-btn" data-status="2">Inactive</button>
                        <button type="button" class="btn btn-warning update-status-btn" data-status="3">Suspend</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Event listener for status buttons in the modal
                $('.edit-status-btn').click(function() {
                    var employeeId = $(this).data('employee-id');
                    $('#employeeId').val(employeeId);
                });

                // Event listener for updating status
                $('.update-status-btn').click(function() {
                    var status = $(this).data('status');
                    var employeeId = $('#employeeId').val();

                    // AJAX request to update status
                    $.ajax({
                        url: 'updateEmployeeStatus.php',
                        type: 'POST',
                        data: { employeeId: employeeId, status: status },
                        success: function(response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('#statusModal').modal('hide');
                            // Reload the page to refresh the status in the table
                            location.reload();
                            // Show success alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: 'Employee status updated successfully.'
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error, if needed
                            console.error('Error updating status:', error);
                        }
                    });
                });

                // Ensure modal is hidden on close
                $('#statusModal').on('hidden.bs.modal', function () {
                    $(this).find('.update-status-btn').off('click'); // Remove click event handlers
                });
            });
        </script>

        <!-- End of Main Content -->
        <?php
            // Fetch departments
            $departmentQuery = "SELECT ID, Department FROM departments";
            $departmentResult = $conn->query($departmentQuery);

            // Fetch branches
            $branchQuery = "SELECT ID, Branch FROM branches";
            $branchResult = $conn->query($branchQuery);
        ?>
        <!-- Edit Branch Modal -->
        <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #007bff; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editEmployeeForm" action="employeeeditsave.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_employee_id">Employee ID:</label>
                                <input type="text" name="edit_employee_id" id="edit_employee_id" class="form-control" required>
                                <label for="edit_employee_name">Employee Name:</label>
                                <input type="text" name="edit_employee_name" id="edit_employee_name" class="form-control" required>
                                <label for="edit_employee_branch">Employee Branch:</label>
                                <select name="edit_employee_branch" id="edit_employee_branch" class="form-control" required>
                                    <?php
                                    while ($branch = $branchResult->fetch_assoc()) {
                                        echo "<option value='".$branch["Branch"]."'>".$branch["Branch"]."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="edit_employee_department">Employee Department:</label>
                                <select name="edit_employee_department" id="edit_employee_department" class="form-control" required>
                                    <?php
                                    while ($department = $departmentResult->fetch_assoc()) {
                                        echo "<option value='".$department["Department"]."'>".$department["Department"]."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="edit_employee_position">Employee Position:</label>
                                <input type="text" name="edit_employee_position" id="edit_employee_position" class="form-control" required>
                                <label for="edit_employee_sex">Employee Sex:</label>
                                <input type="text" name="edit_employee_sex" id="edit_employee_sex" class="form-control" required>
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
        <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #dc3545; color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Employee Information?
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
    $('.edit-employee-btn').click(function() {
        var employeeId = $(this).data('employee-id');
        var employeeName = $(this).data('employee-name');
        var employeeBranch = $(this).data('employee-branch');
        var employeeDepartment = $(this).data('employee-department');
        var employeePosition = $(this).data('employee-position');
        var employeeSex = $(this).data('employee-sex');

        $('#edit_employee_id').val(employeeId);
        $('#edit_employee_name').val(employeeName);
        $('#edit_employee_branch').val(employeeBranch);
        $('#edit_employee_department').val(employeeDepartment);
        $('#edit_employee_position').val(employeePosition);
        $('#edit_employee_sex').val(employeeSex);
    });

    // Submit the form when "Save Changes" is clicked
    $('#editEmployeeForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
            url: 'employeeeditsave.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success, like updating the table
                $('#editEmployeeModal').modal('hide');
                // You might want to reload the table or update the edited row
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });

    $('.delete-employee-btn').click(function() {
        var employeeId = $(this).data('employee-id');
        $('#deleteEmployeeModal').find('.confirm-delete-btn').data('employee-id', employeeId);
    });

    $('.confirm-delete-btn').click(function() {
        var employeeId = $(this).data('employee-id');
        $.ajax({
            url: 'employeedelete.php',
            type: 'POST',
            data: {employeeId: employeeId},
            success: function(response) {
                // Handle success, like updating the table
                $('#deleteEmployeeModal').modal('hide');
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
document.addEventListener("DOMContentLoaded", function() {
    populateDropdown("statusFilter", 8); // Index of status column
});

function populateDropdown(selectId, columnIndex) {
    console.log("Populating dropdown...");
    var select = document.getElementById(selectId);
    var options = [];
    var table = document.getElementById("myTable");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
        var cell = rows[i].getElementsByTagName("td")[columnIndex];
        var value = cell.textContent || cell.innerText;
        console.log("Value:", value);
        if (!options.includes(value)) {
            options.push(value);
            var option = document.createElement("option");
            option.text = value;
            select.add(option);
        }
    }
    console.log("Dropdown populated successfully.");
}


function filterTable() {
    console.log("Filtering table...");
    var selectStatus = document.getElementById("statusFilter");
    var filterStatus = selectStatus.value.toUpperCase();
    var searchInput = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("myTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var tdStatus = tr[i].getElementsByTagName("td")[8]; // Index of Status column
        var tdEmployeeName = tr[i].getElementsByTagName("td")[2]; // Index of Employee Name column
        var tdEmployeeID = tr[i].getElementsByTagName("td")[1]; // Index of Employee ID column
        if (tdStatus && tdEmployeeName && tdEmployeeID) {
            var statusMatch = filterStatus === '' || tdStatus.textContent.toUpperCase() === filterStatus;
            var employeeNameMatch = tdEmployeeName.textContent.toUpperCase().indexOf(searchInput) > -1;
            var employeeIDMatch = tdEmployeeID.textContent.toUpperCase().indexOf(searchInput) > -1;
            if ((statusMatch && employeeNameMatch) || (statusMatch && employeeIDMatch)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    console.log("Table filtered successfully.");
}


document.getElementById("statusFilter").addEventListener("change", filterTable);
document.getElementById("searchInput").addEventListener("input", filterTable);

    
</script>

</body>
</html>
