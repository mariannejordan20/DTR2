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

    // Check if the employee_id already exists in the logs table
    $checkIfExists = "SELECT $timeLogColumn FROM $logsTableName WHERE Employee_ID = '$employeeID'";
    $resultCheck = $conn->query($checkIfExists);

    if ($resultCheck !== false) {
        $row = $resultCheck->fetch_assoc();
        $existingTimeLog = $row[$timeLogColumn] ?? null;

        if ($existingTimeLog !== null) {
            // The TimeLog column is already filled, indicating the employee has already performed this action
            echo "You already log this!";
        } else {
            // The TimeLog column is empty, allowing the employee to perform the action
            // Check if the employee_id exists in the employee_information table
            $checkEmployeeInfo = "SELECT Employee_ID FROM $employeeInfoTableName WHERE Employee_ID = '$employeeID'";
            $resultEmployeeInfo = $conn->query($checkEmployeeInfo);

            if ($resultEmployeeInfo->num_rows > 0) {
                // Employee_id exists in employee_information table
                // Check if the employee_id already exists in the logs table
                $checkIfExists = "SELECT Employee_ID FROM $logsTableName WHERE Employee_ID = '$employeeID'";
                $resultCheck = $conn->query($checkIfExists);

                if ($resultCheck->num_rows > 0) {
                    // Employee_id exists in logs table, perform UPDATE
                    $sqlUpdate = "UPDATE $logsTableName SET $timeLogColumn = '$timestamp', $dateLogColumn = CURDATE() WHERE Employee_ID = '$employeeID'";
                    
                    if ($conn->query($sqlUpdate) === TRUE) {
                        echo "Your data has been recorded!";
                    } else {
                        echo "Error updating data: " . $conn->error;
                    }
                } else {
                    // Employee_id does not exist in logs table, perform INSERT
                    $sqlInsert = "INSERT INTO $logsTableName (Employee_ID, $timeLogColumn, $dateLogColumn) VALUES ('$employeeID', '$timestamp', CURDATE())";
                    
                    if ($conn->query($sqlInsert) === TRUE) {
                        echo "Your data has been recorded!";
                    } else {
                        echo "Error inserting data: " . $conn->error;
                    }
                }
            } else {
                // Employee_id does not exist in employee_information table
                echo "Employee ID not registered!.";
            }
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
