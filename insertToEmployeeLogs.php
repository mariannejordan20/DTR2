<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include 'connection.php';

    // Retrieve data from the AJAX request
    $employeeID = $_POST['employeeID'];
    $employeeDate = $_POST['employeeDate'];
    $employeeTime = $_POST['employeeTime'];
    $employeeIsWorking = $_POST['employeeIsWorking'];

    // Determine the column to update/insert based on the value of $employeeIsWorking
    switch ($employeeIsWorking) {
        case "Employee_TimeInAM":
            $columnName = "Employee_TimeInAM";
            $errorMessage = "You have already timed in in the morning.";
            break;
        case "Employee_TimeOutAM":
            $columnName = "Employee_TimeOutAM";
            $errorMessage = "You have already timed out in the morning.";
            $requiredTimeInColumn = "Employee_TimeInAM";
            break;
        case "Employee_TimeInPM":
            $columnName = "Employee_TimeInPM";
            $errorMessage = "You have already timed in in the afternoon.";
            $requiredTimeInColumn = "Employee_TimeInPM";
            break;
        case "Employee_TimeOutPM":
            $columnName = "Employee_TimeOutPM";
            $errorMessage = "You have already timed out in the afternoon.";
            $requiredTimeInColumn = "Employee_TimeInPM"; // Assuming afternoon time out requires afternoon time in
            break;
        default:
            // Handle default case or error
            break;
    }

    // Check if a record already exists for the specified Employee_ID, Employee_Date, and column
$sql_check_existing = "SELECT $columnName FROM employee_log WHERE Employee_ID = ? AND Employee_Date = ?";
$stmt_check_existing = $conn->prepare($sql_check_existing);
$stmt_check_existing->bind_param("ss", $employeeID, $employeeDate);
$stmt_check_existing->execute();
$result_check_existing = $stmt_check_existing->get_result();

if ($result_check_existing->num_rows > 0) {
    // If a record exists for the employee and date, check if the timestamp for the specific type already exists
    $existing_row = $result_check_existing->fetch_assoc();
    $existing_timestamp = $existing_row[$columnName];

    if ($columnName == "Employee_TimeInAM" || $columnName == "Employee_TimeOutAM" ||
        $columnName == "Employee_TimeInPM" || $columnName == "Employee_TimeOutPM") {
        // For all cases, check if the timestamp is empty
        if (empty($existing_timestamp)) {
            // If timestamp does not exist, update the existing record with the new timestamp
            $sql = "UPDATE employee_log SET $columnName = CURRENT_TIMESTAMP WHERE Employee_ID = ? AND Employee_Date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $employeeID, $employeeDate);
        } else {
            // If timestamp already exists, send an error response with descriptive message
            echo "Error: " . $errorMessage;
            exit;
        }
    }
} else {
    // If no record exists, perform an insert
    $sql = "INSERT INTO employee_log (Employee_ID, Employee_Date, $columnName) VALUES (?, ?, CURRENT_TIMESTAMP)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $employeeID, $employeeDate);
}

    // Execute the SQL query
    if ($stmt->execute()) {
        // If the query executed successfully, send a success response
        echo "Timestamp saved successfully!";
    } else {
        // If there was an error, send an error response
        echo "Error: Failed to save timestamp.";
    }

    // Close the database connections and statements
    $stmt_check_existing->close();
    if (isset($stmt_check_timein)) {
        $stmt_check_timein->close();
    }
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, send an error response
    echo "Invalid request method!";
}
?>
