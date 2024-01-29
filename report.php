<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="myStyles/CSS/indexCSSFile.css"> 
    <link rel="stylesheet" href="myStyles/CSS/sb-admin-2.min.css"> 
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="myStyles/CSS/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10">
</head>
<body onload="window.print()">
    <div class="container">
        <center>
            <h1 style="margin-top: 30px; margin-right:60%;">Daily Time Record</h1>
            <hr>
        </center>
        <table id="ready" class="table table-striped table-bordered" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_log_details = mysqli_query($conn, "SELECT * FROM employee_log");
                // $get_employee_name = mysqli_query($conn, "SELECT el.Employee_ID,el.Employee_Date,el.Employee_Time,el.Employee_Status,ei.Employee_FullName,ei.Employee_Department,ei.Employee_Position,ei.Employee_Sex,ei.user_type
                // FROM employee_log el
                // JOIN employee_information ei ON el.Employee_ID = ei.Employee_ID;");

                while ($row = mysqli_fetch_array($get_log_details)) { ?>
                    <tr>
                        <td><?php echo $row['ID'] ?></td>
                        <td><?php echo $row['Employee_ID'] ?></td>
                        <td><?php echo $row['Employee_Date'] ?></td>
                        <td><?php echo $row['Employee_Time'] ?></td>
                        <td><?php echo $row['Employee_Status'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <button type="button" class="btn btn-info noprint" style="width:100%;" 
        onclick="window.location.replace('AdminReportsDaily.php');">CANCEL PRINT</button>
    </div>
</body>

</html>
