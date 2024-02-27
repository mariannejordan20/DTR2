<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form
    $employeeID = $_POST['textBoxUserID'];
    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s"); // Current timestamp in the Philippines time zone

    // Determine which button was clicked based on the provided btnId parameter
    $btnId = isset($_POST['btnId']) ? $_POST['btnId'] : '';

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee_db";
    $logsTableName = "logs";
    $employeeInfoTableName = "employee_information";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the employee_id is registered in the employee_information table
    $checkEmployeeInfo = "SELECT Employee_ID, Employee_FullName FROM $employeeInfoTableName WHERE Employee_ID = '$employeeID'";
    $resultEmployeeInfo = $conn->query($checkEmployeeInfo);

    if ($resultEmployeeInfo !== false) {
        if ($resultEmployeeInfo->num_rows > 0) {
            $employeeInfo = $resultEmployeeInfo->fetch_assoc();
            $employeeFullName = $employeeInfo['Employee_FullName'];

            // Determine the TimeLog and DateLog columns
            $timeLogColumn = '';
            $dateLogColumn = 'DateLog'; // Assuming DateLog is the new column name
            switch ($btnId) {
                case 'btnTimeIn1':
                    $timeLogColumn = 'TimeLog1';
                    break;
                case 'btnTimeOut1':
                    $timeLogColumn = 'TimeLog2';
                    break;
                case 'btnTimeIn2':
                    $timeLogColumn = 'TimeLog3';
                    break;
                case 'btnTimeOut2':
                    $timeLogColumn = 'TimeLog4';
                    break;
                default:
                    echo "Invalid button click";
                    exit;
            }

            // Check if the employee_id already has any record for the current day
            $checkIfExists = "SELECT Employee_ID, $timeLogColumn, $dateLogColumn FROM $logsTableName WHERE Employee_ID = '$employeeID' AND $dateLogColumn = CURDATE()";
            $resultCheck = $conn->query($checkIfExists);

            if ($resultCheck !== false) {
                if ($resultCheck->num_rows > 0) {
                    $existingEntry = $resultCheck->fetch_assoc();

                    // Check if the time-log column is empty
                    if (empty($existingEntry[$timeLogColumn])) {
                        // Update the existing row
                        $sql = "UPDATE $logsTableName SET $timeLogColumn = '$timestamp' WHERE Employee_ID = '$employeeID' AND $dateLogColumn = CURDATE()";

                        if ($conn->query($sql) === TRUE) {
                            echo "$employeeFullName! YOUR DATA HAS BEEN RECORDED! HEHEHEHE";
                        } else {
                            echo "Error updating data: " . $conn->error;
                        }
                    } else {
                        echo "You already have a record for this time period!";
                    }
                } else {
                    // No previous entries for the employee on the current day
                    // Create a new row for the new day
                    $sql = "INSERT INTO $logsTableName (Employee_ID, $timeLogColumn, $dateLogColumn) VALUES ('$employeeID', '$timestamp', CURDATE())";

                    if ($conn->query($sql) === TRUE) {
                        echo "$employeeFullName! YOUR DATA HAS BEEN RECORDED!";
                    } else {
                        echo "Error inserting data: " . $conn->error;
                    }
                }
            } else {
                // The query result is null, handle accordingly (e.g., log an error)
                echo "Error querying data: " . $conn->error;
            }
        } else {
            echo "Employee ID not registered!";
        }
    } else {
        // The query result is null, handle accordingly (e.g., log an error)
        echo "Error querying data: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
