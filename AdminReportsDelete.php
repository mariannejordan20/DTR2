<?php
include 'connection.php';

// Check if it's a POST request and if the employeeId is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employeeId'])) {
    $employeeId = $_POST['employeeId'];

    // Delete from employee_log table
    $queryEmployeeLog = "DELETE FROM employee_log WHERE ID = '$employeeId'";
    $resultEmployeeLog = mysqli_query($conn, $queryEmployeeLog);

    // Delete from employee_information table
    $queryEmployeeInfo = "DELETE FROM employee_information WHERE Employee_ID = '$employeeId'";
    $resultEmployeeInfo = mysqli_query($conn, $queryEmployeeInfo);

    if ($resultEmployeeLog && $resultEmployeeInfo) {
        $response = ['status' => 'success', 'message' => 'Records deleted successfully'];
        echo json_encode($response);
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to delete records: ' . mysqli_error($conn)];
        echo json_encode($response);
    }
} else {
    // Handle invalid requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
