<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize response array
    $response = array();

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
        $response['status'] = 'error';
        $response['message'] = "Connection failed: " . $conn->connect_error;
    } else {
        // Check if the employee_id is registered in the employee_information table
        $checkEmployeeInfo = "SELECT Employee_ID, Employee_FullName, Employee_Status FROM $employeeInfoTableName WHERE Employee_ID = '$employeeID'";
        $resultEmployeeInfo = $conn->query($checkEmployeeInfo);

        if ($resultEmployeeInfo !== false) {
            if ($resultEmployeeInfo->num_rows > 0) {
                $employeeInfo = $resultEmployeeInfo->fetch_assoc();
                $employeeFullName = $employeeInfo['Employee_FullName'];
                $employeeStatus = $employeeInfo['Employee_Status'];

                // Add Employee_Status to the response
                $response['Employee_Status'] = $employeeStatus;

                // Check if the employee is active (assuming status 1 means active) or suspended (assuming status 2 means suspended)
                if ($employeeStatus == 1) {
                    // Employee is active, continue processing
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
                            $response['status'] = 'error';
                            $response['message'] = "Invalid button click";
                            echo json_encode($response);
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
                                    $response['status'] = 'success';
                                    $response['message'] = "$employeeFullName! YOUR DATA HAS BEEN RECORDED!";
                                } else {
                                    $response['status'] = 'error';
                                    $response['message'] = "Error updating data: " . $conn->error;
                                }
                            } else {
                                $response['status'] = 'error';
                                $response['message'] = "You already have a record for this time period!";
                            }
                        } else {
                            // No previous entries for the employee on the current day
                            // Create a new row for the new day
                            // Get the full IP address of the device
                            $ipaddress = getenv("REMOTE_ADDR");
                            $sql = "INSERT INTO $logsTableName (Employee_ID, $timeLogColumn, $dateLogColumn, IpAddress) VALUES ('$employeeID', '$timestamp', CURDATE(), '$ipaddress')";

                            if ($conn->query($sql) === TRUE) {
                                $response['status'] = 'success';
                                $response['message'] = "$employeeFullName! YOUR DATA HAS BEEN RECORDED!";
                            } else {
                                $response['status'] = 'error';
                                $response['message'] = "Error inserting data: " . $conn->error;
                            }
                        }
                    } else {
                        // The query result is null, handle accordingly (e.g., log an error)
                        $response['status'] = 'error';
                        $response['message'] = "Error querying data: " . $conn->error;
                    }
                } elseif ($employeeStatus == 2) {
                    // Employee is suspended
                    $response['status'] = 'error';
                    $response['message'] = "Your account is INACTIVE!";
                } else {
                    // Employee is inactive or has other status
                    $response['status'] = 'error';
                    $response['message'] = $employeeFullName . ", your account is SUSPENDED!";
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = "Employee ID not registered!";
            }
        } else {
            // The query result is null, handle accordingly (e.g., log an error)
            $response['status'] = 'error';
            $response['message'] = "Error querying data: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();

    // Output the response as JSON
    echo json_encode($response);
} else {
    $response['status'] = 'error';
    $response['message'] = "Invalid request method";
    // Output the response as JSON
    echo json_encode($response);
}
?>
