<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Time Record</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css" media="print">
        @media print {
            .container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
            }

            .logo {
                max-height: 50px; /* Adjust the height as needed */
            }

            .title {
                font-size: 24px;
                font-weight: bold;
            }

            .subtitle {
                font-size: 18px;
            }

            hr {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body onload="window.print()">
<div class="container">
    <?php
    require_once "connection.php"; // Include your database connection file

    // Check if 'search' parameter is set in the URL
    if (isset($_GET['search'])) {
        $search_input = $_GET['search'];
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
        TIME_FORMAT(TIMEDIFF(el.Employee_TimeOutAm, el.Employee_TimeInAm), '%H:%i') AS DurationAM,
        TIME_FORMAT(TIMEDIFF(el.Employee_TimeInPm, el.Employee_TimeOutPm), '%H:%i') AS DurationPM,
        TIME_FORMAT(
            SEC_TO_TIME(
                COALESCE(
                    TIME_TO_SEC(IFNULL(TIMEDIFF(el.Employee_TimeOutAm, el.Employee_TimeInAm), 0)),
                    0
                ) + COALESCE(
                    TIME_TO_SEC(IFNULL(TIMEDIFF(el.Employee_TimeInPm, el.Employee_TimeOutPm), 0)),
                    0
                )
            )
        , '%H:%i') AS TotalDuration
    FROM
        employee_log el
    JOIN
        employee_information ei ON el.Employee_ID = ei.Employee_ID
                                                WHERE el.Employee_ID = '$search_input' ORDER BY
    el.Employee_Date DESC");
    } else {
        // If 'search' parameter is not set, fetch all rows
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
        TIME_FORMAT(TIMEDIFF(el.Employee_TimeOutAm, el.Employee_TimeInAm), '%H:%i') AS DurationAM,
        TIME_FORMAT(TIMEDIFF(el.Employee_TimeInPm, el.Employee_TimeOutPm), '%H:%i') AS DurationPM,
        TIME_FORMAT(
            SEC_TO_TIME(
                COALESCE(
                    TIME_TO_SEC(IFNULL(TIMEDIFF(el.Employee_TimeOutAm, el.Employee_TimeInAm), 0)),
                    0
                ) + COALESCE(
                    TIME_TO_SEC(IFNULL(TIMEDIFF(el.Employee_TimeInPm, el.Employee_TimeOutPm), 0)),
                    0
                )
            )
        , '%H:%i') AS TotalDuration
    FROM
        employee_log el
    JOIN
        employee_information ei ON el.Employee_ID = ei.Employee_ID ORDER BY
    el.Employee_Date DESC");
    }

    $counter = 1;
    if ($row = mysqli_fetch_assoc($get_log_details)) {
        // Print header with logo, title, and subtitle
        echo '<div class="header">';
        echo '<div>';
        echo '<div class="title">Daily Time Record</div>';
        echo '<div class="subtitle">Date and Time Printed: ' . date('Y-m-d H:i:s') . '</div>';
        echo '<div>Employee ID: ' . $row['Employee_ID'] . '<br>Full Name: ' . $row['Employee_FullName'] . '</div>';
        echo '</div>';
        echo '<img src="Images/logoBizma.png" alt="Logo" class="logo">';
        echo '</div>';
        echo '<hr>';

        // Print the table
        echo '<table id="ready" class="table table-striped table-bordered" style="width:100%;">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Date</th>';
        echo '<th>Time In AM</th>';
        echo '<th>Time Out AM</th>';
        echo '<th>Time In PM</th>';
        echo '<th>Time Out PM</th>';
        echo '<th>Total Time</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        mysqli_data_seek($get_log_details, 0); // Reset pointer to the beginning of the result set

        while ($row = mysqli_fetch_array($get_log_details)) {
            echo '<tr>';
            echo '<td>' . $counter . '</td>';
            echo '<td>' . $row['Employee_Date'] . '</td>';
            echo '<td>' . $row['Employee_TimeInAm'] . '</td>';
            echo '<td>' . $row['Employee_TimeOutAm'] . '</td>';
            echo '<td>' . $row['Employee_TimeInPm'] . '</td>';
            echo '<td>' . $row['Employee_TimeOutPm'] . '</td>';
            echo '<td>' . $row['TotalDuration'] . ' hours</td>';
            echo '</tr>';
            $counter++;
        }

        echo '</tbody>';
        echo '</table>';
    }
    ?>
</div>


    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
